<?php

class CountryC extends C {

	private $worldbank_indicators = array(
		'population_total' => 'SP.POP.TOTL',
		//'population_growth_percent' => 'SP.POP.GROW',
		'population_urban_percent' => 'SP.URB.TOTL.IN.ZS',
		//'population_urban_growth_percent' => 'SP.URB.GROW',
		'population_rural_percent' => 'SP.RUR.TOTL.ZS',
		//'population_rural_growth_percent' => 'SP.RUR.TOTL.ZG',
		'internet_users_per_100' => 'IT.NET.USER.P2',
		'land_area' => 'AG.LND.TOTL.K2',
		'forest_area' => 'AG.LND.FRST.K2',
		'energy_use_per_capita' => 'EG.USE.PCAP.KG.OE',
		'co2_per_capita' => 'EN.ATM.CO2E.PC',
		'water_pollution_chemical_percent' => 'EE.BOD.CHEM.ZS',
		'water_pollution_food_percent' => 'EE.BOD.FOOD.ZS',
		'water_pollution_metal_percent' => 'EE.BOD.MTAL.ZS',
		'water_pollution_textile_percent' => 'EE.BOD.TXTL.ZS',
		'water_pollution_wood_percent' => 'EE.BOD.WOOD.ZS',
		'freshwater_annual_total' => 'ER.H2O.FWTL.K3',
		//'freshwater_annual_percent' => 'ER.H2O.FWTL.ZS',
		'freshwater_renewable_total' => 'ER.H2O.INTR.K3'
	);

	private function worldbank_indicator($iso2, $indicator) {
		$iso2 = strtolower($iso2);
		$indicator2 = $this->worldbank_indicators[$indicator];
		
		$json = curl_get("http://api.worldbank.org/countries/$iso2/indicators/$indicator2", 'format=json');
		
		$json = json_decode($json, TRUE);
		
		if ($json['error']) {
			return FALSE;
		} else {
			$json = @$json[1];
			
			foreach ($json as $yearly_value) {
				if (! empty($yearly_value['value'])) {
					return array(
						'value' => $yearly_value['value'],
						'year' => $yearly_value['date']
					);
				}
			}
		}
	}

	private function worldbank($iso2) {
		$iso2 = strtolower($iso2);
		$dbVariables = DbVariables::get_instance();
		$cache = $dbVariables->get("worldbank_$iso2");
		
		if ($cache) {
			return json_decode($cache, TRUE);
		}
		
		$result = array();
		foreach (array_keys($this->worldbank_indicators) as $indicator) {
			$result[$indicator] = $this->worldbank_indicator($iso2, $indicator);
		}
		
		if ($result['land_area']) {
			$area = $result['land_area']['value'];
			if ($area > 300000) {
				$map_zoom = 3;
			} else if ($area > 200000) {
				$map_zoom = 4;
			} else if ($area > 100000) {
				$map_zoom = 5;
			} else {
				$map_zoom = 6;
			}
		} else {
			$map_zoom = 3;
		}
		$result['map_zoom'] = $map_zoom;
		
		$dbVariables->set("worldbank_$iso2", json_encode($result));
		return $result;
	}

	public function country($country, $city = NULL) {
		global $smarty, $uri;
		
		$dbSchoolsCountries = DbSchoolsCountries::get_instance();
		
		$country_low = strtolower($country);
		$country = $dbSchoolsCountries->get("LOWER(`country_short`) = '$country_low' OR LOWER(`country`) = '$country_low'");
		
		//If a long name was passed, let's redirect to the short name of the country
		if ($country && ($country['country'] != $country['country_short']) && (strtolower($country['country_short']) != $country_low)) {
			redirect($uri['country'] . $country['country_short'], TRUE);
		}
		
		if ($country) {
			$type = 'country';
			$smarty->assign('title', "Life-Link Friendship-Schools in {$country['country']}");
			$smarty->_assign_by_ref('country', $country);
			
			$where = array(
				'`datetime_approval` IS NOT NULL',
				'countries_iso' => $country['countries_iso']
			);
			$order = "`count_reports` DESC";
			if ($city) {
				$type = 'city';
				$city_low = strtolower($city);
				$where[] = "(LOWER(`city`) = '$city_low' OR `city` SOUNDS LIKE '$city')";
				$order = "LOWER(`city`) = '$city_low', `city` SOUNDS LIKE '$city', $order";
			}
			
			$dbSchools = DbSchools::get_instance();
			$schools = $dbSchools->gets($where, $order, $_GET['all'] ? NULL : ($smarty->_tpl['pagination']['schools_in_country'] + 1));
			$smarty->_assign_by_ref('schools', $schools);
			
			if (! $city) {
				$dbEvents = DbEvents::get_instance();
				$events = $dbEvents->gets(array(
					'countries_iso' => $country['countries_iso']
				), '`date_end` DESC', 3);
				$smarty->_assign_by_ref('events', $events);
			}
			
			if ($city && ! $schools) {
				/*
				 * @todo build message with possible cities
				 */
				$smarty->display_404($country, $message);
			} else {
				$where = array(
					'`datetime_approval` IS NOT NULL',
					'countries_iso' => $country['countries_iso']
				);
				$order = '`date` DESC';
				if ($city) {
					$city_low = strtolower($city);
					$where[] = "(LOWER(`city`) = '$city_low' OR `city` SOUNDS LIKE '$city')";
					$order = "LOWER(`city`) = '$city_low', `city` SOUNDS LIKE '$city', $order";
				}
				
				$dbReports = DbReports::get_instance();
				$latest_reports = $dbReports->gets($where, $order, 5);
				$smarty->_assign_by_ref('latest_reports', $latest_reports);
				
				$where[] = "`attachments` LIKE '%jpg%'";
				$latest_reports_with_photos = $dbReports->gets($where, $order, 5);
				$smarty->_assign_by_ref('latest_reports_with_photos', $latest_reports_with_photos);
				
				$worldbank = $this->worldbank($country['iso2']);
				$smarty->_assign_by_ref('worldbank', $worldbank);
				
				$smarty->_assign_by_ref('type', $type);
				$smarty->display_wrap('friendship_schools/country.tpl');
			}
		} else {
			$dbCountries = DbCountries::get_instance();
			$countries = $dbCountries->gets("`country` SOUNDS LIKE '$country' OR `country_short` SOUNDS LIKE '$country'");
			
			/*
			 * @todo build message with possible countries
			 */
			$smarty->display_404($country, $message);
		}
	}
}