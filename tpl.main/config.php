<?php

register_session_var('speed_up', is_mobile() ? 'yes' : 'check');

$config = array(
	'js' => array(
		'head' => array(
			//'http://shared.life-link.org/jquery/jquery.min.js',
			$tpl['tpl_uri'] . '/js/jquery/dist/jquery.min.js',
			$tpl['tpl_uri'] . '/js/jquery-ui-1.8.17.custom.min.js'
		), 
		'pre_body' => array(),
		'post_body' => array()
	), 
	'js_merge' => array(
		'head' => array(
		),
		'pre_body' => array(),
		'post_body' => array(
			'http://shared.life-link.org/jquery.plugins/_util/jquery.cooquery-3.0/cooquery.min.js', 
			'http://shared.life-link.org/jquery.plugins/_form/jquery.autosuggest-1.4/jquery.autoSuggest.minified.js', 
			'http://shared.life-link.org/jquery.plugins/_form/jquery.html5form-1.1/jquery.html5form-min.js', 
			
			$tpl['tpl_uri'] . '/js/contactable.js', 
			'http://shared.life-link.org/jquery.plugins/_form/jquery.contactable-1.2.1/jquery.validate.min.js',  //need to change to another form validation plugin, and then adjust contactable
			
			'http://shared.life-link.org/jquery.plugins/_util/jquery.imgcenter-1.0/jquery.imgcenter.minified.js', 
			'http://shared.life-link.org/jquery.plugins/_preview/jquery.colorbox-1.3.9/colorbox/jquery.colorbox.fix.js', 
			'http://shared.life-link.org/jquery.plugins/_tooltip/jquery.tipTip-1.3/jquery.tipTip.minified.js',

			$tpl['tpl_uri'] . '/js/menu.js', 
			$tpl['tpl_uri'] . '/js/sidebar.js', 
			$tpl['tpl_uri'] . '/js/layout.js'
		)
	),
	'css' => array(
		$tpl['tpl_uri'] . '/css/jquery-ui-1.8.17.custom.css'
	), 
	'css_merge' => array(
		'http://shared.life-link.org/jquery.plugins/_tooltip/jquery.tipTip-1.3/tipTip.css'
	),
	'pagination' => array(
		'posts' => 10, 
		'organisations' => 10, 
		'conferences' => 3, 
		'campaigns' => 3, 
		'schools' => 20, 
		
		'events' => 6, 
		'results_in_search' => 20, 
		'reports_in_school' => 3, 
		'reports_in_action' => 3, 
		'schools_in_country' => 5
	), 
	'date_format' => '%B %#d, %Y', 
	'short_date_format' => '%b %#d, \'%y', 
	'speed_up' => $_SESSION['speed_up'], 
	'gmaps_key' => LL_GMAPS_KEY, 
	'version' => LL_VERSION . ' ' . LL_VERSION_STATUS, 
	'version_minor' => LL_VERSION_MINOR, 
	'fb_uid' => LL_FACEBOOK_UID, 
	'fb_rss' => LL_FACEBOOK_RSS, 
	'months' => array(
		'January', 
		'February', 
		'March', 
		'April', 
		'May', 
		'June', 
		'July', 
		'August', 
		'September', 
		'October', 
		'November', 
		'December'
	)
);

if (LL_AT_HOME) {
	$config['js_merge']['post_body'][] = $tpl['tpl_uri'] . '/js/analytics.js';
}

if (LL_AT_HOME || LL_AT_HOME_DEBUG) {
	$config['js']['post_body'][] = $tpl['tpl_uri'] . '/js/fb.js';
}

if ($_SESSION['speed_up'] == 'check') {
	$config['js']['post_body'][] = $tpl['tpl_uri'] . '/js/layout_speed_up.js';
}