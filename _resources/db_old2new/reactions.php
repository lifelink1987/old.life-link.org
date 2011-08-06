<?php

require_once('_header.php');

echo '<br><br>----------';
echo '<br>Copying `ll_lists_reactions` data to `reactions`';

$sql = "
	TRUNCATE TABLE `lifelink`.`reactions`;;
";
$result = mquery($sql, $link);

$sql = "
	INSERT INTO `lifelink`.`reactions` (
		`reactions_id`,
		`countries_iso_fk`,
		`who`,
		`reaction`
	) SELECT * FROM `lifelink_org`.`ll_lists_reactions`
	;;
";
mquery($sql, $link);
