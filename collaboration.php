<?

require_once('libs/funcs.php');

$smarty->prepare_display();
if (!$_REQUEST['ajax'])
{
	$smarty->display('header.tpl');
}

switch ($_REQUEST['sub'])
{
	/* partnerships */
	/* ----- ----- ----- ----- */
	case 'partnerships':
		$smarty->display($smarty->get_page() . '.tpl');
		break;

	/* organisations */
	/* ----- ----- ----- ----- */
	case 'organisations':
		if ($_REQUEST['namelike'])
		{
			$condition_namelike = " AND name LIKE '%" . $_REQUEST['namelike'] . "%'";
		}
		if ($_REQUEST['email'])
		{
			$condition_email = " AND NOT ISNULL(email)";
		}
		if ($_REQUEST['website'])
		{
			$condition_website = " AND NOT ISNULL(website)";
		}

		$total = db_organisations::counter("$condition_namelike$condition_email$condition_website");
		$limit = $smarty->pagination($total, $tpl['per_page']['organisations'], $links['collaboration'] . '#results');

		$organisations = db_organisations::gets($_REQUEST['namelike'], $_REQUEST['email'], $_REQUEST['website'], $limit);
		$smarty->assign_by_ref('organisations', $organisations);
		if (!$_REQUEST['ajax'])
		{
			$smarty->display($smarty->get_page() . '.tpl');
		}
		else {
			$smarty->display($smarty->get_page() . '/results.tpl');
		}
		break;

	/* default */
	/* ----- ----- ----- ----- */
	default:
		$smarty->display($smarty->get_page_default() . 'default.tpl');
}

if (!$_REQUEST['ajax'])
{
	$smarty->display('footer.tpl');
}

?>