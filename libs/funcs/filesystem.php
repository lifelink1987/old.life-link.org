<?php

/**
 * Implements file functions
 *
 * @author	Andrei Neculau <andrei.neculau@gmail.com>, http://www.andreineculau.com
 * @version	0.1.$LastChangedRevision
 * @date	$LastChangedDate
 */

/**
 * Read directory with descript.ion information
 * @param string $folder
 * @param string $extra['uri_image']
 * @param string $extra['uri_thumb']
 * @param string $extra['uri_file']
 * @param string $extra['uri_icon']
 * @param mixed $extra['filter_extensions']
 * @return mixed
 */
function read_media_dir($folder, $extra = NULL) {
	$result = array();
	extract($extra);
	
	if (isset($filter_extensions)) {
		if (! is_array($filter_extensions)) {
			$filter_extensions = explode(',', $filter_extensions);
		}
	}
	
	if ($folderh = @opendir($folder)) {
		if ($description_file = @fopen($folder . '/descript.ion', 'r')) {
			fgets($description_file, 4096);
			while ($photoinfo = fgets($description_file, 4096)) {
				list ($file, $title, $description) = explode("\|", $photoinfo, 3);
				if (file_exists($folder . '/' . $file)) {
					$result[strtolower($file)] = array(
						'title' => $title ? $title : $file,
						'description' => trim($description)
					);
				}
			}
			fclose($description_file);
		}
		while ($file = readdir($folderh)) {
			$extension = extension($file);
			if (isset($filter_extensions) && ! in_array($extension, $filter_extensions)) {
				continue;
			}
			if (is_file($folder . '/' . $file) && $file != 'descript.ion' && substr($file, 0, 3) != 'tn_') {
				$result[strtolower($file)] = array(
					'folder' => basename($folder),
					'file' => $folder . '/' . $file,
					'extension' => $extension,
					'filename' => $file,
					'filename_url' => rawurlencode($file),
					'title' => $result[strtolower($file)]['title'],
					'description' => $result[strtolower($file)]['description']
				);
				
				//Based on file type add some more info
				if ($uri_image && $uri_thumb && in_array($extension, array(
					'jpg',
					'jpeg',
					'gif',
					'png'
				))) {
					$result[strtolower($file)]['uri'] = $uri_image . rawurlencode($file);
					$result[strtolower($file)]['uri_thumb'] = $uri_thumb . rawurlencode($file);
				} elseif ($uri_file && $uri_icon && in_array($extension, array(
					'pdf',
					'doc',
					'docx',
					'ppt',
					'pptx',
					'xls',
					'xlsx'
				))) {
					$result[strtolower($file)]['uri'] = $uri_file . rawurlencode($file);
					$result[strtolower($file)]['uri_thumb'] = $uri_icon . $extension;
				} elseif ($uri_file && $uri_icon) {
					$result[strtolower($file)]['uri'] = $uri_file . rawurlencode($file);
					$result[strtolower($file)]['uri_thumb'] = $uri_icon . $extension;
				}
			}
		}
		closedir($folderh);
	}
	return $result;
}

/**
 * Write descript.ion for a folder's files (or just images if files are not named)
 * @param string $folder
 * @param mixed $extra['files']
 * @param string $extra['folder_title']
 * @param mixed $extra['titles']
 */
function write_description($folder, $extra = NULL) {
	extract($extra);
	
	$files = $files ? $files : read_media_dir($folder);
	$files = (array) $files;
	$titles = (array) $titles;
	
	$result = array();
	
	if ($fhandle = @fopen($folder . '/descript.ion', 'w')) {
		fwrite($fhandle, $folder_title);
		$i = - 1;
		foreach ($files as $file) {
			$i++;
			$file['title'] = nl2br($titles[$i]);
			$result[] = $photo;
			fwrite($fhandle, "\n" . $file['filename'] . '|' . $file['title'] . '|' . $file['description']);
		}
		fclose($fhandle);
	} else {
		return FALSE;
	}
	return $result;
}

/**
 * Execute a command in background, without waiting for its result
 * @param string $cmd
 */
function exec_background($cmd) {
	if (substr(php_uname(), 0, 7) == 'Windows') {
		pclose(popen("start $cmd > NUL", 'r'));
	} else {
		exec("$cmd > /dev/NULL &");
	}
}

/**
 * Get file extension
 * @param string $filename
 */
function extension($filename, $lower = TRUE) {
	$filename = $lower ? strtolower(basename($filename)) : basename($filename);
	return end(explode('.', $filename));
}
