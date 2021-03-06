<?php

require '../libs/config.php';
require '../libs/funcs/web.php';
require '../libs/cssmin/cssmin.php';
define('CACHE_DIR', realpath('./js_css_cache'));
define('CACHE_LIFE', 3600 * 24 * 7);

$input_css = '';

$files = isset($_GET['file']) ? (array) $_GET['file'] : array();

// if files were given, process them, and try to serve a cached compilation
if (count($files)) {
foreach ($files as $key => $file) {
	$file = urldecode($file);
	$files[$key] = $file;
}

$files_md5 = $files;
sort($files_md5);
$files_md5 = md5(implode(',', $files_md5));

$file_cache = CACHE_DIR . "/$files_md5.css";

if (! LL_DEBUG_CSS && file_exists($file_cache) && (time() - filemtime($file_cache) < CACHE_LIFE)) {
	header('Content-Type: text/css');
	header_last_modified(filemtime($file_cache), md5_file($file_cache));
	header_inline("$files_md5.css", filemtime($file_cache));
	header_cache();
		
	echo file_get_contents($file_cache);
	exit(0);
}

foreach ($files as $key => $file) {
	$input_css = $input_css . "\r\n" . file_get_contents($file);
}
}

$css = CSSMin::minify($input_css);
if (! LL_DEBUG_CSS) {
	file_put_contents($file_cache, $css);
}

header('Content-Type: text/css');
header_last_modified(filemtime($file_cache), md5_file($file_cache));
header_inline("$files_md5.css", filemtime($file_cache));
header_cache();

echo $css;