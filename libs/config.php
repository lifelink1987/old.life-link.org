<?php

require_once 'config/auto_pre.php';

/*
 * General settings
 */
define('LL_TEMPLATE', 'main');
//if (true == false) {
  @define('LL_DEBUG', LL_AT_HOME_DEBUG ? 'css,js,php,sql,smarty' : 'php,sql,smarty'); //js, css, php, sql and/or smarty (csv string)
  define('LL_DEBUG_OUTPUT', LL_AT_HOME_DEBUG ? 'firephp' : 'file'); //screen, buffer, file and/or mail (csv string)
  define('LL_CACHE', LL_AT_HOME);
/*} else {
  @define('LL_DEBUG', 'php'); //js, css, php, sql and/or smarty (csv string)
  define('LL_DEBUG_OUTPUT', 'firephp'); //screen, buffer, file and/or mail (csv string)
  define('LL_CACHE', false);
}*/

/*
 * Database settings
 */
define('LL_DB_HOST', 'sql.life-link.org');
define('LL_DB_PORT', '3306');
define('LL_DB_USER', '');
define('LL_DB_PASS', '');
define('LL_DB_SCHEMA', '');

/*
 * Email settings
 */
define('LL_SMTP', 'smtp.gmail.com');
define('LL_SMTP_PORT', '587');
define('LL_SMTP_USER', 'andrei.neculau@life-link.org');
define('LL_SMTP_PASS', 'andrei437');
define('LL_MAIL', 'friendship-schools@life-link.org');
define('LL_MAIL_ACTIONS', 'actions@life-link.org');
define('LL_MAIL_WEBMASTER', 'webmaster@life-link.org');
define('LL_MAIL_NOREPLY', 'noreply@life-link.org');
define('LL_MAIL_GALLERY', 'gallery@life-link.org');

/*
 * Twitter
 */
define('LL_TWITTER', 'http://www.twitter.com/lifelink');
define('LL_TWITTER_RSS', 'http://twitter.com/statuses/user_timeline/18311310.rss');

/*
 * Facebook
 */
define('LL_FACEBOOK', 'http://www.facebook.com/lifelink.org');
//define('LL_FACEBOOK_RSS', 'http://www.facebook.com/feeds/page.php?format=atom10&id=7259019019');
define('LL_FACEBOOK_RSS', 'http://www.facebook.com/feeds/page.php?format=rss20&id=7259019019');
define('LL_FACEBOOK_NOTES_RSS', 'http://www.facebook.com/feeds/notes.php?id=7259019019&viewer=1004642413&key=1cdc64b353&format=rss20');
define('LL_FACEBOOK_UID', 1780871734);

/* Reports */
define('LL_REPORT_MEDIA', realpath(LL_ROOT . '/../files/action_photos'));

/* Google Maps, Delicious API */
define('LL_GMAPS_KEY', 'AIzaSyDMUjjzgXybDtNOhjo3qR7UOloxRuQuFwY');
if (LL_AT_HOME) {
	//life-link.org
	define('LL_YAHOO_KEY', 'dj0yJmk9QUROYUFOS3ZKeWIzJmQ9WVdrOVREWTJXVnBFTXpBbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmeD02Mw');
	define('LL_YAHOO_SECRET', 'd36946247f2d268f9fb75fcbee76646aa3a8e4fa');
} else {
	//life-link.se
}

require_once 'config/auto_post.php';
require_once 'config/uri.php';
