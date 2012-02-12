<?php

class ReportC extends C {

	public function image($report, $file, $width = 800, $height = NULL, $all = FALSE) {
		if ($height) {
			$aspect_ratio = $width/$height;
		}
		$unique_suffix = ".w$width";
		$unique_suffix .= $height ? ".h$height" : '';
		$unique_suffix .= $all ? '.all' : '.not_all';
		show_png(LL_REPORT_MEDIA . "/$report/$file", $width, $aspect_ratio, $all);
	}

	public function thumb($report, $file) {
		show_png(LL_REPORT_MEDIA . "/$report/$file", 200);
	}

	public function file($report, $file) {
		download(LL_REPORT_MEDIA . "/$report/$file");
	}
}