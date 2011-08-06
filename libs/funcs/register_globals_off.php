<?php

/**
 * Undoes register_globals effect
 *
 * @author	Andrei Neculau <andrei.neculau@gmail.com>, http://www.andreineculau.com
 * @version	0.1.$LastChangedRevision
 * @date	$LastChangedDate
 */

if (ini_get('register_globals')) {
	foreach ($GLOBALS as $s_variable_name => $m_variable_value) {
		if (! in_array($s_variable_name, array(
			
			'GLOBALS',
			'argv',
			'argc',
			'_FILES',
			'_COOKIE',
			'_POST',
			'_GET',
			'_SERVER',
			'_ENV',
			'_SESSION',
			'_REQUEST',
			's_variable_name',
			'm_variable_value'
		))) {
			unset($GLOBALS[$s_variable_name]);
			unset(${$s_variable_name});
		}
	}
	unset($GLOBALS['s_variable_name']);
	unset($GLOBALS['m_variable_value']);
}