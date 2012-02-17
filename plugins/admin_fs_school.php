<?php

class AdminFsSchoolC extends C {

	public function browse() {
		global $smarty;
		
		$smarty->assign('title', "Manage Schools");
		
		$dbSchools = DbSchools::get_instance();
		
		$where = array();
		if ($_GET['number']) {
			$where['member_schools_number'] = (int) $_GET['number'];
		} else {
			if ($_GET['name']) {
				$where[] = 'LOWER(`school`) LIKE \'%' . strtolower($dbSchools->_($_GET['name'])) . '%\'';
			}
			if ($_GET['country']) {
				$where['countries_iso'] = $_GET['country'];
			}
			if ($_GET['city']) {
				$where['city'] = $_GET['city'];
			}
			if ($_GET['after']) {
				$after = explode('.', $_GET['after']);
				$where[] = "`datetime_registration` >= '" . mysql_date($after[1], $after[0]) . "'";
			}
			if ($_GET['before']) {
				$before = explode('.', $_GET['before']);
				$where[] = "`datetime_registration` <= '" . mysql_date($before[1], $before[0], lastday($before[1], $before[0])) . "'";
			}
			
			switch ($_GET['order']) {
				case 'report_date':
					$order = "ISNULL(`date_report_last`) DESC";
					break;
				default:
					$order = "ISNULL(`datetime_approval`) DESC, `datetime_registration` DESC";
			}
		}
		
		$limit = mysql_limit($_GET['skip'], $smarty->_tpl['pagination']['schools_in_admin'] + 1);
		$schools = $dbSchools->gets($where, $order, $limit);
		$count = $dbSchools->count($where);
		
		$smarty->_assign_by_ref('schools', $schools);
		$smarty->_assign_by_ref('count', $count);
		
		if (! $_GET['ajax']) {
			$smarty->display_wrap_admin('admin/friendship_schools/schools.tpl');
		} else {
			$smarty->display('admin/friendship_schools/schools_more.tpl');
		}
	}

	public function school($school_number) {
		global $smarty;
		
		$dbSchools = DbSchools::get_instance();
		$school = $dbSchools->get($school_number);
		
		if (!$school) {
			/*
			 * @todo build message with possible countries
			 */
			return $smarty->display_404('School not found', $message);
		}
		
		$smarty->assign('title', "Manage School #{$school_number}");
		
		$smarty->_assign_by_ref('school', $school);
		
		$dbReports = DbReports::get_instance();
		$where = array(
			'member_schools_number' => $school_number
		);
		
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
		
		$limit = mysql_limit($_GET['skip'], $smarty->_tpl['pagination']['reports_in_admin'] + 1);
		$reports = $dbReports->gets($where, 'ISNULL(`datetime_approval`) DESC, `datetime_registration` DESC', $limit);
		
		$smarty->_assign_by_ref('reports', $reports);
		
		if (! $_GET['ajax']) {
			$smarty->display_wrap_admin('admin/friendship_schools/school.tpl');
		} else {
			$smarty->display('admin/friendship_schools/school_more.tpl');
		}
	}
}