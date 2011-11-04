<?php

define('LL_VERSION', 3);
define('LL_VERSION_MINOR', 2);
define('LL_VERSION_DATE', '2007-04-11');
define('LL_TIMEZONE', 'Europe/Stockholm');
define('LL_AT_HOME', (($_SERVER['SERVER_NAME'] == 'www.life-link.org') || ($_SERVER['SERVER_NAME'] == 'life-link.org') || ($_SERVER['SERVER_NAME'] == 'www.life-link.se') || ($_SERVER['SERVER_NAME'] == 'life-link.se')));

//define('LL_DB_HOST', LL_AT_HOME?'db-3.crystone.se':'localhost');
define('LL_DB_HOST', LL_AT_HOME?'sql.life-link.se':'localhost');
define('LL_DB_HOST_UTIL', LL_AT_HOME?'db-3.crystone.se':'localhost');
define('LL_DB_USER', 'huge7i2ueu');
define('LL_DB_PASS', 'ippakelle5');
define('LL_DB_SCHEMA', 'lifelink_org');

define('LL_ADMIN_USER', 'admin');
define('LL_ADMIN_PASS', 'gluntenoffice');

define('LL_SMTP', 'smtp.gmail.com');
define('LL_SMTP_PORT', '587');
define('LL_SMTP_USER', 'andrei.neculau@life-link.org');
define('LL_SMTP_PASS', 'andrei437');
define('LL_MAIL', 'friendship-schools@life-link.org');
define('LL_MAIL_ACTIONS', 'actions@life-link.org');
define('LL_MAIL_WEBMASTER', 'webmaster@life-link.org');
define('LL_MAIL_NOREPLY', 'noreply@life-link.org');
define('LL_MAIL_GALLERY', 'gallery@life-link.org');

define('LL_DEFAULT_TEMPLATE', '2007');
define('LL_DEFAULT_TEMPLATE_LEVEL', 0);

define('LL_PHOTO_WIDTH', 500);
define('LL_PHOTO_HEIGHT', 300);

define('LL_DEBUG', 1); // 2 for emailing the errors
define('LL_DEBUG_JS', 0);
define('LL_DEBUG_EMAIL', 0);

define('LL_YUI_VER', '2.2.2');

//the settings bellow should not be changed. they are automatically detected

$tmp = str_replace('\\', '/', realpath(dirname(__FILE__) . '/..') . '/');
$tmp = preg_replace('@^.:(.+)@', '$1', $tmp);
$tmp = preg_replace('@/$@', '', $tmp);
define('LL_ROOT', $tmp);
unset($tmp);

$tmp = $_SERVER['SCRIPT_NAME'];
$tmp = dirname($tmp);
$tmp = str_replace('\\', '/', $tmp);
$tmp = preg_replace('@/$@', '', $tmp);
define('LL_WEBPATH', $tmp);
unset($tmp);

define('LL_WEBHOST', 'http://' . $_SERVER['SERVER_NAME']);
define('LL_WEB', LL_WEBHOST . LL_WEBPATH);
define('LL_URI', LL_WEBHOST . $_SERVER['SCRIPT_NAME']);
define('LL_URI_FULL', LL_WEBHOST . $_SERVER['REQUEST_URI']);

define('SMARTY_DIR', LL_ROOT . '/libs/smarty/');

if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) //add no safari and no ie<sp2
{
	define('LL_GZIP', true);
}
else {
	define('LL_GZIP', false);
}

if (LL_AT_HOME)
{
	define('LL_YUI_URI', 'http://yui.yahooapis.com/' . LL_YUI_VER . '/build/');
}
else {
	define('LL_YUI_URI', LL_WEBPATH . '/js/yui/');
}

define('MAGPIE_DIR', LL_ROOT . '/libs/magpierss/');
define('MAGPIE_CACHE_DIR', '/tmp/magpie_cache');
define('LL_TWITTER', 'http://www.twitter.com/lifelink');
define('LL_TWITTER_RSS', 'http://twitter.com/statuses/user_timeline/18311310.rss');
define('LL_FACEBOOK', 'http://www.facebook.com/lifelink.org');
define('LL_FACEBOOK_RSS', 'http://www.facebook.com/feeds/page.php?format=atom10&id=7259019019');

?>