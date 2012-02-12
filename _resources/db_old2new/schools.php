<?php

require_once ('_header.php');

echo '<br><br>----------';
echo '<br>Copying `ll_members_schools` data to `member_schools`';

$sql = "
	TRUNCATE TABLE `lifelink`.`member_schools`;;
	TRUNCATE TABLE `lifelink`.`member_schools_has_tags`;;
	TRUNCATE TABLE `lifelink`.`tags`;;
";
$result = mquery($sql, $link);

$sql = "
	INSERT INTO `lifelink`.`member_schools` (
		`member_schools_number`,
		`school`,
		`address`,
		`address_zipcode`,
		`city`,
		`county`,
		`countries_iso_fk`,
		`coord_lat`,
		`coord_lng`,
		`coord_accuracy`,
		`tel`,
		`fax`,
		`email`,
		`website`,
		`contact_senior`,
		`email_contact_senior`,
		`contact_junior`,
		`email_contact_junior`,
		`students`,
		`students_age`,
		`students_gender`,
		`teachers`,
		`datetime_registration`,
		`datetime_update`
	)
	SELECT
		`schoolnumber`,
		`name`,
		`address`,
		`zipcode`,
		`city`,
		`county`,
		`country`,
		NULL,
		NULL,
		NULL,
		`tel`,
		`fax`,
		`email`,
		`website`,
		`teachercontact`,
		`teachercontactemail`,
		`studentcontact`,
		`studentcontactemail`,
		`students`,
		`studentsage`,
		`studentsgender`,
		`teachers`,
		NOW(),
		`update`
	FROM `lifelink_org`.`ll_members_schools`
	;;
";
$result = mquery($sql, $link);

$sql = "
	SELECT `schoolnumber`, `tags`
	FROM `lifelink_org`.`ll_members_schools`
	WHERE `tags`
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
			INSERT INTO `lifelink`.`member_schools_has_tags` (
				`member_schools_number_fk`,
				`tags_id_fk`
			) VALUES (
				%d,
				LAST_INSERT_ID()
			)
			;;
		";
		
		$tags = explode(',', $record['tags']);
		foreach ($tags as $tag) {
			$sql_derive = sprintf($sql1, $tag);
			mquery($sql_derive, $link);
			$sql_derive = sprintf($sql2, $record['schoolnumber']);
			mquery($sql_derive, $link);
		}
	}
}




