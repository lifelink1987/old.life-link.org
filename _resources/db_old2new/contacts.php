<?php

require_once('_header.php');

echo '<br><br>----------';
echo '<br>Copying `ll_lists_contacts` data to `contacts`';

$sql = "
	TRUNCATE TABLE `lifelink`.`contacts`;;
";
$result = mquery($sql, $link);

$sql = "
	INSERT INTO `lifelink`.`contacts` (
		`contact`,
		`position`,
		`department`,
		`department_order`,
		`countries_iso_fk`,
		`nickname`,
		`email`
	)
	SELECT
		`fullname`,
		`title`,
		`department`,
		`position`,
		`country`,
		`nickname`,
		`email`
	FROM `lifelink_org`.`ll_lists_contacts`
	;;
";
mquery($sql, $link);