<?php

//require_once(dirname(__FILE__) . '/../libs/config.main.php');
define('LL_DB_HOST', 'sql.life-link.org');
define('LL_DB_USER', 'lifelink_basic');
define('LL_DB_PASS', '');
define('LL_DB_SCHEMA', 'lifelink');

$link = mysql_connect(LL_DB_HOST, LL_DB_USER, LL_DB_PASS);
mysql_select_db(LL_DB_SCHEMA, $link);

$result = mysql_query('SELECT email, email_contact_senior, email_contact_junior FROM member_schools');

$emails = array();
while ($row = mysql_fetch_assoc($result)) {
	$em = explode(',', $row['email']);
	foreach ($em as $e) {
		$e = trim($e);
		if ($e) $emails[] = $e;
	}
	$em = explode(',', $row['email_contact_senior']);
	foreach ($em as $e) {
		$e = trim($e);
		if ($e) $emails[] = $e;
	}
	$em = explode(',', $row['email_contact_junior']);
	foreach ($em as $e) {
		$e = trim($e);
		if ($e) $emails[] = $e;
	}
}

$emails = array_unique($emails);

?>
<h1>Life-Link Schools' E-mail Addresses</h1>

<?

$i = 0;
foreach ($emails as $e) {
	$i++;
	echo $e;
	if ($i == 400) {
		$i == 0;
		echo '<br><br>-- 400 limit --<br><br>';
	}else{
		echo ', ';
	}
}

mysql_close($link);

?>