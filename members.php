<?

require_once('libs/funcs.php');
$template['js_files']['head'][] = LL_WEBPATH . '/js/yui/autocomplete/autocomplete-min.js';

$countries = db_schools::get_countries();
$smarty->assign_by_ref('countries', $countries);
$cities = db_schools::get_cities($_REQUEST['list_country']);
$smarty->assign_by_ref('cities', $cities);
$actions = db_actions::gets();
$smarty->assign_by_ref('actions', $actions);
$years = db_reports::get_years();
$smarty->assign_by_ref('years', $years);
$months = db_reports::get_months();
$smarty->assign_by_ref('months', $months);

$schools_cc = db_schools::get_schools_country_city();
$smarty->assign_by_ref('schools_cc', $schools_cc);

if ($_REQUEST['list_order'] == 'latest')
{
	$order = ' ORDER BY r.perfdate DESC, c.name, s.city, s.name';
}
$list_reports = ($_REQUEST['list_sr'] == 'r');
$country = $_REQUEST['list_country'];
$city = $_REQUEST['list_city'];
if ($_REQUEST['guideline'])
{
	$actionnumber = $_REQUEST['guideline_action'];
}
if ($_REQUEST['between'])
{
	$field = 'r.perfdate';
	if ($_REQUEST['between_pr'] == 'r')
	{
		$field = 'r.regdate';
	}
	$after = db::date_build($_REQUEST['between_year'], $_REQUEST['between_month'], 1);
	$before = db::date_build($_REQUEST['between_and_year'], $_REQUEST['between_and_month'], 31);
	$between = ' AND ' . db::date_between($field, $after, $before);
}
if ($_REQUEST['tagged'])
{
	$tags = array($_REQUEST['tag']);
}
if ($_REQUEST['photos'])
{
	$photos = 1;
}

$smarty->prepare_display();
if (!$_REQUEST['ajax'] && ($_REQUEST['sub'] != 'photo'))
{
	$smarty->display('header.tpl');
}

switch ($_REQUEST['sub'])
{
	/* get photo/thumbnail */
	/* ----- ----- ----- ----- */
	case 'photo':
		db_reports::photo($_REQUEST['photo'], isset($_REQUEST['thumbnail'])?'thumbnail':'photo');
		break;
	/* report; prepare; join */
	/* ----- ----- ----- ----- */
	case 'prepare':
	case 'join':
	case 'report':
		redirect('/' . $_REQUEST['sub'] . '.php');
		break;

	/* search by name */
	case 'name':
		if (isset($_REQUEST['namelike']))
		{
			$namelike = $_REQUEST['namelike'];
			$output = db_schools::gets_bynamelike($namelike);
			
			if ($output['result_message'])
			{
				$smarty->assign('result_message', $output['result_message']);
				$smarty->display($smarty->get_page_default() . 'default.tpl');
			}
			else
			{
				if (count($output['results']) == 1)
				{
					redirect($links['member'] . $output['results'][0]['schoolnumber']);
				}
				$smarty->assign_by_ref('schools', $output['results']);
				$smarty->display($smarty->get_page() . '.tpl');
			}
		}
		else
		{
			$smarty->display($smarty->get_page_default() . 'default.tpl');
		}
		break;

	/* list members/reports */
	/* ----- ----- ----- ----- */
	case 'list':
		/* list reports */
		/* ----- ----- ----- ----- */
		if ($list_reports)
		{
			$total = db_reports::counter($country, $city, null, $actionnumber, $between, $photos);
			$limit = $smarty->pagination($total, $tpl['per_page']['reports'], $links['members']);

			$reports_list = db_reports::get_list($country, $city, null, $actionnumber, $between, $photos, $order, $limit);
			if ($reports_list)
			{
				foreach ($reports_list as $report_id)
				{
					$reports[] = db_reports::get_full($report_id);
				}
				$smarty->assign_by_ref('reports', $reports);
				if (!$_REQUEST['ajax'])
				{
					$smarty->display($smarty->get_page() . '/default.tpl');
				}
				else {
					$smarty->display($smarty->get_page() . '/results.tpl');
				}
			}
			else
			{
				$smarty->assign('result_message', 'No results. Please try a more general approach.');
				$smarty->display($smarty->get_page_default() . 'default.tpl');
			}
		}
		/* list members */
		/* ----- ----- ----- ----- */
		else
		{
			$total = db_schools::counter($country, $city, null, $actionnumber, $between, $photos, 0, $tags);
			$limit = $smarty->pagination($total, $tpl['per_page']['schools'], $links['members']);

			$schools_list = db_schools::get_list($country, $city, null, $actionnumber, $between, $photos, $order, $limit, 0, $tags);
			if ($schools_list)
			{
				foreach ($schools_list as $school_id)
				{
					$schools[] = db_schools::get($school_id);
				}
				$smarty->assign_by_ref('schools', $schools);
				if (!$_REQUEST['ajax'])
				{
					$smarty->display($smarty->get_page() . '/default.tpl');
				}
				else {
					$smarty->display($smarty->get_page() . '/results.tpl');
				}
			}
			else
			{
				$smarty->assign('result_message', 'No results. Please try a more general approach.');
				$smarty->display($smarty->get_page_default() . 'default.tpl');
			}
		}
		break;

	/* show school page */
	/* ----- ----- ----- ----- */
	case 'school':
		if (!empty($_REQUEST['schoolnumber']))
		{
			$schoolnumber = (int)$_REQUEST['schoolnumber'];
			if (db_schools::exists($schoolnumber))
			{
				$school = db_schools::get($schoolnumber);
				$smarty->assign_by_ref('school', $school);

				$total = db_reports::counter(null, null, $schoolnumber, $actionnumber, $between, $photos, null);
				$limit = $smarty->pagination($total, $tpl['per_page']['reports'], $links['members']);

				$reports_list = db_reports::get_list(null, null, $schoolnumber, $actionnumber, $between, $photos, null, $limit);
				if ($reports_list)
				{
					foreach ($reports_list as $report_id)
					{
						$reports[] = db_reports::get_full($report_id);
					}
				}
				$smarty->assign_by_ref('reports', $reports);
				if (!$_REQUEST['ajax'])
				{
					$smarty->display($smarty->get_page() . '/default.tpl');
				}
				else {
					$smarty->display($smarty->get_page() . '/results.tpl');
				}
			}
			else
			{
				$smarty->assign('result_message', 'There is no school registered with number ' . $schoolnumber . '.');
				$smarty->display($smarty->get_page_default() . 'default.tpl');
			}
		}
		else
		{
			$smarty->display($smarty->get_page_default() . 'default.tpl');
		}
		break;

	/* default; basic/advanced search */
	/* ----- ----- ----- ----- */
	default:
		$smarty->display($smarty->get_page_default() . 'default.tpl');
}

if (!$_REQUEST['ajax'] && ($_REQUEST['sub'] != 'photo'))
{
	$smarty->display('footer.tpl');
}

?>