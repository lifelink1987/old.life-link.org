<?php

require_once('_header.php');

echo '<br><br>----------';
echo '<br>Copying `ll_lists_countries` data to `countries`';

$sql = "
	TRUNCATE TABLE `lifelink`.`countries`;;
";
$result = mquery($sql, $link);

$sql = "
	INSERT INTO `lifelink`.`countries` (
		`countries_iso`,
		`country`,
		`country_se`,
		`iso3`,
		`iso2`,
		`phone`,
		`adjectivals`,
		`demonyms`,
		`demonyms_colloquial`,
		`coord_lat`,
		`coord_lng`
	) SELECT * FROM `lifelink_org`.`countries_new`
	;;
";
mquery($sql, $link);
