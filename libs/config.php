<?php

require_once 'config/auto_pre.php';

/*
 * General settings
 */
define('LL_TEMPLATE', 'main');
@define('LL_DEBUG', LL_AT_HOME_DEBUG ? 'css,js,php,sql,smarty' : 'php,sql,smarty'); //js, css, php, sql and/or smarty (csv string)
define('LL_DEBUG_OUTPUT', LL_AT_HOME_DEBUG ? 'firephp' : 'file'); //screen, buffer, file and/or mail (csv string)
define('LL_CACHE', LL_AT_HOME);

/*
 * Database settings
 */
define('LL_DB_HOST', 'sql.life-link.info');
define('LL_DB_PORT', '3306');
define('LL_DB_USER', 'lifelink_basic');
define('LL_DB_PASS', 'ducmG2JJ');
define('LL_DB_SCHEMA', 'lifelink');

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
if (LL_AT_HOME) {
	//life-link.org
	define('LL_GMAPS_KEY', 'ABQIAAAAkmZu1AlWmeRAC_XJ5GP6nxQabb5xD6fA3hvWMxqKNSz_1BWAYRTf4Hjk9Q7oavMHJh1Gra62Yn_WPA');
	define('LL_YAHOO_KEY', 'dj0yJmk9QUROYUFOS3ZKeWIzJmQ9WVdrOVREWTJXVnBFTXpBbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmeD02Mw');
	define('LL_YAHOO_SECRET', 'd36946247f2d268f9fb75fcbee76646aa3a8e4fa');
} else {
	//life-link.se
	define('LL_GMAPS_KEY', 'ABQIAAAAkmZu1AlWmeRAC_XJ5GP6nxTRtbkmDoGqKKa8WLcTkwIH8AS2aRR9hetPxdmgL-sO0huRqW77pXKyOw');
}

require_once 'config/auto_post.php';
require_once 'config/uri.php';
