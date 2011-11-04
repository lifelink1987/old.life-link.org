<?php

db_contacts::init();

class db_contacts
{
	private static $db;
	
	static function init()
	{
		self::$db = new db();
	}
	
	static function gets($department = null, $nickname = null, $visible = 1)
	{
		global $db_contacts_name;
		$db =& self::$db;
		if ($department)
		{
			$department = ucfirst(strtolower($department));
			$department = " AND LOWER(department) = '$department'";
		}
		if ($nickname)
		{
			$nickname = strtolower($nickname);
			$nickname = " AND LOWER(nickname) = '$nickname'";
		}
		if ($visible)
		{
			$visible = " AND visible = 'yes'";
		}
		$sql = "
			SELECT *
			FROM $db_contacts_name
			WHERE 1=1$department$nickname$invisible
			ORDER BY position ASC, SUBSTRING_INDEX(fullname, ' ', -1) ASC
		";
		$i = -1;
		while ($result = $db->data_assoc($sql, 0))
		{
			$i++;
			$contacts[$i]['titlename'] = trim($result['gender'] . ' ' . $result['fullname']);
			$contacts[$i]['gender'] = $result['gender'];
			$contacts[$i]['name'] = $result['fullname'];
			$contacts[$i]['firstname'] = preg_replace('@ .*@', '', $result['fullname']);
			$contacts[$i]['nickname'] = $result['nickname'];
			$contacts[$i]['title'] = $db->db2html($result['title']);
			$contacts[$i]['department'] = $result['department'];
			$contacts[$i]['email'] = $result['email'];
		}
		$db->clear();
		return $contacts;
	}
	

}

?>