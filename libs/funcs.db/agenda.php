<?php

db_agenda::init();

class db_agenda
{
	private static $db;

	static function init()
	{
		self::$db = new db();
	}

	static function gets_events($condition = null, $orderby = null, $limit = null)
	{
		global $db_agenda_name;
		$db =& self::$db;
		if (!$orderby)
		{
			$orderby = " ORDER BY startdate";
		}
		if ($limit)
		{
			$limit = " LIMIT $limit";
		}
		$sql = "
			SELECT *
			FROM $db_agenda_name
			WHERE 1=1$condition
			$orderby
			$limit
		";
		$i = -1;
		while ($result = $db->data_assoc($sql, 0))
		{
			$i++;
			$events[$i]['startdate'] = $result['startdate'];
			$events[$i]['enddate'] = $result['enddate'];
			$events[$i]['title'] = $result['title'];
			$events[$i]['startdate'] = $result['description'];
			$events[$i] = array_merge($events[$i], db_actions::from_string($result['actionnumber']));
		}
		$db->clear();
		return $events;
	}
	
	static function gets_live($end_date = 0)
	{
		global $links, $timetest;
		$timetest['news_list_start'] = gmdate('H:i:s');
		$news_raw = db_wordpress::get_list('News', null, '0,1');
		$timetest['news_list_end'] = gmdate('H:i:s');
		if ($news_raw)
		{
			$timetest['news_list_start_raw1'] = gmdate('H:i:s');
			for ($i=0; $i<count($news_raw); $i++)
			//foreach ($news_raw as &$item)
			{
				$temp = db_wordpress::get_full($news_raw[$i]);
				//$temp = db_wordpress::get_full($item);
				if (
					(
						($end_date)
						&& (strcmp($temp['meta']['end_date'], date('Y-m-d')) > 0)
					)
					|| (!$end_date)
				)
				{
					$news[] = $temp;
				}
				unset($temp);
			}
			$timetest['news_list_start_raw2'] = gmdate('H:i:s');
		
			if ((!$news) && ($news_raw))
			{
				$news_item = db_wordpress::get_full($news_raw[0]);
				$news_item['guid'] = $links['live_get'].'news#'.$news_item['id'];
				$news[] = $news_item;
			}
			$timetest['news_list_start_raw3'] = gmdate('H:i:s');
			unset($news_raw);
		}
		
		$timetest['newsletter_list_start'] = gmdate('H:i:s');
		$newsletters_raw = db_wordpress::get_list('Newsletters', null, '0,1');
		$timetest['newsletter_list_end'] = gmdate('H:i:s');
		if ($newsletters_raw)
		{
			for ($i=0; $i<count($newsletters_raw); $i++)
			//foreach ($newsletters_raw as &$item)
			{
				$temp = db_wordpress::get_full($newsletters_raw[$i]);
				//$temp = db_wordpress::get_full($item);
				if (
					(
						($end_date)
						&& (strcmp($temp['meta']['end_date'], date('Y-m-d')) > 0)
					)
					|| (!$end_date)
				)
				{
					$newsletters[] = $temp;
				}
				unset($temp);
			}
			if ((!$newsletters) && ($newsletters_raw))
			{
				$newsletters[] = db_wordpress::get_full($newsletters_raw[0]);
			}
			unset($newsletters_raw);
		}
		
		$timetest['appendix_list_start'] = gmdate('H:i:s');
		$appendix_raw = db_wordpress::get_list('Board Meetings', null, '0,1');
		$timetest['appendix_list_end'] = gmdate('H:i:s');
		if ($appendix_raw)
		{
			for ($i=0; $i<count($appendix_raw); $i++)
			//foreach ($appendix_raw as &$item)
			{
				$temp = db_wordpress::get_full($appendix_raw[$i]);
				//$temp = db_wordpress::get_full($item);
				if (
					(
						($end_date)
						&& (strcmp($temp['meta']['end_date'], date('Y-m-d')) > 0)
					)
					|| (!$end_date)
				)
				{
					$appendix[] = $temp;
				}
				unset($temp);
			}
			if ((!$appendix) && ($appendix_raw))
			{
				$appendix[] = db_wordpress::get_full($appendix_raw[0]);
			}
			unset($appendix_raw);
		}
		
		return array(
			'news' => $news,
			'newsletters' => $newsletters,
			'appendix' => $appendix
		);
	}
	
	static function gets_recent()
	{
		$conferences = db_conferences::get_list(' AND enddate < CURDATE() AND DATEDIFF(CURDATE(), enddate) < 90', '0, 1');
		$campaigns = db_campaigns::get_list(' AND enddate < CURDATE() AND DATEDIFF(CURDATE(), enddate) < 90', '0, 1');
		$days = db_days::gets(" AND (STR_TO_DATE(CONCAT(YEAR(CURDATE()), '-', month, '-', day), '%Y-%m-%d') BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE() - INTERVAL 1 DAY)");
		$events = db_agenda::gets_events(' AND (enddate BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE() - INTERVAL 1 DAY)');
		return self::format_results($conferences, $campaigns, $days, $events, true);
	}
	
	static function gets_future()
	{
		$conferences = db_conferences::get_list(' AND startdate >= CURDATE()', '0, 1');
		$campaigns = db_campaigns::get_list(' AND startdate >= CURDATE()', '0, 1');
		$days = db_days::gets(" AND (STR_TO_DATE(CONCAT(YEAR(CURDATE()), '-', month, '-', day), '%Y-%m-%d') BETWEEN CURDATE() AND CURDATE() + INTERVAL 1 MONTH)");
		$events = db_agenda::gets_events(' AND (startdate BETWEEN CURDATE() AND CURDATE() + INTERVAL 1 MONTH)');
		return self::format_results($conferences, $campaigns, $days, $events);
	}
	
	static function gets_calendar($month, $year)
	{
		$conferences = db_conferences::get_list(' AND (' . $month . ' BETWEEN MONTH(startdate) AND MONTH(enddate)) AND (' . $year . ' BETWEEN YEAR(startdate) AND YEAR(enddate))');
		$campaigns = db_campaigns::get_list(' AND (' . $month . ' BETWEEN MONTH(startdate) AND MONTH(enddate)) AND (' . $year . ' BETWEEN YEAR(startdate) AND YEAR(enddate))');
		$days = db_days::gets(' AND month = ' . $month);
		$events = db_agenda::gets_events(' AND (' . $month . ' BETWEEN MONTH(startdate) AND MONTH(enddate)) AND (' . $year . ' BETWEEN YEAR(startdate) AND YEAR(enddate))');
		$results_raw = self::format_results($conferences, $campaigns, $days, $events);
		$firstday = "$year-$month-01";
		$lastday = "$year-$month-" . date('d', mktime(23, 59, 59, $month + 1, 0, $year));
		if ($results_raw)
		{
			foreach ($results_raw as &$result)
			{
				$result['mstartdate'] = (strcmp($result['startdate'], $firstday) > 0)?$result['startdate']:$firstday;
				$result['menddate'] = (strcmp($result['enddate'], $lastday) > 0)?$lastday:$result['enddate'];
				$results[] = $result;
			}
		}
		return $results;
	}
	
	private static function format_results($conferences, $campaigns, $days, $events, $reverse = false)
	{
		global $links;
		if ($conferences)
		{
			foreach ($conferences as &$conference)
			{
				$conference = db_conferences::get($conference);
				$result = array(
					'startdate' => $conference['startdate'],
					'enddate' => $conference['enddate'],
					'title' => $conference['title'],
					'description' => $conference['description'],
					'actions' => $conference['actions'],
					'actionnumber' => $conference['actionnumber'],
					'typetitle' => 'Conference',
					'type' => 'conference',
					'link' => $links['conference_get'] . $conference['id']
				);
				$results[] = $result;
			}
		}
		if ($campaigns)
		{
			foreach ($campaigns as &$campaign)
			{
				$campaign = db_campaigns::get($campaign);
				$result = array(
					'startdate' => $campaign['startdate'],
					'enddate' => $campaign['enddate'],
					'title' => $campaign['title'],
					'description' => $campaign['description'],
					'actions' => $campaign['actions'],
					'actionnumber' => $campaign['actionnumber'],
					'typetitle' => 'Campaign',
					'type' => 'campaign',
					'link' => $links['campaign_get'] . $campaign['id']
				);
				$results[] = $result;
			}
		}
		if ($days)
		{
			foreach ($days as &$day)
			{
				$result = array(
					'startdate' => $day['startdate'],
					'enddate' => $day['enddate'],
					'title' => $day['title'],
					'description' => $day['description'],
					'actions' => $day['actions'],
					'actionnumber' => $day['actionnumber'],
					'typetitle' => $day['type'] . ' Day',
					'type' => 'day',
					'link' => null
				);
				$results[] = $result;
			}
		}
		if ($events)
		{
			foreach ($events as &$event)
			{
				$result = array(
					'startdate' => $event['startdate'],
					'enddate' => $event['enddate'],
					'title' => $event['title'],
					'description' => $event['description'],
					'actions' => $event['actions'],
					'actionnumber' => $event['actionnumber'],
					'typetitle' => 'Event',
					'type' => 'event',
					'link' => null
				);
				$results[] = $result;
			}
		}
		if ($results)
		{
			foreach ($results as $key => $row)
			{
				$startdate[$key]  = $row['startdate'];
			}
			array_multisort($startdate, ($reverse?SORT_DESC:SORT_ASC), $results);
		}
		return $results;
	}
}

?>