<?php

/**
 * Implements numeric functions
 *
 * @author	Andrei Neculau <andrei.neculau@gmail.com>, http://www.andreineculau.com
 * @version	0.1.$LastChangedRevision
 * @date	$LastChangedDate
 */

/**
 * Gets current UNIX timestamp (formatted)
 * @return numeric
 */
function microtime_float() {
	list ($msec, $sec) = explode(' ', microtime());
	$microtime = (float) $msec + (float) $sec;
	return $microtime;
}