<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

define('LL_DB_HOST', 'sql.life-link.org');
define('LL_DB_USER', '');
define('LL_DB_PASS', '');

function esc($text) {
	global $link;
	return mysql_real_escape_string($text, $link);
}

$link = mysql_connect(LL_DB_HOST, LL_DB_USER, LL_DB_PASS);
if (! $link) {
	die('<br>Could not connect: ' . mysql_error());
}

echo '<br>Connected successfully';

mysql_query('SET NAMES UTF8', $link);
mysql_query('SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0', $link);
mysql_query('SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0', $link);

function trim_ws($item) {
	//Remove outside spaces
	$item = trim($item);

	//Remove inside spaces when more than 1
	$item = preg_replace("/ {2,}/", " ", $item);

	//Remove inside spaces when more than 1
	$item = preg_replace("/\t{2,}/", "\t", $item);

	//Change double quotes to single quotes - why?!?!
	//$item = preg_replace("/\"/", "'", $item);


	//Remove new lines when more than 2
	$item = preg_replace("/\n{3,}/", "\n\n", $item);
	return $item;
}

function mquery($sql, $link) {
	$sqls = explode(';;', $sql);
	$result = FALSE;
	foreach ($sqls as $sql) {
		$sql = trim_ws($sql);
		if (! $sql)
			continue;
		echo '<br><br>' . $sql;
		$result = mysql_query($sql, $link);
		if ($result === FALSE) {
			die('<br><br>MySQL Error: ' . mysql_error());
		}
	}
	return $result;
}