<?php
defined('XCSSCONFIG') or die('No direct access allowed.');

/**
 * xCSS config
 */

$config['path_to_css_dir'] = realpath(dirname(__FILE__)) . '/js_css_cache/'; //	default: '../'

$source_dir = '../css/source';
$static_dir = '../css/static';
$generated_dir = '.';
$ext = LL_DEBUG_CSS ? '.debug.css' : '.css';

$config['xCSS_files'] = array(
	/*$source_dir . '/baseline.0.5.3/css/uncompressed/baseline.reset.css' => $generated_dir . '/baseline.reset' . $ext,
	$source_dir . '/baseline.0.5.3/css/uncompressed/baseline.base.css' => $generated_dir . '/baseline.base' . $ext,
	$source_dir . '/baseline.0.5.3/css/uncompressed/baseline.type.css' => $generated_dir . '/baseline.type' . $ext,
	$source_dir . '/baseline.0.5.3/css/uncompressed/baseline.table.css' => $generated_dir . '/baseline.table' . $ext,
	$source_dir . '/baseline.0.5.3/css/uncompressed/baseline.form.css' => $generated_dir . '/baseline.form' . $ext,
	$source_dir . '/baseline.0.5.3/css/uncompressed/baseline.grid.css' => $generated_dir . '/baseline.grid' . $ext,*/
	$source_dir . '/vars_dynamic.css' => $generated_dir . '/vars_dynamic' . $ext,
	$source_dir . '/elements.css' => $generated_dir . '/elements' . $ext,
	$source_dir . '/layout.css' => $generated_dir . '/layout' . $ext,
	$source_dir . '/header.css' => $generated_dir . '/header' . $ext,
	$source_dir . '/sidebar.css' => $generated_dir . '/sidebar' . $ext,
	$source_dir . '/footer.css' => $generated_dir . '/footer' . $ext,
	$source_dir . '/menu.css' => $generated_dir . '/menu' . $ext,
	
	$source_dir . '/content.css' => $generated_dir . '/content' . $ext,
	$source_dir . '/content_section.css' => $generated_dir . '/content_section' . $ext,
	//$source_dir . '/school.css' => $generated_dir . '/school' . $ext,
	//$source_dir . '/report.css' => $generated_dir . '/report' . $ext,
	
	$source_dir . '/contactable.css' => $generated_dir . '/contactable' . $ext,
	$source_dir . '/colorbox.css' => $generated_dir . '/colorbox' . $ext/*,
	$source_dir . '/slider.css' => $generated_dir . '/slider' . $ext*/
);

$config['use_master_file'] = true; // default: 'true'
$config['compress_output_to_master'] = ! LL_DEBUG_CSS; // default: 'false'
$config['master_filename'] = $generated_dir . '/master' . $ext; // default: 'master' . $ext

$config['reset_files'] = array(
	/*$static_dir . '/baseline.0.5.3/css/uncompressed/baseline.reset' . $ext,
	$static_dir . '/baseline.0.5.3/css/uncompressed/baseline.base' . $ext,
	$static_dir . '/baseline.0.5.3/css/uncompressed/baseline.type' . $ext,
	$static_dir . '/baseline.0.5.3/css/uncompressed/baseline.table' . $ext,
	$static_dir . '/baseline.0.5.3/css/uncompressed/baseline.form' . $ext,
	$static_dir . '/baseline.0.5.3/css/uncompressed/baseline.grid' . $ext*/
	$static_dir . '/baseline.0.5.3/css/compressed/baseline.compress' . $ext
); //$static_dir . '/cssreset' . $ext
$config['hook_files'] = array(); //$static_dir . '/hooks' . suffix . '.css: screen'

$config['construct_name'] = 'self'; // default: 'self'

$config['disable_xCSS'] = false; //	default: 'false'

$config['debugmode'] = LL_DEBUG_CSS; // default: 'false'
$config['minify_output'] = ! LL_DEBUG_CSS; // default: 'false'