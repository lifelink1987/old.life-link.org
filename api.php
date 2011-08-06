<?php

require_once 'libs/funcs.php';

switch ($_GET['action']) {
	case 'get_cities':
		$where = array();
		if ($_GET['country']) {
			$where['countries_iso'] = $_GET['country'];
		}
	
		$dbSchoolsCities = DbSchoolsCities::get_instance();
		$cities = $dbSchoolsCities->gets($where, '`city` ASC');
		
		foreach ($cities as $city) {
			$cities_simple[] = $city['city'];
		}
		echo json_encode($cities_simple);
		break;
	
	case 'get_countries':
		$where = array(
			'`countries_iso` > 0'
		);
		if ($_GET['term']) {
			$_GET['term'] = strtolower($_GET['term']);
			$where[] = "LOWER(`country`) LIKE '{$_GET['term']}%'";
		}
		if ($_GET['all']) {
			$dbCountries = DbCountries::get_instance();
			$countries = $dbCountries->gets($where, 'country');
		} else {
			$dbSchoolsCountries = DbSchoolsCountries::get_instance();
			$countries = $dbSchoolsCountries->gets($where, 'country');
		}
		
		foreach ($countries as $country) {
			$countries_simple[] = array(
				'label' => $country['country'], 
				'value' => $country['country_short']
			);
		}
		echo json_encode($countries_simple);
		break;
	
	case 'get_actions':
		if (! $_GET['old']) {
			$where[] = "`is_old` = 'no'";
		}
		if ($_GET['term']) {
			$_GET['term'] = strtolower($_GET['term']);
			if (is_numeric($_GET['term'])) {
				$where[] = "`actions_number` = {$_GET['term']}";
			} else {
				$where[] = "LOWER(`action`) LIKE '%{$_GET['term']}%'";
			}
		}
		$dbActions = DbActions::get_instance();
		$actions = $dbActions->gets($where, 'actions_number');
		
		foreach ($actions as $action) {
			$actions_simple[] = array(
				'label' => $action['actions_number_nice'] . ' ' . $action['action'], 
				'value' => $action['actions_number']
			);
		}
		echo json_encode($actions_simple);
		break;
	
	case 'get_schools':
		if ($_GET['term']) {
			$_GET['term'] = strtolower($_GET['term']);
			if (is_numeric($_GET['term'])) {
				$where_or[] = "`member_schools_number` = {$_GET['term']}";
			}
			$where_or[] = "LOWER(`school`) LIKE '%{$_GET['term']}%'";
			$where = implode(' OR ', $where_or);
		}
		$dbSchools = DbSchools::get_instance();
		$schools = $dbSchools->gets($where, 'school');
		
		foreach ($schools as $school) {
			$schools_simple[] = array(
				'label' => '#' . $school['member_schools_number'] . ' ' . $school['school'] . ', ' . $school['city'] . ', ' . $school['country_short'], 
				'value' => $action['member_schools_number']
			);
		}
		echo json_encode($schools_simple);
		break;
	
	default:
		break;
}