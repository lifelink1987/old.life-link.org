<?php

db_website::init();

class db_website
{
	private static $db;
	
	static function init()
	{
		self::$db = new db();
	}
	
	static function get(&$visitors, &$total, &$lastupdate)
	{
		global $db_website_name;
		$db =& self::$db;
		$sql = "
			SELECT id, `date`, visitors, total, lastupdate, updating
			FROM $db_website_name
			ORDER BY `date` DESC
			LIMIT 1;
		";
		$result = $db->data_assoc($sql);

		if ($result)
		{
			$lastupdate = $result['lastupdate'];
			/*we already have data about visitors til today*/
			if (($result['date'] == date('Y-m-d'))
				|| ((date('G') < 3)
						&& ($result['date'] == date('Y-m-d', strtotime('-1 day')))))
			{
				$visitors = $result['visitors'];
				$total = $result['total'];
			}
			/*we do have data
			and we need to gather this month's data
			and even sum up for the previous month*/
			else
			{
				if (!self::get_trafic_visitors($this_month, $previous_month))
				{
					return;
				}
				$visitors = $this_month;
				$total = $result['total'];
				/*it's the same month*/
				if (date('m', $result['date']) == date('m'))
				{
					$update = array(
						'visitors' => $this_month,
						'date' => date('Y-m-d')
					);
					$db->update('website', $update, 'id = ' . $result['id']);
				}
				/*it's a new month*/
				else
				{
					$total += $previous_month;
					$update = array(
						'visitors' => $previous_month,
						'date' => date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-01'))))
					);
					$db->update('website', $update, 'id = ' . $result['id']);
					$insert = array(
						'visitors' => $this_month,
						'date' => date('Y-m-d'),
						'total' => $previous_month + $result['total'],
						'lastupdate' => $result['lastupdate']
					);
					$db->insert('website', $insert);
				}
			}
		}
	}
	
	static private function get_trafic_visitors(&$this_month, &$previous_month)
	{
		function get_content($url)
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla: (compatible; Windows XP)');
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_TIMEOUT, 5);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$string = curl_exec($ch);
			curl_close($ch);
			return $string;
		}
		/*alternative to file_get_contents
		$traficro = get_content('http://stat3.trafic.ro/stat/lifelinkorg/vizitatori/luna/');*/
		ini_set('user_agent','Mozilla: (compatible; Windows XP)');
		$traficro = file_get_contents('http://stat3.trafic.ro/stat/lifelinkorg/vizitatori/luna/', 'r');
		if (!$traficro)
		{
			return false;
		}
		$needles = array('Grafic&nbsp;', '<td nowrap>');
		$start = '<td>';
		$end = '</td>';
		$this_month = substr_search($traficro, $needles, $start, $end);
		$needles = array('Grafic&nbsp;', '<td nowrap>', '<td nowrap>');
		$previous_month = substr_search($traficro, $needles, $start, $end);
		return true;
	}
}

?>