<?

/*basic colors, heights, widths, font-families, etc.*/
$basics = array
(
	/*colors*/
//	'llgreen' => '#32643C',			//[RGB:  50-100- 60]
	'llgreen' => '#006A33',			//[RGB:   0-106- 51]
	'lightgreen' => '#B0D0B0',	//[RGB: 176-208-176]
	'watergreen' => '#F7FBF7',	//[RGB: 247-251-247]
	'wateryellow' => '#FDFFB4',
	'yellow' => '#FCF90D',
	'lightorange' => '#FCC90D',
	'orange' => '#FC990D',
	'black' => '#000000',
	'grey' => '#888888',
	'lightgrey' => '#EFEFEF',
	'watergrey' => '#FDFDFD',
	'white' => '#FFFFFF',

	/*body*/
	'body_width' => 770,
	
	/*header*/
	'header_height' => 100,
	'header_bg' => $tpl['webpath'] . 'images/header2.jpg',
	'banner_width' => 500,
	'banner_bg' => $tpl['webpath'] . 'images/header1.jpg',

	/*gradient*/
	'gradient_height' => 300,
	'gradient_bg' => $tpl['webpath'] . 'images/gradient.jpg',
	
	/*subheader*/
	'subheader_height' => 20,
	'switch_width' => 150,
	
	/*menu*/
	'menu_width' => 140,
	
	/*page*/
	'page_width' => 600,
	
	/*footer*/
	'footer_height' => 50,
	'footer_bg' => $tpl['webpath'] . 'images/footer2.jpg',
	'footer_left_width' => 500,
	'footer_left_bg' => $tpl['webpath'] . 'images/footer1.jpg',
	
	/*fonts*/
	'font_family' => 'Tahoma, Arial, Helvetica, sans-serif',
	'font_size' => '11',
	'font_family_heading' => 'Verdana, Tahoma, Arial, Helvetica, sans-serif',
	'font_size1' => '16',
	'font_size2' => '14',
	'font_size3' => '12',
	'font_familyPageTitle' => '"Times New Roman", Times, serif',
	'font_sizePageTitle' => '26',
	
	/*lightbox*/
	'lightbox_prev' => $tpl['webpath'] . 'images/lightbox/prevlabel.gif',
	'lightbox_next' => $tpl['webpath'] . 'images/lightbox/nextlabel.gif',
	'lightbox_blank' => $tpl['webpath'] . 'images/lightbox/blank.gif',
	'lightbox_loading' => $tpl['webpath'] . 'images/lightbox/loading.gif',
	'lightbox_close' => $tpl['webpath'] . 'images/lightbox/closelabel.gif',
	
	/*others*/
	'buttons_height' => 20,
	'buttons_width_side' => 21
);

$tpl = array
(
	'max_banner' => 1,
	'date_format' => '%B %e, %Y',
	'icons' => array
	(
		'stop' => 'icons/stop.gif',
		'accept' => 'icons/accept.gif',
		'word' => 'icons/page_white_word.gif',
		'excel' => 'icons/page_white_excel.gif',
		'powerpoint' => 'icons/page_white_powerpoint.gif',
		'file' => 'icons/page_white_go.gif',
		'acrobat' => 'icons/page_white_acrobat.gif',
		'mail' => 'icons/email.gif',
		'magnify' => 'icons/magnify.gif',
		'external' => array(
			'src' => 'icons/external.gif',
			'align' => 'bottom'
		),
		'link' => 'icons/page_next.gif',
		'leaf' => 'icons/leaf.gif'
	),
	'images' => array
	(
		'loading' => 'images/loading.gif',
		'leaf' => 'images/leaf.gif',
		'leaf_small' => 'images/leaf_small.gif',
		'gallery' => 'images/gallery.gif'
	),
	'bullets' => array
	(
		'dot_row' => 'bullets/dot_red_on_white.gif',
		'dot_gow' => 'bullets/dot_green_on_white.gif',
		'dot_wow' => 'bullets/dot_white_on_white.gif',
		'arrow_wow' => 'bullets/arrow_white_on_white.gif',
		'pagenext' => 'icons/page_next.gif',
		'leaf' => 'bullets/leaf.gif',
		'leaf_small' => 'bullets/leaf_small.gif'
	),
	'buttons' => array
	(
		'left' => 'buttons/bar1_left.gif',
		'right' => 'buttons/bar1_right.gif',
		'back' => 'buttons/bar1_center.gif'
	),
	'css_files' => array
	(
		'../../../js/yui/reset/reset.css',
		'../../../js/yui/fonts/fonts.css',
		'../../../js/yui/menu/assets/menu.css',
		'../../../js/yui/container/assets/container.css',
		'../../../js/yui/logger/assets/logger.css',
		'_official_elements.css',
		'_official_headings.css',
		'_official_lists.css',
		'_official_links.css',
		'_official_form.css',
		'_layout.css',
		'_elements.css',
		'_lightbox.css',
		'_niftycorners.css',
		'_menu.css',
		'_form.css',
		'_boxes.css',
		'_lists.css',
		'_links.css',
		'_campaigns.conferences.css'
	),
	'email_css_files' => array
	(
		'_official_elements.css',
		'_official_headings.css',
		'_elements.css',
		'_boxes.css'
	),
	'js_files' => array
	(
		'head' => array
		(
			'_panel_wait.js',
			'_event_pageload.js',
			'_ajax.js',
			'_form.js',
			'_dialog_summary.js',
			'_dialog_info.js',
			'_menu_main.js',
			'_main.js',
			'_litebox_1.0.js',
			'_litebox_moo.fx.js'
		),
		'body' => array
		(
			'_trafic.js'
		)
	),
	'per_page' => array
	(
		'posts' => 10,
		'organisations' => 10,
		'reactions' => 10,
		'conferences' => 5,
		'campaigns' => 5,
		'reports' => 5,
		'schools' => 15
	)
) + $tpl;

?>