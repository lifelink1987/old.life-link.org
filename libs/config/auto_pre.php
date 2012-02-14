<?php

/*
 * Timezone
 */
define('LL_TIMEZONE', 'Europe/Stockholm');

/*
 * Host
 */
define('LL_SERVERS', 'www.life-link.org,life-link.org');
define('LL_DEBUG_SERVERS', 'localhost,beta.life-link.org');
define('LL_AT_HOME', in_array($_SERVER['SERVER_NAME'], explode(',', LL_SERVERS)));
define('LL_AT_HOME_DEBUG', in_array($_SERVER['SERVER_NAME'], explode(',', LL_DEBUG_SERVERS)));
if ($_GET['force_debug']) {
	define('LL_DEBUG', $_GET['force_debug']);
}

/*
 * Discover paths - root/URI absolute
 */
$root = str_replace('\\', '/', realpath(dirname(__FILE__) . '/../..'));
$root = preg_replace('@^.:(.+)@', '$1', $root);
$root = preg_replace('@/$@', '', $root);

$script_filename = str_replace('\\', '/', $_SERVER['SCRIPT_FILENAME']);
$script_filename = preg_replace('@^.:(.+)@', '$1', $script_filename);
$script_filename = explode('/', $script_filename);
$script_url = explode('/', $_SERVER['SCRIPT_NAME']);

while (count($script_filename) && count($script_url)) {
	$last = array_pop($script_filename);
	$script_filename_str = implode('/', $script_filename);
	if (($last == $script_url[count($script_url) - 1]) && $script_filename_str != $root) {
		array_pop($script_url);
	} else {
		array_pop($script_url);
		break;
	}
}

/*
 * Site's root on the server
 */
define('LL_ROOT', $root);

/*
 * Site's URI root
 */
define('LL_ROOT_URI', @array_shift(explode('/',strtolower($_SERVER['SERVER_PROTOCOL']))) . '://' . $_SERVER['SERVER_NAME'] . (($_SERVER['SERVER_PORT'] != 80)?':' . $_SERVER['SERVER_PORT']:'') . implode('/', $script_url));

/*
 * Site's request URI
 */
define('LL_REQUEST_URI', LL_ROOT_URI . substr($_SERVER['REQUEST_URI'], strlen(parse_url(LL_ROOT_URI, PHP_URL_PATH) - 1)));

/*
 * Smarty location
 */
define('SMARTY_DIR', LL_ROOT . '/libs/smarty3/libs/');
//define('SMARTY_DIR', LL_ROOT . '/libs/smarty2/libs/');

/*
 * GeoIP location
 */
define('GEOIP_DIR', LL_ROOT . '/libs/geoip');

/*
 * Magpie location
 */
define('MAGPIE_DIR', LL_ROOT . '/libs/magpierss/');
define('MAGPIE_CACHE_DIR', LL_ROOT . '/libs/magpierss_data/');

/*
 * Image Cache location
 */
define('IMAGE_CACHE_DIR', LL_ROOT . '/libs/image_data');

/*
 * Major and minor version (revision)
 */
require_once 'revision.php';

/*
 * Unset temporary variables
 */
unset($root);
unset($script_filename);
unset($script_filename_str);
unset($script_url);
unset($last);
