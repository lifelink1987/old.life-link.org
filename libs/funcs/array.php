<?php

/**
 * Implements array functions
 *
 * @author	Andrei Neculau <andrei.neculau@gmail.com>, http://www.andreineculau.com
 * @version	0.1.$LastChangedRevision
 * @date	$LastChangedDate
 */

/**
 * Output table with array contents
 * @param array $array
 */
function print_a($array) {
	$array = (array) $array;
	
	echo "<table border=0 cellspacing=1 cellpadding=1>\n";
	
	$keys = array_keys($array);
	foreach ($keys as $key) {
		echo "<tr>\n";
		
		echo "<td bgcolor='#AAAAAA' valign='top'>";
		echo "<b>" . $key . "</b>";
		echo "</td>\n";
		
		echo "<td bgcolor='#EEEEEE' valign='top'>";
		if (is_array($array[$key])) {
			print_a($array[$key]);
		} else {
			echo str_replace("\n", "<br>\n", $array[$key]);
		}
		echo "</td>\n";
		
		echo "</tr>\n";
	}
	
	echo "</table>\n";
}

/**
 * Output an array within <pre> tags
 * @param array $array
 */
function print_r_pre($array) {
	$array = (array) $array;
	echo '<pre>';
	print_r($array);
	echo '</pre>' . "\n";
}

/**
 * Merge arrays by replacing the old values (associative arrays) or by appending the new values (arrays)
 */
function array_merge_replace() {
	$arrays = func_get_args();
	$base = (array) array_shift($arrays);
	foreach ($arrays as $append) {
		$append = (array) $append;
		foreach ($append as $key => $value) {
			if (is_array($value) && isset($base[$key]) && is_array($base[$key])) {
				//If both are arrays, just merge their items
				$base[$key] = array_merge_recursive_distinct($base[$key], $append[$key]);
			} else if (is_numeric($key)) {
				//If this is a numeric key
				if (! in_array($value, $base))
					$base[] = $value;
			} else {
				//Otherwise, just replace
				$base[$key] = $value;
			}
		}
	}
	return $base;
}