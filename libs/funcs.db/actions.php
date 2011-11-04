<?php

db_actions::init();

class db_actions
{
	private static $db;
	
	static function init()
	{
		self::$db = new db();
	}

	static function exists($actionnumber, $notold = null)
	{
		global $db_actions_name;
		$db =& self::$db;
		$actionnumber = self::clean_actionnumber($actionnumber);
		if (!$actionnumber)
		{
			return false;
		}
		if ($notold)
		{
			$notold = " AND old = 'no'";
		}
		$result = $db->data_row("
			SELECT actionnumber
			FROM $db_actions_name
			WHERE actionnumber=$actionnumber$notold
		");
		return (bool) $result;
	}
	
	static function gets($chapter = null, $notold = null)
	{
		global $db_actions_name;
		$db =& self::$db;
		if ($chapter)
		{
			$chapter = self::get_chapter($chapter);
			$next_chapter = $chapter+100;
			$chapter = " AND actionnumber >= {$chapter} AND actionnumber < {$next_chapter}";
		}
		if ($notold)
		{
			$notold = " AND old = 'no'";
		}
		$sql = "
			SELECT actionnumber, name, old
			FROM $db_actions_name
			WHERE 1=1$chapter$notold
			ORDER BY actionnumber
		";
		$i = -1;
		while ($result = $db->data_assoc($sql, 0))
		{
			$i++;
			$actions[$i]['actionnumber_raw'] = $result['actionnumber'];
			$actions[$i]['actionnumber'] = self::format_actionnumber($result['actionnumber']);
			$actions[$i]['name'] = htmlspecialchars($result['name']);
			$actions[$i]['old'] = ($result['old'] == 'yes')?true:false;
			$actions[$i]['ischapter'] = self::is_chapter($result['actionnumber']);
		}
		$db->clear();
		return $actions;
	}

	static function get_raw($actionnumber, $notold)
	{
		global $db_actions_name;
		$db =& self::$db;
		$actionnumber = self::clean_actionnumber($actionnumber);
		if (!self::exists($actionnumber)) 
		{
			return;
		}
		if ($notold)
		{
			$notold = " AND old = 'no'";
		}
		$result = $db->data_assoc("
			SELECT *
			FROM $db_actions_name
			WHERE actionnumber=$actionnumber$notold
		");
		return $result;
	}
	
	static function get($actionnumber, $notold = null)
	{
		$raw_result = self::get_raw($actionnumber, $notold);
		if (!$raw_result)
		{
			return;
		}
		$result['actionnumber'] = self::format_actionnumber($raw_result['actionnumber']);
		$result['actionnumber_raw'] = $raw_result['actionnumber'];
		$result['name'] = htmlspecialchars($raw_result['name']);
		$result['theory'] = self::db2html($raw_result['theory']);
		$result['action'] = self::db2html($raw_result['action']);
		$result['stepbystep'] = self::db2html($raw_result['stepbystep']);
		$result['addtitle'] = htmlspecialchars($raw_result['addtitle']);
		$result['addinfo'] = self::db2html($raw_result['addinfo']);
		$result['old'] = (bool) ($raw_result['old'] == 'yes');
		$result['chapter'] = self::get_chapter($raw_result['actionnumber']);
		return $result;
	}
	
	static function get_chapter($actionnumber)
	{
		$result = self::clean_actionnumber($actionnumber);
		return $result[0] . '00';
	}
	
	static function is_chapter($actionnumber)
	{
		$result = self::clean_actionnumber($actionnumber);
		$result = substr($result, 1);
		return ((int) $result == 0);
	}
	
	static function clean_actionnumber($actionnumber)
	{
		$result = $actionnumber;
		$result = str_replace(':', '', $result);
		$result = str_replace('_', '', $result);
		$result = str_replace(' ', '', $result);
		$result = str_pad($result, 3, '0', STR_PAD_RIGHT);
		return $result;
	}

	static function format_actionnumber($actionnumber)
	{
		$result = self::clean_actionnumber($actionnumber);
		$result = $result[0] . ':' . $result[1] . $result[2];
		return $result;
	}
	
	static function db2html($text)
	{
		$text = trim($text);
		if (!$text)
		{
			return;
		}
		$text = preg_replace('@[|\r]\n([|\r]\n)+@', '</li><li class="llspaced lljustify">', $text);
		$text = '<ul><li class="llspaced lljustify">' . $text . '</li></ul>';
		$text = self::$db->db2html($text, 1);
		return $text;
	}
	
	static function from_string($actionnumbers)
	{
		$result = array();
		$temp = explode(',', $actionnumbers);
		foreach ($temp as $actionnumber)
		{
			$actionnumber = trim($actionnumber);
			if (db_actions::exists($actionnumber))
			{
				$action = db_actions::get($actionnumber);
				$action['chapter'] = db_actions::get($action['chapter']);
				$result['actions'][] = $action;
				$result['actionnumber'][] = $actionnumber;
			}
		}
		return $result;
	}
}

?>