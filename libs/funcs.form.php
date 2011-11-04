<?php

function update_querystring($new_keys, $new_values = null, $skips = null, $addAmpersand = 0, $querystring = null)
{
	$query = array();
	if (!$querystring)
	{
		$query = array_merge($_GET, $_POST);
	}
	else
	{
		parse_str($querystring, $query);
	}
	$new_keys = (array) $new_keys;
	$new_values = (array) $new_values;
	if ($new_keys)
	{
		$news = array_combine($new_keys, $new_values);
		foreach ($news as $new_key => $new_value)
		{
			$query[$new_key] = $new_value;
		}
	}
	$skips = (array) $skips;
	$skips = array_merge($skips, array('template', 'jsenabled'));
	if ($skips)
	{
		foreach ($skips as $skip)
		{
			unset($query[$skip]);
		}
	}
	$querystring = http_build_query($query);
	if (($addAmpersand) && ($querystring))
	{
		$querystring = '&' . $querystring;
	}
	return $querystring;
}

function register_session($names, $default_values)
{
	$names = (array) $names;
	$default_values = (array) $default_values;
	$session = array_combine($names, $default_values);
	if ($session)
	{
		foreach ($session as $key => $value)
		{
			if (strpos($key, '_time')) continue;
			if (isset($_POST[$key]))
			{
				$_SESSION[$key] = $_POST[$key];
			}
			elseif (isset($_GET[$key]))
			{
				$_SESSION[$key] = $_GET[$key];
			}
			else
			{
				$time = (isset($session[$key . '_time']))?$session[$key . '_time']:$_SESSION[$key . '_time'];
				if (!$time)
				{
					$_SESSION[$key] = (isset($_SESSION[$key]))?$_SESSION[$key]:$value;
				}
				elseif (time() <= $time) {
					$_SESSION[$key] = (isset($_SESSION[$key]))?$_SESSION[$key]:$value;
					$_SESSION[$key . '_time'] = $time;
				}
				else {
					$_SESSION[$key] = $value;
					$_SESSION[$key . '_time'] = $time;
				}
			}
		}
	}
}

function delete_cookie($name)
{
	setcookie($name, "", time()-3600*24);
}

function required($elem, $parent = null, $dependency = null)
{
	if (!is_array($elem))
	{
		$elem = array($elem);
	}
	if ($parent)
	{
		if ((!is_null($dependency)) && (empty($parent[$dependency])))
		{
			return true;
		}
	}
	elseif ((!is_null($dependency)) && (empty($dependency)))
	{
		return true;
	}
	foreach ($elem as $e)
	{
		if ($parent)
		{
			if (empty($parent[$e]))
			{
				echo $e;
				return false;
			}
		}
		elseif (empty($e))
		{
			return false;
		}
	}
	return true;
}

function regexp_check($value, $type)
{
	switch (strtolower($type))
	{
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
	if ($regexp)
	{
		return preg_match($regexp, $value);
	}
	return true;
}

function regexp_fields($fields, $type, $parent = null)
{
	if (!is_array($fields))
	{
		$fields = array($fields);
	}
	foreach ($fields as $field)
	{
		$text = "Field '$field' doesn't fulfill the format requirement.";
		if ($parent)
		{
			$field = $parent[$field];
		}
		if (($field) && (!regexp_check($field, $type)))
		{
			$results[] = $text;
		}
	}
	return $results;
}

function regexp_form($fields, $parent = null)
{
	$results = array();
	foreach ($fields as $type => $fields_raw)
	{
		$text = regexp_fields($fields_raw, $type, $parent);
		if ($text)
		{
			$results = array_merge($results, $text);
		}
	}
	return implode('<br>', $results);
}

function form_array($field, $parent = null)
{
	if (!$parent)
	{
		$parent =& $_REQUEST;
	}
	$i = 1;
	$result = array();
	while (isset($parent[$field . $i]))
	{
		$result[] = $parent[$field . $i];
		$i++;
	}
	return $result;
}

?>