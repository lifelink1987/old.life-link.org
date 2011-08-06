<?php

/*
 * Start output buffer; with gzip compression if available
 * IE5, IE6, IE7 and Safari are not trusted
 */
/**
 * @todo gzip not working properly with smarty
 */
/*require_once 'funcs/web.php';
if (function_exists('gzencode')) {
	$zlib_compression = strtolower(ini_get('zlib.output_compression'));
	if ($zlib_compression != '' && $zlib_compression != 'off' && $zlib_compression != '0') {
		ini_set('zlib.output_compression', 'Off');
	}
}
if (! is_lt_msie8() && ! is_safari()) {
	if (! ob_start('ob_gzhandler')) {
		ob_start();
	} else {
		define('LL_GZIP', TRUE);
	}
} else {
	ob_start();
}*/
ob_start();
if (! defined('LL_GZIP')) {
	define('LL_GZIP', FALSE);
}
//@apache_setenv('no-gzip', TRUE);
@ini_set('zlib.output_compression', FALSE);
@ini_set('implicit_flush', FALSE);
@ob_implicit_flush(FALSE);
register_shutdown_function('ob_flush');
set_time_limit(500);

/*
 * Start session
 */
session_start();

/**
 * Stop Notices/Warnings
 */
error_reporting(E_ALL ^ E_NOTICE);
ini_set('error_reporting', E_ALL ^ E_NOTICE);

/*
 * Load config variables
 */
require_once 'config.php';

/*
 * Set charset
 */
header('Content-Type: text/html; charset=UTF-8');
mb_internal_encoding('UTF-8');

/*
 * Set language
 */
setlocale(LC_ALL, 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');

/*
 * Set timezone
 */
date_default_timezone_set(LL_TIMEZONE);

/*
 * Turn on logging capabilities
 */
require_once 'funcs/class.logger.php';
if (LL_AT_HOME_DEBUG) {
	require_once 'firephp/FirePHP.class.php';
}
$log = new Logger(array(
	'destination' => explode(',', LL_DEBUG_OUTPUT),
	'error_handler' => LL_DEBUG_PHP,
	'level' => LL_AT_HOME_DEBUG ? Logger::DEBUG : Logger::ERROR,
	'dir' => dirname(__FILE__) . '/logs',
	'root' => LL_ROOT
));

/*
 * Load libraries
 */
require_once 'funcs/register_globals_off.php';
require_once 'funcs/php_newer.php';
foreach (glob(LL_ROOT . '/libs/funcs/*.php') as $library) {
	require_once $library;
}
$db = new Db(LL_DB_HOST, LL_DB_USER, LL_DB_PASS, LL_DB_SCHEMA, LL_DB_PORT, LL_DEBUG_SQL);
new DbSchools($db);
new DbSchoolsCountries($db);
new DbSchoolsCities($db);
new DbReports($db);
new DbActions($db);
new DbDays($db);
new DbEvents($db);
new DbReactions($db);
new DbContacts($db);
new DbCountries($db);
new DbHighlights($db);
new DbVariables($db);
new DbDelicious($db);
new DbTags($db);

/**
 * Load Smarty
 */
$smarty = new LLSmarty(array(
	'cache' => LL_CACHE,
	'debug' => LL_DEBUG_SMARTY,
	'gzip' => LL_GZIP
));

/**
 * Register SESSION variables; with default
 */
register_session_var('template', LL_TEMPLATE);

/*
$template = array();
$template['cache'] = 1;
$template['debug'] = LL_DEBUG;
$template['debugjs'] = LL_DEBUG_JS;
$template['debugmail'] = LL_DEBUG_MAIL;

$css_files =& $template['css_files'];
$js_files =& $template['js_files'];

$template['js_files']['head'][] = LL_YUI_URI . 'utilities/utilities.js';
$template['js_files']['head'][] = LL_YUI_URI . 'container/container-min.js';
$template['js_files']['head'][] = LL_YUI_URI . 'menu/menu-min.js';
if (LL_AT_HOME)
{
	//$template['js_files']['head'][] = LL_WEBPATH . '/libs/min/g=js';
	$template['js_files']['head'][] = LL_WEBPATH . '/js/_1.js';// . (LL_GZIP?'.gz':'');
}
else {
	$template['js_files']['head'][] = LL_WEBPATH . '/js/yui_config.js';
	$template['js_files']['head'][] = LL_WEBPATH . '/js/yui_ext.js';
	$template['js_files']['head'][] = LL_WEBPATH . '/js/yui-ext/yutil-min.js';
	$template['js_files']['head'][] = LL_WEBPATH . '/js/yui-ext/DomQuery-min.js';
	$template['js_files']['head'][] = LL_WEBPATH . '/js/yui-ext/Element-min.js';
	$template['js_files']['head'][] = LL_WEBPATH . '/js/yui-ext/EventManager-min.js';
	$template['js_files']['head'][] = LL_WEBPATH . '/js/json.js';
	$template['js_files']['head'][] = LL_WEBPATH . '/js/field.js';
	$template['js_files']['head'][] = LL_WEBPATH . '/js/prototype.lite.js';
	$template['js_files']['head'][] = LL_WEBPATH . '/js/trafic.js';
}

$template['css_files'][] = LL_YUI_URI . 'reset-fonts-grids/reset-fonts-grids.css';
$template['css_files'][] = LL_YUI_URI . 'container/assets/container.css';
$template['css_files'][] = LL_YUI_URI . 'menu/assets/menu.css';

$messages = array
(
	'success' => 'SUCCESS: Your information was successfuly received!',
	'error_save' => 'ERROR: Something went wrong.<br>There was an error saving the information.<br>Please contact the website manager.',
	'error_form' => 'ERROR: Something went wrong, or you didn\'t provide us with enough information.<br>Please try again.'
);

require_once ('config.links.php');
require_once ('config.menu.php');
require_once ('funcs.tpl.php');
require_once ('funcs.db.php');
require_once ('funcs.mail.php');
require_once ('funcs.error.php');
require_once ('funcs.geoip.php');
require_once ('funcs.images.php');
require_once ('funcs.status.php');
$timetest['funcs_loaded'] = array(
	
	gmdate('H:i:s'),
	memory_get_usage(true)
);

$db = new db();

$tpl['website']['total_reports'] = db_reports::counter();
$tpl['website']['total_schools'] = db_schools::counter();
$tpl['website']['total_countries'] = db_schools::counter_countries();
$tpl['website']['version'] = array(
	
	'major' => LL_VERSION,
	'minor' => LL_VERSION_MINOR,
	'date' => LL_VERSION_DATE
);

if (! extension_loaded('json')) {
	require_once ('jsonrpc/xmlrpc.inc');
	require_once ('jsonrpc/jsonrpc.inc');
	require_once ('jsonrpc/json_extension_api.inc');
}
$timetest['db_loaded'] = array(
	
	gmdate('H:i:s'),
	memory_get_usage(true)
);*/
