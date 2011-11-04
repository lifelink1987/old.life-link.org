<?php

function download($fpath)
{
	@ob_end_clean();
	$fname = basename($fpath);
	$fsize = filesize($fpath);
	$bufsize = 20000;
	if(isset($_SERVER['HTTP_USER_AGENT']) && preg_match("/MSIE/", $_SERVER['HTTP_USER_AGENT']))
	{
		// IE Bug in download name workaround
		ini_set('zlib.output_compression', 'Off');
	}

	if(isset($_SERVER['HTTP_RANGE']))  //Partial download
	{
		if(preg_match("/^bytes=(\\d+)-(\\d*)$/", $_SERVER['HTTP_RANGE'], $matches))
		{ //parsing Range header
			$from = $matches[1];
			$to = $matches[2];
			if(empty($to))
			{
				$to = $fsize - 1;  // -1  because end byte is included
                           //(From HTTP protocol:
													// 'The last-byte-pos value gives the byte-offset of the last byte in the range; that is, the byte positions specified are inclusive')
			}
			$content_size = $to - $from + 1;

			header("HTTP/1.1 206 Partial Content");
			header("Content-Range: $from-$to/$fsize");
			header("Content-Length: $content_size");
			header("Content-Type: application/force-download");
			header("Content-Disposition: attachment; filename=$fname");
			header("Content-Transfer-Encoding: binary");
			header("Cache-control: no-cache, must-revalidate");
			header("Pragma: private");

			if(file_exists($fpath) && $fh = fopen($fpath, "rb"))
			{
				fseek($fh, $from);
				$cur_pos = ftell($fh);
				while($cur_pos !== FALSE && ftell($fh) + $bufsize < $to+1)
				{
					$buffer = fread($fh, $bufsize);
					print $buffer;
					$cur_pos = ftell($fh);
				}

				$buffer = fread($fh, $to+1 - $cur_pos);
				print $buffer;

				fclose($fh);
				exit;
			}
			else
			{
				header("HTTP/1.1 404 Not Found");
				exit;
			}
		}
		else
		{
			header("HTTP/1.1 500 Internal Server Error");
			exit;
		}
	}
	else // Usual download
	{
		header("HTTP/1.1 200 OK");
		header("Content-Length: $fsize");
		header("Content-Type: application/force-download");
		header("Content-Disposition: attachment; filename=$fname");
		header("Content-Transfer-Encoding: binary");
		header("Cache-control: no-cache, must-revalidate");
		header("Pragma: private");

		if(file_exists($fpath) && $fh = fopen($fpath, "rb"))
		{
			while($buf = fread($fh, $bufsize))
			{
				print $buf;
			}
			fclose($fh);
		}
		else
		{
			header("HTTP/1.1 404 Not Found");
		}
		exit;
	}
}

function error_image($ratio = 1) {
	$img = imagecreate(100, 100 * 1/$ratio);
	imagecolorallocate($img,0,0,0);
	$c = imagecolorallocate($img,70,70,70);
	imageline($img, 0, 0, 100, 100 * 1/$ratio, $c);
	imageline($img, 100, 0, 0, 100 * 1/$ratio, $c);
	header("Content-type: image/jpeg");
	imagejpeg($img);
	exit();
}

function show_image($file, $width_max, $ratio, $all = false)
{
	@ob_clean();

	$extension = strtolower(substr(strrchr($file, '.'), 1));
	# Get image location
	if ($extension == 'jpeg' || $extension == 'jpg') {
		$img = imagecreatefromjpeg($file);
	}elseif ($extension == 'png') {
		$img = imagecreatefrompng($file);
		imagealphablending($img, true);
		imagesavealpha($img, true);
	}elseif ($extension == 'gif') {
		$img = imagecreatefromgif($file);
		imagesavealpha($img, true);
	}
	if ($img === false)
	{
		error_image($ratio);
	}
	$img = resize_image($img, $width_max, $ratio, $all);

	# Create error image if necessary
	if (!$img) error_image($ratio);

	# Display the image
	@ob_clean();
	header("Content-type: image/png");
	imagepng($img);
	exit();
}

function resize_image($img, $width_max, $ratio, $all = false/*, $portrait = false*/)
{
	$height_max = $width_max * 1/$ratio;

	# Get image size and scale ratio
	$width = imagesx($img);
	$height = imagesy($img);
	
/*	if (($portrait) && ($width < $height))
	{
		$tmp = $width;
		$width = $height;
		$height = $tmp;
		unset($tmp);
		$ratio = 1/$ratio;
	}
*/
	$wscale = $width_max/$width;
	$hscale = $height_max/$height;
	$scale = $all?min($wscale, $hscale):max($wscale, $hscale);
	
	# If the image is larger than the max, then shrink it
	if (($hscale < 1) || ($wscale < 1)) {
		$new_width = min($width, floor($scale*$width));
		$new_height = min($height, floor($scale*$height));
	
		# Create a new temporary image for resampling
		$tmp_img = imagecreatetruecolor($new_width, $new_height);
		$white = imagecolorallocate($tmp_img, 255, 255, 255);
		imagefill($tmp_img, 0, 0, $white);
		
		# Copy and resize old image into new image
		imagecopyresampled($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		imagedestroy($img);
		
		if (!$all)
		{
			$img = $tmp_img;
		
			# Create a new temporary image for adjusting canvas size
			$tmp_img = imagecreatetruecolor($width_max, $height_max);
			$white = imagecolorallocate($tmp_img, 255, 255, 255);
			imagefill($tmp_img, 0, 0, $white);
			
			$diff_x = abs(floor(($width_max-$new_width)/2));
			$diff_y = abs(floor(($height_max-$new_height)/2));
			
			$diff_width = ($width != $new_width)?$diff_x:0;
			$diff_height = ($height != $new_height)?$diff_y:0;
			
			if ($width_max < $new_width){
				$diff_x = 0;
			}
			if ($height_max < $new_height){
				$diff_y = 0;
			}
			# Copy and resize old image into new image
			imagecopy($tmp_img, $img, $diff_x, $diff_y, $diff_width, $diff_height, $width_max, $height_max);
			imagedestroy($img);
			
			imagefill($tmp_img, $width_max-1, $height_max-1, $white);
		}
		return $tmp_img;
	}
	else {
		return $img;
	}
}

function read_media_dir($path, $photo_link = null, $thumbnail_link = null, $other_link = null)
{
	if ($handle = @opendir($path))
	{
		if ($fhandle = @fopen($path . '/descript.ion', 'r'))
		{
			fgets($fhandle, 4096);
			while ($photoinfo = fgets($fhandle, 4096))
			{
				list($file, $title, $description) = split("\|", $photoinfo, 3);
				if (file_exists($path . '/' . $file))
				{
					$result[strtolower($file)] = array(
						'title' => $title?$title:$file,
						'description' => trim($description)
					);
				}
			}
			fclose($fhandle);
		}
		while ($file = readdir($handle))
		{
			if ((is_file($path . '/' . $file)) && (strpos($file, 'tn_') === false) && ($file != 'descript.ion'))
			{
				if (isset($result[strtolower($file)])) {
					$result[strtolower($file)]['title'] = $result[strtolower($file)]['title'];
					$result[strtolower($file)]['description'] = $result[strtolower($file)]['description'];
				} else {
					$result[strtolower($file)] = array(
						'report_id' => $id,
						'file' => $path . '/' . $file,
						'filename' => $file,
						'filename_url' => rawurlencode($file),
						'title' => $result[strtolower($file)]['title'],
						'description' => $result[strtolower($file)]['description']
					);
				}
				$extension = strtolower(substr(strrchr($file, '.'), 1));
				if (in_array($extension, array('jpg', 'jpeg', 'gif', 'png')))
				{
					$result[strtolower($file)]['url'] =  $photo_link . rawurlencode($file);
					$result[strtolower($file)]['thumbnail'] = $thumbnail_link . rawurlencode($file);
				} elseif (in_array($extension, array('pdf', 'doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx'))) {
					$result[strtolower($file)]['url'] =  $other_link . rawurlencode($file);
					$result[strtolower($file)]['thumbnail'] = $other_link . "icon/$extension";
				} else {
					$result[strtolower($file)]['url'] =  $other_link . rawurlencode($file);
					$result[strtolower($file)]['thumbnail'] = $other_link . "icon/file";
				}
			}
		}
		closedir($handle);
	}
	return $result;
}

function write_image_description($path, $photos = null, $title = null, $titles = null)
{
	if (!$photos)
	{
		$photos = read_images_dir($path);
	}
	$result = array();
	
	if ($fhandle = @fopen($path . '/descript.ion', 'w'))
	{
		fwrite($fhandle, "$title");
		$i = -1;
		foreach ($photos as $photo)
		{
			$i++;
			$photo['title'] = nl2br($titles[$i]);
			$result[] = $photo;
			fwrite($fhandle, "\n" . $photo['filename'] . '|' . $photo['title'] . '|' . $photo['description']);
		}
		fclose($fhandle);
	}
	else {
		return false;
	}
	return $result;
}

?>
