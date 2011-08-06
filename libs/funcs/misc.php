<?php

/**
 * Implements miscelaneous functions
 *
 * @author	Andrei Neculau <andrei.neculau@gmail.com>, http://www.andreineculau.com
 * @version	0.1.$LastChangedRevision
 * @date	$LastChangedDate
 */

/**
 * Check if a variable is truly empty i.e. do not ignore 0 or "0" or even FALSE/" "
 * @param mixed $var
 * @param bool $allow_false consider
 * @param bool $allow_ws
 */
function is_empty($var, $allow_false = TRUE, $allow_ws = FALSE) {
	if (! isset($var) || ($allow_ws == FALSE && trim($var) == "" && ! is_bool($var)) || ($allow_false === FALSE && is_bool($var) && $var === FALSE) || (is_array($var) && empty($var))) {
		return TRUE;
	} else {
		return FALSE;
	}
}

/**
 * Convert memory bytes to short format
 * @param numeric $size
 */
function convert_memory($size) {
	$unit = array(
		'b',
		'kb',
		'mb',
		'gb',
		'tb',
		'pb'
	);
	return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
}

/**
 * Convert parameters into a MySQL limit
 * @param numeric $skip
 * @param numeric $max
 * @param bool $all
 */
function mysql_limit($skip = 0, $max = 1, $all = FALSE) {
	$max = $all ? 65535 : $max;
	if ($skip) {
		$limit = "$skip,$max";
	} else {
		$limit = $max;
	}
	return $limit;
}

/**
 * Convert date to MySQL date
 * @param numeric $year
 * @param numeric $month
 * @param numeric $day
 */
function mysql_date($year = NULL, $month = 1, $day = 1) {
	$year = $year ? $year : date('Y');
	return date('Y-m-d', strtotime("$year-$month-$day"));
}

/**
 * Convert time to MySQL time
 * @param numeric $hour
 * @param numeric $min
 * @param numeric $sec
 */
function mysql_time($hour = 0, $min = 1, $sec = 1) {
	return date('H:i:s', strtotime("$hour:$min:$sec"));
}

