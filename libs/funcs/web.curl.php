<?php

/**
 * Implements CURL functions
 *
 * @author	Andrei Neculau <andrei.neculau@gmail.com>, http://www.andreineculau.com
 * @version	0.1.$LastChangedRevision
 * @date	$LastChangedDate
 */

/**
 * Gets file using CURL
 * @param string $url
 * @param string $fields
 * @param string $handle
 * @param mixed $info
 * @return mixed
 */
function curl_get($url, $fields = '', &$handle = NULL, &$info = NULL) {
	global $curl_last_timestamp, $curl_throttle, $curl_handle;
	if (!$handle) {
		$handle = $curl_handle?$curl_handle:curl_init();
	}
	if (! $curl_throttle) {
		$curl_throttle = 5;
	}
	if ($curl_last_timestamp && time() - $curl_last_timestamp < $curl_throttle * 60) {
		$delay = min(array(
			$curl_throttle,
			time() - $curl_last_timestamp
		));
		if ($delay) {
			trigger_error("CURL Sleeping for $delay second(s)", E_USER_NOTICE);
			usleep($delay * 1000000);
		}
	}
	if ($fields) {
		if (is_array($fields))
			$fields = http_build_query2($fields, '', '&');
		$url = "$url?$fields";
	}
	curl_setopt($handle, CURLOPT_HTTPGET, TRUE);
	curl_setopt($handle, CURLOPT_URL, $url);
	curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
	$result = curl_exec($handle);
	$info = curl_getinfo($handle);
	$curl_last_timestamp = time();
	trigger_error("CURL GET $url ; with info=" . json_encode($info), E_USER_NOTICE);
	return $result;
}

/**
 * Posts file using CURL
 * @param string $url
 * @param string $fields
 * @param string $handle
 * @param mixed $info
 * @return mixed
 */
function curl_post($url, $fields = '', &$handle, &$info = NULL) {
	global $curl_last_timestamp, $curl_throttle, $curl_handle;
	if (!$handle) {
		$handle = $curl_handle?$curl_handle:curl_init();
	}
	if (! $curl_throttle) {
		$curl_throttle = 2;
	}
	if ($curl_last_timestamp && time() - $curl_last_timestamp < $curl_throttle * 60) {
		$delay = min(array(
			
			$curl_throttle * 60,
			time() - $curl_last_timestamp
		));
		if ($delay) {
			trigger_error("CURL Sleeping for $delay second(s)", E_USER_NOTICE);
			usleep($delay * 1000000);
		}
	}
	$curl_last_timestamp = time();
	if ($fields && is_array($fields))
		$fields = http_build_query2($fields, '', '&');
	curl_setopt($handle, CURLOPT_POST, TRUE);
	if ($fields)
		curl_setopt($handle, CURLOPT_POSTFIELDS, $fields);
	curl_setopt($handle, CURLOPT_URL, $url);
	curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
	$result = curl_exec($handle);
	$info = curl_getinfo($handle);
	trigger_error("CURL POST $url?$fields ; with info=" . json_encode($info), E_USER_NOTICE);
	return $result;
}