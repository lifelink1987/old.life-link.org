<?php

/**
 * Implements functions available in newer PHP versions
 *
 * @author	Andrei Neculau <andrei.neculau@gmail.com>, http://www.andreineculau.com
 * @version	0.1.$LastChangedRevision
 * @date	$LastChangedDate
 */

if (! function_exists('get_called_class')) {

	/**
	 * Gets the name of the class the static method is called in
	 * @param mixed $bt Result from a different debug_backtrace()
	 * @param numeric $l Level of backtrace to search from
	 * @return string
	 */
	function get_called_class($bt = FALSE, $l = 1) {
		if (! $bt)
			$bt = debug_backtrace();
		if (! isset($bt[$l]))
			throw new Exception("Cannot find called class -> stack level too deep.");
		if (! isset($bt[$l]['type'])) {
			throw new Exception('type not set');
		} else
			switch ($bt[$l]['type']) {
				case '::':
					$lines = file($bt[$l]['file']);
					$i = 0;
					$callerLine = '';
					do {
						$i++;
						$callerLine = $lines[$bt[$l]['line'] - $i] . $callerLine;
					} while (stripos($callerLine, $bt[$l]['function']) === FALSE);
					preg_match('/([a-zA-Z0-9\_]+)::' . $bt[$l]['function'] . '/', $callerLine, $matches);
					if (! isset($matches[1])) {
						// must be an edge case.
						throw new Exception("Could not find caller class: originating method call is obscured.");
					}
					switch ($matches[1]) {
						case 'self':
						case 'parent':
							return get_called_class($bt, $l + 1);
						default:
							return $matches[1];
					}
				// won't get here.
				case '->':
					switch ($bt[$l]['function']) {
						case '__get':
							// edge case -> get class of calling object
							if (! is_object($bt[$l]['object']))
								throw new Exception("Edge case fail. __get called on non object.");
							return get_class($bt[$l]['object']);
						default:
							return $bt[$l]['class'];
					}
				
				default:
					throw new Exception("Unknown backtrace method type");
			}
	}
}

if (! function_exists('array_replace_recursive')) {

	/**
	 * Overwrite one or more arrays
	 * @param array $array1 Initial array to overwrite
	 * @param array $_
	 * @return array An array of values resulted from overwriting the arguments
	 */
	function array_replace_recursive($array, $_ = NULL) {

		function recurse($array, $array1) {
			foreach ($array1 as $key => $value) {
				// create new key in $array, if it is empty or not an array
				if (! isset($array[$key]) || (isset($array[$key]) && ! is_array($array[$key]))) {
					$array[$key] = array();
				}
				
				// overwrite the value in the base array
				if (is_array($value)) {
					$value = recurse($array[$key], $value);
				}
				$array[$key] = $value;
			}
			return $array;
		}
		
		// handle the arguments, merge one by one
		$args = func_get_args();
		$array = $args[0];
		if (! is_array($array)) {
			return $array;
		}
		for ($i = 1; $i < count($args); $i++) {
			if (is_array($args[$i])) {
				$array = recurse($array, $args[$i]);
			}
		}
		return $array;
	}
}

//PHP_VERSION_ID is available as of PHP 5.2.7, if our
//version is lower than that, then emulate it
if (! defined('PHP_VERSION_ID')) {
	$version = explode('.', PHP_VERSION);
	
	define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
}