<?php

require_once('funcs.mail.php');
error_reporting(E_ALL ^ E_NOTICE);
$myERRORS = array();

function custom_error($errno, $errstr, $errfile, $errline, $errcontext)
{
	global $myERRORS;
	$dt = date("Y-m-d H:i:s (T)");
	$myERRORS[] = array($dt, $errno, $errstr, $errfile, $errline);
	$errtype = array(
		E_ERROR           => "Error",
		E_WARNING         => "Warning",
		E_PARSE           => "Parsing Error",
		E_NOTICE          => "Notice",
		E_CORE_ERROR      => "Core Error",
		E_CORE_WARNING    => "Core Warning",
		E_COMPILE_ERROR   => "Compile Error",
		E_COMPILE_WARNING => "Compile Warning",
		E_USER_ERROR      => "User Error",
		E_USER_WARNING    => "User Warning",
		E_USER_NOTICE     => "User Notice",
		E_STRICT          => "Runtime Notice"
	);
	$warnings = E_WARNING || E_CORE_WARNING || E_COMPILE_WARNING || E_USER_WARNING;
	$notices = E_NOTICE || E_USER_NOTICE;
	$errors = E_ERROR || E_CORE_ERROR || E_COMPILE_ERROR || E_USER_ERROR;
	$parse = E_PARSE;
	if (($errno & error_reporting()) != 0)
	{
		if (LL_DEBUG)
		{
			echo "
				<div>
					<b>$dt - {$errtype[$errno]}</b><br>
					$errstr<br><br>
					$errfile at line $errline
				</div><br>
			";
			if ($errno & $errors)
			{
				die();
			}
		}
	}
	
	if ((!$errno) || (LL_DEBUG != 2)) return;
	$email = new email();
	$message = "
		$dt - $errno - {$errtype[$errno]}
		
		$errstr
		
		$errfile at line $errline
		
		---
		POST: " . var_export($_POST, 1) . "
		---
		GET: " . var_export($_GET, 1) . "
		---
		COOKIE: " . var_export($_COOKIE, 1) . "
		---
		SERVER: " . var_export($_SERVER, 1) . "
	";
	
	$email->setSubject('Life-Link.Org Error');
	$email->setFrom('"Life-Link.Org" <' . LL_MAIL_NOREPLY . '>');
	$email->setReturnPath(LL_MAIL_NOREPLY);
	$email->setText($message);
	$email->send(array(LL_MAIL_WEBMASTER), 'smtp');
}

function print_errors()
{
	global $myERRORS;
	foreach ($myERRORS as $myERROR)
	{
		list($dt, $errno, $errtype, $errstr, $errfile, $errline) = $myERROR;
		echo "
			<div>
				<b>$dt - {$errtype[$errno]}</b><br>
				$errstr<br><br>
				$errfile at line $errline
			</div><br>
		";
	}
}

set_error_handler('custom_error');

?>