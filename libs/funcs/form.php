<?php

require_once 'regexp.php';

/**
 * Implements form/querystring functions
 *
 * @author	Andrei Neculau <andrei.neculau@gmail.com>, http://www.andreineculau.com
 * @version	0.1.$LastChangedRevision
 * @date	$LastChangedDate
 */

/**
 * Update a query string with new/changed keys (values)
 * @param mixed $new_keys
 * @param mixed $new_values
 * @param mixed $extra$skip_keys
 * @param bool $extra$addAmpersand
 * @param mixed $extra$querystring
 * @return string
 */
function update_querystring($new_keys, $new_values, $extra = array()) {
	extract($extra);
	
	//Build query
	$query = array();
	if (! $querystring) {
		$query = $_SERVER['QUERY_STRING'];
		//$query = array_merge($_GET, $_POST);
	} else {
		parse_str($querystring, $query);
	}
	
	//Merge query keys
	$new_keys = (array) $new_keys;
	$new_values = (array) $new_values;
	$news = array_combine($new_keys, $new_values);
	foreach ($news as $new_key => $new_value) {
		$query[$new_key] = $new_value;
	}
	
	//Remote unwanted keys
	$skip_keys = (array) $skip_keys;
	if ($skip_keys) {
		foreach ($skip_keys as $skip_key) {
			unset($query[$skip_key]);
		}
	}
	
	//Build new query string
	$querystring = http_build_query($query);
	
	//Add ampersand if requested and needed
	if (($add_ampersand) && ($querystring)) {
		$querystring = '&' . $querystring;
	}
	
	return $querystring;
}

/**
 * Builds URL-friendly query
 * @param array $data
 * @param string $prefix
 * @param string $sep
 * @param string $key
 * @return string
 */
function http_build_query2($data, $prefix = '', $separator = '', $key = '') {
	$data = (array) $data;
	$ret = array();
	foreach ($data as $k => $v) {
		if (is_int($k) && $prefix != NULL) {
			$k = urlencode($prefix . $k);
		}
		if ($key || $key === 0)
			$k = $key . '[' . urlencode($k) . ']';
		if (is_array($v) || is_object($v)) {
			array_push($ret, http_build_query2($v, '', $separator, $k));
		} else {
			array_push($ret, $k . '=' . urlencode($v));
		}
	}
	if (!$separator)
		$separator = ini_get('arg_separator.output');
	return implode($separator, $ret);
}

/**
 * Check if required form items are not empty, and if their dependencies are followed
 * @param mixed $items Form elements within context or form values
 * @param string $dependency Dependency element within context or dependency value
 * @param string $context $_GET, $_POST or $_REQUEST
 * @return bool
 */
function form_check_requirements($items, $dependency = NULL, $context = NULL) {
	$items = (array) $items;
	
	//Ignore check if dependency is empty, and thus doesn't require the children
	if ($context) {
		if (is_set($dependency) && is_empty($context[$dependency])) {
			return TRUE;
		}
	} elseif (is_set($dependency) && is_empty($dependency)) {
		return TRUE;
	}
	
	foreach ($items as $item) {
		if ($context) {
			if (is_empty($context[$item])) {
				return FALSE;
			}
		} elseif (is_empty($item)) {
			return FALSE;
		}
	}
	
	return TRUE;
}

/**
 * Check if form elements follow RegExp
 * @param mixed $items Form elements within context or form values
 * @param string $type RegExp type
 * @param string $context $_GET, $_POST or $_REQUEST
 * @return string
 */
function form_check_regexp($items, $type, $context = NULL) {
	$items = (array) $items;
	
	foreach ($items as $item) {
		$text = "Field '$item' doesn't fulfill the format requirement.";
		
		if ($context) {
			$item = $context[$item];
		}
		if ($item && ! regexp_check($item, $type)) {
			$results[] = $text;
		}
	}
	
	return $results;
}

/**
 * Check if form elements follow the associated RegExp
 * @param array $list Associative array of RegExp type and form elements within context or form values
 * @param string $context $_GET, $_POST or $_REQUEST
 * @return string
 */
function form_regexp($list, $context = NULL) {
	$list = (array) $list;
	$results = array();
	
	foreach ($list as $type => $items) {
		$text = regexp_fields($items, $type, $context);
		
		if ($text) {
			$results = array_merge($results, $text);
		}
	}
	
	return $results;
}

/**
 * Builds an array from sequenced form elements
 * @param string $field
 * @param string $context $_GET, $_POST or $_REQUEST
 * @return array
 */
function form_array($field, $context = NULL) {
	if (! $context) {
		$context = & $_REQUEST;
	}
	$i = 1;
	$result = array();
	while (isset($context[$field . $i])) {
		$result[] = $context[$field . $i];
		$i++;
	}
	return $result;
}