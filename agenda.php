<?

require_once('libs/funcs.php');

$smarty->prepare_display();
if (!$_REQUEST['ajax'])
{
	$smarty->display('header.tpl');
}

$recent_agenda = db_agenda::gets_recent();
$future_agenda = db_agenda::gets_future();
$month = $_REQUEST['month'];
$year = $_REQUEST['year'];
if ((!$month) || ($month < 1) || ($month > 12))
{
	$month = gmstrftime('%m');
}
if ((!$year) || ($year < 1987) || ($year > date('Y')))
{
	$year = gmstrftime('%Y');
}
$calendar = db_agenda::gets_calendar($month, $year);

$prevyear = $nextyear = $year;
$prevmonth = $month-1;
$nextmonth = $month+1;

if ($prevmonth == 0)
{
	$prevmonth = 12;
	$prevyear--;
}
if ($nextmonth == 13)
{
	$nextmonth = 1;
	$nextyear++;
}
$monthtitle = date('F', mktime(0, 0, 0, $month, 1, $year));
$prevmonthtitle = date('F', mktime(0, 0, 0, $prevmonth, 1, $prevyear));
$nextmonthtitle = date('F', mktime(0, 0, 0, $nextmonth, 1, $nextyear));

$smarty->assign_by_ref('recent_agenda', $recent_agenda);
$smarty->assign_by_ref('future_agenda', $future_agenda);
$smarty->assign_by_ref('calendar', $calendar);

$smarty->assign_by_ref('month', $month);
$smarty->assign_by_ref('monthtitle', $monthtitle);
$smarty->assign_by_ref('year', $year);

$smarty->assign_by_ref('prevmonth', $prevmonth);
$smarty->assign_by_ref('prevmonthtitle', $prevmonthtitle);
$smarty->assign_by_ref('prevyear', $prevyear);

$smarty->assign_by_ref('nextmonth', $nextmonth);
$smarty->assign_by_ref('nextmonthtitle', $nextmonthtitle);
$smarty->assign_by_ref('nextyear', $nextyear);

if (!$_REQUEST['ajax'])
{
	$smarty->display($smarty->get_page() . 'default.tpl');
}
else {
	$smarty->display($smarty->get_page() . 'results.tpl');
}

if (!$_REQUEST['ajax'])
{
	$smarty->display('footer.tpl');
}

?>