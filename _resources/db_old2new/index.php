<?php

error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
set_time_limit(0);
@ob_implicit_flush(TRUE);

require_once('_header.php');

require_once('countries.php');
require_once('reactions.php');
require_once('actions.php');
require_once('contacts.php');

require_once('days.php');
require_once('events.php');

require_once('schools.php');
require_once('reports.php');
require_once('schools_after_reports.php');

require_once('_footer.php');