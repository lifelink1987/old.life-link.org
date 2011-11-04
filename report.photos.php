<?php

require_once('libs/funcs.php');

if ($_REQUEST['photo']) 
{
	if (!$_SESSION['unique']) exit();
	if (!$_REQUEST['delete'])
	{
		$width_max = isset($_REQUEST['thumbnail'])?$tpl['image_sizes']['action_tw']:$tpl['image_sizes']['action_pw'];
		show_image(LL_ROOT . "/gallery_actions_upload/" . $_SESSION['unique'] . '/' . $_REQUEST['photo'], $width_max, $tpl['image_sizes']['action_pr']);
		exit();
	}
	else {
		unlink(LL_ROOT . "/gallery_actions_upload/" . $_SESSION['unique'] . '/' . $_REQUEST['photo']);
	}
}

$smarty->prepare_display();
if (!$_REQUEST['ajax'])
{
	$smarty->display('header.tpl');
}

$default = $_POST;
$smarty->assign_by_ref('default', $default);

if (isset($_POST['upload']))
{
	if ((!$result_message) && ($_FILES['document']['error'] == UPLOAD_ERR_NO_FILE))
	{
		$result_message = "No file has been selected for upload!";
	}
	if (!$result_message)
	{
		if ($_FILES["document"]["error"] == UPLOAD_ERR_OK)
		{
			$tmp_name = $_FILES["document"]["tmp_name"];
			$name = $_FILES["document"]["name"];
			$size = $_FILES["document"]["size"];
			
			$photo = @imagecreatefromjpeg($tmp_name);
			if ($photo)
			{
				$i++;
				$dir = LL_ROOT . "/gallery_actions_upload/" . $_SESSION['unique'];
				@mkdir($dir, 0700, true);
				//$photo = resize_image($photo, LL_PHOTO_WIDTH, LL_PHOTO_WIDTH/LL_PHOTO_HEIGHT);
				if (file_exists("$dir/$name"))
				{
					$result_message = "A file with the same name was already uploaded! New file was not uploaded!";
				}
				elseif (!@imagejpeg($photo, "$dir/$name"))
				{
					$result_message = "Couldn't save JPEG image! File was not uploaded!";
				}
			}
			else {
				$result_message = 'No JPEG image! File was not uploaded!';
			}
			@imagedestroy($photo);
		}
		elseif ($_FILES["document"]["error"] == UPLOAD_ERR_INI_SIZE) {
			$result_message = 'Your file exceeded the maximum size: ' . ini_get('upload_max_size') . '. File was not uploaded!';
		}
		elseif ($_FILES["document"]["error"] == UPLOAD_ERR_EXTENSION) {
			$result_message = 'Your file extension is not supported by this server. File was not uploaded!';
		}
		else {
			$result_message = 'An unknown error occured. File was not uploaded!';
		}
	}
}
elseif (isset($_POST['photos']))
{
	if (db_reports::upload_photos($_SESSION['llreport'], $_SESSION['unique']))
	{
		$result_message = "Your Action Photos have been attached!<br><br>";
	}
	$result_message .= "Your Action Reporting is now complete!";
	$result_noform = 1;
	$_SESSION['llreport'] = null;
	$_SESSION['unique'] = null;
}
elseif (isset($_POST['delete']))
{
	$path = LL_ROOT . "/gallery_actions_upload/" . $_SESSION['unique'];
	
	if ($handle = @opendir($path))
	{
		while ($file = readdir($handle))
		{
			unlink($folder . '/' . $file, "/gallery_actions/$id/" . $file);
		}
		closedir($folder);
		rmdir($folder);
	}
	$result_message = "No Action Photos have been attached!<br><br>Your Action Report process is now complete!";
	$result_noform = 1;
	$_SESSION['llreport'] = null;
	$_SESSION['unique'] = null;
}

if ((isset($_SESSION['llreport'])) && (isset($_SESSION['unique'])))
{
	$report = db_reports::get_full($_SESSION['llreport']);
	$smarty->assign_by_ref('school', $report['school']);
	$smarty->assign_by_ref('report', $report);

	$photos = read_media_dir(LL_ROOT . "/gallery_actions_upload/" . $_SESSION['unique'], $links['report_photos_get_photo'], $links['report_photos_get_thumbnail']);
	$smarty->assign_by_ref('photos', $photos);
	
	if (count($photos) == 5)
	{
		$result_noupload = 1;
		$smarty->assign_by_ref('result_noupload', $result_noupload);
	}
}
else {
	if (!$result_message)
	{
		$result_message = "You can only add Action Photos online after an online sending of an Action Report.";
	}
	$result_noform = 1;
}

if (isset($_POST['titles']))
{
	$path = LL_ROOT . "/gallery_actions_upload/" . $_SESSION['unique'];
	$photos = write_image_description($path, $photos, 'Report ' . $_SESSION['llreport'], form_array('title', $_POST));
}
	
$smarty->assign_by_ref('result_message', $result_message);
$smarty->assign_by_ref('result_noform', $result_noform);

if (!$_REQUEST['ajax'])
{
	$smarty->display($smarty->get_page_default() . 'default.tpl');
}
else
{
	$smarty->display($smarty->get_page_default() . 'results.tpl');
}

if (!$_REQUEST['ajax'])
{
	$smarty->display('footer.tpl');
}
?>