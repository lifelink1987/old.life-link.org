<?php

db_days::init();

class db_days
{
	private static $db;

	static function init()
	{
		self::$db = new db();
	}

	static function gets($condition = null, $orderby = null, $limit = null)
	{
		global $db_days_name;
		$db =& self::$db;
		if (!$orderby)
		{
			$orderby = " ORDER BY month, day";
		}
		if ($limit)
		{
			$limit = " LIMIT $limit";
		}
		$sql = "
			SELECT *, STR_TO_DATE(CONCAT(YEAR(CURDATE()), '-', month, '-', day), '%Y-%m-%d') as date
			FROM $db_days_name
			WHERE 1=1$condition
			$orderby
			$limit
		";
		$i = -1;
		while ($result = $db->data_assoc($sql, 0))
		{
			$i++;
			$days[$i]['type'] = ($result['type'] == 'un')?'UN':ucwords($result['type']);
			$days[$i]['day'] = $result['day'];
			$days[$i]['month'] = $result['month'];
			$days[$i]['startdate'] = $result['date'];
			$days[$i]['enddate'] = $result['date'];
			$days[$i]['title'] = $result['title'];
			$days[$i] = array_merge($days[$i], db_actions::from_string($result['actionnumber']));
		}
		$db->clear();
		return $days;
	}
}

?>