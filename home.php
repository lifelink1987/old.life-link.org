<?

$timetest['start'] = array(gmdate('H:i:s'), memory_get_usage(true));

require_once('libs/funcs.php');

$timetest['start_funcs'] = array(gmdate('H:i:s'), memory_get_usage(true));

$smarty->prepare_display();
if (!$_REQUEST['ajax'])
{
	$smarty->display('header.tpl');
}

if (($_SESSION['llschoolnumber'] != 0) && (db_schools::exists($_SESSION['llschoolnumber'])))
{
	$live = db_agenda::gets_live();
	$smarty->assign_by_ref('live', $live);
	
	$schoolnumber = $_SESSION['llschoolnumber'];
	$school = db_schools::get($schoolnumber);
	$smarty->assign_by_ref('school', $school);
}
$reports_list = db_reports::get_list(null, null, $schoolnumber, null, null, null, " ORDER BY r.regdate DESC, c.name ASC, s.city ASC, s.name ASC", "0,1", 1);
if ($reports_list)
{
	$report = db_reports::get_full($reports_list[0]);
	$smarty->assign_by_ref('report', $report);
	if (!$school)
	{
		$school = db_schools::get($report['schoolnumber']);
		$smarty->assign_by_ref('school', $school);
	}
}

$smarty->display($smarty->get_page_default() . 'default.tpl');

if (!$_REQUEST['ajax'])
{
	$smarty->display('footer.tpl');
}

?>