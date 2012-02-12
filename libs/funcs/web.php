<?php

/**
 * Implements web functions
 *
 * @author	Andrei Neculau <andrei.neculau@gmail.com>, http://www.andreineculau.com
 * @version	0.1.$LastChangedRevision
 * @date	$LastChangedDate
 */

/**
 * Redirect to given URI
 * @param string $URI
 */
function redirect($URI, $permanent = FALSE) {
	@ob_clean();
	$URI = htmlspecialchars_decode($URI);
	if ($permanent) {
		header('HTTP/1.1 301 Moved Permanently');
	}
	header('Location: ' . $URI);
	exit(0);
}

// $lastModifiedDate must be a GMT Unix Timestamp
// You can use gmmktime(...) to get such a timestamp
// getlastmod() also provides this kind of timestamp for the last
// modification date of the PHP file itself
function header_last_modified($mtime, $etag = NULL) {
	//Disable etag
	if ($mtime) {
		if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) >= $mtime) {
			if (php_sapi_name() == 'CGI') {
				Header("Status: 304 Not Modified");
			} else {
				Header("HTTP/1.0 304 Not Modified");
			}
			if ($etag) {
				header('If-None-Match: "' . $etag . '"');
			}
			exit();
		} else {
			$gmtDate = gmdate("D, d M Y H:i:s\G\M\T", $mtime);
			header('Last-Modified: ' . $gmtDate);
			if ($etag) {
				header('ETag: "' . $etag . '"');
			}
		}
	}
}

function header_cache($cache_time = 604800) {
	if ($cache_time) {
		if (! is_numeric($cache_time)) {
			$cache_time = 3600 * 24 * 7;
		}
		header("Cache-Control: private, max-age=$cache_time, pre-check=$cache_time");
		header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $cache_time) . ' GMT');
		header('Pragma: private');
	} else {
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Cache-Control: post-check=0, pre-check=0', FALSE);
		header('Pragma: no-cache');
	}
}

function header_download($name, $mtime) {
	$quotes = is_msie() ? '' : '"';
	header('Content-Disposition: attachment; filename=' . $quotes . $name . $quotes . '; modification-date="' . date('r', $mtime) . '";');
	header('Content-Type: application/force-download');
	header('Content-Transfer-Encoding: binary');
}

function header_inline($name, $mtime) {
	$quotes = is_msie() ? '' : '"';
	header('Content-Disposition: inline; filename=' . $quotes . $name . $quotes . '; modification-date="' . date('r', $mtime) . '";');
	header('Content-Transfer-Encoding: binary');
}

/**
 * Retrieve true remote IP address
 * @return string
 */
function remote_addr() {
	if (! is_empty($_SERVER['HTTP_CLIENT_IP'])) {
		// check IP from shared internet
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (! is_empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		// check IP from proxy
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}

/**
 * Register POST/GET/COOKIE/default value to SESSION variable
 * @param mixed $names One or more variable name
 * @param mixed $default_values Corresponding variable default values
 */
function register_session_var($names, $default_values) {
	$names = (array) $names;
	$default_values = (array) $default_values;
	$session = array_combine($names, $default_values);
	if ($session) {
		foreach ($session as $key => $value) {
			if (strpos($key, '_expires'))
				continue;
			$_SESSION[$key . '_default'] = $value;
			if (isset($_POST[$key])) {
				// store POST
				$_SESSION[$key] = $_POST[$key];
			} elseif (isset($_GET[$key])) {
				// store GET
				$_SESSION[$key] = $_GET[$key];
			} elseif (isset($_COOKIE[$key])) {
				// store COOKIE
				$_SESSION[$key] = $_COOKIE[$key];
			} else {
				$expires = (isset($session[$key . '_expires'])) ? $session[$key . '_expires'] : @$_SESSION[$key . '_expires'];
				if (! $expires) {
					// there is no expiration time, keep or store default
					$_SESSION[$key] = (isset($_SESSION[$key])) ? $_SESSION[$key] : $value;
				} elseif (time() <= $expires) {
					// keep existing value if it did not expire
					$_SESSION[$key] = (isset($_SESSION[$key])) ? $_SESSION[$key] : $value;
					$_SESSION[$key . '_expires'] = $expires;
				} else {
					// variable expired, store default
					$_SESSION[$key] = $value;
					$_SESSION[$key . '_expires'] = $expires;
				}
			}
		}
	}
}

/**
 * Delete SESSION variable
 * @param string $names One or more variable name
 */
function delete_session_var($names) {
	$names = (array) $names;
	if ($names) {
		foreach ($names as $name) {
			if (isset($_SESSION[$name . '_default'])) {
				$_SESSION[$name] = $_SESSION[$name . '_default'];
			} else {
				unset($_SESSION[$name]);
			}
			unset($_SESSION[$name . '_time']);
		}
	}
}

/**
 * Delete stored cookie
 * @param string $name
 */
function delete_cookie($name) {
	setcookie($name, '', time() - 3600 * 24);
}

require_once 'web.browser.php';
require_once 'web.curl.php';