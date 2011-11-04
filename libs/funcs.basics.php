<?php

/*
	Function coded by Stephan Pirson
	contact: saibot@hesperia-mud.org
*/

function print_a( $TheArray )
{ // Note: the function is recursive
	echo "<table border=0 cellspacing=1 cellpadding=1>\n";

	$Keys = array_keys($TheArray);
	foreach ($Keys as $OneKey)
	{
		echo "<tr>\n";

		echo "<td bgcolor='#AAAAAA' valign='top'>";
		echo "<B>" . $OneKey . "</B>";
		echo "</td>\n";

		echo "<td bgcolor='#EEEEEE' valign='top'>";
		if (is_array($TheArray[$OneKey]))
		{
			print_a($TheArray[$OneKey]);
		}
		else
		{
			echo str_replace("\n", "<br>\n", $TheArray[$OneKey]);
		}
		echo "</td>\n";

		echo "</tr>\n";
	}
	echo "</table>\n";
}

function redirect($URI)
{
	ob_clean();
	$URI = htmlspecialchars_decode($URI);
	header('Location: ' . LL_WEB . $URI);
	die();
}

function str_max($string, $maxlen, $tolerance = 3)
{
	if (strlen($string) > $maxlen+$tolerance)
	{
		$string = substr($string, 0, $maxlen) . '...';
	}
	return $string;
}

function str_rand($length, $useupper = false, $usenumbers = false)
{
	$charset = 'abcdefghijklmnopqrstuvwxyz';
	if ($useupper)
	{
		$charset .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	}
	if ($usenumbers)
	{
		$charset .= '0123456789';
	}
		for ($i=0; $i<$length; $i++)
		{
			$key .= $charset[(mt_rand(0, (strlen($charset)-1)))];
		}
		return $key;
}

function check_null($variable, $type = null, $htmlentities = 0)
{
	if (empty($variable))
	{
		switch ($type)
		{
			case 'integer' : return 0; break;
			case 'string' : return ''; break;
			default : return '-';
		}
	}
	else
	{
		if ($htmlentities)
		{
			return htmlentities($variable);
		}
		return $variable;
	}
}

function check_plural($variable)
{
	$people = explode(',', $variable);
	if (count($people) > 1)
	{
		return 's';
	}
}

function check_website($variable)
{
	$websites = explode(',', $variable);
	$webstring = '';
	foreach ($websites as $website)
	{
		if ($website)
		{
			$website = str_replace('http://', '', $website);
			$website = trim($website);
			$website = ', <a href="http://' . $website . '" rel="nofollow">' . str_max($website, 30) . '</a>';
			$webstring .= $website;
		}
	}
	if ($webstring)
	{
		$webstring = substr($webstring, 2);
		return $webstring;
	}
	else
	{
		return '-';
	}
}

function check_email($variable, $people = null)
{
	$emails = explode(',', $variable);
	$people = explode(',', $people);
	$result = array();
	$j = max(count($emails), count($people));
	for ($i = 0; $i < $j; $i++)
	{
		if ($emails[$i])
		{
			$emails[$i] = trim(strtolower($emails[$i]));
			$people[$i] = trim($people[$i]);
			$people[$i] = (empty($people[$i]))?$emails[$i]:$people[$i];
			$result[] = '<a href="mailto:' . $emails[$i] . '" class="mail">' . $people[$i] . '</a>';
		}
		else {
			$result[] = $people[$i];
		}
	}
	if ($result)
	{
		return implode(', ', $result);
	}
	else
	{
		return '-';
	}
}

function check_gender($variable, $simple = false)
{
	if ($simple)
	{
		if ($variable == 'f') return 'Ms. ';
		if ($variable == 'm') return 'Mr. ';
		return;
	}
	$people = explode(',', $variable);
	$result = array();
	foreach ($people as $person)
	{
		$person = trim($person);
		$person = preg_replace("/^mr\.?\s(.*)/i", "Mr. $1", $person);
		$person = preg_replace("/^mr?s\.?\s(.*)/i", "Ms. $1", $person);
		$person = ucwords(strtolower($person));
		$result[] = $person;
	}
	return implode(', ', $result);
}

function mailto($emails_array)
{
	$emails = array();
	if (count($emails_array))
	{
		foreach ($emails_array as $emailstring)
		{
			$emails = array_merge($emails, explode(',', $emailstring));
		}
		array_walk($emails, 'trim');
		$emails = array_unique($emails);
		return 'mailto:' . implode(',', $emails);
	}
}

function substr_search($haystack, $needles, $between_start, $between_end)
{
	if (!is_array($needles))
	{
		$needles[] = $needles;
	}
	$start = 0;
	foreach ($needles as $needle)
	{
		$start = strpos($haystack, $needle, $start);
	}
	$start = strpos($haystack, $between_start, $start);
	$end = strpos($haystack, $between_end, $start);
	$start += strlen($between_start);
	return substr($haystack, $start, $end-$start);
}

function ordinal_ending($number)
{
	if (($number > 9) && ($number < 20))
	{
		$result = 'th';
	}
	else
	{
		$last = $number % 10;
		switch ($last)
		{
			case 1:
				$result = 'st';
				break;
			case 2:
				$result = 'nd';
				break;
			case 3:
				$result = 'rd';
				break;
			default:
				$result = 'th';
		}
	}
	return $result;
}

function db_line_clean(&$item, $key)
{
	$item = trim($item);
}

function trimtext(&$item, $key = null)
{
	$item = trim($item);
	$item = preg_replace("/ {2,}/", ' ', $item);
	$item = preg_replace("/\"/", "'", $item);
	$item = preg_replace("/\n{3,}/", "\n\n", $item);
	return $item;
}

function trimmultiple(&$item, $key = null)
{
	$items = explode(',', $item);
	array_walk($items, 'trimtext');
	$item = implode(', ', $items);
	return $item;
}

?>