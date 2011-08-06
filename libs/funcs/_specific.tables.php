<?php

require_once 'class.dbtable.php';

class DbSchools extends DbTable {

	function __construct($db, $debug = LL_DEBUG_SQL) {
		parent::__construct($db, array(
			'member_schools', 
			'member_schools_overview'
		), $debug);
	}

	function clean_results($items) {
		return $items;
	}
}

class DbSchoolsCountries extends DbTable {

	function __construct($db, $debug = LL_DEBUG_SQL) {
		parent::__construct($db, array(
			'countries', 
			'member_schools_countries_overview'
		), $debug);
	}
}

class DbSchoolsCities extends DbTable {

	function __construct($db, $debug = LL_DEBUG_SQL) {
		parent::__construct($db, array(
			'member_schools', 
			'member_schools_cities_overview'
		), $debug);
	}
}

class DbReports extends DbTable {

	function __construct($db, $debug = LL_DEBUG_SQL) {
		parent::__construct($db, array(
			'member_reports', 
			'member_reports_overview'
		), $debug);
	}

	function clean_results($items) {
		global $uri;
		
		if (! $items) {
			return array();
		}
		
		$dbActions = DbActions::get_instance();
		
		foreach ($items as &$item) {
			$media = read_media_dir(LL_REPORT_MEDIA . '/' . $item['member_reports_id'], array(
				'uri_image' => $uri['report_image'] . $item['member_reports_id'] . '/', 
				'uri_thumb' => $uri['report_thumb'] . $item['member_reports_id'] . '/', 
				'uri_file' => $uri['report_file'] . $item['member_reports_id'] . '/', 
				'uri_icon' => $uri['icon_file']
			));
			if ($media) {
				foreach ($media as $media_document) {
					if ($media_document['extension'] == 'jpg' || $media_document['extension'] == 'png') {
						$item['media_front'] = $media_document;
						break;
					}
				}
			}
			$item['media'] = $media;
			
			$item['link'] = $uri['report'] . $item['member_reports_id'];
			
			$actions = explode(',', $item['actions']);
			foreach ($actions as $action) {
				$item['actions_full'][] = $dbActions->get($action);
			}
		}
		return $items;
	}
}

class DbActions extends DbTable {

	private $_cache = array();

	function __construct($db, $debug = LL_DEBUG_SQL) {
		parent::__construct($db, array(
			'actions', 
			'actions_overview'
		), $debug);
		
		$this->_caching = TRUE;
		$this->cache();
		unset($this->_caching);
	}

	function cache() {
		if (! $this->_cache) {
			$actions = $this->gets(NULL, '`actions_number` ASC');
			
			foreach ($actions as $action) {
				$this->_cache[$action['actions_number']] = $action;
			}
			
			ksort($this->_cache);
		}
		return $this->_cache;
	}

	function get($where) {
		if (is_numeric($where) && isset($this->_cache[$where])) {
			return $this->_cache[$where];
		} else {
			$action = parent::get($where);
			if ($action) {
				$this->_cache[$action['actions_number']] = $action;
			}
			return $action;
		}
	}

	function clean_results($items) {
		global $uri;
		
		if (! $items) {
			return array();
		}
		
		foreach ($items as &$item) {
			$item['link'] = $uri['action'] . $item['actions_number'];
			
			$item['tags'] = $item['tags'] ? explode(',', $item['tags']) : array();
			$item['tags'][] = 'action:' . $item['actions_number'];
			$item['tags'] = implode(',', $item['tags']);
			
			//$item['actions_number_nice'] = left($item['actions_number']) . ':' . right($item['actions_number'], 2);
			if (right($item['actions_number'], 2) != 0) {
				$item['theme'] = $this->get(left($item['actions_number']) . '00');
				$item['theme']['link'] = $uri['theme_' . left($item['actions_number'])];
				$item['theme']['action_short'] = str_replace('Care for ', '', str_replace('Let\'s Get Organised!', 'Organised', $item['theme']['action']));
			}
		}
		return $items;
	}
}

class DbDays extends DbTable {

	function __construct($db, $debug = LL_DEBUG_SQL) {
		parent::__construct($db, array(
			'days', 
			'days_overview'
		), $debug);
	}
}

class DbEvents extends DbTable {

	function __construct($db, $debug = LL_DEBUG_SQL) {
		parent::__construct($db, array(
			'events', 
			'events_overview'
		), $debug);
	}

	function get_major($date) {
		$db = $this->_db;
		
		$sql = "
			SELECT SUM(`e`.`type` = 'conference_major')
			FROM `lifelink`.`events` `e`
			WHERE `e`.`date_start` <= '$date'
		";
		
		$result = $db->query($sql);
		return @array_shift($result->fetch_assoc());
	}

	function clean_results($items) {
		global $uri;
		
		if (! $items) {
			return array();
		}
		
		$dbActions = DbActions::get_instance();
		
		foreach ($items as &$item) {
			$item['type_nice'] = ucwords($item['type']);
			if ($item['type'] == 'conference_major') {
				$count = $this->get_major($item['date_start']);
				$item['type_nice'] = $count . english_ordinal_ending($count) . ' Conference';
				$item['event_nice'] = $count . english_ordinal_ending($count) . ' International Conference';
			} else {
				$item['event_nice'] = $item['event'] . ' ' . $item['year_start'] . (($item['year_start'] != $item['year_end']) ? ('-' . $item['year_end']) : '') . ' ' . $item['type_nice'];
			}
			
			$item['link'] = $uri['event'] . $item['events_id'];
			
			if ($item['actions']) {
				$actions = explode(',', $item['actions']);
				foreach ($actions as $action) {
					$item['actions_full'][] = $dbActions->get($action);
				}
			}
		}
		return $items;
	}
	
/*function tagged($tags, $min_tags = 0, $orderby = NULL, $limit = NULL) {
		if (! $tags) {
			return;
		}
		
		$tags = is_string($tags) ? explode(',', $tags) : (array) $tags;
		$tags = "'" . implode("','", $tags) . "'";
		
		$dbTags = DbTags::get_instance();
		$items = $dbTags->gets("`tag` IN ($tags)");
		
		foreach ($items as $item) {
			$ids[] = $item["{$this->_id}_fk"];
		}
		$ids = implode(',', $ids);
		
		if ($ids) {
			$items = $this->gets("`{$this->_id}` IN ($ids)", $orderby, $limit);
			return $items;
		}
	}*/
}

class DbReactions extends DbTable {

	function __construct($db, $debug = LL_DEBUG_SQL) {
		parent::__construct($db, array(
			'reactions', 
			'reactions_overview'
		), $debug);
	}
}

class DbContacts extends DbTable {

	function __construct($db, $debug = LL_DEBUG_SQL) {
		parent::__construct($db, array(
			'contacts', 
			'contacts_overview'
		), $debug);
	}
}

class DbCountries extends DbTable {

	function __construct($db, $debug = LL_DEBUG_SQL) {
		parent::__construct($db, array(
			'countries', 
			'countries_overview'
		), $debug);
	}
}

class DbHighlights extends DbTable {

	function __construct($db, $debug = LL_DEBUG_SQL) {
		parent::__construct($db, array(
			'highlights'
		), $debug);
	}
}

class DbVariables extends DbTable {

	function __construct($db, $debug = LL_DEBUG_SQL) {
		parent::__construct($db, array(
			'variables'
		), $debug);
	}

	public function get($variable) {
		$results = $this->gets("`variable` = '$variable'", '`datetime` DESC', 1);
		$results = @array_shift($results);
		return @$results['value'];
	}

	public function set($variable, $value) {
		$sql = "
			INSERT INTO `lifelink`.`variables` (
				`variable`,
				`value`,
				`datetime`
			) VALUES (
				'%s',
				%s,
				NOW()
			)
		";
		
		if (left($value, 1) != '(' && left($value, 1) != "'") {
			$value = "'$value'";
		}
		
		$sql = sprintf($sql, $variable, $value);
		$this->_db->query($sql);
	}

	public function set2($where, $data) {
		$this->set($where, $data);
	}
}

class DbDelicious extends DbTable {

	function __construct($db, $debug = LL_DEBUG_SQL) {
		parent::__construct($db, array(
			'delicious', 
			'delicious_overview'
		), $debug);
	}

	function clean_results($items) {
		global $uri;
		
		if (! $items) {
			return array();
		}
		
		foreach ($items as &$item) {
			$tags_full = array();
			if ($item['tags']) {
				$tags = explode(',', $item['tags']);
				foreach ($tags as $tag) {
					$tag = explode(':', $tag);
					$tag_full = array();
					if (count($tag) == 2) {
						$tag_full['type'] = $tag[0];
						$tag_full['title'] = $tag[1];
						$tag_full['tag'] = implode(',', $tag);
						$tags_full[$tag[0]] = $tag_full;
					} else {
						$tag_full['type'] = '';
						$tag_full['title'] = $tag[0];
						$tag_full['tag'] = $tag[0];
						$tags_full[] = $tag_full;
					}
				}
			}
			$item['tags_full'] = $tags_full;
		}
		return $items;
	}
}

class DbTags extends DbTable {

	function __construct($db, $debug = LL_DEBUG_SQL) {
		parent::__construct($db, array(
			'tags'
		), $debug);
	}
}
