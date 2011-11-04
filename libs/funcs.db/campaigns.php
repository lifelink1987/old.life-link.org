<?php

db_campaigns::init();

class db_campaigns
{
	private static $db;

	static function init()
	{
		self::$db = new db();
	}

	static function get_list($between = null, $limit = null)
	{
		global $db_campaigns_name;
		$db =& self::$db;
		if ($limit)
		{
			$limit = " LIMIT $limit";
		}
		$sql = "
			SELECT id
			FROM $db_campaigns_name
			WHERE 1=1$between
			ORDER BY enddate DESC
			$limit
		";
		while ($result = $db->data_row($sql, 0))
		{
			$campaigns[] = $result[0];
		}
		$db->clear();
		return $campaigns;
	}

	static function get_raw($id)
	{
		global $db_campaigns_name;
		$db =& self::$db;
		$result = $db->data_assoc("
			SELECT *
			FROM $db_campaigns_name
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
		$result['startdate'] = $raw_result['startdate'];
		$result['enddate'] = $raw_result['enddate'];
		$result['title'] = htmlspecialchars($raw_result['title']);
		$result['subtitle'] = htmlspecialchars($raw_result['subtitle']);
		$result['description'] = self::$db->db2html($raw_result['description'], 1);
		$result['gallery_slug'] = $raw_result['gallery_slug'];
		$result['survey_slug'] = $raw_result['survey_slug'];
		$result['logo'] = (bool) $raw_result['logo'];
		$result = array_merge($result, db_actions::from_string($raw_result['actionnumber']));
		$result['links'] = db_wordpress::get_links(db_wordpress::get_category_id('Campaigns'), 'campaign', $result['id']);
		return $result;
	}
	
	static function counter($condition = null)
	{
		global $db_campaigns_name;
		$db =& self::$db;
		return $db->count("$db_campaigns_name", $condition);
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