<?php

/**
 * Implements website-specific functions
 *
 * @author	Andrei Neculau <andrei.neculau@gmail.com>, http://www.andreineculau.com
 * @version	0.1.$LastChangedRevision
 * @date	$LastChangedDate
 */

/**
 * Build URI
 * @param string $path
 * @param mixed $extra
 * @return string
 */
function build_uri($path, $extra = array()) {
	$result = LL_ROOT_URI . '/index.php?path=' . $path;
	if (count($extra)) {
		if (! is_array($extra)) {
			parse_str($extra, $extra2);
			$extra = $extra2;
		}
		$result .= '&' . http_build_query($extra);
	}
	return $result;
}
