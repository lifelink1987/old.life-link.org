<?php

function relative_date($time) {
	$today = strtotime(date('M j, Y'));
	$reldays = ($time - $today) / 86400;
	if ($reldays >= 0 && $reldays < 1) {
		return 'today';
	} else if ($reldays >= 1 && $reldays < 2) {
		return 'tomorrow';
	} else if ($reldays >= - 1 && $reldays < 0) {
		return 'yesterday';
	}
	if (abs($reldays) < 7) {
		if ($reldays > 0) {
			$reldays = floor($reldays);
			return 'in ' . $reldays . ' day' . ($reldays != 1 ? 's' : '');
		} else {
			$reldays = abs(floor($reldays));
			return $reldays . ' day' . ($reldays != 1 ? 's' : '') . ' ago';
		}
	}
	if (date('Y', $time ? $time : time()) == date('Y', time())) {
		if (abs($reldays) < 14) {
			return date('l, F j', $time ? $time : time());
		} else {
			return date('F j', $time ? $time : time());
		}
	} else {
		return date('F j, Y', $time ? $time : time());
	}
}

function lastday($year = NULL, $month = NULL) {
	$month = $month ? $month : date('m');
	$year = $year ? $year : date('Y');
	$result = strtotime("$year-$month-01");
	$result = strtotime('-1 second', strtotime('+1 month', $result));
	return date('d', $result);
}
