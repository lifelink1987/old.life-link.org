<?php

db_reactions::init();

class db_reactions
{
	private static $db;
	
	static function init()
	{
		self::$db = new db();
	}
	
	static function gets($country = null, $limit = null)
	{
		global $db_reactions_name, $db_countries_name;
		$db =& self::$db;
		if ($country)
		{
			$country = " AND country = $country";
		}
		if ($limit)
		{
			$limit = " LIMIT $limit";
		}
		$sql = "
			SELECT *
			FROM $db_reactions_name r
			JOIN $db_countries_name c
				ON r.country = c.codenumber
			WHERE 1=1$country
			ORDER BY c.name, r.info
			$limit
		";
		$i = -1;
		while ($result = $db->data_assoc($sql, 0))
		{
			$i++;
			$reactions[$i]['country'] = $result['codenumber'];
			$reactions[$i]['countryname'] = $result['name'];
			$reactions[$i]['countryiso'] = $result['iso'];
			$reactions[$i]['info'] = $db->db2html($result['info'], 1);
			$reactions[$i]['reaction'] = $db->db2html($result['reaction'], 1);
		}
		$db->clear();
		return $reactions;
	}

	static function get_countries($orderby = null)
	{
		global $db_reactions_name, $db_countries_name;
		$db =& self::$db;
		if (!$orderby)
		{
			$orderby = " ORDER BY c.name";
		}
		$sql = "
			SELECT DISTINCT c.codenumber, c.name, c.iso
			FROM $db_countries_name c
			JOIN $db_reactions_name r
				ON r.country = c.codenumber
			$orderby
		";
		$i = -1;
		while ($result = $db->data_assoc($sql, 0))
		{
			$i++;
			$countries[$i]['name'] = $result['name'];
			$countries[$i]['codenumber'] = $result['codenumber'];
			$countries[$i]['iso'] = $result['iso'];
		}
		$db->clear();
		return $countries;
	}

	static function counter($condition = null)
	{
		global $db_reactions_name;
		$db =& self::$db;
		return $db->count("$db_reactions_name", $condition);
	}
}

?>