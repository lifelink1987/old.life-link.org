<?php

require_once LL_ROOT . '/libs/php-kml/kml.php';
require_once LL_ROOT . '/libs/php-kml/kml_root.php';
require_once LL_ROOT . '/libs/php-kml/kml_Object.php';
require_once LL_ROOT . '/libs/php-kml/kml_SchemaField.php';
require_once LL_ROOT . '/libs/php-kml/kml_ColorStyle.php';
require_once LL_ROOT . '/libs/php-kml/kml_Feature.php';
require_once LL_ROOT . '/libs/php-kml/kml_Geometry.php';
require_once LL_ROOT . '/libs/php-kml/kml_StyleSelector.php';
require_once LL_ROOT . '/libs/php-kml/kml_TimePrimitive.php';
require_once LL_ROOT . '/libs/php-kml/kml_Container.php';
require_once LL_ROOT . '/libs/php-kml/kml_Overlay.php';
require_once LL_ROOT . '/libs/php-kml/kml_LinearRing.php';
foreach (glob(LL_ROOT . '/libs/php-kml/kml_*.php') as $kml_plugin) {
	require_once $kml_plugin;
}

class KML {
	public $kml = NULL;
	
	public function KML() {
		$this->kml = new kml_Document();
	}
	
	public function add_icon_style($id, $icon, $extra = NULL) {
		$style = new kml_Style();
		$style->set_id("{$id}Style");
		$icon_style = new kml_IconStyle();
		$icon_style->set_id("{$id}Icon");
		$icon_style->set_Icon(new kml_Icon($icon));
		$icon_style->set_hotSpot();
		if ($extra['scale']) {
			$icon_style->set_scale($extra['scale']);
		}
		$style->set_IconStyle($icon_style);
		$this->kml->add_Feature($style);
	}
	
	public function add_placemark($id, $lng, $lat, $extra = NULL) {
		$extra['title'] = $extra['title']?$extra['title']:"#$id";
		$placemark = new kml_Placemark($extra['title'], new kml_Point($lng, $lat));
		$placemark->set_id($id);
		if ($extra['style']) {
			$placemark->set_styleUrl("#{$extra['style']}Style");
		}
		if ($extra['description']) {
			$placemark->set_description($extra['description']);
		}
		$this->kml->add_feature($placemark);
	}
	
	public function save($filename) {
		$contents = $this->kml->dump(false, $filename, true, true);
		file_put_contents($filename, $contents);
	}
}