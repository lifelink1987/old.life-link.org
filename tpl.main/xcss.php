<?php

require '../libs/funcs/web.php';
define('CACHE_DIR', realpath('./js_css_cache'));
define('CACHE_LIFE', 3600 * 24 * 7);

$input_xcss_vars = file_get_contents('css/source/vars_dynamic.css');

$files = (array) $_GET['file'];

foreach ($files as $key => $file) {
	$file = urldecode($file);
	$file = str_replace('../', '', $file);
	if (file_exists(realpath('.' . $file))) {
		$file = realpath('.' . $file);
	} else {
		$file = realpath('./pages' . $file);
	}
	$files[$key] = $file;
}

$files_md5 = $files;
sort($files_md5);
$files_md5 = md5(implode(',', $files_md5));
$files_cache = CACHE_DIR . "/$files_md5.css";

if (file_exists($files_cache) && (time() - filemtime($files_cache) < CACHE_LIFE)) {
	$timestamp = 0;
	foreach ($files as $key => $file) {
		if (filemtime($file) > $timestamp) {
			$timestamp = filemtime($file);
		}
	}

	if ($timestamp < filemtime($files_cache)) {
		header('Content-Type: text/css');
		header_last_modified(filemtime($files_cache), md5_file($files_cache));
		header_inline("$files_md5.css", filemtime($files_cache));
		header_cache();
		
		echo file_get_contents($files_cache);
		exit(0);
	}
}

$input_xcss = '';
foreach ($files as $key => $file) {
	$input_xcss = $input_xcss . file_get_contents($file);
}

define('XCSSCLASS', 'css/xcss/xcss-class.php');
file_exists(XCSSCLASS) ? include XCSSCLASS : die('alert("xCSS Parse error: Can\'t find the xCSS class file: \''.XCSSCLASS.'\'.");');

define('XCSSCONFIG', 'css/xcss/config.php');
file_exists(XCSSCONFIG) ? include XCSSCONFIG : die('alert("xCSS Parse error: Can\'t find the xCSS config file: \''.XCSSCONFIG.'\'.");');

$xCSS = new xCSS($config);

$css = $xCSS->compile($input_xcss_vars . $input_xcss);
file_put_contents($files_cache, $css);

header('Content-Type: text/css');
header_last_modified(filemtime($files_cache), md5_file($files_cache));
header_inline("$files_md5.css", filemtime($files_cache));
header_cache();

echo $css;

