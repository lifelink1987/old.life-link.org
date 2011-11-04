<?php

require_once('mail/htmlMimeMail5.php');
ini_set('SMTP', LL_SMTP);

class email extends htmlMimeMail5
{
	function __construct()
	{
		parent::__construct();
		$this->setSMTPParams(LL_SMTP, LL_SMTP_PORT, null, true, LL_SMTP_USER, LL_SMTP_PASS);
		$this->setSendmailPath('/usr/sbin/sendmail -t -i');
		//$this->setSendmailPath('/xampp/sendmail -t -i');
		$this->setTextCharset('UTF-8');
		$this->setHTMLCharset('UTF-8');
		$this->setHeadCharset('UTF-8');

		$this->setHeader('X-Mailer', 'Life-Link.Org');
		$this->setHeader('Date', date('r'));
		$this->setHeader('Originating-IP', $_SERVER['REMOTE_ADDR']);
		$this->setFrom(LL_MAIL_NOREPLY);
		$this->setBcc(LL_MAIL_WEBMASTER);
	}
}

if (!function_exists('checkdnsrr'))
{
	function checkdnsrr($hostName, $recType = '')
	{
		if (!empty($hostName))
		{
  		if ($recType == '')
  		{
  			$recType = "MX";
  		}
  		exec("nslookup -type=$recType $hostName", $result);
  		// check each line to find the one that starts with the host
  		// name. If it exists then the function succeeded.
  		foreach ($result as $line)
  		{
    		if (eregi("^$hostName",$line))
    		{
      		return true;
    		}
  		}
			// otherwise there was no mail handler for the domain
  		return false;
		}
		return false;
	}
}

function validate_emails($emails, &$valid_emails)
{
	if (!is_array($emails))
	{
		trimmultiple($emails);
		$emails = explode(', ', $emails);
	}
	$valid_emails = array();
	$result = false;
	if ($emails)
	{
		foreach ($emails as $email)
		{
			if (validate_email($email))
			{
				$valid_emails[] = $email;
				$result = true;
			}
		}
	}
	$valid_emails = array_unique($valid_emails);
	return $result;
}

function validate_email($email)
{
	if (preg_match("/^.+@.+\...+$/", $email))
	{
		if (checkdnsrr(array_pop(explode("@", $email)), "MX"))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}
}

?>