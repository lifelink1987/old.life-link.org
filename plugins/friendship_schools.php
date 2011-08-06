<?php

class FriendshipSchoolsC extends C {
	
	public function index() {
		global $smarty;
		
		$smarty->assign('title', 'Life-Link Friendship-Schools');
			
		$dbSchools = DbSchools::get_instance();
		$latest_schools = $dbSchools->gets('`datetime_approval` IS NOT NULL', '`datetime_registration` DESC', 10);
		$smarty->_assign_by_ref('latest_schools', $latest_schools);
		
		$dbReports = DbReports::get_instance();
		$latest_reports = $dbReports->gets('`datetime_approval` IS NOT NULL', '`date` DESC', 5);
		$smarty->_assign_by_ref('latest_reports', $latest_reports);
		
		$latest_reports_with_photos = $dbReports->gets(array('`datetime_approval` IS NOT NULL', "`attachments` LIKE '%jpg%'"), '`date` DESC', 10);
		$smarty->_assign_by_ref('latest_reports_with_photos', $latest_reports_with_photos);
		
		$smarty->display_wrap('friendship_schools/index.tpl');
	}

	public function search() {
		global $smarty;
		
		$smarty->assign('title', 'Search Friendship-Schools and their Actions Reports');

		$dbReports = DbReports::get_instance();
		switch ($_GET['order']) {
			case 'report_date':
				$order = "`date` DESC";
				break;
			default:
				$order = "`school` ASC";
		}
		$where = array(
			'`datetime_approval` IS NOT NULL'
		);
		if ($_GET['country']) {
			$where['countries_iso'] = $_GET['country'];
		}
		if ($_GET['city']) {
			$where['city'] = $_GET['city'];
		}
		if ($_GET['action']) {
			$where[] = "`actions` LIKE '%" . $_GET['action'] . "'";
		}
		if ($_GET['after']) {
			$after = explode('.', $_GET['after']);
			$where[] = "`date` >= '" . mysql_date($after[1], $after[0]) . "'";
		}
		if ($_GET['before']) {
			$before = explode('.', $_GET['before']);
			$where[] = "`date` <= '" . mysql_date($before[1], $before[0], lastday($before[1], $before[0])) . "'";
		}
		if ($_GET['photos']) {
			$where[] = "`attachments` LIKE '%jpg%'";
		}
		if ($_GET['type'] == 'school') {
			$where[] = "1=1 GROUP BY `member_schools_number`";
			switch ($_GET['order']) {
				case 'report_date':
					$order = "MAX(`date`) DESC";
					break;
				default:
					$order = "`school` ASC";
			}
		}
		
		$limit = mysql_limit($_GET['skip'], $smarty->_tpl['pagination']['results_in_search'] + 1, $_GET['all']);
		$results = $dbReports->gets($where, $order, $limit);
				
		$smarty->_assign_by_ref('results', $results);
		if (! $_GET['ajax']) {					
			$smarty->display_wrap('friendship_schools/search.tpl');
		} else {
			$smarty->display_wrap('friendship_schools/search_more.tpl');
		}
	}
}