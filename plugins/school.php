<?php

class SchoolC extends C {

	public function school($school_number, $report = NULL) {
		global $smarty;
		
		$dbSchools = DbSchools::get_instance();
		$school = $dbSchools->get($school_number);
		
		if ($school && $school['datetime_approval']) {
			$type = 'school';
			$smarty->_assign_by_ref('school', $school);
			
			$dbReports = DbReports::get_instance();
			if ($report && is_numeric($report)) {
				$report = $dbReports->get($report);
			}
			if (! $report || ! $report['datetime_approval']) {
				$smarty->assign('title', "{$school['school']} in {$school['city']}, {$school['country_short']}");
				
				$where = array(
					'`datetime_approval` IS NOT NULL',
					'member_schools_number' => $school_number
				);
				if ($_GET['from']) {
					$where[] = '`member_reports_id` <= ' . $_GET['from'];
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
				
				$limit = mysql_limit($_GET['skip'], $smarty->_tpl['pagination']['reports_in_school'] + 1, $_GET['all']);
				$latest_reports = $dbReports->gets($where, '`date` DESC', $limit);
				$smarty->_assign_by_ref('latest_reports', $latest_reports);
			
				$nearby_schools = $dbSchools->gets(array(
					'`datetime_approval` IS NOT NULL', 
					"`member_schools_number` <> {$school['member_schools_number']}",
					"ABS(`coord_lat`-{$school['coord_lat']}+`coord_lng`-{$school['coord_lng']}) < 5"
				), "ABS(`coord_lat`-{$school['coord_lat']}+`coord_lng`-{$school['coord_lng']}) ASC", 5);
				$smarty->_assign_by_ref('nearby_schools', $nearby_schools);
				
				$dbEvents = DbEvents::get_instance();
				$events = $dbEvents->tagged($school['tags'], '`date_end` DESC');
				$smarty->_assign_by_ref('events', $events);
			} else {
				$smarty->assign('title', "Action Report #{$action['actions_number']} from {$school['school']} in {$school['city']}, {$school['country_short']}");
				
				$type = 'report';
				$smarty->_assign_by_ref('report', $report);
			}
			
			if (! $_GET['ajax'] || $report) {
				$smarty->_assign('type', $type);
				
				if ($type == 'school') {
					$dbSchools = DbSchools::get_instance();
					$schools = $dbSchools->gets("`iso3` = '{$school['iso3']}'", "(`city` = '{$school['city']}') DESC, `count_reports` DESC", 5);
					$smarty->_assign_by_ref('schools', $schools);
					
					$latest_reports_with_photos = $dbReports->gets(array(
						'`datetime_approval` IS NOT NULL',
						'member_schools_number' => $school_number, 
						"`attachments` LIKE '%jpg%'"
					), '`date` DESC', 10);
					$smarty->_assign_by_ref('latest_reports_with_photos', $latest_reports_with_photos);
					
					$smarty->display_wrap('friendship_schools/school.tpl');
				} else {
					$smarty->display_wrap('friendship_schools/report.tpl');
				}
			} else {
				$smarty->display_wrap('friendship_schools/school_more.tpl');
			}
		} else {
			/*
			 * @todo build message with possible countries
			 */
			$smarty->display_404('School not found', $message);
		}
	}

	public function report($report_id) {
		$dbReports = DbReports::get_instance();
		$report = $dbReports->get($report_id);
		
		if ($report && $report['datetime_approval']) {
			$this->school($report['member_schools_number'], $report);
		} else {
			/*
			 * @todo build message with possible countries
			 */
			$smarty->display_404('Report not found', $message);
		}
	}
}