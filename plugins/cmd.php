<?php

class CmdC extends C {

	public function statistics_daily() {
		set_time_limit(600);
		$dbVariables = DbVariables::get_instance();

		//Update Number for the Programme
		$sql = "
			SELECT
				SUM(`sc`.`count_schools`)
			FROM `lifelink`.`member_schools_countries_overview` `sc`
		";
		$dbVariables->set('schools_counter', "($sql)");

		$sql = "
			SELECT
				SUM(`sc`.`count_reports`)
			FROM `lifelink`.`member_schools_countries_overview` `sc`
		";
		$dbVariables->set('reports_counter', "($sql)");

		$sql = "
			SELECT
				COUNT(*)
			FROM `lifelink`.`member_schools_countries_overview` `sc`
		";
		$dbVariables->set('countries_counter', "($sql)");

		$sql = "
			SELECT
				GROUP_CONCAT(DISTINCT `sc`.`iso2` SEPARATOR '')
			FROM `lifelink`.`member_schools_countries_overview` `sc`
		";
		$dbVariables->set('countries_concat_iso2', "($sql)");

		die('done');
	}

	public function statistics_weekly() {
		set_time_limit(600);
		$dbVariables = DbVariables::get_instance();
		$dbSchoolsCountries = DbSchoolsCountries::get_instance();

		//Update Numbers for each Country
		$countries = $dbSchoolsCountries->gets();
		foreach ($countries as $country) {
			$country['iso3'] = strtolower($country['iso3']);
			$dbVariables->set("schools_counter_{$country['iso3']}", $country['count_schools']);
			$dbVariables->set("reports_counter_{$country['iso3']}", $country['count_reports']);
			$dbVariables->set("actions_counter_{$country['iso3']}", $country['count_actions']);
			$dbVariables->set("date_report_first_{$country['iso3']}", $country['date_report_first']);
			$dbVariables->set("date_report_last_{$country['iso3']}", $country['date_report_last']);
		}

		$this->statistics_daily();
	}

	public function statistics_monthly() {
		set_time_limit(600);
		$dbVariables = DbVariables::get_instance();

		//Update Number of Care Actions
		$sql = "
			SELECT
				COUNT(*)
			FROM `lifelink`.`actions` `a`
			WHERE 1=1
				AND `a`.`is_old` = 'no'
				AND RIGHT(`a`.`actions_number`, 2) <> '00'
		";
		$dbVariables->set('actions_counter', "($sql)");

		//Update Number of Conferences
		$sql = "
			SELECT
				COUNT(*)
			FROM `lifelink`.`events` `e`
			WHERE 1=1
				AND (`e`.`type` = 'conference' OR `e`.`type` = 'conference_major')
		";
		$dbVariables->set('conferences_counter', "($sql)");

		//Update Number of Campaigns
		$sql = "
			SELECT
				COUNT(*)
			FROM `lifelink`.`events` `e`
			WHERE 1=1
				AND `e`.`type` = 'campaign'
		";
		$dbVariables->set('campaigns_counter', "($sql)");

		//Update Number of Reactions
		$sql = "
			SELECT
				COUNT(*)
			FROM `lifelink`.`reactions` `r`
		";
		$dbVariables->set('reactions_counter', "($sql)");

		$this->update_kml();
		$this->update_delicious();

		$this->statistics_weekly();
	}

	public function statistics_yearly() {
		$dbVariables = DbVariables::get_instance();
		$dbVariables->delete("`variable` LIKE 'worldbank_%'");

		$this->statistics_monthly();
	}

	public function update_delicious() {
		global $db;
		$dbDelicious = DbDelicious::get_instance();
		$dbTags = DbTags::get_instance();

		$json = curl_get('http://feeds.delicious.com/v2/json/lifelinkfriendshipschools?count=100');
		$json = json_decode($json, TRUE);

		foreach ($json as $item) {
			$url = $item['u'];
			$title = $item['d'];
			$description = $item['n'];
			$datetime = date('Y-m-d H:i:s', strtotime($item['dt']));
			$tags = $item['t'];

			$dbDelicious->add(array(
				'url' => $url,
				'title' => $title,
				'description' => $description,
				'datetime' => $datetime
			));

			$delicious_id = $dbDelicious->last_insert_id;

			foreach ($tags as $tag) {
				$dbTags->add(array('tag' => $tag));

				$tag_id = $dbTags->last_insert_id;
				$sql = "
					DELETE FROM `lifelink`.`delicious_has_tags`
					WHERE 1=1
						AND `delicious_id_fk` = {$delicious_id}
				";

				$db->execute($sql);

				$sql = "
					INSERT IGNORE INTO `lifelink`.`delicious_has_tags` (
						`delicious_id_fk`,
						`tags_id_fk`
					) VALUES (
						{$delicious_id},
						{$tag_id}
					)
				";

				$db->execute($sql);
			}
		}

	}

	public function update_kml() {
		$this->create_schools_kml();
		$this->create_countries_kml();
	}

	private function create_schools_kml() {
		global $curl_throttle, $uri;
		$curl_throttle_backup = $curl_throttle;
		$curl_throttle = 1;

		//Update Coordinates for each School and create KML with School placemarks
		$dbSchools = DbSchools::get_instance();
		$schools = $dbSchools->gets('`datetime_approval` IS NOT NULL');

		$schools_kml = new KML();
		$schools_kml->add_icon_style('school', 'http://beta.life-link.org/tpl.main/img/layout/leaf_dark.png');
		$schools_kml->kml->set_description('Listing of schools within Life-Link Friendship-Schools<br/>Data from <a href="http://www.life-link.org">www.life-link.org</a><br/>Updated ' . date('Y-m-d'));

		while ($school = @array_shift(each($schools))) {
			if ($school['coord_accuracy'] < 4) {
				$address = $school['city'];
				if ($school['county']) {
					$address .= ', ' . $school['county'];
				}
				$address .= ', ' . $school['country'];

				while (TRUE) {
					$json = curl_get("http://maps.google.com/maps/geo", array(
						'output' => 'json',
						'key' => LL_GMAPS_KEY,
						'q' => $address
					));
					$json = json_decode($json, TRUE);

					if ($json['Status']['code'] == 620) {
						$curl_throttle++;
					} else {
						break;
					}
				}

				if ($json['Status']['code'] == 200 && $json['Placemark'][0]['AddressDetails']['Accuracy'] >= 4) {
					$data = array(
						'coord_lat' => $json['Placemark'][0]['Point']['coordinates'][1],
						'coord_lng' => $json['Placemark'][0]['Point']['coordinates'][0],
						'coord_accuracy' => $json['Placemark'][0]['AddressDetails']['Accuracy']
					);
					$dbSchools->set($school['member_schools_number'], $data);

					$school = array_merge($school, $data);
				}
			}

			if ($school['coord_accuracy'] >= 4) {
				$description = "
					{$school['school']}<br />
					in {$school['city']}, {$school['country']}<br />
					<br />
					<a href=\"{$uri['school']}{$school['member_schools_number']}\">View contact information &amp; Action Reports</a>
				";
				$schools_kml->add_placemark($school['member_schools_number'], $school['coord_lng'], $school['coord_lat'], array(
					'style' => 'school',
					'description' => $description
				));
			}
		}

		$schools_kml->save(LL_ROOT . '/kml/friendship-schools.kml');
		$curl_throttle = $curl_throttle_backup;
	}

	private function create_countries_kml() {
		//Create KML for School Countries
		$dbSchoolsCountries = DbSchoolsCountries::get_instance();
		$countries = $dbSchoolsCountries->gets('`coord_lat` AND `coord_lng`');

		$countries_kml = new KML();
		$countries_kml->add_icon_style('country', 'http://beta.life-link.org/tpl.main/img/layout/leaf_dark.png');
		$countries_kml->kml->set_description('Listing of countries within Life-Link Friendship-Schools<br/>Data from <a href="http://www.life-link.org">www.life-link.org</a><br/>Updated ' . date('Y-m-d'));

		foreach ($countries as $country) {
			$country['date_report_first'] = left($country['date_report_first'], 4);
			$title = "{$country['country']} ({$country['date_report_first']}) {$country['count_schools']}";
			$description = "
				Joined => {$country['date_report_first']}<br />
				Country => {$country['country']}<br />
				Number of Schools => {$country['count_schools']}<br />
			";
			$countries_kml->add_placemark($country['countries_iso'], $country['coord_lng'], $country['coord_lat'], array(
				'title' => $title,
				'description' => $description
			));
		}

		$countries_kml->save(LL_ROOT . '/kml/friendship-schools-countries.kml');
	}
}