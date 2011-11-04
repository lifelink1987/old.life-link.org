<?php

db_organisations::init();

class db_organisations
{
	private static $db;
	
	static function init()
	{
		self::$db = new db();
	}
	
	static function gets($namelike = null, $email = 0, $website = 0, $limit = null)
	{
		global  $db_organisations_name;
		$db =& self::$db;
		if ($namelike)
		{
			$namelike = strtolower($namelike);
			$namelike = " AND LOWER(name) LIKE '%$namelike%'";
		}
		if ($email)
		{
			$email = " AND NOT ISNULL(email)";
		}
		if ($website)
		{
			$website = " AND NOT ISNULL(website)";
		}
		if ($limit)
		{
			$limit = " LIMIT $limit";
		}
		$sql = "
			SELECT *
			FROM $db_organisations_name
			WHERE 1=1$namelike$email$website
			$limit
		";
		$i = -1;
		while ($result = $db->data_assoc($sql, 0))
		{
			$i++;
			$organisations[$i]['name'] = $result['name'];
			$organisations[$i]['address'] = $db->db2html($result['address']);
			$organisations[$i]['tel'] = check_null($result['tel']);
			$organisations[$i]['fax'] = check_null($result['fax']);
			$organisations[$i]['email'] = check_email($result['email']);
			$organisations[$i]['website'] = check_website($result['website']);
			$organisations[$i]['addinfo'] = $db->db2html($result['addinfo'], 1);
		}
		$db->clear();
		return $organisations;
	}

	static function counter($condition = null)
	{
		global $db_organisations_name;
		$db =& self::$db;
		return $db->count("$db_organisations_name", $condition);
	}
}

?>