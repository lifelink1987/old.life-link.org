<?php

class HomeC extends C {

	public function index() {
		global $smarty, $geoip;
		
		$smarty->assign('title', 'Welcome to Life-Link Friendship-Schools!');
		
		$dbReports = DbReports::get_instance();
		$latest_reports = $dbReports->gets(array(
			'`datetime_approval` IS NOT NULL',
			"`attachments` LIKE '%jpg%'"
		), '`datetime_registration` DESC', 6);
		$smarty->_assign_by_ref('latest_reports', $latest_reports);
		
		$dbHighlights = DbHighlights::get_instance();
		$highlights = $dbHighlights->gets(array(
			"`enabled` = 'yes'"
		), '`priority` DESC');
		$smarty->_assign_by_ref('highlights', $highlights);
		
		$geoip_record = geoip_remote_addr();
		/*$geoip_record = new geoiprecord();
		$geoip_record->country_code = 'ro';
		$geoip_record->country_code3 = 'rou';
		$geoip_record->country_name = 'Romania';*/
		$smarty->_assign_by_ref('geoip_record', $geoip_record);
		
		$smarty->display_wrap('home/index.tpl');
	}
}