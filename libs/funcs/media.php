<?php

require_once 'web.php';
require_once 'filesystem.php';
@ini_set('gd.jpeg_ignore_warning', 1);

/**
 * Implements image functions
 *
 * @author	Andrei Neculau <andrei.neculau@gmail.com>, http://www.andreineculau.com
 * @version	0.1.$LastChangedRevision
 * @date	$LastChangedDate
 */

function download($filepath) {
	@ob_end_clean();
	$mtime = ($mtime = filemtime($filepath)) ? $mtime : gmtime();
	
	$fname = basename($filepath);
	$fsize = filesize($filepath);
	$bufsize = 20000;
	
	// IE Bug in download name workaround
	if (is_msie()) {
		ini_set('zlib.output_compression', 'Off');
	}
	
	//Partial or full download?
	if (isset($_SERVER['HTTP_RANGE'])) {
		//Parse range headers
		if (preg_match("/^bytes=(\\d+)-(\\d*)$/", $_SERVER['HTTP_RANGE'], $matches)) {
			$from = $matches[1];
			$to = $matches[2];
			//If there's no length, then just deliver the rest -1 (without the end byte)
			if (! $to) {
				$to = $fsize - 1;
			}
			$content_size = $to - $from + 1;
			
			header_last_modified($mtime);
			header_download($fname, $mtime);
			header_cache();
			header('HTTP/1.1 206 Partial Content');
			header('Content-Range: ' . $from . '-' . $to . '/' . $fsize);
			header('Content-Length: ' . $content_size);
			
			if (file_exists($filepath) && $fh = fopen($filepath, 'rb')) {
				fseek($fh, $from);
				$cur_pos = ftell($fh);
				while ($cur_pos !== FALSE && ftell($fh) + $bufsize < $to + 1) {
					$buffer = fread($fh, $bufsize);
					print $buffer;
					$cur_pos = ftell($fh);
				}
				
				$buffer = fread($fh, $to + 1 - $cur_pos);
				print $buffer;
				
				fclose($fh);
				exit(0);
			} else {
				header('HTTP/1.1 404 Not Found');
				exit(0);
			}
		} else {
			header('HTTP/1.1 500 Internal Server Error');
			exit(0);
		}
	} else {
		header_last_modified($mtime);
		header_download($fname, $mtime);
		header_cache();
		header('Content-Length: ' . $fsize);
		
		if (file_exists($filepath) && $fh = fopen($filepath, 'rb')) {
			while ($buf = fread($fh, $bufsize)) {
				print $buf;
			}
			fclose($fh);
		} else {
			header('HTTP/1.1 404 Not Found');
		}
		exit(0);
	}
}

/**
 * Output an error image
 * @param unknown_type $ratio_width_to_height
 */
function error_image($aspect_ratio = 1) {
	@ob_end_clean();
	
	$img = imagecreate(100, 100 * 1 / $aspect_ratio);
	imagecolorallocate($img, 0, 0, 0);
	$c = imagecolorallocate($img, 70, 70, 70);
	imageline($img, 0, 0, 100, 100 * 1 / $aspect_ratio, $c);
	imageline($img, 100, 0, 0, 100 * 1 / $aspect_ratio, $c);
	
	header('Content-Type: image/png');
	header_cache();
	imagepng($img);
	imagedestroy($img);
	exit(0);
}

function show_image($filepath) {
	@ob_end_clean();
	$mtime = ($mtime = filemtime($filepath)) ? $mtime : gmtime();
	$extension = extension($filepath);
	$fsize = filesize($filepath);
	
	if ($extension == 'jpeg' || $extension == 'jpg') {
		header('Content-Type: image/jpeg');
	} elseif ($extension == 'png') {
		header('Content-Type: image/png');
	} elseif ($extension == 'gif') {
		header('Content-Type: image/gif');
	} elseif ($extension == 'bmp') {
		header('Content-Type: image/bmp');
	}
	
	header_last_modified($mtime, md5_file($filepath));
	header_inline(basename($filepath), $mtime);
	header_cache();
	header('Content-Length: ' . $fsize);
	
	readfile($filepath);
	exit(0);
}

/**
 * Show a PNG/JPEG/GIF image as inline PNG
 * @param string $file File path
 * @param numeric $width_max Maximum accepted width (pixels)
 * @param numeric $aspect_ratio Width to height ratio
 * @param bool $all Clip or fill with empty areas
 */
function show_png($filepath, $width_max = NULL, $aspect_ratio = NULL, $all = FALSE, $unique_suffix = NULL) {
	$extension = extension($filepath);
	$mtime = ($mtime = filemtime($filepath)) ? $mtime : gmtime();
	
	header_last_modified($mtime);
	
	if (!$unique_suffix) {
		$unique_suffix .= $width_max ? ".w$width_max" : '';
		$unique_suffix .= $all ? '.all' : '.not_all';
	}
	
	//Check cache
	if (defined('IMAGE_CACHE_DIR')) {
		$file_cache = IMAGE_CACHE_DIR . '/' . md5($filepath) . $unique_suffix . '.png';
		if (file_exists($file_cache)) {
			header_last_modified($mtime, md5_file($file_cache));
			header_inline(str_replace(extension($filepath, FALSE), 'png', basename($filepath)), $mtime);
			header_cache();
			header('Content-Type: image/png');
			
			readfile($file_cache);
			exit(0);
		}
	}
	
	//Create image
	if ($extension == 'jpeg' || $extension == 'jpg') {
		$img = imagecreatefromjpeg($filepath);
	} elseif ($extension == 'png') {
		$img = imagecreatefrompng($filepath);
		imagealphablending($img, TRUE);
		imagesavealpha($img, TRUE);
	} elseif ($extension == 'gif') {
		$img = imagecreatefromgif($filepath);
		imagesavealpha($img, TRUE);
	}
	
	//On error then output an error image
	if ($img === FALSE) {
		error_image($aspect_ratio);
	}
	
	//Resize image
	if ($width_max) {
		$img = resize_image($img, $width_max, $aspect_ratio, $all);
		
		# Create error image if necessary
		if (! $img)
			error_image($aspect_ratio);
	}
	
	//Display the image
	@ob_end_clean();
	header_inline(str_replace(extension($filepath, FALSE), 'png', basename($filepath)), $mtime);
	header('Content-Type: image/png');
	imagepng($img);
	if (defined('IMAGE_CACHE_DIR')) {
		imagepng($img, $file_cache);
		header_cache();
		header_last_modified($mtime, md5_file($file_cache));
	}
	exit(0);
}

/**
 * Resize a PHP image object
 * @param object $img
 * @param numeric $width_max
 * @param numeric $aspect_ratio
 * @param bool $all
 */
function resize_image($img, $width_max, $aspect_ratio = NULL, $all = FALSE/*, $portrait = FALSE*/)
{
	//Get image size and scale ratio
	$width = imagesx($img);
	$height = imagesy($img);
	
	if ($aspect_ratio) {
		$height_max = $width_max * 1 / $aspect_ratio;
	} else {
		$height_max = $width_max / $width * $height;
	}
	
	/*	if (($portrait) && ($width < $height))
	{
		$tmp = $width;
		$width = $height;
		$height = $tmp;
		unset($tmp);
		$ratio = 1/$ratio;
	}*/
	
	$wscale = $width_max / $width;
	$hscale = $height_max / $height;
	$scale = $all ? min($wscale, $hscale) : max($wscale, $hscale);
	
	//If the image size is larger than the maximum accepted, then shrink it
	if (($hscale < 1) || ($wscale < 1)) {
		$new_width = min($width, floor($scale * $width));
		$new_height = min($height, floor($scale * $height));
		
		//Create a new temporary image for resampling
		$tmp_img = imagecreatetruecolor($new_width, $new_height);
		$white = imagecolorallocate($tmp_img, 255, 255, 255);
		imagefill($tmp_img, 0, 0, $white);
		
		//Copy and resize old image into new image
		imagecopyresampled($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		imagedestroy($img);
		
		if (! $all) {
			$img = $tmp_img;
			
			//Create a new temporary image for adjusting canvas size
			$tmp_img = imagecreatetruecolor($width_max, $height_max);
			$white = imagecolorallocate($tmp_img, 255, 255, 255);
			imagefill($tmp_img, 0, 0, $white);
			
			$diff_x = abs(floor(($width_max - $new_width) / 2));
			$diff_y = abs(floor(($height_max - $new_height) / 2));
			
			$diff_width = ($width != $new_width) ? $diff_x : 0;
			$diff_height = ($height != $new_height) ? $diff_y : 0;
			
			if ($width_max < $new_width) {
				$diff_x = 0;
			}
			if ($height_max < $new_height) {
				$diff_y = 0;
			}
			//Copy and resize old image into new image
			imagecopy($tmp_img, $img, $diff_x, $diff_y, $diff_width, $diff_height, $width_max, $height_max);
			imagedestroy($img);
			
			imagefill($tmp_img, $width_max - 1, $height_max - 1, $white);
		}
		return $tmp_img;
	} else {
		return $img;
	}
}
