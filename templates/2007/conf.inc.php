<?

/*use minified versions of the JS scripts only when accessed from outside*/
if (LL_AT_HOME)
{
	$js = array("_1.js");
}
else {
	$js = array(
		"_anim.js",
		"_event_pageload.js",
		"_menu.js",
		"_form.js",
		"_wait.js",
		"_litebox_moo.fx.js",
		"_litebox_1.0_modified.js",
		"_shadedborder.js",
		"_main.js"
	);
}

$css = array
(
	'_official_elements.css',
	'_official_lists.css',
	'_layout.css',
	'_layout_sidebar.css',
	'_elements.css',
	'_lightbox.css',
	'_menu.css',
	'_form.css'
);
if ($_SESSION['lltemplatelevel'] > -1)
{
	$css[] = '_shadedborder.css';
}

/*basic colors, heights, widths, font-families, etc.*/
$basics = array
(
	/*colors*/
	'llgreen' => '#006A33',			//[RGB:   0-106- 51]
	'lightorange' => '#FCC90D',
	'waterorange' => '#FDFFB4',
	'black' => '#000000',
	'grey' => '#444444',
	'lightgrey' => '#DDDDDD',
	'white' => '#FFFFFF',
	
	'lightgreen' => '#B0D0B0',	//[RGB: 176-208-176]
	'watergreen' => '#F7FBF7',	//[RGB: 247-251-247]
	'wateryellow' => '#FDFFB4',
	'yellow' => '#FCF90D',
	'orange' => '#FC990D',
	'watergrey' => '#FDFDFD',

	/*layout*/
	'page_width' => 790,
	'page_header_height' => 130,
	'page_content_height' => 720,
	'page_footer_height' => 40,
	'sidebar_width' => 450,
	'sidebar_height' => 750,
	'sidebar_content_width' => 190,
	'page_header' => $tpl['webpath'] . 'images/page-header.jpg',
	'page_content' => $tpl['webpath'] . 'images/page-content.jpg',
	'page_footer' => $tpl['webpath'] . 'images/page-footer.jpg',
	'sidebar' => $tpl['webpath'] . 'images/sidebar.jpg',
	
	/*fonts*/
	'font_family' => '"Lucida Grande", "Lucida Sans Unicode", Tahoma, Geneva, sans-serif',
	'font_family_heading' => '"Trebuchet MS", Helvetica, Tahoma, Geneva, sans-serif',
	
	/*lightbox*/
	'lightbox_prev' => $tpl['webpath'] . 'images/lightbox/prevlabel.gif',
	'lightbox_next' => $tpl['webpath'] . 'images/lightbox/nextlabel.gif',
	'lightbox_blank' => $tpl['webpath'] . 'images/lightbox/blank.gif',
	'lightbox_loading' => $tpl['webpath'] . 'images/loading.gif',
	'lightbox_close' => $tpl['webpath'] . 'images/lightbox/closelabel.gif'
);

$tpl = array_merge(array
(
	'date_format' => '%B %e, %Y',
	'short_date_format' => '%b %e, \'%y',
	'icons' => array
	(
		'acrobat' => 'icons/page_white_acrobat.gif',
		'compressed' => 'icons/page_white_compressed.gif',
		'excel' => 'icons/page_white_excel.gif',
		'file' => 'icons/page_white_go.gif',
		'picture' => 'icons/page_white_picture.gif',
		'powerpoint' => 'icons/page_white_powerpoint.gif',
		'word' => 'icons/page_white_word.gif',

		'mail' => 'icons/email.gif',
		'external' => array(
			'src' => 'icons/external.gif',
			'align' => 'bottom'
		),

		'magnify' => 'icons/magnify.gif',
		'leaf' => 'icons/leaf.gif'
	),
	'images' => array
	(
		'spacer' => 'images/spacer.gif',
		'loading' => 'images/loading.gif',
		'leaf' => 'images/leaf.gif',
		'leaf_small' => 'images/leaf_small.gif',
		'gallery' => 'images/gallery.gif',
		
		// badges
		'bie' => array(
			src => 'badges/ie.gif',
			alt => 'IE 6 SP2 / 7',
			title => 'IE 6 SP2 / 7'
		),
		'bopera' => array(
			src => 'badges/opera.gif',
			alt => 'Opera 9',
			title => 'Opera 9'
		),
		'bfirefox' => array(
			src => 'badges/firefox.png',
			alt => 'Firefox 2',
			title => 'Firefox 2'
		),
		
		'bapache' => array(
			src => 'badges/get_apache.png',
			alt => 'Apache 2',
			title => 'Apache 2'
		),
		'bmysql' => array(
			src => 'badges/get_mysql.png',
			alt => 'MySQL 5',
			title => 'MySQL 5'
		),
		'bphp' => array(
			src => 'badges/get_php.png',
			alt => 'PHP 5',
			title => 'PHP 5'
		),
		
		'bcss' => 'badges/valid_css.png',
		'bhtml' => 'badges/valid_html401.png',
		
		'butf8' => 'badges/utf8.png'
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
	'css_files' => $css,
	'email_css_files' => array
	(
		'email_rfg.css',
		'_official_elements.css',
		'email_layout.css',
		'_elements.css'
	),
	'js_files' => array
	(
		'head' => $js,
		'body' => array
		(
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
		'schools' => 20
	),
	'image_sizes' => array
	(
		'action_tw' => 100,
		'action_pw' => 500,
		'action_pr' => 5/3,
		
		'clogo_tw' => 150,
		'clogo_pw' => 500,
		'clogo_pr' => 1
	),
	'version' => array(
		'major' => 1,
		'minor' => 5,
		'date' => '2007-04-15'
	)
), $tpl);

unset($js);
unset($css);

?>