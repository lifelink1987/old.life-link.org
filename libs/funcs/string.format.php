<?php

/**
 * Implements formatting functions
 *
 * @author	Andrei Neculau <andrei.neculau@gmail.com>, http://www.andreineculau.com
 * @version	0.1.$LastChangedRevision
 * @date	$LastChangedDate
 */

function nl2li($var) {
	$var = preg_replace('/\r/', '', $var);
	$var = preg_replace('/\n{1,}/', '</li><li>', $var);
	return "<li>$var</li>";
}

/**
 * Puts single quotes around a variable, or 'NULL' if empty
 * @param string $var
 * @param boolean $quotes
 * @return string
 */
function nullify($var, $quotes = TRUE) {
	if (is_empty($var))
		$var = 'NULL';
	elseif ($quotes) {
		//$var = mysql_escape_string($var);
		$var = "'$var'";
	}
	return $var;
}

function nullify2(&$var) {
	$var = nullify($var);
}

/**
 * Puts a dash if empty
 *
 * @param string $var
 * @return string
 */
function dashify($var) {
	if (is_empty($var))
		$var = '-';
	return $var;
}

function dashify2(&$var) {
	$var = dashify($var);
}

/**
 * Clean a string/array into a proper URI string/array
 * @param mixed $variable
 * @param bool $html_output
 * @return mixed
 */
function clean_website($variable, $html_output = TRUE) {
	$websites = $variable;
	if (! is_array($websites)) {
		$websites = explode(',', $variable);
		$return_string = TRUE;
	}
	
	$result = array();
	foreach ($websites as $website) {
		$website = 'http://' . trim(str_replace('http://', '', $website));
		$website = $html_output ? '<a href="http://' . $website . '">' . str_max($website, 30) . '</a>' : $website;
		$result[] = $website;
	}
	
	return $return_string ? implode(', ', $result) : $result;
}

/**
 * Clean a string/array into a proper email string/array
 * @param mixed $variable
 * @param mixed $keys
 * @param bool $html_output
 * @return mixed
 */
function clean_email($variable, $keys = NULL, $html_output = TRUE) {
	$emails = $variable;
	if (! is_array($emails)) {
		$emails = explode(',', $variable);
		$return_string = TRUE;
	}
	
	$people = $keys;
	if (! is_array($people)) {
		$people = explode(',', $variable);
	}
	
	$result = array();
	$j = max(count($emails), count($people));
	for ($i = 0; $i < $j; $i++) {
		if ($emails[$i]) {
			$emails[$i] = trim(strtolower($emails[$i]));
			$people[$i] = trim($people[$i]);
			$people[$i] = (is_empty($people[$i])) ? $emails[$i] : $people[$i];
			$result[] = $html_output ? '<a href="mailto:' . $emails[$i] . '">' . $people[$i] . '</a>' : $emails[$i];
		} else {
			$result[] = $people[$i];
		}
	}
	
	return $return_string ? implode(', ', $result) : $result;
}

/**
 * Clean a string/array into a proper Mr./Mrs./Ms. string/array with titles
 * @param mixed $variable
 * @return mixed
 */
function clean_title($variable) {
	$items = $variable;
	if (! is_array($items)) {
		$items = explode(',', $variable);
		$return_string = TRUE;
	}
	
	$result = array();
	foreach ($items as $item) {
		$item = trim($item);
		$item = preg_replace("/^mr\.?\s(.*)/i", "Mr. $1", $item);
		$item = preg_replace("/^mr?s\.?\s(.*)/i", "Ms. $1", $item);
		$item = ucwords(strtolower($item));
		$result[] = $item;
	}
	
	return $return_string ? implode(', ', $result) : $result;
}

/**
 * Return the English ordinal ending for a given number
 * @param numeric $number
 * @return string
 */
function english_ordinal_ending($number) {
	if (($number > 9) && ($number < 20)) {
		$result = 'th';
	} else {
		$last = $number % 10;
		switch ($last) {
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

/**
 * Return the English plural ending for a given comma separated string or an array
 * @param mixed $variable
 * @return string
 */
function english_plural_ending($variable) {
	$items = $variable;
	if (! is_array($items)) {
		$items = explode(',', $variable);
	}
	
	if (count($items) > 1) {
		return 's';
	}
}

function html_entities2(&$string, $quote_style = ENT_COMPAT, $charset = 'UTF-8') {
	$string = htmlentities($string, $quote_style, $charset);
}

function htmlspecialchars2(&$string) {
	$string = htmlspecialchars($string);
}

/**
 * Convert HTML entitites to XML
 * http://techtrouts.com/webkit-entity-nbsp-not-defined-convert-html-entities-to-xml/
 * @param string $string
 * @return string
 */
function xmlentities($string) {
	$html2xml = array( //"&quot;" => "&#34;",
		//"&amp;" => "&#38;",
		//"&lt;" => "&#60;",
		//"&gt;" => "&#62;",
		

		"&nbsp;" => "&#160;",
		"&iexcl;" => "&#161;",
		"&cent;" => "&#162;",
		"&pound;" => "&#163;",
		"&curren;" => "&#164;",
		"&yen;" => "&#165;",
		"&brvbar;" => "&#166;",
		"&sect;" => "&#167;",
		"&uml;" => "&#168;",
		"&copy;" => "&#169;",
		"&ordf;" => "&#170;",
		"&laquo;" => "&#171;",
		"&not;" => "&#172;",
		"&shy;" => "&#173;",
		"&reg;" => "&#174;",
		"&macr;" => "&#175;",
		"&deg;" => "&#176;",
		"&plusmn;" => "&#177;",
		"&sup2;" => "&#178;",
		"&sup3;" => "&#179;",
		"&acute;" => "&#180;",
		"&micro;" => "&#181;",
		"&para;" => "&#182;",
		"&middot;" => "&#183;",
		"&cedil;" => "&#184;",
		"&sup1;" => "&#185;",
		"&ordm;" => "&#186;",
		"&raquo;" => "&#187;",
		"&frac14;" => "&#188;",
		"&frac12;" => "&#189;",
		"&frac34;" => "&#190;",
		"&iquest;" => "&#191;",
		"&Agrave;" => "&#192;",
		"&Aacute;" => "&#193;",
		"&Acirc;" => "&#194;",
		"&Atilde;" => "&#195;",
		"&Auml;" => "&#196;",
		"&Aring;" => "&#197;",
		"&AElig;" => "&#198;",
		"&Ccedil;" => "&#199;",
		"&Egrave;" => "&#200;",
		"&Eacute;" => "&#201;",
		"&Ecirc;" => "&#202;",
		"&Euml;" => "&#203;",
		"&Igrave;" => "&#204;",
		"&Iacute;" => "&#205;",
		"&Icirc;" => "&#206;",
		"&Iuml;" => "&#207;",
		"&ETH;" => "&#208;",
		"&Ntilde;" => "&#209;",
		"&Ograve;" => "&#210;",
		"&Oacute;" => "&#211;",
		"&Ocirc;" => "&#212;",
		"&Otilde;" => "&#213;",
		"&Ouml;" => "&#214;",
		"&times;" => "&#215;",
		"&Oslash;" => "&#216;",
		"&Ugrave;" => "&#217;",
		"&Uacute;" => "&#218;",
		"&Ucirc;" => "&#219;",
		"&Uuml;" => "&#220;",
		"&Yacute;" => "&#221;",
		"&THORN;" => "&#222;",
		"&szlig;" => "&#223;",
		"&agrave;" => "&#224;",
		"&aacute;" => "&#225;",
		"&acirc;" => "&#226;",
		"&atilde;" => "&#227;",
		"&auml;" => "&#228;",
		"&aring;" => "&#229;",
		"&aelig;" => "&#230;",
		"&ccedil;" => "&#231;",
		"&egrave;" => "&#232;",
		"&eacute;" => "&#233;",
		"&ecirc;" => "&#234;",
		"&euml;" => "&#235;",
		"&igrave;" => "&#236;",
		"&iacute;" => "&#237;",
		"&icirc;" => "&#238;",
		"&iuml;" => "&#239;",
		"&eth;" => "&#240;",
		"&ntilde;" => "&#241;",
		"&ograve;" => "&#242;",
		"&oacute;" => "&#243;",
		"&ocirc;" => "&#244;",
		"&otilde;" => "&#245;",
		"&ouml;" => "&#246;",
		"&divide;" => "&#247;",
		"&oslash;" => "&#248;",
		"&ugrave;" => "&#249;",
		"&uacute;" => "&#250;",
		"&ucirc;" => "&#251;",
		"&uuml;" => "&#252;",
		"&yacute;" => "&#253;",
		"&thorn;" => "&#254;",
		"&yuml;" => "&#255;",
		"&euro;" => "&#8364;"
	);
	
	// HTML entities are case-sensitive (http://htmlhelp.com/reference/html40/entities/)
	return str_replace(array_keys($html2xml), array_values($html2xml), $string);
}

function xmlhtmlentities($string, $quote_style = ENT_COMPAT, $charset = 'UTF-8') {
	return xmlentities(htmlentities($string, $quote_style, $charset));
}

function xmlhtmlentities2(&$string) {
	$string = xmlhtmlentities($string);
}