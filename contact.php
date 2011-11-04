<?

require_once('libs/funcs.php');
require_once('libs/funcs.captcha.php');

$countries = db_countries::gets();
$smarty->assign_by_ref('countries', $countries);
if ((isset($_REQUEST['to'])) && ($contact = db_contacts::gets(null, $_REQUEST['to'])))
{
	$contact = $contact[0];
}
$smarty->assign_by_ref('contact', $contact);

$smarty->prepare_display();
if (!$_REQUEST['ajax'])
{
	$smarty->display('header.tpl');
}

$default = $_REQUEST;
array_walk($default, 'trimtext');
$smarty->assign_by_ref('default', $default);

if (isset($_POST['send']))
{
	$fields = array(
		'name' => 'name',
		'email' => 'email',
		'phone' => array('tel', 'fax')
	);
	$result_message = regexp_form($fields, $_POST);
	if ((!$result_message) && (!PhpCaptcha::Validate($_POST['captcha'])))
	{
		$result_message = "Your signature is not valid!";
	}
	if ((!$result_message) && (!required(array('name', 'country', 'message'), $_POST)))
	{
		$result_message = "Please fill in required fields!";
	}
	if (!$result_message)
	{
		geoipcity();
		$geo = geoip_record_by_addr($geoip, $_SERVER['REMOTE_ADDR']);
		$smarty->assign_by_ref('geo', $geo);

		$default['country'] = db_countries::get_name($_POST['country']);
		foreach ($default as $key => $value)
		{
			$smarty->assign($key, $value);
		}

		$bodyHTML = $smarty->fetch('mail/header.tpl');
		$bodyHTML .= $smarty->fetch('mail/contact.tpl');
		$bodyHTML .= $smarty->fetch('mail/footer.tpl');

		$email = new email();

		if (validate_email($_POST['email']))
		{
			$email->setFrom('"' . $_POST['name'] . '" <' . $_POST['email'] . '>');
			$email->setReturnPath($_POST['email']);
		}
		else
		{
			$email->setFrom('"Life-Link Friendship-Schools" <' . LL_MAIL . '>');
			$email->setReturnPath(LL_MAIL);
		}

		$email->setSubject('Life-Link.Org Message');
		$email->setHTML($bodyHTML);

		if ($contact)
		{
			$to = array('"' . $contact['name'] . '" <' . $contact['email'] . '>');
		}
		else
		{
			$to = array('"Life-Link Friendship-Schools" <' . LL_MAIL . '>');
		}

		$result_message = $email->send($to, 'sendmail');
		// Roula
		$email->send(array('"Roula Mecherkany" <roula.mecherkany@life-link.org>'), 'sendmail');

		if ($result_message === 0) //sendmail returns 0
		{
			$result_message = "Your message has been delivered!";
			$result_noform = 1;
		}
		else
		{
			$result_message = "There was a problem sending your message! Try again!";
		}
	}
	
	if (!is_array($result_message))
	{
		$result_message = array($result_message);
	}
	$smarty->assign_by_ref('result_message', $result_message);
	$smarty->assign_by_ref('result_noform', $result_noform);
}

if (!$_REQUEST['ajax'])
{
	$smarty->display($smarty->get_page_default() . 'default.tpl');
}
else {
	$smarty->display($smarty->get_page_default() . 'results.tpl');
}

if (!$_REQUEST['ajax'])
{
	$smarty->display('footer.tpl');
}

?>