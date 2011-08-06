<?php

require_once('_header.php');

echo '<br><br>----------';
echo '<br>Copying `ll_lists_actions` data to `actions`';

$sql = "
	TRUNCATE TABLE `lifelink`.`actions`;;
";
$result = mquery($sql, $link);

$sql = "
	INSERT INTO `lifelink`.`actions` (
		`actions_number`,
		`action`,
		`description_theory`,
		`description_action`,
		`description_stepbystep`,
		`extra_title`,
		`extra_info`,
		`is_old`
	) SELECT * FROM `lifelink_org`.`ll_lists_actions`
	;;
";
mquery($sql, $link);

/*$sql = "
	SELECT `actions_number`
	FROM `lifelink`.`actions`
	;;
";
$result = mquery($sql, $link);

if (mysql_num_rows($result) > 0) {
	while ($record = mysql_fetch_assoc($result)) {
		$sql1 = "
			INSERT INTO `lifelink`.`tags` (
				tag
			) VALUES (
				'%s'
			)
			ON DUPLICATE KEY UPDATE
				`tags_id` = LAST_INSERT_ID(`tags_id`)
			;;
		";
		$sql2 = "
			INSERT INTO `lifelink`.`actions_has_tags` (
				`actions_number_fk`,
				`tags_id_fk`
			) VALUES (
				%d,
				LAST_INSERT_ID()
			)
			;;
		";
		
		$sql_derive = sprintf($sql1, 'action:' . $record['actions_number']);
		mquery($sql_derive, $link);
		$sql_derive = sprintf($sql2, $record['actions_number']);
		mquery($sql_derive, $link);
	}
}*/