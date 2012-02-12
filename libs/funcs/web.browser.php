<?php

/**
 * Implements browser functions
 *
 * @author	Andrei Neculau <andrei.neculau@gmail.com>, http://www.andreineculau.com
 * @version	0.1.$LastChangedRevision
 * @date	$LastChangedDate
 */

/**
 * Return browser information
 * http://php.net/manual/en/function.get-browser.php
 * @param string $agent
 * @return array
 */
function browser_info($agent = NULL) {
	// Declare known browsers to look for
	$known = array(
		'msie',
		'firefox',
		'chrome',
		'mobile',
		'safari',
		'webkit',
		'opera',
		'netscape',
		'konqueror',
		'gecko'
	);
	
	// Clean up agent and build regex that matches phrases for known browsers
	// (e.g. "Firefox/2.0" or "MSIE 6.0" (This only matches the major and minor
	// version numbers.  E.g. "2.0.0.6" is parsed as simply "2.0"
	$agent = strtolower($agent ? $agent : $_SERVER['HTTP_USER_AGENT']);
	$pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[A-Za-z0-9]+(?:\.[0-9]+)?)#';
	
	// Find all phrases (or return empty array if none found)
	if (! preg_match_all($pattern, $agent, $matches))
		return array();
		
	// Since some UAs have more than one phrase (e.g Firefox has a Gecko phrase,
	// Opera 7,8 have a MSIE phrase), use the last one found (the right-most one
	// in the UA).  That's usually the most correct.
	$i = count($matches['browser']) - 1;
	return array(
		'browser' => $matches['browser'][$i],
		'version' => $matches['version'][$i],
		$matches['browser'][$i] => $matches['version'][$i],
		'all' => array_combine($matches['browser'], $matches['version'])
	);
}

/**
 * Return TRUE if the browser is a mobile browser
 * @return bool
 */
function is_mobile() {
	global $is_mobile;
	
	if (isset($is_mobile)) {
		return $is_mobile;
	}
	
	$op = strtolower(@$_SERVER['HTTP_X_OPERAMINI_PHONE']);
	$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
	$ac = strtolower($_SERVER['HTTP_ACCEPT']);
	
	return $is_mobile = (strpos($ac, 'application/vnd.wap.xhtml+xml') !== FALSE || $op != '' || strpos($ua, 'sony') !== FALSE || strpos($ua, 'symbian') !== FALSE || strpos($ua, 'nokia') !== FALSE || strpos($ua, 'samsung') !== FALSE || strpos($ua, 'mobile') !== FALSE || strpos($ua, 'windows ce') !== FALSE || strpos($ua, 'epoc') !== FALSE || strpos($ua, 'opera mini') !== FALSE || strpos($ua, 'nitro') !== FALSE || strpos($ua, 'j2me') !== FALSE || strpos($ua, 'midp-') !== FALSE || strpos($ua, 'cldc-') !== FALSE || strpos($ua, 'netfront') !== FALSE || strpos($ua, 'mot') !== FALSE || strpos($ua, 'up.browser') !== FALSE || strpos($ua, 'up.link') !== FALSE || strpos($ua, 'audiovox') !== FALSE || strpos($ua, 'blackberry') !== FALSE || strpos($ua, 'ericsson,') !== FALSE || strpos($ua, 'panasonic') !== FALSE || strpos($ua, 'philips') !== FALSE || strpos($ua, 'sanyo') !== FALSE || strpos($ua, 'sharp') !== FALSE || strpos($ua, 'sie-') !== FALSE || strpos($ua, 'portalmmm') !== FALSE || strpos($ua, 'blazer') !== FALSE || strpos($ua, 'avantgo') !== FALSE || strpos($ua, 'danger') !== FALSE || strpos($ua, 'palm') !== FALSE || strpos($ua, 'series60') !== FALSE || strpos($ua, 'palmsource') !== FALSE || strpos($ua, 'pocketpc') !== FALSE || strpos($ua, 'smartphone') !== FALSE || strpos($ua, 'rover') !== FALSE || strpos($ua, 'ipaq') !== FALSE || strpos($ua, 'au-mic,') !== FALSE || strpos($ua, 'alcatel') !== FALSE || strpos($ua, 'ericy') !== FALSE || strpos($ua, 'up.link') !== FALSE || strpos($ua, 'vodafone/') !== FALSE || strpos($ua, 'wap1.') !== FALSE || strpos($ua, 'wap2.') !== FALSE);
}

/**
 * Return TRUE if the browser is actually a crawler
 * @return bool
 */
function is_bot() {
	global $is_bot;
	
	if (isset($is_bot)) {
		return $is_bot;
	}
	
	$op = strtolower(@$_SERVER['HTTP_X_OPERAMINI_PHONE']);
	$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
	$ac = strtolower($_SERVER['HTTP_ACCEPT']);
	$ip = $_SERVER['REMOTE_ADDR'];
	
	return $is_bot = ($ip == '66.249.65.39' || strpos($ua, 'googlebot') !== FALSE || strpos($ua, 'mediapartners') !== FALSE || strpos($ua, 'yahooysmcm') !== FALSE || strpos($ua, 'baiduspider') !== FALSE || strpos($ua, 'msnbot') !== FALSE || strpos($ua, 'slurp') !== FALSE || strpos($ua, 'ask') !== FALSE || strpos($ua, 'teoma') !== FALSE || strpos($ua, 'spider') !== FALSE || strpos($ua, 'heritrix') !== FALSE || strpos($ua, 'attentio') !== FALSE || strpos($ua, 'twiceler') !== FALSE || strpos($ua, 'irlbot') !== FALSE || strpos($ua, 'fast crawler') !== FALSE || strpos($ua, 'fastmobilecrawl') !== FALSE || strpos($ua, 'jumpbot') !== FALSE || strpos($ua, 'googlebot-mobile') !== FALSE || strpos($ua, 'yahooseeker') !== FALSE || strpos($ua, 'motionbot') !== FALSE || strpos($ua, 'mediobot') !== FALSE || strpos($ua, 'chtml generic') !== FALSE || strpos($ua, 'nokia6230i/. fast crawler') !== FALSE);
}

/**
 * Return TRUE if the browser is Apple Safari on iPhone
 * @return bool
 */
function is_iphone() {
	global $is_iphone;
	
	if (isset($is_iphone)) {
		return $is_iphone;
	}
	
	global $browser_info;
	$browser_info = $browser_info ? $browser_info : browser_info();
	return $is_iphone = isset($browser_info['safari']) && isset($browser_info['all']['mobile']) && stristr($_SERVER['HTTP_USER_AGENT'], 'iPhone');
}

/**
 * Return TRUE if the browser is Apple Safari on iPad
 * @return bool
 */
function is_ipad() {
	global $is_ipad;
	
	if (isset($is_ipad)) {
		return $is_ipad;
	}
	
	global $browser_info;
	$browser_info = $browser_info ? $browser_info : browser_info();
	return $is_ipad = isset($browser_info['safari']) && isset($browser_info['all']['mobile']) && stristr($_SERVER['HTTP_USER_AGENT'], 'iPad');
}

/**
 * Return TRUE if the browser is Apple Safari
 * @return bool
 */
function is_safari() {
	global $is_safari;
	
	if (isset($is_safari)) {
		return $is_safari;
	}
	
	global $browser_info;
	$browser_info = $browser_info ? $browser_info : browser_info();
	return $is_safari = isset($browser_info['safari']);
}

/**
 * Return TRUE if the browser is Microsoft Internet Explorer
 * @return bool
 */
function is_msie() {
	global $is_msie;
	
	if (isset($is_msie)) {
		return $is_msie;
	}
	
	global $browser_info;
	$browser_info = $browser_info ? $browser_info : browser_info();
	return $is_msie = isset($browser_info['msie']);
}

/**
 * Return TRUE if the browser is Microsoft Internet Explorer 6
 * @return bool
 */
function is_msie6() {
	if (! is_msie())
		return FALSE;
	
	$version = explode('.', $browser_info['msie']);
	return $version[0] == 6;
}

/**
 * Return TRUE if the browser is Microsoft Internet Explorer 7
 * @return bool
 */
function is_msie7() {
	if (! is_msie())
		return FALSE;
	
	$version = explode('.', $browser_info['msie']);
	return $version[0] == 7;
}

/**
 * Return TRUE if the browser is Microsoft Internet Explorer <6
 * @return bool
 */
function is_lt_msie6() {
	if (! is_msie())
		return FALSE;
	
	$version = explode('.', $browser_info['msie']);
	return $version[0] < 6;
}

/**
 * Return TRUE if the browser is Microsoft Internet Explorer <7
 * @return bool
 */
function is_lt_msie7() {
	if (! is_msie())
		return FALSE;
	
	$version = explode('.', $browser_info['msie']);
	return $version[0] < 7;
}

/**
 * Return TRUE if the browser is Microsoft Internet Explorer <8
 * @return bool
 */
function is_lt_msie8() {
	if (! is_msie())
		return FALSE;
	
	$version = explode('.', $browser_info['msie']);
	return $version[0] < 8;
}

/**
 * Return TRUE if the browser is Mozilla Firefox
 * @return bool
 */
function is_firefox() {
	global $is_firefox;
	
	if (isset($is_firefox)) {
		return $is_firefox;
	}
	
	global $browser_info;
	$browser_info = $browser_info ? $browser_info : browser_info();
	return $is_firefox = isset($browser_info['firefox']);
}

/**
 * Return TRUE if the browser is Opera
 * @return bool
 */
function is_opera() {
	global $is_opera;
	
	if (isset($is_opera)) {
		return $is_opera;
	}
	
	global $browser_info;
	$browser_info = $browser_info ? $browser_info : browser_info();
	return $is_opera = isset($browser_info['opera']);
}