<?php

/**
 * Implements string functions
 *
 * @author	Andrei Neculau <andrei.neculau@gmail.com>, http://www.andreineculau.com
 * @version	0.1.$LastChangedRevision
 * @date	$LastChangedDate
 */

/**
 * Abbreviate an expression
 * @param string $string
 * @return string
 */
function abbrev($string) {
	$string = trim_ws(preg_replace('/([\d|\pL]+)/u', ' ${1} ', $string));
	$tokens = split(' ', $string);
	foreach ($tokens as $token) {
		$abbrev_tokens[] = substr($token, 0, 1);
	}
	return join('', $abbrev_tokens);
}

/**
 * Shortens a string to a maximum length and appends ellipsis
 * @param string $string
 * @param numeric $max_length
 * @param numeric $tolerance
 * @return string
 */
function str_max($string, $max_length, $tolerance = 3) {
	if (strlen($string) > $max_length + $tolerance) {
		$string = substr($string, 0, $max_length) . '...';
	}
	return $string;
}

/**
 * Generates a random string with letters (and digits)
 * @param numeric $length
 * @param bool $use_uppercase
 * @param bool $use_numbers
 * @return string
 */
function str_rand($length, $use_uppercase = FALSE, $use_numbers = FALSE) {
	$charset = 'abcdefghijklmnopqrstuvwxyz';
	if ($use_uppercase) {
		$charset .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	}
	if ($use_numbers) {
		$charset .= '0123456789';
	}
	for ($i = 0; $i < $length; $i++) {
		$result .= $charset[(mt_rand(0, (strlen($charset) - 1)))];
	}
	return $result;
}

/**
 * Return substring with given textual boundaries, optionally preceeded by sequenced needles
 * @param string $haystack
 * @param string $needle_start
 * @param string $needle_end
 * @param mixed $after_needles
 * @return string
 */
function substr_search($haystack, $needle_start, $needle_end, $after_needles = NULL) {
	//Move through, passing by the sequenced needles
	if ($after_needles) {
		$needles = (array) $needles;
		
		if (count($needles)) {
			foreach ($needles as $needle) {
				$start = strpos($haystack, $needle, $start);
			}
		}
	}
	
	//Find substring with the given textual boundaries
	$start = strpos($haystack, $between_start, $start);
	$end = strpos($haystack, $between_end, $start);
	$start += strlen($between_start);
	
	return substr($haystack, $start, $end - $start);
}

/**
 * Removes line breaks
 * @param string $string
 * @return string
 */
function oneline($string) {
	$string = preg_replace('/\t/', ' ', $string);
	$string = preg_replace('/\r?\n/', ' ', $string);
	$string = preg_replace('/\s{2,}/', ' ', $string);
	return $string;
}

/**
 *
 * @param string $item
 * @return string
 */
function trim_ws($item) {
	//Remove outside spaces
	$item = trim($item);
	
	//Remove inside spaces when more than 1
	$item = preg_replace("/ {2,}/", " ", $item);
	
	//Remove inside spaces when more than 1
	$item = preg_replace("/\t{2,}/", "\t", $item);
	
	//Change double quotes to single quotes - why?!?!
	//$item = preg_replace("/\"/", "'", $item);
	

	//Remove new lines when more than 2
	$item = preg_replace("/\n{3,}/", "\n\n", $item);
	return $item;
}

/**
 *
 * @param string $item
 * @param mixed $key
 */
function trim_ws2(&$item, $key = NULL) {
	$item = trim_ws($item);
}

/**
 *
 * @param string $item
 * @return string
 */
function trim_csv_ws($item) {
	$items = explode(',', $item);
	array_walk($items, 'trim_ws2');
	$item = implode(', ', $items);
	return $item;
}

/**
 *
 * @param string $item
 * @param mixed $key
 */
function trim_csv_ws2(&$item, $key = NULL) {
	$item = trim_csv_ws($item);
}

/* not sure what's with this function
function trim2($string) {
	return trim($string, "\x120\x09\x0A\x0D\x00\x0B\xA0\xC2"); //why the hell does do i need Acirc xC2 for when &nbsp; fails to translate to xA0
}*/

/**
 * Return the textual value of a boolean variable
 * @param bool $var
 * @return string
 */
function bool2str($var) {
	if (strtoupper($var) == 'FALSE') {
		$var = FALSE;
	}
	return $var ? 'TRUE' : 'FALSE';
}

/**
 *
 * @param string $var
 * @param numeric $length
 */
function left($var, $length = 1) {
 return substr($var, 0, $length);
}

/**
 *
 * @param string $item
 * @param mixed $key
 */
function urlencode2(&$item, $key = NULL) {
	$item = urlencode($item);
}

/**
 *
 * @param string $var
 * @param numeric $length
 */
function right($var, $length = 1) {
 return substr($var, -$length);
}

require_once 'string.format.php';
require_once 'string.mb_sprintf.php';