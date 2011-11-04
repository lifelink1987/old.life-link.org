<?php

db_reports::init();

class db_reports
{
	private static $db;

	static function init()
	{
		self::$db = new db();
	}

	static function exists($id, $registered = 0)
	{
		global $db_reports_name;
		$db =& self::$db;
		$registered = $registered?" AND registered = 'yes'":"";
		$result = $db->data_row("
			SELECT schoolnumber
			FROM $db_reports_name
			WHERE id=$id$registered
		");
		return (bool) $result;
	}

	static function get_list($country = null, $city = null, $schoolnumber = null, $actionnumber = null, $between = null, $photos = null, $orderby = null, $limit = null, $registered = 0, $tags = null)
	{
		global $db_reports_name, $db_countries_name, $db_schools_name;
		$db =& self::$db;
		if ($country)
		{
			$country = " AND c.codenumber=$country";
		}
		if ($city)
		{
			$city = " AND s.city='$city'";
		}
		if ($schoolnumber)
		{
			$schoolnumber = " AND s.schoolnumber=$schoolnumber";
		}
		if ($actionnumber)
		{
			$actionnumber = " AND r.actionnumber LIKE '%$actionnumber%'";
			/* daca actionnumber == 100,200,300,400 atunci cauta oricare actiune din capitole */
		}
		if ($photos)
		{
			$photos = " AND r.photos = 'yes'";
		}
		if (!$orderby)
		{
			$orderby = " ORDER BY r.perfdate DESC, r.regdate DESC, c.name ASC, s.city ASC, s.name ASC";
		}
		if ($limit)
		{
			$limit = " LIMIT $limit";
		}
		$registered = $registered?" AND r.registered = 'yes'":"";
		if ($tags)
		{
			$tags = "";
			if (!is_array($tags))
			{
				$tags = explode(',', $tags);
			}
			foreach ($tags as $tag)
			{
				$tags .= " AND FIND_IN_SET('$tag', r.tags)";
			}
		}
		$sql = "
			SELECT DISTINCT r.id
			FROM $db_schools_name s
			JOIN $db_countries_name c
				ON c.codenumber = s.country
			JOIN $db_reports_name r
				ON r.schoolnumber = s.schoolnumber
			WHERE 1=1$country$city$schoolnumber$actionnumber$between$photos$registered
			$orderby
			$limit
		";
		while ($result = $db->data_row($sql, 0))
		{
			$reports[] = $result[0];
		}
		$db->clear();
		return $reports;
	}

	static function get_raw($id)
	{
		global $db_reports_name;
		$db =& self::$db;
		$result = $db->data_assoc("
			SELECT *
			FROM $db_reports_name
			WHERE id=$id
		");
		return $result;
	}

	static function photo($file, $type = null)
	{
		global $tpl;
		$width_max = ($type == 'thumbnail')?$tpl['image_sizes']['action_tw']:$tpl['image_sizes']['action_pw'];
		$all = !($type == 'thumbnail');
		if (substr($file, 0 , 4) == 'icon'){
			list($tmp, $file) = split('/', $file);
			show_image(LL_ROOT . '/shared/icons/quartz/file_' . $file . '.png', $width_max, $tpl['image_sizes']['action_pr'], $all);
		} else {
			show_image(LL_ROOT . '/gallery_actions/' . $file, $width_max, $tpl['image_sizes']['action_pr'], $all);
		}
	}

	private static function fill_with_media ($id)
	{
		global $links;
		$result = array();
		$folder = LL_ROOT . "/gallery_actions/$id";
		return read_media_dir($folder, $links['members_get_photo'] . $id . '/', $links['members_get_thumbnail'] . $id . '/', $links['members_get_thumbnail']);
	}
	
	static function upload_photos($id, $unique)
	{
		if (!$unique) return false;
		$result = false;
		$folder = LL_ROOT . "/gallery_actions_upload/$unique";
		$new_folder = LL_ROOT . "/gallery_actions/$id";
		
		if ($handle = @opendir($folder))
		{
			while ($file = readdir($handle))
			{
				if (is_file($folder . '/' . $file))
				{
					@mkdir($new_folder, 0700, true);
					rename($folder . "/$file", $new_folder . "/$file");
					$result = true;
				}
			}
			closedir($handle);
			rmdir($folder);
		}
		return $result;
	}

	static function get($id, $raw_result = null)
	{
		global $db_reports_name;
		if (!$raw_result)
		{
			$raw_result = self::get_raw($id);
			if (!$raw_result)
			{
				return;
			}
		}
		$result['id'] = $raw_result['id'];
		$result['schoolnumber'] = $raw_result['schoolnumber'];
		$result = array_merge($result, db_actions::from_string($raw_result['actionnumber']));
		$result['description'] = self::$db->db2html($raw_result['description'], 0, 1);
		$result['students'] = (int) $raw_result['students'];
		$result['age'] = $raw_result['age'];
		$result['parents'] = (int) $raw_result['parents'];
		$result['teachers'] = (int) $raw_result['teachers'];
		$result['perfdate'] = $raw_result['perfdate'];
		$result['perfdays'] = $raw_result['perfdays'];
		$result['regdate'] = $raw_result['regdate'];
		$result['registered'] = (bool) ($raw_result['registered']=='yes');
		$result['addinfo'] = self::$db->db2html($raw_result['addinfo'], 0, 1);
		$result['media'] = file_exists(LL_ROOT . '/gallery_actions/' . $raw_result['id']);
		if ($result['media'])
		{
			$result['media'] = self::fill_with_media($result['id']);
			/*if (!$result['media'])
			{
				$db =& self::$db;
				$db->update("$db_reports_name", array('string_photos', 'no'), " AND id = " . $result['id']);
			}*/
		}

		if ($raw_result['actioncontactemail'])
		{
			$result['actioncontact'] = check_email(check_gender($raw_result['actioncontactemail']), $raw_result['actioncontact']);
		}

		if ($result['students'])
		{
			$result['info'][] .= $result['students'] . ' student(s)';
			if ($result['age'])
			{
				$result['info'][] .= 'aged ' . $result['age'];
			}
		}
		if ($result['teachers'])
		{
			$result['info'][] .= $result['teachers'] . ' teacher(s)';
		}
		if ($result['parents'])
		{
			$result['info'][] .= $result['parents'] . ' parent(s)';
		}
		if (isset($result['info']))
		{
			$result['info'] = implode(', ', $result['info']);
		}

		return $result;
	}

	static function get_full($id, $raw_result = null)
	{
		$result = self::get($id, $raw_result);
		if (!$result)
		{
			return;
		}
		$result['school'] = db_schools::get($result['schoolnumber']);
/*		$actionnumbers = $result['actionnumber'];
		$temp = db_actions::from_string($result['actionnumber']);
		$result['actions'] = $temp['actions'];
		$result['actionnumber'] = null;*/
		return $result;
	}

	static function get_years($starting_from = null)
	{
		global $db_reports_name;
		$db =& self::$db;
		if (!$starting_from)
		{
			$result = $db->data_row("
				SELECT YEAR(perfdate)
				FROM $db_reports_name
				WHERE perfdate
				ORDER BY perfdate
				LIMIT 1
			");
			$starting_from = $result[0];
		}
		for ($i = $starting_from; $i<=(int) date('Y'); $i++)
		{
			$years[] = $i;
		}
		return $years;
	}

	static function get_months($starting_from = null)
	{
		$db =& self::$db;
		if (!$starting_from)
		{
			$starting_from = 1;
		}
		for ($i = $starting_from; $i<=12; $i++)
		{
			$months[(int) $i] = date('F', strtotime("2000-$i-01"));
		}
		return $months;
	}

	static function insert($info, &$id = null, $passive = 0)
	{
		global $db_reports_name;
		$db =& self::$db;
		$info['regdate'] = date('Y-m-d');
		array_walk($info, 'trimtext');
		$info['actioncontact'] = check_gender($info['actioncontactgender'], true) . ucwords(strtolower(trim($info['actioncontact'])));
		$info['actioncontactemail'] = strtolower($info['actioncontactemail']);
		if (!$passive)
		{
			$db->insert("$db_reports_name", $info);
			$id = $db->insert_id();
		}
		return $info;

	}

	static function counter($country = null, $city = null, $schoolnumber = null, $actionnumber = null, $between = null, $photos = null, $registered = 0)
	{
		global $db_reports_name, $db_countries_name, $db_schools_name;
		$db =& self::$db;
		if ($country)
		{
			$country = " AND c.codenumber=$country";
		}
		if ($city)
		{
			$city = " AND s.city='$city'";
		}
		if ($schoolnumber)
		{
			$schoolnumber = " AND s.schoolnumber=$schoolnumber";
		}
		if ($actionnumber)
		{
			$actionnumber = " AND r.actionnumber LIKE '%$actionnumber%'";
		}
		if ($photos)
		{
			$photos = " AND r.photos = 'yes'";
		}
		$registered = $registered?" AND r.registered = 'yes'":"";
		$sql = "
			SELECT COUNT(*)
			FROM $db_schools_name s
			JOIN $db_countries_name c
				ON c.codenumber = s.country
			JOIN $db_reports_name r
				ON r.schoolnumber = s.schoolnumber
			WHERE 1=1$country$city$schoolnumber$actionnumber$between$photos$registered
		";
		$result = $db->data_row($sql, 0);
		$db->clear();
		return $result[0];
	}
}

?>