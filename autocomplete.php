<?php

require_once('libs/funcs.php');

function output_yui_ds_xhr($output)
{
	$output = json_encode(array('output' => $output));
	echo $output . "\n";
}

switch ($_REQUEST['function'])
{
	case 'members_bynumber':
		$school = db_schools::get($_REQUEST['schoolnumber']);
		if ($school)
		{
			$output['results'] = db::restrict(array($school), array('schoolnumber', 'name', 'city', 'countryname'));
			output_yui_ds_xhr($output);
		}
		break;
	case 'members_byname':
		$output = db_schools::gets_bynamelike($_REQUEST['namelike']);
		if (!$output['result_message'])
		{
			$output['results'] = db::restrict($output['results'], array('schoolnumber', 'name', 'city', 'countryname'));
		}
		output_yui_ds_xhr($output);
		break;
	case 'cities_bycountry':
		if ($_REQUEST['city'])
		{
			$orderby = ' ORDER BY (s.city LIKE "' . $_REQUEST['city'] . '%" OR s.city SOUNDS LIKE "' . $_REQUEST['city'] . '") DESC, s.city';
		}
		$cities = db_schools::get_cities($_REQUEST['country'], $orderby);
		foreach ($cities as $city)
		{
			$parsedCities[]['name'] = $city;
		}
		$output['results'] = $parsedCities;
		output_yui_ds_xhr($output);
		break;
}

?>