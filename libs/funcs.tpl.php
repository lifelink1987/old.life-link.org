<?php

require_once(SMARTY_DIR . 'Smarty.class.php');
//require_once(SMARTY_DIR . 'Smarty_Test.class.php');

class mySmarty extends Smarty
{
	function mySmarty()
	{
		$this->Smarty();

		/*new delimiters; easier to use in Dreamweaver*/
		$this->left_delimiter = '<{';
		$this->right_delimiter = '}>';

		$this->template_dir = $this->get_root();
		$this->compile_dir = LL_ROOT . '/libs/smarty_data/templates_c/';
		$this->plugins_dir = array(LL_ROOT . '/libs/smarty/plugins/');
		$this->config_dir = LL_ROOT . '/libs/smarty_data/configs/';
		$this->cache_dir = LL_ROOT . '/libs/smarty_data/cache/';
		$this->caching = 0;
		$this->compile_check = true;

		/*register OFFICIAL resource*/
		function smarty_official_template($tpl_name, &$tpl_source, &$smarty_obj) {
			$tpl_source = @file_get_contents(LL_ROOT . '/' . $tpl_name);
			return file_exists(LL_ROOT . '/' . $tpl_name);
		}
		function smarty_official_timestamp($tpl_name, &$timestamp, &$smarty_obj) {
			$timestamp = @filemtime(LL_ROOT . '/' . $tpl_name);
			return file_exists(LL_ROOT . '/' . $tpl_name);
		}
		function smarty_official_secure($tpl_name, &$smarty_obj)
		{
		    return true;
		}
		function smarty_official_trusted($tpl_name, &$smarty_obj)
		{
		}
		$this->register_resource('official', array(
			'smarty_official_template',
			'smarty_official_timestamp',
			'smarty_official_secure',
			'smarty_official_trusted'
		));

		/*register functions*/
		$this->register_function('page', 'mySmarty::function_page');
		$this->register_function('cache', 'mySmarty::function_cache');
		$this->register_function('banner', 'mySmarty::function_banner');
		$this->register_function('checked', 'mySmarty::function_checkboxradio_checked');
		$this->register_function('selected', 'mySmarty::function_option_selected');
		$this->register_function('switcher', 'mySmarty::function_switcher');
		$this->register_modifier('capitalize', 'mySmarty::modifier_capitalize');
		$this->register_modifier('urlencode', 'mySmarty::modifier_urlencode');

		/*load template's configuration*/
		$this->load_config();
	}

	function load_config()
	{
		global $tpl, $basics;
		function walk_css(&$item, $key)
		{
			global $tpl;
			$original = $tpl['root'] . 'css/' . str_replace('-', '/', $item);
			$parsed = $tpl['root'] . 'css/built/' . str_replace('-', '/', $item);
			if ((file_exists($parsed)) && (filemtime($original) < filemtime($parsed)))
			{
				$item = LL_WEB . $tpl['webpath'] . 'css/built/' . str_replace('-', '/', $item);;
			}
			else {
				$item = LL_WEB . '/css.php?item=' . $item;
			}
		}
		function walk_js(&$item, $key)
		{
			global $tpl;
			$item = str_replace('-', '/', $item);
			$original = $tpl['root'] . 'js/' . $item;
			$parsed = $tpl['root'] . 'js/built/' . basename($item);
			if ((file_exists($parsed)) && (filemtime($original) < filemtime($parsed)))
			{
				$item = LL_WEB . $tpl['webpath'] . 'js/built/' . basename($item);
			}
			else {
				$item = LL_WEB . '/js.php?item=' . $item;
			}
		}
		function walk_flatten_tag_array(&$item, $key)
		{
			$item = " $key=\"$item\"";
		}
		function walk_css_images(&$item, $key, $group)
		{
			global $tpl;
			if (!is_array($item))
			{
				$item = array('src' => $item);
			}
			$item['src'] = $tpl['webpath'] . $item['src'];
			if (($group == 'icons') && (!$item['align']))
			{
				$item['align'] = 'absmiddle';
			}
			if (($group == 'icons') && (!$item['style']))
			{
				$item['style'] = 'margin: 0; margin-right: 3px';
			}
			array_walk($item, 'walk_flatten_tag_array');
			$item = '<img alt=""' . join('', $item) . '>';
		}
		function walk_css_images_src(&$item, $key, $group)
		{
			global $tpl;
			if (!is_array($item))
			{
				$item = array('src' => $item);
			}
			$item['src'] = $tpl['webpath'] . $item['src'];
			$item = $item['src'];
		}

		$tpl['host'] = LL_WEBHOST;
		$tpl['root'] = $this->get_root();
		$tpl['webpath'] = $this->get_webpath();
		$tpl['current'] = $this->get_current();
		$tpl['currentsub'] = $this->get_currentsub();
		$tpl['page_css'] = str_replace('/', '_', $_REQUEST['sub']);
		include_once($this->template_dir . 'conf.inc.php');
		$tpl['basics'] = $basics;
		unset($basics);

		$walk_function = 'walk_css_images';
		if (basename($_SERVER['SCRIPT_FILENAME'], '.php') == 'css')
		{
			$walk_function = 'walk_css_images_src';
		}
		array_walk($tpl['bullets'], $walk_function, 'bullets');
		array_walk($tpl['buttons'], $walk_function, 'buttons');
		array_walk($tpl['images'], $walk_function, 'images');
		array_walk($tpl['icons'], $walk_function, 'icons');
		array_walk($tpl['css_files'], 'walk_css');
		array_walk($tpl['email_css_files'], 'walk_css');
		array_walk($tpl['js_files']['head'], 'walk_js');
		array_walk($tpl['js_files']['body'], 'walk_js');
	}

	function get_current()
	{
		return 'pages/' . basename($_SERVER['SCRIPT_FILENAME'], '.php') . "/";
	}

	function get_currentsub()
	{
		$result = 'pages/' . basename($_SERVER['SCRIPT_FILENAME'], '.php') . "/";
		if (isset($_REQUEST['sub']))
		{
			if (dirname($result . $_REQUEST['sub']) != '.')
			{
				$result .= dirname($_REQUEST['sub']) . '/';
			}
		}
		return $result;
	}

	function get_root()
	{
		return LL_ROOT . '/templates/' . $_SESSION['lltemplate'] . '/';
	}

	function get_webpath()
	{
		return LL_WEBPATH . '/templates/' . $_SESSION['lltemplate'] . '/';
	}

	function get_page()
	{
		return $this->get_currentsub() . basename($_REQUEST['sub']);
	}

	function get_page_default()
	{
		return $this->get_currentsub();
	}

	function prepare_display()
	{
		global $tpl, $template, $menu, $messages;
		$tpl = array_merge_recursive($template, $tpl);
/*		if (isset($_REQUEST['sub']))
		{
			$sub = '_' . $_REQUEST['sub'];
		}
		$original = $tpl['root'] . 'js/' . basename($_SERVER['SCRIPT_FILENAME'], '.php') . $sub . '.js';
		$parsed = $tpl['root'] . 'js/built/' . basename($_SERVER['SCRIPT_FILENAME'], '.php') . $sub . '.js';
		if ((file_exists($parsed)) && (filemtime($original) < filemtime($parsed)))
		{
			$tpl['js_files']['body'][] = LL_WEB . $tpl['webpath'] . 'js/built/' . basename($_SERVER['SCRIPT_FILENAME'], '.php') . $sub . '.js';
		}
		else {
			$tpl['js_files']['body'][] = LL_WEB . '/js.php?item=' . basename($_SERVER['SCRIPT_FILENAME'], '.php') . $sub . '.js';
		}
*/		$this->assign_by_ref('tpl', $tpl);
		$this->assign_by_ref('menu', $menu);
		$this->assign_by_ref('messages', $messages);
	}
	
	function display($what){
		global $tpl, $timetest;
		@flush();
		@ob_flush();
		if ($what == 'header.tpl'){
			create_menu();
		}elseif ($what == 'footer.tpl'){
			$tpl['website']['recent_agenda'] = db_agenda::gets_recent();
			$tpl['website']['future_agenda'] = db_agenda::gets_future();
			//$tpl['website']['live'] = db_agenda::gets_live(1);
			
			$timetest['end'] = array(gmdate('H:i:s'), memory_get_usage(true));
			$timetest['end_peak'] = memory_get_peak_usage(true);
			$this->assign_by_ref('timetest', print_r($timetest, true));
		}
		parent::display($what);
		@flush();
		@ob_flush();
	}

	function pagination($total, $howmany_per_page, $link)
	{
		if (!$_REQUEST['all'])
		{
			$pages = ceil($total / $howmany_per_page);
			$pages_array = range(1, $pages);
			$page = (int)$_REQUEST['page'];
			if ($page > 1)
			{
				if ($page > $pages)
				{
					$page = $pages;
				}
				$start = (($page)-1) * $howmany_per_page;
			}
			else
			{
				$page = 1;
				$start = 0;
			}
		}
		$this->assign('page', $page);
		$this->assign('pages', $pages);
		$this->assign('per_page', $howmany_per_page);
		$this->assign('pages_array', $pages_array);
		$this->assign('page_link', $link);
		if (!$_REQUEST['all'])
		{
			return "$start, $howmany_per_page";
		}
	}

	static function function_page($params)
	{
		global $smarty;
		$link = $smarty->get_template_vars('page_link');
		list($link, $anchor) = explode('#', $link);
		if ($anchor)
		{
			$anchor = '#' . $anchor;
		} 
		$link .= '?' . update_querystring(null, null, array('page', 'ajax'));
		return str_replace('?&', '?', $link . '&page=' . $params['number'] . $anchor);
	}

	static function function_checkboxradio_checked($params)
	{
		if ($params['current'])
		{
			if ($params['value'] == $params['current'])
			{
				return ' checked';
			}
		}
		else if ($params['value'])
		{
			return ' checked';
		}
	}

	static function function_option_selected($params)
	{
		if ($params['value'] == $params['current'])
		{
			return ' selected';
		}
	}

	static function function_cache($params)
	{
		global $template;
		if ($template['cache'])
		{
			return '<meta http-equiv="pragma" content="no-cache"><meta http-equiv="cache-control" content="no-cache"><meta http-equiv="expires" content="0">';
		}
	}

	static function function_banner($params)
	{
		global $tpl, $template;
		if (!$tpl['banner'])
		{
			$tpl['banner'] = $tpl['webpath'] . '/banners/' . mt_rand(1, $tpl['max_banner']) . '.swf';
		}
		return $tpl['banner'];
	}
	
	static function function_switcher($params)
	{
		if ($params['keys'])
		{
			$keys = explode(',', $params['keys']);
			$values = explode(',', $params['values']);
		}
		else {
			$keys = $params['key'];
			$values = $params['value'];
		}
		if ($params['skips'])
		{
			$skips = explode(',', $params['skips']);
		}
		else {
			$skips = $params['skip'];
		}
		return ($params['uri']?$params['uri']:LL_URI) . '?' . update_querystring($keys, $values, $skips);
	}
	
	static function modifier_capitalize($string)
	{
		return mb_strtoupper($string, 'UTF-8');
	}
	
	static function modifier_urlencode($string, $raw = true)
	{
		if ($raw) return rawurlencode($string);
		return urlencode($string);
	}
}

$smarty = new mySmarty;
?>