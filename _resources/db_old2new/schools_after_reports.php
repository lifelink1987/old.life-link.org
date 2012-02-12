<?php

require_once('_header.php');

echo '<br><br>----------';
echo '<br>Fix `member_schools`';

$sql = "
	UPDATE `lifelink`.`member_schools` `s`
	JOIN (
		SELECT
			`member_schools_number`,
			MIN(`r`.`datetime_registration`) as `datetime_r_min`,
			MIN(`r`.`datetime_approval`) as `datetime_a_min`
		FROM `lifelink`.`member_schools` `s2`
		JOIN `lifelink`.`member_reports` `r` ON `s2`.`member_schools_number` = `r`.`member_schools_number_fk`
		GROUP BY `s2`.`member_schools_number`
		) `s2` ON `s`.`member_schools_number` = `s2`.`member_schools_number`
	SET
		`s`.`datetime_registration` = `s2`.`datetime_r_min`,
		`s`.`datetime_approval` = `s2`.`datetime_a_min`
	;;
";
mquery($sql, $link);

$sql = "
	UPDATE `lifelink`.`member_schools` `s`
	SET `s`.`datetime_update` = `s`.`datetime_registration`
	WHERE ISNULL(`s`.`datetime_update`)
	;;
";
mquery($sql, $link);

