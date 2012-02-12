<?php

class ActionC extends C {

	public function theme($theme) {
		global $smarty;
		
		switch ($theme) {
			case 'care-for-myself':
				$action = 100;
				break;
			case 'care-for-others':
				$action = 200;
				break;
			case 'care-for-nature':
				$action = 300;
				break;
			case 'lets_get_organised':
				$action = 400;
				break;
		}
		if ($action) {
			$smarty->display_wrap("friendship_schools/action/$action.tpl");
		} else {
			/*
			 * @todo build message with possible actions
			 */
			$smarty->display_404('Action not found', $message);
		}
	}

	public function action($action_number) {
		global $smarty;
		
		$dbActions = DbActions::get_instance();
		$action = $dbActions->get($action_number);
		
		if ($action) {
			$smarty->assign('title', "{$action['actions_number_nice']} {$action['action']}");
			$smarty->_assign_by_ref('action', $action);
			
			$dbReports = DbReports::get_instance();
			$limit = mysql_limit($_GET['skip'], $smarty->_tpl['pagination']['reports_in_action'] + 1, $_GET['all']);
			
			$where = array(
				'`datetime_approval` IS NOT NULL',
				"`actions` LIKE '%{$action['actions_number']}%'"
			);
			if ($_GET['country']) {
				$where['countries_iso'] = $_GET['country'];
			}
			if ($_GET['city']) {
				$where['city'] = $_GET['city'];
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
			
			$latest_reports = $dbReports->gets($where, '`date` DESC', $limit);
			$smarty->_assign_by_ref('latest_reports', $latest_reports);
			
			if (! $_GET['ajax']) {
				$where[] = "`attachments` LIKE '%jpg%'";
				$latest_reports_with_photos = $dbReports->gets($where, '`date` DESC', 10);
				$smarty->_assign_by_ref('latest_reports_with_photos', $latest_reports_with_photos);
				
				$dbDelicious = DbDelicious::get_instance();
				$delicious = $dbActions->crosstagged($dbDelicious, $action['tags'], NULL, NULL, '`datetime` DESC');
				$smarty->_assign_by_ref('delicious', $delicious);
				
				$smarty->display_wrap('friendship_schools/action.tpl');
			} else {
				$smarty->display_wrap('friendship_schools/action_more.tpl');
			}
		} else {
			/*
			 * @todo build message with possible actions
			 */
			$smarty->display_404('Action not found', $message);
		}
	}
}