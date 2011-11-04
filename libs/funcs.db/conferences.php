<?php

db_conferences::init();

class db_conferences
{
	private static $db;

	static function init()
	{
		self::$db = new db();
	}

	static function get_raw($id)
	{
		global $db_conferences_name;
		$db =& self::$db;
		$result = $db->data_assoc("
			SELECT *
			FROM $db_conferences_name
			WHERE id=$id
		");
		return $result;
	}

	static function get($id)
	{
		$raw_result = self::get_raw($id);
		if (!$raw_result)
		{
			return;
		}
		$result['id'] = $raw_result['id'];
		$result['country'] = $raw_result['country'];
		$result['countryname'] = db_countries::get_name($result['country']);
		$result['major'] = (bool) ($raw_result['major'] == 'yes');
		if ($result['major'])
		{
			$result['major_count'] = self::get_major($result['id']);
			$result['major_count_ending'] = ordinal_ending($result['major_count']);
			$result['major_title'] = $result['major_count'] . $result['major_count_ending'] . ' Life-Link Conference';
		}
		$result['startdate'] = $raw_result['startdate'];
		$result['enddate'] = $raw_result['enddate'];

		$result['title'] = htmlspecialchars($raw_result['title']);
		if (!$result['title'])
		{
			$result['title'] = $result['major_title'];
			$result['major_title'] = '';
		}
		$result['description'] = self::$db->db2html($raw_result['description'], 1);
		$result['gallery_slug'] = $raw_result['gallery_slug'];
		$result['survey_slug'] = $raw_result['survey_slug'];
		$result['logo'] = (bool) $raw_result['logo'];
		$result = array_merge($result, db_actions::from_string($raw_result['actionnumber']));
		$result['links'] = db_wordpress::get_links(db_wordpress::get_category_id('Conferences'), 'conference', $result['id']);
		return $result;
	}

	static function get_list($between = null, $limit = null)
	{
		global $db_conferences_name;
		$db =& self::$db;
		if ($limit)
		{
			$limit = " LIMIT $limit";
		}
		$sql = "
			SELECT id
			FROM $db_conferences_name
			WHERE 1=1$between
			ORDER BY enddate DESC
			$limit
		";
		while ($result = $db->data_row($sql, 0))
		{
			$conferences[] = $result[0];
		}
		$db->clear();
		return $conferences;
	}

	static function get_major($id)
	{
		global $db_conferences_name;
		$db =& self::$db;
		$raw_result = self::get_raw($id);
		$result = $db->data_row("
			SELECT SUM(major = 'yes')
			FROM $db_conferences_name
			WHERE startdate < '{$raw_result['startdate']}'
				AND id!=$id
			ORDER BY startdate
		");
		$result[0]++;
		return $result[0];

	}

	static function counter($condition = null)
	{
		global $db_conferences_name;
		$db =& self::$db;
		return $db->count("$db_conferences_name", $condition);
	}

	static function output_logo($id, $type = null)
	{
		global $tpl;
		ob_clean();
		$raw_result = self::get_raw($id);
		if ($raw_result)
		{
			# Get image location
			if (($img = imagecreatefromstring($raw_result['logo'])) === false)
			{
				error_image($tpl['image_sizes']['clogo_pr']);
			}
			
			# Resize
			$width_max = ($type == 'thumbnail')?$tpl['image_sizes']['clogo_tw']:$tpl['image_sizes']['clogo_pw'];
			$img = resize_image($img, $width_max, $tpl['image_sizes']['clogo_pr'], true);
			
			# Create error image if necessary
			if (!$img) error_image($tpl['image_sizes']['clogo_pr']);
			
			# Display the image
			@ob_clean();
			header("Content-type: image/jpeg");
			imagejpeg($img);
		}
		exit();
	}
}

?>