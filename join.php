<?

require_once('libs/funcs.php');
require_once('libs/funcs.captcha.php');

$template['js_files']['head'][] = LL_YUI_URI . 'calendar/calendar-min.js';
$template['css_files'][] = LL_YUI_URI . 'calendar/assets/calendar.css';
$template['js_files']['head'][] = LL_YUI_URI . 'autocomplete/autocomplete-min.js';

$countries = db_countries::gets();
$smarty->assign_by_ref('countries', $countries);
$actions = db_actions::gets(null, 1);
$smarty->assign_by_ref('actions', $actions);

geoipcity();
$geo = geoip_record_by_addr($geoip, $_SERVER['REMOTE_ADDR']);
$smarty->assign_by_ref('geo', $geo);

$smarty->prepare_display();
if (!$_REQUEST['ajax'])
{
	$smarty->display('header.tpl');
}

$default = $_POST?$_POST:$_REQUEST;
array_walk($default, 'trimtext');
if (!$default['countryiso'])
{
	$default['countryiso'] = $geo->country_code3;
}
if (!$default['unique'])
{
	$default['unique'] = date('Ymd') . str_rand(19);
}
$smarty->assign_by_ref('default', $default);

switch ($_REQUEST['context'])
{
	case 'esd':
		$context = array(
			'name' => 'esd',
			'title' => '2010-2014 Earth Care Campaign',
			'actionnumber' => 411,
			'perfdate' => date('Y-m-d'),
			'perfdays' => 1,
			'students' => 0,
			'description' => 'Start for the 2010-2014 Earth Care Campaign!',
			'continue' => 'http://earthcare.life-link.org/culture-of-care/register-for-coc-2011/?schoolnumber=_schoolnumber_',
			'continuetitle' => 'Click HERE to continue your registration on the 2010-2014 Earth Care Campaign website.'
		);
}
$smarty->assign_by_ref('context', $context);

if (isset($_POST['edit']))
{
	$result_message = 'Please edit any information you find to be incorrect.';
	unset($default['captcha']);
}
elseif ((isset($_POST['join']))/* && (!$_COOKIE['lljoin'])*/)
{
	$fields = array(
		'emails' => array('email', 'teachercontactemail', 'studentcontactemail'),
		'website' => 'website',
		'phones' => array('tel', 'fax'),
		'name' => array('studentcontact1', 'studentcontact2', 'teachercontact1', 'teachercontact2'),
		'gender' => array('studentcontactgender1', 'studentcontactgender2', 'teachercontactgender1', 'teachercontactgender2'),
		'number' => array('steachers', 'sstudents', 'teachers', 'students', 'parents'),
		'date' => 'perfdate',
		'range' => 'age'
	);
	$result_message = regexp_form($fields, $_POST);
	if ((!$result_message) && (!required(array('name', 'country', 'city', 'address', 'teachercontact1', 'teachercontactgender1', 'studentcontact1', 'studentcontactgender1', 'actionnumber', 'perfdate', 'description'), $_POST)) && (!required('teachercontactgender2', $_POST, 'teachercontact2')) && (!required('studentcontactgender2', $_POST, 'studentcontact2')))
	{
		$result_message = "Please fill in required fields!";
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
		$school_raw = db_schools::insert($default, $school, 1);
		$school_raw['id'] = 0;
		$report = db_reports::get(null, $report_raw);
		$school = db_schools::get(null, $school_raw);
		$smarty->assign_by_ref('school', $school);
		$smarty->assign_by_ref('report', $report);
	}
	if ((!$result_message) && (!PhpCaptcha::Validate($_POST['captcha'])))
	{
		$result_message = "Your signature is not valid!";
	}
	if (!$result_message)
	{
		$email = new email();
		
		db_schools::insert($default, $schoolnumber);
		$default['schoolnumber'] = $schoolnumber;
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
		
		$email->setSubject('New Life-Link Friendship-School');
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
		if (validate_emails($_POST['studentcontactemail'] . ', ' . $_POST['teachercontactemail'] . ', ' . $_POST['email'], $valid_emails))
		{
			foreach ($valid_emails as $valid_email)
			{
				$to[] = $valid_email;
			}
		}

		if ($to && !$context)
		{
			$autoresponse = new email();
			$bodyHTML = $smarty->fetch('mail/header.tpl');
			$bodyHTML .= $smarty->fetch('mail/autoresponse.tpl');
			$bodyHTML .= $smarty->fetch('mail/member.tpl');
			$bodyHTML .= $smarty->fetch('mail/report.tpl');
			$bodyHTML .= $smarty->fetch('mail/footer.tpl');
			
			$autoresponse->setFrom('"Life-Link Friendship-schools" <' . LL_MAIL . '>');
			$autoresponse->setReturnPath(LL_MAIL);
			
			$autoresponse->setSubject('Your registration as a Life-Link Friendship-School');
			$autoresponse->setHTML($bodyHTML);
			@$autoresponse->send($to, 'sendmail');
		}
	

		$result_message = 'You are now a Life-Link school!';
		
		$result_message .= '<br><br><small>Your Life-Link school number is '. $schoolnumber .'. From now on whenever you contact us, you should specify this number for identification. Your school now has <a href="'.$links['member'].$schoolnumber.'">a page with contact information and all your Life-Link Action Reports</a>, just like all the other Life-Link schools.</small>';
		
		if ($context) {
			$continuelink = $context['continue'];
			$continuelink = str_replace('_schoolnumber_', $schoolnumber, $continuelink);
			$result_message .= '<br><br><big><a href="' . $continuelink . '">'. ($context['continuetitle']?$context['continuetitle']:$continuelink) . '</a></big>';
		} else {
			$result_message .= '
				You can now add photos to your first Action Report!<br><br>
				<small>If you want to register more action reports now, just go on <a href="'.$links['member'].$schoolnumber.'">your school\'s Life-Link page</a> and click on <b>Report a New Action</b>.</small>
			';
		}
		
		//setcookie('lljoin', $schoolnumber, time()+3600*24);
		$result_noform = 1;
	}
}
/*elseif ($_COOKIE['lljoin'])
{
	$school = db_schools::get($_COOKIE['lljoin']);
	if (!$school['registered'])
	{
		$reports_list = db_reports::get_list(null, null, $school['schoolnumber'], null, null, null, null, "0,1", 0);
		if ($reports_list)
		{
			$report = db_reports::get_full($reports_list[0]);
			$smarty->assign_by_ref('report', $report);
		}
		$result_message = 'You have already registered a new school from this computer with Life-Link number ' . $school['schoolnumber'] . '.<br><br><small>Please wait for your school to show up in the <a href="' . $links['members'] . '">Schools &amp; Actions</a> section and/or to get notified by E-m@il about your registration status.<br><br>If you want to register more action reports now, before your application gets approved, just go to <a href="' . $links['report'] . '">Action Report</a> from this computer for the next 24 hours after the application.<br><br>* You can also register a new school in 24 hours after the delivery of the most recent application form.</small>';
		$result_noform = 1;
	}
	else {
		delete_cookie('lljoin');
	}
}*/

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