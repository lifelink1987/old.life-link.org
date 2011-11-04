<?

require_once('libs/funcs.php');

$smarty->prepare_display();
if (!$_REQUEST['ajax'])
{
	$smarty->display('header.tpl');
}

switch ($_REQUEST['sub'])
{
	/* blog posts in news/newsletters/appendix */
	/* ----- ----- ----- ----- */
	case 'news':
	case 'newsletters':
	case 'appendix':
		switch ($_REQUEST['sub'])
		{
			case 'news':
				$category = 'News';
				break;
			case 'newsletters':
				$category = 'Newsletters';
				break;
			case 'appendix':
				$category = 'Board Meetings';
				break;
		}

		$category_id = db_wordpress::get_category_id($category);
		$category_info = db_wordpress::get_category($category_id);
		$smarty->assign_by_ref('category', $category_info);
		$condition_category = " AND pc.term_taxonomy_id = " . $category_id;
		$condition_status = " AND p.post_status = 'publish'";

		$total = db_wordpress::counter($condition_category . $condition_status);
		$limit = $smarty->pagination($total, $tpl['per_page']['posts'], $links['live']);

		$posts_list = db_wordpress::get_list($category, null, $limit);

		if ($posts_list)
		{
			foreach ($posts_list as $post_id)
			{
				$posts[] = db_wordpress::get_full($post_id);
			}
		}
		else
		{
			$smarty->assign('error_message', 'No posts.');
		}
		$smarty->assign_by_ref('posts', $posts);
		if (!$_REQUEST['ajax'])
		{
			$smarty->display($smarty->get_page() . '/default.tpl');
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