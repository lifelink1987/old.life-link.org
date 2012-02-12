<?php

require_once ('_header.php');

echo '<br><br>----------';

$sql = "
	TRUNCATE TABLE `lifelink`.`events`;;
	TRUNCATE TABLE `lifelink`.`events_has_actions`;;
";
$result = mquery($sql, $link);

require_once ('events_campaigns.php');
require_once ('events_conferences.php');
require_once ('events_agenda.php');