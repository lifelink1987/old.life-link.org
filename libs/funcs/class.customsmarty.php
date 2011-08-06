<?php

require_once SMARTY_DIR . 'Smarty.class.php';
require_once 'date.php';

/**
 * Implements the CustomSmarty class, extending the Smarty class
 *
 * @author	Andrei Neculau <andrei.neculau@gmail.com>, http://www.andreineculau.com
 * @version	0.1.$LastChangedRevision
 * @date	$LastChangedDate
 */

class CustomSmarty extends Smarty {

	/**
	 * Enable cache
	 * @var bool
	 */
	protected $_cache = TRUE;

	/**
	 * Enable debug
	 * @var bool
	 */
	protected $_debug = TRUE;

	/**
	 * FirePHP
	 * @var mixed
	 */
	protected $_firephp;

	/**
	 * Logger
	 * @var mixed
	 */
	protected $_logger;

	/**
	 * Initial options
	 * @var array
	 */
	protected $_extra = array();

	/**
	 * Instance
	 * @var array
	 */
	protected static $_instance;

	function __construct($extra = array()) {
		parent::__construct();
		
		//Check if the optional parameter was passed
		if (count($extra)) {
			//Go through array and assign parameter to this instance
			foreach ($extra as $param => $value) {
				$param = "_$param";
				$this->$param = $value;
			}
		}
		
		//Set new delimiters; easier to use in Dreamweaver
		//$this->_left_delimiter = '<{';
		//$this->_right_delimiter = '}>';
		

		if (substr($this->_version, 0, 6) == 'Smarty') {
			list ($this->_version_major, $this->_version_minor) = explode('-', $this->_version);
			$this->_version_major = substr($this->_version_major, 6);
		} else {
			list ($this->_version_major, $this->_version_minor, $this->_version_revision) = explode('.', $this->_version);
		}
		
		$this->compile_dir = SMARTY_DIR . '../../smarty_data/templates_c/';
		$this->plugins_dir = SMARTY_DIR . 'plugins/';
		$this->config_dir = SMARTY_DIR . '../../smarty_data/configs/';
		$this->cache_dir = SMARTY_DIR . '../../smarty_data/cache/';
		if ($this->_cache) {
			$this->caching = 1;
			$this->cache_lifetime = 3600;
		} else {
			$this->caching = FALSE;
			$this->_version_major == 2 ? $this->clear_compiled_tpl() : $this->cache->clearAll();
			$this->force_compile = TRUE;
		}
		$this->compile_check = TRUE;
		$this->error_reporting = error_reporting();
		
		if ($this->_debug) {
			/**
			 * @todo enable FirePHP debugging
			 */
			if (class_exists('FirePHP') && $this->_firephp = FirePHP::getInstance(TRUE)) {
				register_shutdown_function(array(
					$this,
					'debug'
				));
			} else {
				$this->_debugging = $this->_debug;
			}
			if (class_exists('Logger')) {
				$this->_logger = Logger::get_instance();
			}
		}
		
		if ($this->_gzip) {
			$this->_version_major == 2 ? $this->load_filter('output', 'gzip') : $this->loadFilter('output', 'gzip');
		}
		
		//Register new functions
		$this->_register_template_function('page', array(
			$this,
			'function_page'
		));
		$this->_register_template_function('cache', array(
			$this,
			'function_cache'
		));
		$this->_register_template_function('banner', array(
			$this,
			'function_banner'
		));
		$this->_register_template_function('checked', array(
			$this,
			'function_checkboxradio_checked'
		));
		$this->_register_template_function('selected', array(
			$this,
			'function_option_selected'
		));
		$this->_register_template_function('switcher', array(
			$this,
			'function_switcher'
		));
		$this->_register_template_function('unassign', array(
			$this,
			'function_unassign'
		));
		
		//Register new modifiers
		$this->_register_modifier('ternary', array(
			$this, 
			'modifier_ternary'
		));
		$this->_register_modifier('capitalize', array(
			$this,
			'modifier_capitalize'
		));
		$this->_register_modifier('urlencode', array(
			$this,
			'modifier_urlencode'
		));
		$this->_register_modifier('dump', array(
			$this,
			'modifier_dump'
		));
		$this->_register_modifier('dateformat', array(
			$this,
			'modifier_dateformat'
		));
		$this->_register_modifier('relativedate', array(
			$this,
			'modifier_relativedate'
		));
		
		if (! isset(self::$_instance)) {
			self::$_instance = array();
		}
		self::$_instance[get_class($this)] = $this;
	}

	/**
	 * Return a reference to this instantiation, if available
	 * @return object
	 */
	public static function get_instance() {
		$class = get_called_class($this);
		if (! isset(self::$_instance)) {
			self::$_instance = array();
		}
		if (! isset(self::$_instance[$class])) {
			return FALSE;
		}
		return self::$_instance[$class];
	}

	/**
	 * Prevent cloning of this object
	 */
	final public function __clone() {
	}

	public function _register_template_function() {
		$args = func_get_args();
		$this->_version_major == 2 ? call_user_func_array(array(
			$this,
			'register_function'
		), $args) : call_user_func_array(array(
			$this->register,
			'templateFunction'
		), $args);
	}

	public function _register_modifier() {
		$args = func_get_args();
		$this->_version_major == 2 ? call_user_func_array(array(
			$this,
			'register_modifier'
		), $args) : call_user_func_array(array(
			$this->register,
			'modifier'
		), $args);
	}

	public function _assign_by_ref($tpl_var, &$value) {
		$this->_version_major == 2 ? call_user_func_array(array(
			$this,
			'assign_by_ref'
		), array($tpl_var, &$value)) : call_user_func_array(array(
			$this,
			'assignByRef'
		), array($tpl_var, &$value));
	}

	public function debug() {
		/**
		 * @todo make this work with Smarty 3
		 */
		if ($this->_version_major == 3) {
			return;
		}
		
		//Get required debug variables
		$assigned_vars = $this->_tpl_vars;
		ksort($assigned_vars);
		
		$config_vars = array();
		if (@is_array($this->_config[0])) {
			$config_vars = $this->_config[0];
			ksort($config_vars);
		}
		
		$this->_firephp->group('Smarty Debug Output');
		//Log template files
		$this->_firephp->group('included templates & config files (load time in seconds)');
		foreach ($this->_smarty_debug_info as $tml) {
			$msg = str_repeat('--', $tml['depth']);
			$msg .= ($tml['depth'] != 0) ? '>' : '';
			$msg .= $tml['filename'] . ' (' . substr($tml['exec_time'], 0, 7) . 's)';
			$this->_firephp->log($msg);
		}
		$this->_firephp->groupEnd(); //end group 'included templates &...'
		

		//Log assigned template variables
		$this->_firephp->group('assigned template variables');
		foreach ($assigned_vars as $key => $value) {
			$this->_firephp->log($value, '{$' . $key . '}');
		}
		$this->_firephp->groupEnd(); //end group 'assigned template variables'
		

		//Log assigned config file variables (outer template scope)
		$this->_firephp->group('assigned config file variables (outer template scope)');
		//Check if there is something in the config
		if ($config_vars) {
			foreach ($config_vars as $key => $value) {
				$this->_firephp->log($value, '{#' . $key . '#}');
			}
		} else {
			$this->_firephp->log("No configuration values available");
		}
		$this->_firephp->groupEnd(); //end group 'assigned config file variables (outer template scope)'
		

		$this->_firephp->groupEnd(); //end group 'Smarty Debug Output'
	}

	function display($what) {
		if ($this->_logger) {
			$this->_timing_header = $this->_logger->log_flow('start', "Smarty $what");
		}
		parent::display($what);
		if ($this->_logger) {
			$this->_logger->log_flow('end', "Smarty $what", $this->_timing_header);
		}
	}

	public function pagination($total_items, $items_per_page, $link) {
		if ($total_items == $items_per_page) {
			$pages = ceil($total_items / $items_per_page);
			$pages_array = range(1, $pages);
			$page = (int) $_REQUEST['page'];
			if ($page > 1) {
				if ($page > $pages) {
					$page = $pages;
				}
				$start = (($page) - 1) * $items_per_page;
			} else {
				$page = 1;
				$start = 0;
			}
		}
		$this->assign('page', $page);
		$this->assign('pages', $pages);
		$this->assign('per_page', $items_per_page);
		$this->assign('pages_array', $pages_array);
		$this->assign('page_link', $link);
		if ($total_items == $items_per_page) {
			return array(
				$start,
				$items_per_page
			);
		}
	}

	public function function_page($extra = array()) {
		$link = $this->get_template_vars('page_link');
		list ($link, $anchor) = explode('#', $link);
		if ($anchor) {
			$anchor = '#' . $anchor;
		}
		$link .= '?' . update_querystring(NULL, NULL, array(
			'page',
			'ajax'
		));
		return str_replace('?&', '?', $link . '&page=' . $extra['number'] . $anchor);
	}

	public function function_checkboxradio_checked($extra = array()) {
		if ($extra['current']) {
			if ($extra['value'] == $extra['current']) {
				return ' checked';
			}
		} else if ($extra['value']) {
			return ' checked';
		}
	}

	public function function_option_selected($extra = array()) {
		if ($extra['value'] == $extra['current']) {
			return ' selected';
		}
	}

	public function function_cache($extra = array()) {
		if (! $this->_cache) {
			@header('Cache-Control: no-cache');
			@header('Pragma: no-cache');
			@header('Expires: -1');
			return '<meta http-equiv="pragma" content="no-cache"/><meta http-equiv="cache-control" content="max-age=0"/><meta http-equiv="cache-control" content="no-cache"/><meta http-equiv="cache-control" content="no-store"/><meta http-equiv="expires" content="-1"/>';
		}
	}

	public function function_switcher($extra = array()) {
		if ($extra['keys']) {
			$keys = explode(',', $extra['keys']);
			$values = explode(',', $extra['values']);
		} else {
			$keys = $extra['key'];
			$values = $extra['value'];
		}
		if ($extra['skips']) {
			$skips = explode(',', $extra['skips']);
		} else {
			$skips = $extra['skip'];
		}
		return ($extra['uri'] ? $extra['uri'] : LL_URI) . '?' . update_querystring($keys, $values, $skips);
	}

	public function function_unassign($extra = array()) {
		unset($this->_tpl_vars[$extra['var']]);
	}
	
	public function modifier_ternary($value, $option1, $option2) {
		return ($value) ? $option1 : $option2;
	}

	public function modifier_capitalize($string) {
		return mb_strtoupper($string, 'UTF-8');
	}

	public function modifier_urlencode($string, $raw = TRUE) {
		if ($raw)
			return rawurlencode($string);
		return urlencode($string);
	}

	public function modifier_dump($value, $name = null) {
		$name = $name ? $name : 'Smarty Var/Func';
		if ($this->_logger) {
			$this->_logger->log_dump($value, $name);
		}
	}

	public function modifier_dateformat($value, $format = SMARTY_RESOURCE_DATE_FORMAT) {
		return strftime($format, strtotime($value));
	}

	public function modifier_relativedate($value) {
		if (!is_numeric($value)) {
			$value = strtotime($value);
		}
		return relative_date($value);
	}
}