<?

require_once('libs/funcs.php');

$smarty->prepare_display();
if (!$_REQUEST['ajax'])
{
	$smarty->display('header.tpl');
}

switch ($_REQUEST['sub'])
{
	/* action chapters */
	/* ----- ----- ----- ----- */
	case 'myself':
	case 'others':
	case 'nature':
	case 'organised':
		if ($_REQUEST['sub'] == 'myself')
		{
			$actions = db_actions::gets(1);
			$id = 100;
		}
		else if ($_REQUEST['sub'] == 'others')
		{
			$actions = db_actions::gets(2);
			$id = 200;
		}
		else if ($_REQUEST['sub'] == 'nature')
		{
			$actions = db_actions::gets(3);
			$id = 300;
		}
		else if ($_REQUEST['sub'] == 'organised')
		{
			$actions = db_actions::gets(4);
			$id = 400;
		}
		$chapter = array_shift($actions);
		$smarty->assign_by_ref('actions', $actions);
		$smarty->assign_by_ref('chapter', $chapter);

		$reports_list = db_reports::get_list(null, null, null, $id, null, true, ' ORDER BY RAND()', 2);
		if ($reports_list)
		{
			foreach ($reports_list as $report_id)
			{
				$reports[] = db_reports::get_full($report_id);
			}
		}

		$smarty->assign_by_ref('reports', $reports);
		$smarty->display($smarty->get_page_default() . 'chapter.tpl');
		break;

	/* management chapters */
	/* ----- ----- ----- ----- */
	case 'management':
	case 'management/step1':
	case 'management/step2':
	case 'management/step3':
	case 'management/step4':
	case 'management/step5':
	case 'management/step6':
	case 'management/summary':
		$smarty->display($smarty->get_page() . '.tpl');
		break;

	/* default; action */
	/* ----- ----- ----- ----- */
	default:
		if (($_REQUEST['id']) && (db_actions::exists($_REQUEST['id'])))
		{
			$actions = db_actions::gets($_REQUEST['id'][0]);
			$chapter = array_shift($actions);
			$action = db_actions::get($_REQUEST['id']);
			$smarty->assign_by_ref('actions', $actions);
			$smarty->assign_by_ref('chapter', $chapter);
			$smarty->assign_by_ref('action', $action);

			$reports_list = db_reports::get_list(null, null, null, $_REQUEST['id'], null, true, ' ORDER BY RAND()', 2);
			if ($reports_list)
			{
				foreach ($reports_list as $report_id)
				{
					$reports[] = db_reports::get_full($report_id);
				}
			}

			$smarty->assign_by_ref('reports', $reports);
			$smarty->display($smarty->get_page_default() . 'action.tpl');
		}
		else
		{
			$smarty->display($smarty->get_page_default() . 'default.tpl');
		}
}

if (!$_REQUEST['ajax'])
{
	$smarty->display('footer.tpl');
}

?>