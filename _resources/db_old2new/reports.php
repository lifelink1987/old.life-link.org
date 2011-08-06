<?php

require_once ('_header.php');
require_once '../../libs/funcs/filesystem.php';
$media_path = realpath('../../../files/action_photos');

echo '<br><br>----------';
echo '<br>Copying `ll_members_reports` data to `member_reports`';

$sql = "
	TRUNCATE TABLE `lifelink`.`member_reports`;;
	TRUNCATE TABLE `lifelink`.`member_reports_has_actions`;;
";
$result = mquery($sql, $link);

$sql = "
	SELECT *
	FROM `lifelink_org`.`ll_members_reports`
	;;
";
$result = mquery($sql, $link);

if (mysql_num_rows($result) > 0) {
	while ($record = mysql_fetch_assoc($result)) {
		
		$sql = "
			INSERT INTO `lifelink`.`member_reports` (
				`member_reports_id`,
				`member_schools_number_fk`,
				`date`,
				`date_days`,
				`description`,
				`students`,
				`students_age`,
				`teachers`,
				`parents`,
				`contact`,
				`email_contact`,
				`datetime_registration`,
				`datetime_approval`,
				`feedback`
			) VALUES (
				%d,
				%d,
				'%s',
				'%s',
				'%s',
				%d,
				'%s',
				%d,
				%d,
				'%s',
				'%s',
				'%s',
				'%s',
				'%s'
			)
			;;
		";
		$sql = sprintf($sql, esc($record['id']), esc($record['schoolnumber']), esc($record['perfdate']), esc($record['perfdays']), esc($record['description']), esc($record['students']), esc($record['age']), esc($record['teachers']), esc($record['parents']), esc($record['actioncontact']), esc($record['actioncontactemail']), esc($record['regdate']), ($record['registered'] == 'yes' ? esc($record['regdate']) : 'NULL'), esc($record['addinfo']));
		mquery($sql, $link);
		
		$sql = "
			INSERT INTO `lifelink`.`member_reports_has_actions` (
				`member_reports_id_fk`,
				`actions_number_fk`
			) VALUES (
				%d,
				%d
			)
			ON DUPLICATE KEY UPDATE
				`member_reports_id_fk` = `member_reports_id_fk`
			;;
		";
		if ($record['actionnumber']) {
			$actions = explode(',', $record['actionnumber']);
			foreach ($actions as $action) {
				$sql_derive = sprintf($sql, $record['id'], $action);
				mquery($sql_derive, $link);
			}
		}
	}
}

$sql = "
	UPDATE `lifelink`.`member_reports`
	SET `datetime_approval` = DATE_ADD(`datetime_approval`, INTERVAL 3 DAY)
	WHERE `datetime_approval`
	;;
";
$result = mquery($sql, $link);

$sql = "
	SELECT `member_reports_id`
	FROM `lifelink`.`member_reports`
	;;
";
$result = mquery($sql, $link);

if (mysql_num_rows($result) > 0) {
	while ($record = mysql_fetch_assoc($result)) {
		if (! file_exists($media_path . '/' . $record['member_reports_id'])) {
			$extensions = 'NULL';
		} else {
			$extensions = array();
			
			$media = scandir($media_path . '/' . $record['member_reports_id']);
			
			foreach ($media as $media_document) {
				if (! extension($media_document) || extension($media_document) == 'ion' || substr($media_document, 0, 3) == 'tn_') {
					continue;
				}
				$extensions[strtolower(extension($media_document))] = TRUE;
			}
			
			$extensions = implode(',', array_keys($extensions));
		}
		
		$sql = "
			UPDATE `lifelink`.`member_reports` `r`
			SET `r`.`attachments` = '%s'
			WHERE `r`.`member_reports_id` = %d
			;;
		";
		$sql = sprintf($sql, esc($extensions), esc($record['member_reports_id']));
		mquery($sql, $link);
	}
}
