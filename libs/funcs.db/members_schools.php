<?php

db_schools::init();

class db_schools
{
	private static $db;

	static function init()
	{
		self::$db = new db();
	}

	static function exists($schoolnumber, $registered = 0)
	{
		global $db_schools_name;
		$db =& self::$db;
		$registered = $registered?" AND registered = 'yes'":"";
		$result = $db->data_row("
			SELECT schoolnumber
			FROM $db_schools_name
			WHERE schoolnumber=$schoolnumber$registered
		");
		return (bool) $result;
	}

	static function get_list($country = null, $city = null, $namelike = null, $actionnumber = null, $between = null, $photos = null, $orderby = null, $limit = null, $registered = 0, $tags = null)
	{
		global $db_schools_name, $db_reports_name, $db_countries_name;
		$db =& self::$db;
		if ($country)
		{
			$country = " AND c.codenumber=$country";
		}
		if ($city)
		{
			$city = " AND s.city='$city'";
		}
		if ($namelike)
		{
			if (is_int($namelike))
			{
				$namelike = " AND s.name LIKE '%$namelike%'";
			}
			else {
				$namelike = mb_strtolower($namelike);
				$namelike = bin2hex("[[:<:]]$namelike");
				$namelike = " AND LOWER(s.name) REGEXP UNHEX('$namelike')";
			}
		}
		
		if ($actionnumber)
		{
			$actionnumber = " AND r.actionnumber LIKE '%$actionnumber%'";
		}
		if ($photos)
		{
			$photos = " AND r.photos = 'yes'";
		}
		if (!$orderby)
		{
			$orderby = " ORDER BY c.name, s.city, s.name";
		}
		if ($limit)
		{
			$limit = " LIMIT $limit";
		}
		$registered = $registered?" AND s.registered = 'yes'":"";
		if ($tags)
		{
			if  (!is_array($tags)) {
				$tags = explode(",", $tags);
			}
			foreach ($tags as $tag) {
				$tags_cond .= " AND FIND_IN_SET('$tag', s.tags)";
			}
			$tags = $tags_cond;
		}
		$sql = "
			SELECT DISTINCT s.schoolnumber
			FROM $db_schools_name s
			JOIN $db_countries_name c
				ON c.codenumber = s.country
			JOIN $db_reports_name r
				ON r.schoolnumber = s.schoolnumber
			WHERE 1=1$country$city$namelike$actionnumber$between$photos$registered$tags
			$orderby
			$limit
		";
		while ($result = $db->data_row($sql, 0))
		{
			$schools[] = $result[0];
		}
		$db->clear();
		return $schools;
	}
	
	static function gets_bynamelike($namelike)
	{
		if ((strlen($namelike) > 2) || (is_int($namelike)))
		{
			$schools_list = db_schools::get_list(null, null, $namelike, null, null, null, ' ORDER BY c.name, s.city, s.name');
			if ($schools_list)
			{
				foreach ($schools_list as $school_id)
				{
					$schools[] = db_schools::get($school_id);
				}
			}
			else
			{
				$result_message = 'There is no school registered with a name like "' . $namelike . '".';
			}
		}
		else
		{
			$result_message = 'Name search field needs to be numeric or at least 3 characters.';
		}
		return array('results' => $schools, 'result_message' => $result_message);
	}

	static function get_raw($schoolnumber)
	{
		global $db_schools_name;
		$db =& self::$db;
		$result = $db->data_assoc("
			SELECT *
			FROM $db_schools_name
			WHERE schoolnumber=$schoolnumber
		");
		return $result;
	}

	static function get($schoolnumber, $raw_result = null)
	{
		if (!$raw_result)
		{
			$raw_result = self::get_raw($schoolnumber);
			if (!$raw_result)
			{
				return;
			}
		}
		$result['schoolnumber'] = check_null($raw_result['schoolnumber']);
		$result['name'] = check_null($raw_result['name']);
		$result['address'] = check_null($raw_result['address']);
		$result['city'] = check_null($raw_result['city']);
		$result['zipcode'] = check_null($raw_result['zipcode']);
		$result['country'] = check_null($raw_result['country']);
		$result['countryname'] = db_countries::get_name($result['country']);
		$result['countryiso'] = db_countries::get_iso($result['country']);
		$result['countryiso2'] = db_countries::get_iso2($result['country']);
		$result['countryflag'] = db_countries::get_flag($result['country']);
		$result['fax'] = check_null($raw_result['fax']);
		$result['tel'] = check_null($raw_result['tel']);
		$result['website'] = check_website($raw_result['website']);
		$result['email'] = check_email($raw_result['email']);
		$result['studentcontact'] = check_email($raw_result['studentcontactemail'], check_gender($raw_result['studentcontact']));
		$result['teachercontact'] = check_email($raw_result['teachercontactemail'], check_gender($raw_result['teachercontact']));
		$result['studentcontact_raw'] = check_gender($raw_result['studentcontact']);
		$result['teachercontact_raw'] = check_gender($raw_result['teachercontact']);
		$result['studentcontactemail'] = $raw_result['studentcontactemail'];
		$result['teachercontactemail'] = $raw_result['teachercontactemail'];
		$result['studentcontactplural'] = check_plural($raw_result['studentcontact']);
		$result['teachercontactplural'] = check_plural($raw_result['teachercontact']);
		$result['students'] = (int) $raw_result['students'];
		$result['teachers'] = (int) $raw_result['teachers'];
		$result['staff'] = (int) $raw_result['staff'];
		$result['registered'] = (bool) ($raw_result['registered']=='yes');
		$result['allemails'] = mailto(array($raw_result['email'], $raw_result['teachercontactemail'], $raw_result['studentcontactemail']));
		$result['update'] = $raw_result['update'];
		$result['tags'] = explode(",", $raw_result['tags']);

		return $result;
	}

	static function get_countries($orderby = null)
	{
		global $db_schools_name, $db_countries_name;
		$db =& self::$db;
		if (!$orderby)
		{
			$orderby = " ORDER BY c.name";
		}
		$sql = "
			SELECT DISTINCT c.codenumber, c.name, c.iso, c.iso2
			FROM $db_countries_name c
			JOIN $db_schools_name s
				ON s.country = c.codenumber
			$orderby
		";
		$i = -1;
		while ($result = $db->data_assoc($sql, 0))
		{
			$i++;
			$countries[$i]['name'] = $result['name'];
			$countries[$i]['codenumber'] = $result['codenumber'];
			$countries[$i]['iso'] = $result['iso'];
			$countries[$i]['iso2'] = $result['iso2'];
			$countries[$i]['flag'] = db_countries::get_flag($result['iso2']);
		}
		$db->clear();
		return $countries;
	}

	static function get_schools_country_city($orderby = null)
	{
		global $db_schools_name, $db_countries_name;
		$db =& self::$db;
		if (!$orderby)
		{
			$orderby = " ORDER BY c.name, s.city, s.name";
		}
		$sql = "
			SELECT c.name, s.city, s.name AS sname, s.schoolnumber
			FROM $db_countries_name c
			JOIN $db_schools_name s
				ON s.country = c.codenumber
			$orderby
		";
		$i = -1;
		while ($result = $db->data_assoc($sql, 0))
		{
			$i++;
			$schools[$i]['countryname'] = $result['name'];
			$schools[$i]['country'] = $result['codenumber'];
			$schools[$i]['city'] = $result['city'];
			$schools[$i]['name'] = $result['sname'];
			$schools[$i]['schoolnumber'] = $result['schoolnumber'];
		}
		$db->clear();
		return $schools;
	}

	static function get_cities($country, $orderby = null, $citylike = null)
	{
		global $db_schools_name, $db_countries_name;
		$db =& self::$db;
		if (!$country)
		{
			return;
		}
		if (!$orderby)
		{
			$orderby = " ORDER BY city";
		}
		$sql = "
			SELECT DISTINCT s.city
			FROM $db_countries_name c
			JOIN $db_schools_name s
				ON s.country = c.codenumber
			WHERE c.codenumber=$country AND s.city IS NOT NULL$citylike
			$orderby
		";
		while ($result = $db->data_assoc($sql, 0))
		{
			$cities[] = $result['city'];
		}
		$db->clear();
		return $cities;
	}

	static function get_last_schoolnumber()
	{
		global $db_schools_name;
		$db =& self::$db;
		$result = $db->data_row("
			SELECT schoolnumber
			FROM $db_schools_name
			ORDER BY schoolnumber DESC
			LIMIT 1
		");
		//	WHERE registered
		return $result[0];
	}
	
	static function get_free_schoolnumber()
	{
		global $db_schools_name;
		$db =& self::$db;
		//select last unused
		$result = $db->data_row("
			SELECT t1.schoolnumber +1 AS missing_schoolnumber
			FROM ll_members_schools t1
			LEFT JOIN ll_members_schools t2 ON t1.schoolnumber +1 = t2.schoolnumber
			WHERE t2.schoolnumber IS NULL
		");
		if ($result[0])
			return $result[0];
		return self::get_last_schoolnumber()+1;
	}

	static function insert($info, &$schoolnumber, $passive = 0)
	{
		global $db_schools_name;
		$db =& self::$db;
		$info['schoolnumber'] = self::get_free_schoolnumber();
		array_walk($info, 'trimtext');
		$info['email'] = strtolower(trimmultiple($info['email']));
		$info['tel'] = trimmultiple($info['tel']);
		$info['fax'] = trimmultiple($info['fax']);
		$i = 1;
		while ($info['studentcontact' . $i])
		{
			$info['studentcontact' . $i] = check_gender($info['studentcontactgender' . $i], 1) . ucwords(strtolower(trim($info['studentcontact' . $i])));
			$info['studentcontact'][] = $info['studentcontact' . $i];
			$info['studentcontactemail'][] = strtolower($info['studentcontactemail' . $i]);
			$i++;
		}
		$i = 1;
		while ($info['teachercontact' . $i])
		{
			$info['teachercontact' . $i] = check_gender($info['teachercontactgender' . $i], 1) . ucwords(strtolower(trim($info['teachercontact' . $i])));
			$info['teachercontact'][] = $info['teachercontact' . $i];
			$info['teachercontactemail'][] = strtolower($info['teachercontactemail' . $i]);
			$i++;
		}
		$info['studentcontact'] = @implode(', ', $info['studentcontact']);
		$info['studentcontactemail'] = @implode(', ', $info['studentcontactemail']);
		$info['teachercontact'] = @implode(', ', $info['teachercontact']);
		$info['teachercontactemail'] = @implode(', ', $info['teachercontactemail']);
		
		if (isset($info['steachers']) || isset($info['sstudents'])){
			$info['teachers'] = $info['steachers'];
			$info['students'] = $info['sstudents'];
		}
		if (!$passive)
		{
			$db->insert("$db_schools_name", $info);
			$schoolnumber = $info['schoolnumber'];
		}
		return $info;
	}

	static function counter($country = null, $city = null, $namelike = null, $actionnumber = null, $between = null, $photos = null, $registered = 0, $tags = null)
	{
		global $db_schools_name, $db_reports_name, $db_countries_name;
		$db =& self::$db;
		if ($country)
		{
			$country = " AND c.codenumber=$country";
		}
		if ($city)
		{
			$city = " AND s.city='$city'";
		}
		if ($namelike)
		{
			if (is_int($namelike))
			{
				$namelike = " AND s.name LIKE '% $namelike%'";
			}
			else
			{
				$namelike = strtolower($namelike);
				$namelike = " AND LOWER(s.name) LIKE '%$namelike%'";
			}
		}
		if ($actionnumber)
		{
			$actionnumber = " AND r.actionnumber LIKE '%$actionnumber%'";
		}
		if ($photos)
		{
			$photos = " AND r.photos = 'yes'";
		}
		$registered = $registered?" AND s.registered = 'yes'":"";
		if ($tags)
		{
			if  (!is_array($tags)) {
				$tags = explode(",", $tags);
			}
			foreach ($tags as $tag) {
				$tags_cond .= " AND FIND_IN_SET('$tag', s.tags)";
			}
			$tags = $tags_cond;
		}
		$sql = "
			SELECT COUNT(DISTINCT s.schoolnumber)
			FROM $db_schools_name s
			JOIN $db_countries_name c
				ON c.codenumber = s.country
			JOIN $db_reports_name r
				ON r.schoolnumber = s.schoolnumber
			WHERE 1=1$country$city$namelike$actionnumber$between$photos$registered$tags
		";
		$result = $db->data_row($sql, 0);
		$db->clear();
		return $result[0];
	}

	static function counter_countries()
	{
		global $db_schools_name;
		$db =& self::$db;
		$result = $db->data_row("
			SELECT COUNT(*)
			FROM (
				SELECT DISTINCT country
				FROM $db_schools_name
				WHERE registered
			) tmp_count
		");
		return $result[0];
	}
}

?>