<?php

class IconC extends C {

	public function file($ext) {
		$ext = strtolower($ext);
		switch ($ext) {
			case 'doc':
			case 'docx':
			case 'rtf':
				$name = 'word';
				break;
			case 'ppt':
			case 'pptx':
				$name = 'file_powerpoint';
				break;
			case 'pdf':
				$name = 'file_pdf';
				break;
			case 'xls':
			case 'xlsx':
			case 'csv':
				$name = 'file_excel';
				break;
			case 'flv':
				$name = 'adobe_flash';
				break;
			default:
				$name = 'file';
				break;
		}
		redirect('http://shared.life-link.org/icons/quartz/' . $name . '.png', TRUE);
	}

	public function social($name) {
		$ext = strtolower($ext);
		switch ($name) {
			case 'facebook':
			case 'twitter':
			case 'delicious':
			case 'mail':
			case 'email':
			case 'news':
			case 'rss':
				break;
			default:
				$name = 'file';
				break;
		}
		redirect('http://shared.life-link.org/icons/quartz/' . $name . '.png', TRUE);
	}

	public function flag_16($iso2) {
		$iso2 = (strlen($iso2)==2) ? strtolower($iso2) : "_$iso2";
		redirect('http://shared.life-link.org/icons/flags_icondrawer/flags_iso/16/' . $iso2 . '.png', TRUE);
	}

	public function flag_24($iso2) {
		$iso2 = (strlen($iso2)==2) ? strtolower($iso2) : "_$iso2";
		redirect('http://shared.life-link.org/icons/flags_icondrawer/flags_iso/24/' . $iso2 . '.png', TRUE);
	}

	public function flag_32($iso2) {
		$iso2 = (strlen($iso2)==2) ? strtolower($iso2) : "_$iso2";
		redirect('http://shared.life-link.org/icons/flags_icondrawer/flags_iso/32/' . $iso2 . '.png', TRUE);
	}

	public function flag_48($iso2) {
		$iso2 = (strlen($iso2)==2) ? strtolower($iso2) : "_$iso2";
		redirect('http://shared.life-link.org/icons/flags_icondrawer/flags_iso/48/' . $iso2 . '.png', TRUE);
	}
}