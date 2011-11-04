<?

require_once('libs/funcs.php');

$smarty->prepare_display();
if (!$_REQUEST['ajax'] && $_REQUEST['sub'] != 'logo')
{
	$smarty->display('header.tpl');
}

switch ($_REQUEST['sub'])
{
	/* output campaign logo */
	/* ----- ----- ----- ----- */
	case 'logo':
		db_campaigns::output_logo($_REQUEST['id'], isset($_REQUEST['thumbnail'])?'thumbnail':'photo');
		break;
	/* previous campaigns */
	/* ----- ----- ----- ----- */
	case 'old':
		$total = db_campaigns::counter(' AND enddate < CURDATE()');
		$limit = $smarty->pagination($total, $tpl['per_page']['campaigns'], $links['campaigns'] . '#results');

		$campaigns_list = db_campaigns::get_list(' AND enddate < CURDATE()', $limit);
		if ($campaigns_list)
		{
			foreach ($campaigns_list as $campaign_id)
			{
				$campaigns[] = db_campaigns::get($campaign_id);
			}
		}
		$smarty->assign_by_ref('campaigns', $campaigns);
		if (!$_REQUEST['ajax'])
		{
			$smarty->display($smarty->get_page() . '/default.tpl');
		}
		else {
			$smarty->display($smarty->get_page() . '/results.tpl');
		}
		break;

	/* single campaign */
	/* ----- ----- ----- ----- */
	case 'single':
		$campaign = db_campaigns::get($_REQUEST['id']);
		$smarty->assign_by_ref('campaign', $campaign);
		$smarty->display($smarty->get_page_default() . '/default.single.tpl');
		break;
		
	/* default; latest campaigns */
	/* ----- ----- ----- ----- */
	default;
		$campaigns_now_list = db_campaigns::get_list(' AND enddate >= CURDATE()');
		if ($campaigns_now_list)
		{
			foreach ($campaigns_now_list as $campaign_id)
			{
				$campaigns_now[] = db_campaigns::get($campaign_id);
			}
		}
		$campaigns_latest_list = db_campaigns::get_list(' AND enddate < CURDATE()', 2);
		if ($campaigns_latest_list)
		{
			foreach ($campaigns_latest_list as $campaign_id)
			{
				$campaigns_latest[] = db_campaigns::get($campaign_id);
			}
		}
		$smarty->assign_by_ref('campaigns_now', $campaigns_now);
		$smarty->assign_by_ref('campaigns_latest', $campaigns_latest);
		$smarty->display($smarty->get_page_default() . 'default.tpl');
}

if (!$_REQUEST['ajax'] && $_REQUEST['sub'] != 'logo')
{
	$smarty->display('footer.tpl');
}

?>