<?

require_once('libs/funcs.php');

$smarty->prepare_display();
if (!$_REQUEST['ajax'])
{
	$smarty->display('header.tpl');
}

if ($_REQUEST['country'])
{
	$country_selected = db_countries::get_name($_REQUEST['country']);
	$condition_country = " AND country = " . $_REQUEST['country'];
	$smarty->assign_by_ref('country_selected', $country_selected);
	$smarty->assign_by_ref('country_selected_codenumber', $_REQUEST['country']);
}

$total = db_reactions::counter($condition_country);
$limit = $smarty->pagination($total, $tpl['per_page']['reactions'], $links['reactions'] . '#results');

$reactions_list = db_reactions::gets($_REQUEST['country'], $limit);

$previous_country = $reactions_list[0]['country'];
$previous_countryname = $reactions_list[0]['countryname'];
foreach ($reactions_list as $reaction)
{
	if ($reaction['country'] != $previous_country)
	{
		$reactions[$previous_countryname] = $country_reactions;
		$previous_country = $reaction['country'];
		$previous_countryname = $reaction['countryname'];
		unset($country_reactions);
	}
	$country_reactions[] = $reaction;
}

$reactions[$reaction['countryname']] = $country_reactions;

$countries = db_reactions::get_countries();
$smarty->assign_by_ref('countries', $countries);
$smarty->assign_by_ref('reactions', $reactions);

if (!$_REQUEST['ajax'])
{
	$smarty->display($smarty->get_page_default() . 'default.tpl');
}
else
{
	$smarty->display($smarty->get_page_default() . 'results.tpl');
}

if (!$_REQUEST['ajax'])
{
	$smarty->display('footer.tpl');
}

?>