<?php

db_countries::init();

class db_countries
{
	private static $db;
	
	static function init()
	{
		self::$db = new db();
	}
	
	static function gets($negative = 0, $orderby = null)
	{
		global $db_countries_name;
		$db =& self::$db;
		if ($negative)
		{
			$negative = '';
		}
		else {
			$negative = " AND codenumber > 0";
		}
		if (!$orderby)
		{
			$orderby = " ORDER BY name";
		}
		$sql = "
			SELECT *
			FROM $db_countries_name
			WHERE 1=1$negative
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
			$countries[$i]['flag'] = self::get_flag($result['iso2']);
			$countries[$i]['phone'] = $result['phone'];
		}
		$db->clear();
		return $countries;
	}
	
	static function get_name_raw($codenumber)
	{
		global $db_countries_name;
		$db =& self::$db;
		$result = $db->data_assoc("
			SELECT name
			FROM $db_countries_name
			WHERE codenumber=$codenumber
		");
		if ($result)
		{
			return $result['name'];
		}
	}
	
	static function get_name($codenumber)
	{
		$result = self::get_name_raw($codenumber);
		$result = self::format_name($result);
		return $result;
	}

	static function get_iso($codenumber)
	{
		global $db_countries_name;
		$db =& self::$db;
		$result = $db->data_assoc("
			SELECT iso
			FROM $db_countries_name
			WHERE codenumber=$codenumber
		");
		if ($result)
		{
			return $result['iso'];
		}
	}

	static function get_iso2($codenumber)
	{
		global $db_countries_name;
		$db =& self::$db;
		$result = $db->data_assoc("
			SELECT iso2
			FROM $db_countries_name
			WHERE codenumber=$codenumber
		");
		if ($result)
		{
			return $result['iso2'];
		}
	}

	static function get_flag($codenumberOrIso2)
	{
		if (is_numeric($codenumberOrIso2))
		{
			$iso2 = self::get_iso2($codenumberOrIso2);
		}
		else {
			$iso2 = $codenumberOrIso2;
		}
		if (file_exists(LL_ROOT . '/pages/flags/' . strtolower($iso2) . '.gif'))
		{
			return strtolower($iso2) . '.gif';
		}
	}

	static function get_phone($codenumber)
	{
		global $db_countries_name;
		$db =& self::$db;
		$result = $db->data_assoc("
			SELECT iso
			FROM $db_countries_name
			WHERE codenumber=$codenumber
		");
		if ($result)
		{
			return $result['phone'];
		}
	}

	static function get_codenumber_by_iso($iso)
	{
		global $db_countries_name;
		$db =& self::$db;
		$result = $db->data_assoc("
			SELECT codenumber
			FROM $db_countries_name
			WHERE iso = '$iso'
		");
		if ($result)
		{
			return $result['codenumber'];
		}
	}

	static function get_codenumber_by_namelike($namelike)
	{
		global $db_countries_name;
		$db =& self::$db;
		$namelike = strtolower($namelike);
		$result = $db->data_assoc("
			SELECT codenumber
			FROM $db_countries_name
			WHERE LOWER(name) LIKE '%$namelike%'
		");
		if ($result)
		{
			return $result['codenumber'];
		}
	}
	
	static function format_name($name)
	{
		$result = explode(',', $name);
		$result = trim(trim($result[1]) . ' ' . trim($result[0]));
		return $result;
	}
}

?>