<?php

class EventC extends C {

	public function index($where = NULL) {
		global $smarty;
		
		$dbEvents = DbEvents::get_instance();
		
		if (! $where) {
			$smarty->assign('type', 'Events');
		}
		
		$limit = mysql_limit($_GET['skip'], $smarty->_tpl['pagination']['events'] + 1, $_GET['all']);
		
		$events = $dbEvents->gets($where, '`date_end` DESC', $limit);
		$smarty->_assign_by_ref('events', $events);
		
		if (! $_GET['ajax']) {
			$smarty->display_wrap('events/index.tpl');
		} else {
			$smarty->display_wrap('events/index_more.tpl');
		}
	}

	public function campaigns() {
		global $smarty;
		$smarty->assign('type', 'Campaigns');
		
		$this->index(array(
			'type' => 'campaigns'
		));
	}

	public function conferences() {
		global $smarty;
		$smarty->assign('type', 'Conferences');
		
		$this->index(array(
			"`type` = 'conference' OR `type` = 'conference_major' OR `type` = 'seminar' OR `type` = 'workshop'"
		));
	}

	public function event($event_id) {
		global $smarty;
		
		$dbEvents = DbEvents::get_instance();
		$event = $dbEvents->get($event_id);
		
		if (! $event) {
			/*
			 * @todo build message with possible events
			 */
			return $smarty->display_404('Event not found', $message);
		}
		
		$smarty->assign('title', $event['event_nice']);
		
		$smarty->_assign_by_ref('event', $event);
		
		$dbTags = DbTags::get_instance();
		$tag = $dbTags->get(array(
			'events_id_fk' => $event['events_id']
		));
		$tag = $tag['tag'];
		
		$dbSchools = DbSchools::get_instance();
		$schools = $dbSchools->tagged($tag, '`country` DESC, `city` DESC');
		$smarty->_assign_by_ref('schools', $schools);
		
		$smarty->display_wrap('events/event.tpl');
	}
}