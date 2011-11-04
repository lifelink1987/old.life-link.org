<?

require_once('libs/funcs.php');

$smarty->prepare_display();
if (!$_REQUEST['ajax'])
{
	$smarty->display('header.tpl');
}

switch ($_REQUEST['sub'])
{
	/* all, except board members*/
	/* ----- ----- ----- ----- */
	case 'brief':
	case 'detail':
	case 'detail/actions':
	case 'detail/schools':
	case 'detail/benefits':
	case 'membership':
		$smarty->display($smarty->get_page() . '.tpl');
		break;

	/* board members */
	/* ----- ----- ----- ----- */
	case 'board':
		$members = db_contacts::gets('board');
		$smarty->assign_by_ref('members', $members);

		$secretary = db_contacts::gets('secretary');
		$smarty->assign_by_ref('secretary', $secretary);

		$consultants = db_contacts::gets('consultants');
		$smarty->assign_by_ref('consultants', $consultants);

		$advisors = db_contacts::gets('international advisors');
		$smarty->assign_by_ref('advisors', $advisors);

		$smarty->display($smarty->get_page() . '.tpl');
		break;

	/* default */
	default:
		$smarty->display($smarty->get_page_default() . 'default.tpl');
}

if (!$_REQUEST['ajax'])
{
	$smarty->display('footer.tpl');
}

?>