<?php

echo '<br><br>----------';
echo '<br>Copying `ll_events_conferences` data to `events`';

$sql = "
	INSERT INTO `lifelink`.`events` (
		`type`,
		`date_start`,
		`date_end`,
		`logo`,
		`event`,
		`event_cont`,
		`description`,
		`slug_gallery`,
		`slug_survey`,
		`countries_iso_fk`
	) SELECT
		IF(`major` = 'yes', 'conference_major', 'conference'),
		`startdate`,
		`enddate`,
		`logo`,
		`title`,
		NULL,
		`description`,
		`gallery_slug`,
		`survey_slug`,
		`country`
	FROM `lifelink_org`.`ll_events_conferences`
	;;
";
$result = mquery($sql, $link);

$sql = "
	SELECT `startdate`, `title`, `actionnumber`
	FROM `lifelink_org`.`ll_events_conferences`
	WHERE `actionnumber`
	;;
";
$result = mquery($sql, $link);

if (mysql_num_rows($result) > 0) {
	while ($record = mysql_fetch_assoc($result)) {
		$sql = "
			SELECT `events_id`
			FROM `lifelink`.`events`
			WHERE 1=1
				AND `date_start` = '%s'
				AND `event` = '%s'
			;;
		";
		$sql = sprintf($sql, esc($record['startdate']), esc($record['title']));
		$result2 = mquery($sql, $link);
		
		$id = mysql_fetch_array($result2, MYSQL_NUM);
		$id = array_shift($id);
		
		$sql = "
			INSERT INTO `lifelink`.`events_has_actions` (
				`events_id_fk`,
				`actions_number_fk`
			) VALUES (
				%d,
				%d
			)
			;;
		";
		
		$actions = explode(',', $record['actionnumber']);
		foreach ($actions as $action) {
			$sql_derive = sprintf($sql, $id, $action);
			mquery($sql_derive, $link);
		}
	}
}
