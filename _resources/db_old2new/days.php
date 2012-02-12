<?php

require_once('_header.php');

echo '<br><br>----------';
echo '<br>Copying `ll_lists_days` data to `days`';

$sql = "
	TRUNCATE TABLE `lifelink`.`days`;;
	TRUNCATE TABLE `lifelink`.`days_has_actions`;;
";
$result = mquery($sql, $link);

$sql = "
	SELECT *
	FROM `lifelink_org`.`ll_lists_days`
	;
";
$result = mquery($sql, $link);

if (mysql_num_rows($result) > 0) {
    while ($record = mysql_fetch_assoc($result)) {
    	
		$sql = "
			INSERT INTO `lifelink`.`days` (
				`type`,
				`month_day`,
				`month`,
				`day`
			) VALUES (
				'%s',
				%d,
				%d,
				'%s'
			)
			;;
		";
    	$sql = sprintf($sql, esc($record['type']), esc($record['day']), esc($record['month']), esc($record['title']));
    	mquery($sql, $link);
    	
		$sql = "
			INSERT INTO `lifelink`.`days_has_actions` (
				`days_id_fk`,
				`actions_number_fk`
			) VALUES (
				%d,
				%d
			)
			;;
		";
		if ($record['actionnumber']) {
    		$actions = explode(',', $record['actionnumber']);
			foreach ($actions as $action) {
	    		$sql_derive = sprintf($sql, mysql_insert_id($link), $action);
	    		mquery($sql_derive, $link);
			}
		}
    }
}
