<?php
defined('XCSSCONFIG') or die('No direct access allowed.');

/**
 * xCSS config
 */

$config['path_to_css_dir'] = '../'; //	default: '../'

$config['xCSS_files'] = array(
	/*'source/baseline.0.5.3/css/uncompressed/baseline.reset.css' => 'generated/baseline.reset.css',
	'source/baseline.0.5.3/css/uncompressed/baseline.base.css' => 'generated/baseline.base.css',
	'source/baseline.0.5.3/css/uncompressed/baseline.type.css' => 'generated/baseline.type.css',
	'source/baseline.0.5.3/css/uncompressed/baseline.table.css' => 'generated/baseline.table.css',
	'source/baseline.0.5.3/css/uncompressed/baseline.form.css' => 'generated/baseline.form.css',
	'source/baseline.0.5.3/css/uncompressed/baseline.grid.css' => 'generated/baseline.grid.css',*/
	'source/vars_dynamic.css' => 'generated/vars_dynamic.css',
	'source/elements.css' => 'generated/elements.css',
	'source/layout.css' => 'generated/layout.css',
	'source/header.css' => 'generated/header.css',
	'source/sidebar.css' => 'generated/sidebar.css',
	'source/footer.css' => 'generated/footer.css',
	'source/menu.css' => 'generated/menu.css',
	
	'source/content.css' => 'generated/content.css',
	'source/content_section.css' => 'generated/content_section.css',
	//'source/school.css' => 'generated/school.css',
	//'source/report.css' => 'generated/report.css',
	
	'source/contactable.css' => 'generated/contactable.css',
	'source/colorbox.css' => 'generated/colorbox.css'/*,
	'source/slider.css' => 'generated/slider.css'*/
);

$config['use_master_file'] = true; // default: 'true'
$config['compress_output_to_master'] = true; // default: 'false'
$config['master_filename'] = 'master.css'; // default: 'master.css'

$config['reset_files'] = array(
	/*'static/baseline.0.5.3/css/uncompressed/baseline.reset.css',
	'static/baseline.0.5.3/css/uncompressed/baseline.base.css',
	'static/baseline.0.5.3/css/uncompressed/baseline.type.css',
	'static/baseline.0.5.3/css/uncompressed/baseline.table.css',
	'static/baseline.0.5.3/css/uncompressed/baseline.form.css',
	'static/baseline.0.5.3/css/uncompressed/baseline.grid.css'*/
	'static/baseline.0.5.3/css/compressed/baseline.compress.css'
); //'static/cssreset.css'

$config['hook_files'] = array(); //'static/hooks.css: screen'

$config['construct_name'] = 'self'; // default: 'self'

$config['minify_output'] = true; // default: 'false'

$config['debugmode'] = false; // default: 'false'

$config['disable_xCSS'] = false; //	default: 'false'
