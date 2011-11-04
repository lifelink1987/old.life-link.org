<?php

define('GEOIP_DB', LL_ROOT . '/libs/geoip/GeoIp.dat');
define('GEOIPCITY_DB', LL_ROOT . '/libs/geoip/GeoLiteCity.dat');
global $geoip;

function geoip()
{
	global $geoip;
	include(LL_ROOT . '/libs/geoip/geoip.inc');
	$geoip = geoip_open(GEOIP_DB, GEOIP_STANDARD);
}

function geoipcity()
{
	global $geoip;
	include(LL_ROOT . '/libs/geoip/geoipcity.inc');
	$geoip = geoip_open(GEOIPCITY_DB, GEOIP_STANDARD);
}

?>