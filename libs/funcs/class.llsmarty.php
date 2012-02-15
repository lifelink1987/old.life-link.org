<?php

require_once 'class.customsmarty.php';

/**
 * Implements the LLSmarty class, extending CustomSmarty
 *
 * @author	Andrei Neculau <andrei.neculau@gmail.com>, http://www.andreineculau.com
 * @version	0.1.$LastChangedRevision
 * @date	$LastChangedDate
 */

class LLSmarty extends CustomSmarty {

	function __construct($extra = array()) {
		global $browser_info, $uri;

		parent::__construct($extra);
		$this->template_dir = $this->get_root() . '/pages';

		//Assign template variables
		$tpl['host'] = LL_ROOT_URI;
		$tpl['tpl_path'] = $this->get_root();
		$tpl['tpl_uri'] = $this->get_root_uri();

		$browser_info = $browser_info ? $browser_info : browser_info();
		$tpl['browser'] = array(
			'name' => $browser_info['browser'],
			'major' => array_shift(explode('.', $browser_info['version']))
		);
		$tpl['uri'] = &$uri;

		require_once $tpl['tpl_path'] . '/config.php';
		$this->_tpl = array_merge_replace($tpl, $config);

		foreach ($this->_tpl as $key => &$value) {
			$this->_assign_by_ref($key, $value);
		}

		//Add xCSS dynamic variables
		$css_vars = file_get_contents($tpl['tpl_path'] . '/css/source/vars.css');
		$css_vars_append = "\$tpl_uri = {$tpl['tpl_uri']};\n";
		$css_vars = str_replace('vars {', "vars {\n\t$css_vars_append", $css_vars);
		file_put_contents($tpl['tpl_path'] . '/css/source/vars_dynamic.css', $css_vars);

		if (LL_DEBUG_SMARTY) {
			$this->allow_php_tag = TRUE;
		}

		//Register functions
		$this->_register_template_function('js', array(
			$this,
			'function_js'
		));

		$this->_register_template_function('css', array(
			$this,
			'function_css'
		));

		$this->_register_template_function('related', array(
			$this,
			'function_related'
		));

		$this->_register_template_function('variable', array(
			$this,
			'function_variable'
		));

		$this->_register_template_function('title', array(
			$this,
			'function_title'
		));

		$this->_register_template_function('get_actions', array(
			$this,
			'function_get_actions'
		));

		$this->_register_template_function('get_months', array(
			$this,
			'function_get_months'
		));

		$this->_register_template_function('get_years', array(
			$this,
			'function_get_years'
		));

		$this->_register_template_function('get_cities', array(
			$this,
			'function_get_cities'
		));

		$this->_register_template_function('get_countries', array(
			$this,
			'function_get_countries'
		));

		$this->_register_template_function('get_contacts', array(
			$this,
			'function_get_contacts'
		));

		$this->_register_template_function('rem', array(
			$this,
			'function_rem'
		));

		$this->_register_template_function('get_random_reaction', array(
			$this,
			'function_get_random_reaction'
		));

		$this->_register_template_function('get_spotlight_days', array(
			$this,
			'function_get_spotlight_days'
		));

		$this->_register_template_function('get_spotlight_events', array(
			$this,
			'function_get_spotlight_events'
		));

		$this->_register_template_function('map', array(
			$this,
			'function_map'
		));
	}

	function load_config() {
		global $tpl, $basics;
	}

	function get_root() {
		return LL_ROOT . '/tpl.' . LL_TEMPLATE;
	}

	function get_root_uri() {
		return LL_ROOT_URI . '/tpl.' . LL_TEMPLATE;
	}

	function display($what) {
		if (isset($_REQUEST['ajax']) && $_REQUEST['ajax'] && ($what == 'header.tpl' || $what == 'footer.tpl')) {
			return;
		}
		parent::display($what);
	}

	function display_wrap($what) {
		/**
		 * Load Life-Link RSS news
		 */
		require_once LL_ROOT . '/libs/magpierss/rss_fetch.inc';
		$this->assign('rss_news', get_rss_news());

		/**
		 * Fetch template content and attached JS/CSS/related
		 */
		$content = $this->fetch($what);

		$js = '/' . str_replace('.tpl', '.js', $what);
		$css = '/' . str_replace('.tpl', '.css', $what);
		$related = '/' . str_replace('.tpl', '_related.tpl', $what);

		/**
		 * Resolve attached JS/CSS
		 */
		if (file_exists($this->template_dir . $js)) {
			$this->function_js(array(
				'file' => $js,
				'merge' => TRUE
			));
		}
		if (file_exists($this->template_dir . $css)) {
			$this->function_css(array(
				'file' => $css,
				'merge' => TRUE
			));
		}

		/**
		 * Resolve JS inside the head tag
		 */
		if ($this->_tpl['js']['head'] || $this->_tpl['js_merge']['head']) {
			if ($this->_tpl['js_merge']['head']) {
				$this->_tpl['js_merge']['head'] = array_unique($this->_tpl['js_merge']['head']);
				if (! LL_DEBUG_JS) {
					array_walk($this->_tpl['js_merge']['head'], 'urlencode2');
					$this->_tpl['js']['head'][] = $this->_tpl['tpl_uri'] . '/js.php?file[]=' . implode('&file[]=', $this->_tpl['js_merge']['head']);
				} else {
					$this->_tpl['js']['head'] = array_merge($this->_tpl['js']['head'], $this->_tpl['js_merge']['head']);
				}
			}
			$this->_tpl['js']['head'] = array_unique($this->_tpl['js']['head']);
		}
		$this->_tpl['js']['head'][] = $this->_tpl['tpl_uri'] . '/css/xcss/';

		/**
		 * Resolve JS at the beginning of the body tag
		 */
		if ($this->_tpl['js']['pre_body'] || $this->_tpl['js_merge']['pre_body']) {
			if ($this->_tpl['js_merge']['pre_body']) {
				$this->_tpl['js_merge']['pre_body'] = array_unique($this->_tpl['js_merge']['pre_body']);
				if (! LL_DEBUG_JS) {
					array_walk($this->_tpl['js_merge']['pre_body'], 'urlencode2');
					$this->_tpl['js']['pre_body'][] = $this->_tpl['tpl_uri'] . '/js.php?file[]=' . implode('&file[]=', $this->_tpl['js_merge']['pre_body']);
				} else {
					$this->_tpl['js']['pre_body'] = array_merge($this->_tpl['js']['pre_body'], $this->_tpl['js_merge']['pre_body']);
				}
			}
			$this->_tpl['js']['pre_body'] = array_unique($this->_tpl['js']['pre_body']);
		}

		/**
		 * Resolve JS at the end of the body tag
		 */
		if ($this->_tpl['js']['post_body'] || $this->_tpl['js_merge']['post_body']) {
			if ($this->_tpl['js_merge']['post_body']) {
				$this->_tpl['js_merge']['post_body'] = array_unique($this->_tpl['js_merge']['post_body']);
				if (! LL_DEBUG_JS) {
					array_walk($this->_tpl['js_merge']['post_body'], 'urlencode2');
					$this->_tpl['js']['post_body'][] = $this->_tpl['tpl_uri'] . '/js.php?file[]=' . implode('&file[]=', $this->_tpl['js_merge']['post_body']);
				} else {
					$this->_tpl['js']['post_body'] = array_merge($this->_tpl['js']['post_body'], $this->_tpl['js_merge']['post_body']);
				}
			}
			$this->_tpl['js']['post_body'] = array_unique($this->_tpl['js']['post_body']);
		}

		/**
		 * Resolve CSS
		 */
		if ($this->_tpl['css'] || $this->_tpl['css_merge']) {
			if ($this->_tpl['css_merge']) {
				$this->_tpl['css_merge'] = array_unique($this->_tpl['css_merge']);
				if (! LL_DEBUG_CSS) {
					array_walk($this->_tpl['css_merge'], 'urlencode2');
					$this->_tpl['css'][] = $this->_tpl['tpl_uri'] . '/css.php?file[]=' . implode('&file[]=', $this->_tpl['css_merge']);
				} else {
					$this->_tpl['css'] = array_merge($this->_tpl['css'], $this->_tpl['css_merge']);
				}
			}
			$this->_tpl['css'] = array_unique($this->_tpl['css']);
		}
		$this->_tpl['css'][] = $this->_tpl['tpl_uri'] . '/css/master.css';

		/**
		 * Resolve xCSS
		 */
		if ($this->_xcss) {
			$this->_xcss = array_unique($this->_xcss);
			array_walk($this->_xcss, 'urlencode2');
			$this->_tpl['css'][] = $this->_tpl['tpl_uri'] . '/xcss.php?file[]=' . implode('&file[]=', $this->_xcss);
		}

		/**
		 * Display header & content
		 */
		$this->display('header.tpl');
		echo $content;

		/**
		 * Display attached related sidebar
		 */
		if (file_exists($this->template_dir . $related)) {
			$this->display($related);
		}

		/**
		 * Display footer
		 */
		$this->display('footer.tpl');
	}

	/**
	 * Display 404 template
	 * @param string $title Title
	 * @param string $message HTML Content
	 * @param array $suggestions Array of titles and links acting as suggestions
	 */
	function display_404($title = NULL, $message = NULL, $suggestions = NULL) {
		header('HTTP/1.0 404 Not Found');
		$title = $title ? $title : 'Not found';
		$message = $message ? $message : 'We couldn\'t find what you are looking for.';

		$this->_assign_by_ref('title', $title);
		$this->_assign_by_ref('message', $message);
		$this->_assign_by_ref('suggestions', $suggestions);
		$this->display_wrap('404.tpl');
	}

	/**
	 * Add JS file(s)
	 * @param string $extra['file'] JS filepaths/URI (absolute/relative)
	 * @param bool $extra['absolute'] True if path is absolute (no server URI to be attached)
	 * @param bool $extra['multiple'] True if multiple files comma-separated
	 * @param bool $extra['merge'] True if files are to be merged into one JS file
	 */
	public function function_js($extra = array()) {
		if (! isset($extra['where'])) {
			$extra['where'] = 'post_body';
		}
		if (! isset($extra['multiple'])) {
			$files = (array) $extra['file'];
		} else {
			$files = explode(',', $extra['file']);
		}
		foreach ($files as $file) {
			if (! isset($extra['absolute'])) {
				$file = $this->_tpl['tpl_uri'] . '/pages' . $file;
			}
			if (! isset($extra['merge'])) {
				$this->_tpl['js'][$extra['where']][] = $file;
			} else {
				$this->_tpl['js_merge'][$extra['where']][] = $file;
			}
		}
	}

	/**
	 * Add CSS file(s)
	 * @param string $extra['file'] CSS filepaths/URI (absolute/relative)
	 * @param bool $extra['absolute'] True if path is absolute (no server URI to be attached)
	 * @param bool $extra['multiple'] True if multiple files comma-separated
	 * @param bool $extra['merge'] True if files are to be merged into one CSS file
	 */
	public function function_css($extra = array()) {
		if (! isset($extra['multiple'])) {
			$files = (array) $extra['file'];
		} else {
			$files = explode(',', $extra['file']);
		}
		if (! isset($extra['absolute'])) {
			//$this->_tpl['css'][] = $this->_tpl['tpl_uri'] . '/xcss.php?file[]=' . implode('&file[]=', $files);
			$this->_xcss = $this->_xcss ? array_merge($this->_xcss, $files) : $files;
		} else {
			if (! isset($extra['merge'])) {
				$this->_tpl['css'] = array_merge($this->_tpl['css'], $files);
			} else {
				$this->_tpl['css_merge'] = array_merge($this->_tpl['css_merge'], $files);
			}
		}
	}

	/**
	 * Add related template files
	 * param string $extra['tag'] Tag(s)
	 */
	public function function_related($extra = array()) {
		if (! isset($extra['multiple'])) {
			$tags = (array) $extra['tag'];
		} else {
			$tags = explode(',', $extra['tag']);
		}
		foreach ($tags as $tag) {
			if (file_exists($this->template_dir . '/obj/tag/' . $tag . '_related.tpl')) {
				$result .= $this->fetch('/obj/tag/' . $tag . '_related.tpl');
			}
		}
		return $result;
	}

	/**
	 * Return variable value
	 * @param string $extra['var'] Variable name
	 */
	public function function_variable($extra = array()) {
		$dbVariables = DbVariables::get_instance();

		if (isset($extra['var'])) {
			$this->assign($extra['var'], $dbVariables->get($extra['name']));
		} else {
			return $dbVariables->get($extra['name']);
		}
	}

	/**
	 * Set page title
	 * @param string $extra['value'] Title
	 */
	public function function_title($extra = array()) {
		$this->assign('title', $extra['value']);
	}

	/**
	 * Assign upcoming day(s) to a variable
	 * @param string $extra['var'] Variable name
	 */
	public function function_get_spotlight_days($extra = array()) {
		$date_start = strtotime('-60 days');
		$date_end = strtotime('+30 days');

		$dbDays = DbDays::get_instance();
		$days = $dbDays->gets(array(
			"(`month` >= " . date('n', $date_start) . " AND `month_day` >= " . date('j', $date_start) . ")",
			"(`month` <= " . date('n', $date_end) . " AND `month_day` <= " . date('j', $date_end) . ")"
		), '`month` ASC, `month_day` ASC');

		$this->assign($extra['var'], $days);
	}

	/**
	 * Assign upcoming event(s) to a variable
	 * @param string $extra['var'] Variable name
	 */
	public function function_get_spotlight_events($extra = array()) {
		$date_start = strtotime('-60 days');
		$date_end = strtotime('+30 days');

		$dbEvents = DbEvents::get_instance();
		$events = $dbEvents->gets("(`date_end` >= '" . date('Y-m-d', $date_start) . "' AND `date_start` <= '" . date('Y-m-d', $date_end) . "') OR `is_sticky` = 'yes'", '`date_start` DESC');

		$this->assign($extra['var'], $events);
	}

	/**
	 * Assign LL Care Actions to a variable
	 * @param string $extra['var'] Variable name
	 */
	public function function_get_actions($extra = array()) {
		$dbActions = DbActions::get_instance();
		$actions = $dbActions->cache();

		$this->assign($extra['var'], $actions);
	}

	/**
	 * Assign Countries to a variable
	 * @param string $extra['var'] Variable name
	 * @param bool $extra['all'] Include countries without LL Schools
	 */
	public function function_get_countries($extra = array()) {
		if ($extra['all']) {
			$dbCountries = DbCountries::get_instance();
			$countries = $dbCountries->gets('`countries_iso` > 0', 'country');
		} else {
			$dbSchoolsCountries = DbSchoolsCountries::get_instance();
			$countries = $dbSchoolsCountries->gets('`countries_iso` > 0', 'country');
		}

		$this->assign($extra['var'], $countries);
	}

	/**
	 * Assign Cities to a variable
	 * @param string $extra['var'] Variable name
	 */
	public function function_get_cities($extra = array()) {
		if (! $extra['country']) {
			return array();
		}

		$dbSchoolsCities = DbSchoolsCities::get_instance();
		$cities = $dbSchoolsCities->gets(array(
			'countries_iso' => $extra['country']
		), 'city');

		$this->assign($extra['var'], $cities);
	}

	/**
	 * Assign Months to a variable
	 * @param string $extra['var'] Variable name
	 * @param numeric $extra['start'] Month to start with
	 * @param numeric $extra['end'] Month to end with
	 * @param numeric $extra['step'] Include every other X months
	 */
	public function function_get_months($extra = array()) {
		$months = $this->_tpl['months'];

		$start = $extra['start'] ? $extra['start'] : 0;
		$end = $extra['end'] ? $extra['end'] : 11;
		$step = $extra['step'] ? $extra['step'] : 1;

		$range = range($start, $end, $step);
		foreach ($range as $key) {
			$result[] = $months[$key];
		}
		$this->assign($extra['var'], $result);
	}

	/**
	 * Assign Years to a variable
	 * @param string $extra['var'] Variable name
	 * @param numeric $extra['start'] Year to start with
	 * @param numeric $extra['end'] Year to end with
	 * @param numeric $extra['step'] Include every other X years
	 */
	public function function_get_years($extra = array()) {
		$start = $extra['start'] ? $extra['start'] : date('Y');
		$end = $extra['end'] ? $extra['end'] : date('Y');
		$step = $extra['step'] ? $extra['step'] : 1;
		$years = range($start, $end, $step);

		$this->assign($extra['var'], $years);
	}

	/**
	 * Assign Contacts to a variable
	 * @param string $extra['var'] Variable name
	 * @param string $extra['department'] Restrict to a given department
	 */
	public function function_get_contacts($extra = array()) {
		$dbContacts = DbContacts::get_instance();
		$where = array();
		if ($extra['department']) {
			$where['department'] = $extra['department'];
		}
		$contacts = $dbContacts->gets($where, '`department_order` ASC, `contact` ASC');

		$this->assign($extra['var'], $contacts);
	}

	/**
	 * Fake function to allow modifiers without output
	 */
	public function function_rem() {
	}

	/**
	 * Assign random reaction to a variable
	 * @param string $extra['var'] Variable name
	 */
	public function function_get_random_reaction($extra = array()) {
		$dbReactions = DbReactions::get_instance();
		$geoip_record = geoip_remote_addr();
		$where = array();
		if ($geoip_record) {
			$where['country'] = $geopip_record->country_name;
		}
		$reaction = $dbReactions->get($where, 'RAND()');
		if (! $reaction) {
			$reaction = $dbReactions->get(NULL, 'RAND()');
		}

		$this->assign($extra['var'], $reaction);
	}

	/**
	 * Assign URI of LL Countries gMap to a variable
	 * @param string $extra['var'] Variable name
	 * @param numeric $extra['height'] Height in pixels
	 * @param numeric $extra['width'] Width in pixels
	 */
	public function function_map($extra = array()) {
		$dbVariables = DbVariables::get_instance();
		$map = $dbVariables->get('countries_concat_iso2');
		$mapc = str_repeat('A', strlen($map) / 2);
		$height = $extra['height'] ? $extra['height'] : 220;
		$width = $extra['width'] ? $extra['width'] : 440;
		$map = "http://chart.apis.google.com/chart?cht=t&chs={$width}x{$height}&chd=s:{$mapc}&chco=cccccc,006a33,B0D0B0&chld={$map}&chtm=world&chf=bg,s,ffffff";
		return $map;
	}
}