<?

require_once('libs/funcs.php');

$smarty->prepare_display();
if (!$_REQUEST['ajax'] && $_REQUEST['sub'] != 'logo')
{
	$smarty->display('header.tpl');
}

switch ($_REQUEST['sub'])
{
	/* output conference logo */
	/* ----- ----- ----- ----- */
	case 'logo':
		db_conferences::output_logo($_REQUEST['id'], isset($_REQUEST['thumbnail'])?'thumbnail':'photo');
		break;
	/* previous conferences */
	/* ----- ----- ----- ----- */
	case 'old':
		$total = db_conferences::counter(' AND enddate < CURDATE()');
		$limit = $smarty->pagination($total, $tpl['per_page']['conferences'], $links['conferences'] . '#results');

		$conferences_list = db_conferences::get_list(' AND enddate < CURDATE()', $limit);
		if ($conferences_list)
		{
			foreach ($conferences_list as $conference_id)
			{
				$conferences[] = db_conferences::get($conference_id);
			}
		}
		$smarty->assign_by_ref('conferences', $conferences);
		if (!$_REQUEST['ajax'])
		{
			$smarty->display($smarty->get_page() . '/default.tpl');
		}
		else {
			$smarty->display($smarty->get_page() . '/results.tpl');
		}
		break;

	/* single conference */
	/* ----- ----- ----- ----- */
	case 'single':
		$conference = db_conferences::get($_REQUEST['id']);
		$smarty->assign_by_ref('conference', $conference);
		$smarty->display($smarty->get_page_default() . '/default.single.tpl');
		break;
		
	/* default; latest conferences */
	/* ----- ----- ----- ----- */
	default:
		$conferences_now_list = db_conferences::get_list(' AND enddate >= CURDATE()');
		if ($conferences_now_list)
		{
			foreach ($conferences_now_list as $conference_id)
			{
				$conferences_now[] = db_conferences::get($conference_id);
			}
		}
		$conferences_latest_list = db_conferences::get_list(' AND enddate < CURDATE()', 2);
		if ($conferences_latest_list)
		{
			foreach ($conferences_latest_list as $conference_id)
			{
				$conferences_latest[] = db_conferences::get($conference_id);
			}
		}
		$smarty->assign_by_ref('campaigns_now', $campaigns_now);
		$smarty->assign_by_ref('conferences_latest', $conferences_latest);
		$smarty->display($smarty->get_page_default() . 'default.tpl');
}

if (!$_REQUEST['ajax'] && $_REQUEST['sub'] != 'logo')
{
	$smarty->display('footer.tpl');
}

?>