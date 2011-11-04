<?

require_once('libs/funcs.php');
require_once('libs/funcs.captcha.php');

$template['js_files']['head'][] = LL_YUI_URI . 'calendar/calendar-min.js';
$template['css_files'][] = LL_YUI_URI . 'calendar/assets/calendar.css';

$actions = db_actions::gets(null, 1);
$smarty->assign_by_ref('actions', $actions);

geoipcity();
$geo = geoip_record_by_addr($geoip, $_SERVER['REMOTE_ADDR']);
$smarty->assign_by_ref('geo', $geo);

$schoolnumber = (isset($_REQUEST['schoolnumber']))?$_REQUEST['schoolnumber']:$_SESSION['llschoolnumber'];
$schoolnumber = (is_numeric($schoolnumber))?$schoolnumber:0;

/*if (!$schoolnumber) {
	$schoolnumber = $_COOKIE['lljoin'];
}*/

if ((!$schoolnumber) || (($schoolnumber) && (!db_schools::exists($schoolnumber, false))))
{
	$schoolnumbers = db_schools::get_list(null, null, null, null, null, null, ' ORDER BY c.name, s.city');
	$schools = array();
	foreach ($schoolnumbers as $schoolnumber)
	{
		$schools[] = db_schools::get($schoolnumber);
	}
	$smarty->assign_by_ref('schools', $schools);
}
else
{
	$school = db_schools::get($schoolnumber);
	$smarty->assign_by_ref('school', $school);
}

$smarty->prepare_display();
if (!$_REQUEST['ajax'])
{
	$smarty->display('header.tpl');
}

$default = $_POST?$_POST:$_REQUEST;
array_walk($default, 'trimtext');
$smarty->assign_by_ref('default', $default);

if (isset($_POST['edit']))
{
	$result_message = 'Please edit any information you find to be incorrect.';
	unset($default['captcha']);
}
elseif (isset($_POST['report']))
{
	$fields = array(
		'emails' => 'actioncontactemail',
		'name' => 'actioncontact',
		'gender' => 'actioncontactgender',
		'number' => array('teachers', 'students', 'parents'),
		'date' => 'perfdate',
		'range' => 'age'
	);
	$result_message = regexp_form($fields, $_POST);
	if ((!$result_message) && ((!required(array('schoolnumber', 'actionnumber', 'perfdate', 'students', 'description'), $_POST)) || (!required('actioncontactgender', $_POST, 'actioncontact'))))
	{
		$result_message = "Please fill in required fields!";
	}
	if ((!$result_message) && (!db_schools::exists($_POST['schoolnumber'], false)))
	{
		$result_message = "The specified school is not in our database!";
	}
	if ((!$result_message) && (!db_actions::exists($_POST['actionnumber'], 1)))
	{
		$result_message = "The specified Guideline Action is not in our database, or is out of date!";
	}
	if ((!$result_message) && (!isset($_POST['confirmed'])))
	{
		$result_message = "Your information seems correct.<br>Please take the time and check it yourself once again!";
		$result_noform = 1;
		
		$report_raw = db_reports::insert($default, $report, 1);
		$report_raw['id'] = 0;
		$report = db_reports::get_full(null, $report_raw);
		$smarty->assign_by_ref('school', $report['school']);
		$smarty->assign_by_ref('report', $report);
	}
	if ((!$result_message) && (!PhpCaptcha::Validate($_POST['captcha'])))
	{
		$result_message = "Your signature is not valid!";
	}
	if (!$result_message)
	{
		$email = new email();
		
		db_reports::insert($default, $report);
		$default['report'] = $report;
		$_SESSION['llreport'] = $report;
		$_SESSION['llreporttime'] = time()+3600*24*365;
		$_SESSION['unique'] = date('YmdHis') . str_rand(19);
		$_SESSION['uniquetime'] = $_SESSION['llreporttime'];

		$report = db_reports::get_full($report);
		$smarty->assign_by_ref('school', $report['school']);
		$smarty->assign_by_ref('report', $report);
		
		$bodyHTML = $smarty->fetch('mail/header.tpl');
		$bodyHTML .= $smarty->fetch('mail/member.tpl');
		$bodyHTML .= $smarty->fetch('mail/report.tpl');
		$bodyHTML .= $smarty->fetch('mail/footer.tpl');
		
		$email->setFrom('"Life-Link Friendship-Schools" <' . LL_MAIL_NOREPLY . '>');
		$email->setReturnPath(LL_MAIL_NOREPLY);
		$to[] = '"Life-Link Friendship-Schools" <' . LL_MAIL . '>';
		$to[] = '"Roula Mecherkany" <roula.mecherkany@life-link.org>';
		
		$email->setSubject('New Action Report from ' . $school['city'] . ', ' . $school['countryname']);
		$email->setHTML($bodyHTML);
		if (LL_DEBUG_EMAIL)
		{
			@ob_clean();
			echo $bodyHTML;
			die;
		}
		else {
			@$email->send($to, 'sendmail');
		}

		$to = array();
		if (validate_emails($school['studentcontactemail'] . ', ' . $school['teachercontactemail'], $valid_emails))
		{
			foreach ($valid_emails as $valid_email)
			{
				$to[] = $valid_email;
			}
		}

		if ($to)
		{
			$autoresponse = new email();
			$bodyHTML = $smarty->fetch('mail/header.tpl');
			$bodyHTML .= $smarty->fetch('mail/autoresponse.tpl');
			$bodyHTML .= $smarty->fetch('mail/member.tpl');
			$bodyHTML .= $smarty->fetch('mail/report.tpl');
			$bodyHTML .= $smarty->fetch('mail/footer.tpl');
			
			$autoresponse->setFrom('"Life-Link Friendship-Schools" <' . LL_MAIL . '>');
			$autoresponse->setReturnPath(LL_MAIL);
			
			$autoresponse->setSubject('Your Life-Link Action Report');
			$autoresponse->setHTML($bodyHTML);
			@$autoresponse->send($to, 'sendmail');
		}
		
		$result_message = "Your Action Report has been delivered and you can now add photos to it!";
		
		$result_noform = 1;
	}
}

if ((isset($_SESSION['llreport'])) && (isset($_SESSION['unique'])))
{
	$photos = read_media_dir(LL_ROOT . "/gallery_actions_upload/" . $_SESSION['unique'], $links['report_photos_get_photo'], $links['report_photos_get_thumbnail']);
	$smarty->assign_by_ref('photos', $photos);
	
	if (count($photos) == 5)
	{
		$result_noupload = 1;
		$smarty->assign_by_ref('result_noupload', $result_noupload);
	}
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