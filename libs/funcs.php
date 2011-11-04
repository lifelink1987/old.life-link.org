<?php

//ob_start((LL_GZIP)?'ob_gzhandler':null);
ob_start();
session_start();
header('Content-Type: text/html; charset=UTF-8');
mb_internal_encoding('UTF-8');

require_once('register_globals_off.php');
require_once('config.main.php');
require_once('funcs.form.php');
require_once('funcs.basics.php');

date_default_timezone_set(LL_TIMEZONE);

register_session(array('lltemplate', 'lltemplatelevel'), array(LL_DEFAULT_TEMPLATE, LL_DEFAULT_TEMPLATE_LEVEL));
register_session(array('llschoolnumber', 'llschoolnumbertime'), array(0, time()+3600*24*365));

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

require_once('config.links.php');
require_once('config.menu.php');
require_once('funcs.tpl.php');
require_once('funcs.db.php');
require_once('funcs.mail.php');
require_once('funcs.error.php');
require_once('funcs.geoip.php');
require_once('funcs.images.php');
require_once('funcs.status.php');
$timetest['funcs_loaded'] = array(gmdate('H:i:s'), memory_get_usage(true));

$db = new db();

$tpl['website']['total_reports'] = db_reports::counter();
$tpl['website']['total_schools'] = db_schools::counter();
$tpl['website']['total_countries'] = db_schools::counter_countries();
$tpl['website']['version'] = array('major' => LL_VERSION, 'minor' => LL_VERSION_MINOR, 'date' => LL_VERSION_DATE);

if (!extension_loaded('json'))
{
	require_once('jsonrpc/xmlrpc.inc');
	require_once('jsonrpc/jsonrpc.inc');
	require_once('jsonrpc/json_extension_api.inc');
}
$timetest['db_loaded'] = array(gmdate('H:i:s'), memory_get_usage(true));

?>