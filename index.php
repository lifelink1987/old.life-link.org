<?php

require_once 'libs/funcs.php';
require_once 'libs/nicedog/NiceDog.php';

foreach (glob(LL_ROOT . '/plugins/*.php') as $plugin) {
	require_once $plugin;
}

//Controller views
R('')->controller('HomeC')->action('index')->on('GET');

R('cmd/statistics/daily')->controller('CmdC')->action('statistics_daily')->on('GET');
R('cmd/statistics/weekly')->controller('CmdC')->action('statistics_weekly')->on('GET');
R('cmd/statistics/monthly')->controller('CmdC')->action('statistics_monthly')->on('GET');
R('cmd/statistics/yearly')->controller('CmdC')->action('statistics_yearly')->on('GET');
R('cmd/delicious')->controller('CmdC')->action('update_delicious')->on('GET');
R('cmd/kml')->controller('CmdC')->action('update_kml')->on('GET');

R('office')->controller('AdminFsSchoolC')->action('browse')->on('GET');
R('office/friendship\-schools')->controller('AdminFsSchoolC')->action('browse')->on('GET');
R('office/friendship\-schools/schools')->controller('AdminFsSchoolC')->action('browse')->on('GET');
R('office/friendship\-schools/school/(?P<school>[0-9]+)')->controller('AdminFsSchoolC')->action('school')->on('GET');
R('office/friendship\-schools/reports')->controller('AdminFsReportC')->action('browse')->on('GET');
R('office/friendship\-schools/report/(?P<report>[0-9]+)')->controller('AdminFsReportC')->action('report')->on('GET');

R('icon/file/(?P<ext>[^/]+)')->controller('IconC')->action('file')->on('GET');
R('icon/social/(?P<ext>[^/]+)')->controller('IconC')->action('social')->on('GET');
R('icon/flag_16/(?P<ext>[^/]+)')->controller('IconC')->action('flag_16')->on('GET');
R('icon/flag_24/(?P<ext>[^/]+)')->controller('IconC')->action('flag_24')->on('GET');
R('icon/flag_32/(?P<ext>[^/]+)')->controller('IconC')->action('flag_32')->on('GET');
R('icon/flag_48/(?P<ext>[^/]+)')->controller('IconC')->action('flag_48')->on('GET');

R('friendship\-schools')->controller('FriendshipSchoolsC')->action('index')->on('GET');
R('friendship\-schools/search')->controller('FriendshipSchoolsC')->action('search')->on('GET');

R('friendship\-schools/action/(?P<action>[0-9]+)')->controller('ActionC')->action('action')->on('GET');
R('friendship\-schools/theme/(?P<theme>[^/]+)')->controller('ActionC')->action('theme')->on('GET');

R('friendship\-schools/country/(?P<country>[^/]+)')->controller('CountryC')->action('country')->on('GET');
R('friendship\-schools/country/(?P<country>[^/]+)/(?P<city>[^/]+)')->controller('CountryC')->action('country')->on('GET');

R('friendship\-schools/school/(?P<school>[0-9]+)')->controller('SchoolC')->action('school')->on('GET');
R('friendship\-schools/report/(?P<report>[0-9]+)')->controller('SchoolC')->action('report')->on('GET');

R('friendship\-schools/report/image/(?P<report>[0-9]+)/(?P<file>[^/]+)')->controller('ReportC')->action('image')->on('GET');
R('friendship\-schools/report/image/(?P<report>[0-9]+)/(?P<file>[^/]+)/(?P<width>[0-9]+)')->controller('ReportC')->action('image')->on('GET');
R('friendship\-schools/report/image/(?P<report>[0-9]+)/(?P<file>[^/]+)/(?P<width>[0-9]+)/(?P<height>[0-9]+)')->controller('ReportC')->action('image')->on('GET');
R('friendship\-schools/report/image/(?P<report>[0-9]+)/(?P<file>[^/]+)/(?P<width>[0-9]+)/(?P<height>[0-9]+)/(?P<all>all)')->controller('ReportC')->action('image')->on('GET');
R('friendship\-schools/report/thumb/(?P<report>[0-9]+)/(?P<file>[^/]+)')->controller('ReportC')->action('thumb')->on('GET');
R('friendship\-schools/report/file/(?P<report>[0-9]+)/(?P<file>[^/]+)')->controller('ReportC')->action('file')->on('GET');

R('reactions')->controller('ReactionsC')->action('index')->on('GET');

R('events')->controller('EventC')->action('index')->on('GET');
R('conferences')->controller('EventC')->action('conferences')->on('GET');
R('campaigns')->controller('EventC')->action('campaigns')->on('GET');
R('(event|campaign|conference)/(?P<event>[0-9]+)')->controller('EventC')->action('event')->on('GET');

//R('contact/send')->controller('MailC')->action('contactable')->on('POST');

//Non-controller views
function r404() {
	global $smarty;
	
	//Primary view
	$tpl_file = str_replace('-', '_', $_GET['url'] . '/' . basename($_GET['url']) . '.tpl');
	if (file_exists(LL_ROOT . '/tpl.' . LL_TEMPLATE . '/pages/' . $tpl_file)) {
		$smarty->display_wrap($tpl_file);
		exit(0);
	}
	
	//Secondary view
	$tpl_file = str_replace('-', '_', $_GET['url'] . '.tpl');
	if (file_exists(LL_ROOT . '/tpl.' . LL_TEMPLATE . '/pages/' . $tpl_file)) {
		$smarty->display_wrap($tpl_file);
		exit(0);
	}
	
	//Not-found view
	/**
	 * @todo not found message
	 */
	header('HTTP/1.0 404 Not Found');
	$smarty->display_404('Not found', '');
}

run();