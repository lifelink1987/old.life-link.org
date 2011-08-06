<?php

/**
 * Implements GeoIP functions
 *
 * @author	Andrei Neculau <andrei.neculau@gmail.com>, http://www.andreineculau.com
 * @version	0.1.$LastChangedRevision
 * @date	$LastChangedDate
 */

define('GEOIP_DB', GEOIP_DIR . '/GeoIP.dat');
define('GEOIP_CITY_DB', GEOIP_DIR . '/GeoLiteCity.dat');

require_once GEOIP_DIR . '/geoipcity.inc';

/**
 * Load country GeoIP
 */
function geoip() {
	global $geoip;
	if ($geoip) {
		geoip_close($geoip);
	} else {
		register_shutdown_function('geoipclose');
	}
	$geoip = geoip_open(GEOIP_DB, GEOIP_STANDARD);
}

/**
 * Load country&city GeoIP
 */
function geoipcity() {
	global $geoip;
	if ($geoip) {
		geoip_close($geoip);
	} else {
		register_shutdown_function('geoipclose');
	}
	$geoip = geoip_open(GEOIP_CITY_DB, GEOIP_STANDARD);
}

function geoip_remote_addr($cookie = TRUE) {
	if ($cookie && $_COOKIE['geoip_record']) {
		return json_decode($_COOKIE['geoip_record']);
	}
	global $geoip;
	require_once 'web.php';
	geoipcity();
	$geoip_record = GeoIP_record_by_addr($geoip, remote_addr());
	if ($cookie) {
		setcookie('geoip_record', json_encode($geoip_record));
	}
	return $geoip_record;
}

/**
 * Close GeoIP
 */
function geoipclose() {
	global $geoip;
	geoip_close($geoip);
}
