<?php

require '../libs/funcs/web.php';
require '../libs/jsmin/jsmin.php';
define('CACHE_DIR', realpath('./js_css_cache'));
define('CACHE_LIFE', 3600 * 24 * 7);

$files = (array) $_GET['file'];

foreach ($files as $key => $file) {
	$file = urldecode($file);
	$files[$key] = $file;
}

$files_md5 = $files;
sort($files_md5);
$files_md5 = md5(implode(',', $files_md5));

$files_cache = CACHE_DIR . "/$files_md5.js";

if (file_exists($files_cache) && (time() - filemtime($files_cache) < CACHE_LIFE)) {
	header('Content-Type: text/javascript');
	header_last_modified(filemtime($files_cache), md5_file($files_cache));
	header_inline("$files_md5.css", filemtime($files_cache));
	header_cache();
		
	echo file_get_contents($files_cache);
	exit(0);
}

foreach ($files as $key => $file) {
	$input_js = $input_js . "\r\n" . file_get_contents($file);
}

$js = JSMin::minify($input_js);
file_put_contents($files_cache, $js);

header('Content-Type: text/javascript');
header_last_modified(filemtime($files_cache), md5_file($files_cache));
header_inline("$files_md5.js", filemtime($files_cache));
header_cache();

echo $js;