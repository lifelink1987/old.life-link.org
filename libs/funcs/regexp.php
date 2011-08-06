<?php

/**
 * Implements RegExp functions
 *
 * @author	Andrei Neculau <andrei.neculau@gmail.com>, http://www.andreineculau.com
 * @version	0.1.$LastChangedRevision
 * @date	$LastChangedDate
 */

/**
 * Match a value to a regular expression
 * @param mixed $value
 * @param string $type
 */
function regexp_check($value, $type) {
	switch (strtolower($type)) {
		case 'number':
			$regexp = "/^\d*$/";
			break;
		case 'range':
			$regexp = "/^(?:(?:\d+\-\d+)|\d*)$/";
			break;
		case 'email':
			$regexp = "/^[\w|\.|\-|_]+@[\w|\.|\-|_]+\.[\w|\.|\-|_]{2,}$/";
			break;
		case 'emails':
			$regexp = "/^[\w|\.|\-|_]+@[\w|\.|\-|_]+\.[\w|\.|\-|_]{2,}(?:,(?: )?[\w|\.|\-|_]+@[\w|\.|\-|_]+\.[\w|\.|\-|_]{2,})*$/";
			break;
		case 'phone':
			$regexp = "/^(?:\+|00)(?:[\d]+[ \(\)\-\.])*[\d]+$/";
			break;
		case 'phones':
			$regexp = "/^(?:\+|00)(?:[\d]+[ \(\)\-\.])*[\d]+(?:,(?: )?(?:\+|00)(?:[\d]+[ \(\)\-\.])*[\d]+)*$/";
			break;
		case 'website':
			$regexp = "/^(?:(?:http(s)?:\/\/)|(www\.))((?:(?:(?:\w|\-|\_)+\.)+)(?:[a-z]{2,5}))((?:\/(?:(?:(?:(?:\w|\-|\_)+\.)*(?:\w|\-|\_)+\/?)*))*)(\?(?:\S*))?$/i";
			break;
		case 'gender':
			$regexp = "/^[f|m]$/i";
			break;
		case 'name':
			$regexp = "/^(?:(?:[\.a-zA-Z\x{00C0}-\x{024f}]{2,}[ \-])?)*[\.a-zA-Z\x{00C0}-\x{024f}]{2,}$/u";
			break;
		case 'names':
			$regexp = "/^(?:(?:[\.a-zA-Z\x{00C0}-\x{024f}]{2,}[ \-])?)*[\.a-zA-Z\x{00C0}-\x{024f}]{2,}(?:,(?: )?(?:(?:[\.a-zA-Z\x{00C0}-\x{024f}]{2,}[ \-])?)*[\.a-zA-Z\x{00C0}-\x{024f}]{2,})*$/u";
			break;
	}
	if ($regexp) {
		return preg_match($regexp, $value);
	}
	return TRUE;
}

/**
 * Is given value a number
 * @param string $value
 */
function regexp_number($value) {
	return regexp_check($value, 'number');
}

/**
 * Is given value a range
 * @param string $value
 */
function regexp_range($value) {
	return regexp_check($value, 'range');
}

/**
 * Is given value a email
 * @param string $value
 */
function regexp_email($value) {
	return regexp_check($value, 'email');
}

/**
 * Is given value one or more emails
 * @param string $value
 */
function regexp_emails($value) {
	return regexp_check($value, 'emails');
}

/**
 * Is given value a phone number
 * @param string $value
 */
function regexp_phone($value) {
	return regexp_check($value, 'phone');
}

/**
 * Is given value one or more phone numbers
 * @param string $value
 */
function regexp_phones($value) {
	return regexp_check($value, 'phones');
}

/**
 * Is given value a website
 * @param string $value
 */
function regexp_website($value) {
	return regexp_check($value, 'website');
}

/**
 * Is given value a gender
 * @param string $value
 */
function regexp_gender($value) {
	return regexp_check($value, 'gender');
}

/**
 * Is given value a name
 * @param string $value
 */
function regexp_name($value) {
	return regexp_check($value, 'name');
}

/**
 * Is given value one or more names
 * @param string $value
 */
function regexp_names($value) {
	return regexp_check($value, 'names');
}