<?php

require_once 'class.extendedclass.php';
require_once 'string.php';
require_once 'misc.php';
require_once 'array.php';

/**
 * Implements Logger class
 *
 * This class can time processes, kill current instance and log messages to a file (and the output)
 *
 * @author	Andrei Neculau <andrei.neculau@gmail.com>, http://www.andreineculau.com
 * @version	0.1.$LastChangedRevision
 * @date	$LastChangedDate
 */

class Logger extends ExtendedClass {

	const SMARTY_INFO = - 10;

	const SMARTY_WARN = - 9;

	const SMARTY_ERROR = - 8;

	const SQL_INFO = - 7;

	const SQL_WARN = - 6;

	const SQL_ERROR = - 5;

	const PHP_INFO = - 4;

	const PHP_WARN = - 3;

	const PHP_ERROR = - 2;

	const DUMP = - 1;

	const DEBUG = 1;

	const INFO = 2;

	const WARN = 3;

	const ERROR = 4;

	const FATAL = 5;

	const OFF = 6;

	/**
	 * Logging status
	 * @var bool
	 */
	protected $_enabled = TRUE;

	/**
	 * Output logs to file and/or screen/buffer (FirePHP if active)
	 * @var mixed
	 */
	protected $_destination = 'file';

	/**
	 * Output level
	 * @var mixed
	 */
	protected $_level = self::ERROR;

	/**
	 * Create a "plus" log file, without filtering output level
	 * @var mixed
	 */
	protected $_log_plus = FALSE;

	/**
	 * Replace default error handler
	 * @var TRUE
	 */
	protected $_error_handler = TRUE;

	/**
	 * Files
	 * @var mixed
	 */
	protected $_file;

	protected $_file_plus;

	/**
	 * Log filenname prefix and suffix
	 * @var mixed
	 */
	protected $_prefix;

	protected $_suffix;

	/**
	 * Folder for log files
	 * @var string
	 */
	protected $_dir;

	/**
	 * Strip new lines from log messages
	 * @var bool
	 */
	protected $_oneline = TRUE;

	/**
	 * Initial options
	 * @var array
	 */
	protected $_extra = array();

	/**
	 * Instance
	 * @var array
	 */
	protected static $_instance = array();

	/**
	 * Timing queue
	 * @var array
	 */
	protected $_timings = array();

	/**
	 * FirePHP instance
	 * @var object
	 */
	protected $_firephp;

	/**
	 * Root folder
	 * @var string
	 */
	protected $_root;

	/**
	 * Constructor
	 * @param array $extra
	 */
	public function __construct($extra = array()) {
		//Check if the optional parameter was passed
		if (count($extra)) {
			//Go through array and assign parameter to this instance
			foreach ($extra as $param => $value) {
				$param = "_$param";
				$this->$param = $value;
			}
		}

		$this->_destination = (array) $this->_destination;
		$this->_dir = $extra['dir'] = realpath(rtrim($this->_dir ? $this->_dir : dirname(__FILE__) . '/logs', '/\\'));
		$this->_extra = $extra;

		if ($this->_root) {
			$this->_root = realpath($this->_root);
		}

		//Check/create directory
		if (! file_exists($this->_dir)) {
			mkdir($this->_dir, ($this->_dir_permissions ? $this->_dir_permissions : 0777), TRUE);
		}

		//Open log file for writing
		$this->_file = $this->_dir . '/' . $this->_prefix . date('Ymd-His') . $this->_suffix . '.txt';
		$this->_file = fopen($this->_file, 'w');

		//Open log_plus file for writing
		if ($this->_log_plus) {
			$this->_file_plus = $this->_dir . '/' . $this->_prefix . date('Ymd-His') . $this->_suffix . '.plus.txt';
			$this->_file_plus = fopen($this->_file_plus, 'w');
		}

		//Turn output buffering on
		if (ob_get_level() == 0) {
			ob_start();
		}

		//Switch screen/buffer to FirePHP if available
		if (class_exists('FirePHP') && ($this->_firephp = FirePHP::getInstance(TRUE)) && (in_array('firephp', $this->_destination) || in_array('screen', $this->_destination))) {
			$this->_destination[] = 'firephp';
			unset($this->_destination['screen']);
		}

		//Register shutdown function
		if (in_array('buffer', $this->_destination)) {
			register_shutdown_function(array(
				$this,
				'_echo_buffer'
			));
		}

		//Register as custom error handler
		if ($this->_error_handler) {
			set_error_handler(array(
				$this,
				'error_handler'
			));
		}

		$this->log_info('Logger was initialized');

		self::$_instance[get_class($this)] = $this;
	}

	/**
	 * Destructor
	 */
	public function __destruct() {
		@fclose($this->_file);
		@fclose($this->_file_plus);
	}

	/**
	 * Return a reference to this instantiation, if available
	 * @param bool $auto_create
	 * @return object
	 */
	public static function get_instance($auto_create = FALSE) {
		$class = get_called_class();
		if ($auto_create === TRUE && ! isset(self::$_instance[$class])) {
			self::$_instance[$class] = new $class();
			return self::$_instance[$class];
		}
		return @self::$_instance[$class];
	}

	/**
	 * Prevent cloning of this object
	 */
	final private function __clone() {
		trigger_error('Clone is not allowed.', E_USER_ERROR);
	}

	/**
	 * Get textual level from numeric level
	 * @param int $level
	 */
	protected function _log_level($level) {
		switch ($level) {
			case self::DUMP:
			case self::DEBUG:
				return array(
					'DEBUG',
					self::DEBUG
				);

			case self::PHP_INFO:
			case self::SQL_INFO:
			case self::SMARTY_INFO:
			case self::INFO:
				return array(
					'INFO',
					self::INFO
				);

			case self::PHP_WARN:
			case self::SQL_WARN:
			case self::SMARTY_WARN:
			case self::WARN:
				return array(
					'WARN',
					self::WARN
				);

			case self::PHP_ERROR:
			case self::SQL_ERROR:
			case self::SMARTY_ERROR:
			case self::ERROR:
				return array(
					'ERROR',
					self::ERROR
				);

			case self::FATAL:
				return array(
					'FATAL',
					self::FATAL
				);

			default:
				return array(
					'LOG',
					self::INFO
				);
		}
	}

	/**
	 * Return backtrace text with datetime, (class)function, file and line information
	 */
	protected function _backtrace() {
		$backtrace = debug_backtrace(TRUE);

		//Find backtrace function outside this class, and if needed part of another class
		$backtrace_item_start = FALSE;
		$backtrace_item_end = FALSE;
		for ($i = 0; $i < count($backtrace); $i++) {
			//Ignore includes
			if (in_array($backtrace[$i]['function'], array(
				'require',
				'require_once',
				'include',
				'include_once'
			))) {
				continue;
			}
			//Remember through which function the Logger was called
			if ($backtrace[$i]['class'] == get_class($this)) {
				$backtrace_item_logger = $i;
			}
			//Remember the function that called Logger
			if (! $backtrace_item_end && $backtrace[$i]['class'] != get_class($this)) {
				$backtrace_item_end = $i;
			}
			//Check for inheritance
			if ($backtrace_item_end && $backtrace[$i]['class']) {
				if (is_subclass_of($backtrace[$backtrace_item_end]['object'], $backtrace[$i]['class'])) {
					$backtrace_item_start = $i;
				} else {
					break;
				}
			}
		}
		if ($backtrace_item_end === FALSE) {
			$backtrace_item_end = $backtrace_item_logger;
		}
		if ($backtrace_item_start !== FALSE) {
			if ($this->_root) {
				$backtrace[$backtrace_item_start]['file'] = str_replace($this->_root, '', $backtrace[$backtrace_item_start]['file']);
			}
			if ($backtrace_item_start - 1 > 0) {
				if ($this->_root) {
					$backtrace[$backtrace_item_start - 1]['file'] = str_replace($this->_root, '', $backtrace[$backtrace_item_start - 1]['file']);
				}
				$start_line_exact = " in <b>{$backtrace[$backtrace_item_start-1]['file']} ({$backtrace[$backtrace_item_start-1]['line']})</b>";
			} else {
				$start_line_exact = "";
			}
			$start_line = "\ninitiated by <b>{$backtrace[$backtrace_item_start]['class']}{$backtrace[$backtrace_item_start]['type']}{$backtrace[$backtrace_item_start]['function']}()</b>$start_line_exact called from <b>{$backtrace[$backtrace_item_start]['file']} ({$backtrace[$backtrace_item_start]['line']})</b>";
		} else {
			$start_line = "";
		}
		if ($this->_root) {
			$backtrace[$backtrace_item_end]['file'] = str_replace($this->_root, '', $backtrace[$backtrace_item_end]['file']);
		}
		if ($backtrace_item_end - 1 > 0) {
			if ($this->_root) {
				$backtrace[$backtrace_item_end - 1]['file'] = str_replace($this->_root, '', $backtrace[$backtrace_item_end - 1]['file']);
			}
			$end_line_exact = " in <b>{$backtrace[$backtrace_item_end-1]['file']} ({$backtrace[$backtrace_item_end-1]['line']})</b>";
		} else {
			$end_line_exact = "";
		}
		$end_line = "<b>{$backtrace[$backtrace_item_end]['class']}{$backtrace[$backtrace_item_end]['type']}{$backtrace[$backtrace_item_end]['function']}()</b>$end_line_exact called from <b>{$backtrace[$backtrace_item_end]['file']} ({$backtrace[$backtrace_item_end]['line']})</b>";
		return "$end_line$start_line";
	}

	/**
	 * Echo buffer
	 */
	public function _echo_buffer() {
		echo $this->_buffer;
	}

	/**
	 * Toggle enabled status
	 * @param bool $force
	 */
	public function toggle($force = NULL) {
		if ($force != NULL) {
			$this->_enabled = $force;
		} else {
			$this->_enabled = ! $this->_enabled;
		}
	}

	/**
	 * Dump variable
	 * @param string $name
	 * @param mixed $value
	 */
	public function log_dump($name, $value) {
		$value2 = json_encode($value);
		if (! $value2) {
			$value2 = var_export($value, TRUE);
		}
		$this->log(self::DUMP, array(
			$name,
			$value2
		));
	}

	/**
	 * Log flow
	 * @param string $moment
	 * @param string $message
	 * @param numeric $id
	 */
	public function log_flow($moment, $message, $id = NULL) {
		$moment = strtolower($moment);
		$mem = '__Memory Usage__: ' . convert_memory(memory_get_usage()) . ' / __Peak__: ' . convert_memory(memory_get_peak_usage());
		switch ($moment) {
			case 'start':
				$id = count($this->_timings) + 1;
				$this->_timings[$id] = microtime_float();
				if ($this->_firephp) {
					$this->_firephp->group('Process ' . $id);
				}
				$this->log(self::DEBUG, "ID#$id Started: $message ---\n$mem");
				return $id;
				break;

			case 'premature':
				if (! $id)
					break;
				$this->log(self::ERROR, "ID#$id Ended Prematurely: $message ---\n$mem");
				if ($this->_firephp) {
					$this->_firephp->groupEnd();
				}
				break;

			case 'end':
				if (! $id)
					break;
				$duration = round(microtime_float() - $this->_timings[$id], 3);
				$this->log(self::DEBUG, "ID#$id Ended: $message. It took $duration seconds ---\n$mem");
				if ($this->_firephp) {
					$this->_firephp->groupEnd();
				}
				break;

			default:
				;
				break;
		}
	}

	/**
	 * Log info message
	 * @param string $message
	 */
	public function log_info($message) {
		$this->log(self::INFO, $message);
	}

	/**
	 * Log debug message
	 * @param string $message
	 */
	public function log_debug($message) {
		$this->log(self::DEBUG, $message);
	}

	/**
	 * Log warn message
	 * @param string $message
	 */
	public function log_warn($message) {
		$this->log(self::WARN, $message);
	}

	/**
	 * Log error message
	 * @param string $message
	 */
	public function log_error($message) {
		$this->log(self::ERROR, $message);
	}

	/**
	 * Log fatal error message
	 * @param string $message
	 */
	public function log_fatal($message) {
		$this->log(self::FATAL, $message);
	}

	/**
	 * Log  message
	 * @param numeric $level
	 * @param string $message
	 */
	protected function log($level, $message) {
		if (! $this->_enabled)
			return;

		if ($level == self::PHP_ERROR) {
			if ($this->_root) {
				$message['errfile'] = str_replace($this->_root, '', $message['errfile']);
			}
			if (is_array($message) && substr($message['errstr'], 0, 3) == 'SQL') {
				switch ($message['errno']) {
					case E_USER_ERROR:
						$level = self::SQL_ERROR;
						break;
					case E_USER_WARNING:
						$level = self::SQL_WARN;
						break;
					case E_USER_NOTICE:
					default:
						$level = self::SQL_INFO;
						break;
				}
				$backtrace = "<b>" . str_replace('User', 'SQL', $message['errtype_long']) . "</b> in <b>{$message['errfile']} ({$message['errline']})</b>";
				$message = substr($message['errstr'], 4);
			} elseif (is_array($message) && substr($message['errstr'], 0, 5) == 'SMARTY') {
				switch ($message['errno']) {
					case E_USER_ERROR:
						$level = self::SMARTY_ERROR;
						break;
					case E_USER_WARNING:
						$level = self::SMARTY_WARN;
						break;
					case E_USER_NOTICE:
					default:
						$level = self::SMARTY_INFO;
						break;
				}
				$backtrace = "<b>" . str_replace('User', 'Smarty', $message['errtype_long']) . "</b> in <b>{$message['errfile']} ({$message['errline']})</b>";
				$message = substr($message['errstr'], 6);
			} else {
				$warnings = E_WARNING | E_CORE_WARNING | E_COMPILE_WARNING | E_USER_WARNING;
				$notices = E_NOTICE | E_USER_NOTICE;
				$errors = E_ERROR | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR;

				if ($message['errno'] & $errors) {
					$level = self::PHP_ERROR;
				} elseif ($message['errno'] & $warnings) {
					$level = self::PHP_WARN;
				} else {
					$level = self::PHP_INFO;
				}
				$backtrace = "<b>{$message['errtype_long']}</b> in <b>{$message['errfile']} ({$message['errline']})</b>";
				$message = $message['errstr'];
			}
		} else {
			$backtrace = $this->_backtrace();
		}
		$backtrace_date = date("H:i:s") . ' ' . $backtrace;

		list ($level_text, $level_basic) = self::_log_level($level);

		if ($level == self::DUMP && is_array($message)) {
			if ($this->_firephp) {
				$this->_firephp->dump($message[0], $message[1]);
			}
			$message = "The value of '{$message[1]}' is {$message[0]}";
		} else {
			$output = strip_tags(htmlspecialchars($message) . " --- $backtrace");
			switch ($level_basic) {
				case self::DEBUG:
				case self::INFO:
					if ($this->_firephp)
						$this->_firephp->info($output);
					break;

				case self::WARN:
					if ($this->_firephp)
						$this->_firephp->warn($output);
					break;

				case self::FATAL:
				case self::ERROR:
					if ($this->_firephp)
						$this->_firephp->error($output);
					break;

				default:
					if ($this->_firephp)
						$this->_firephp->log($output);
					break;
			}
		}

		$output = strip_tags("$backtrace_date\n$level_text - $message");
		$logging_wanted = is_array($this->_level) ? (in_array($level, $this->_level) || in_array($level_basic, $this->_level)) : ($level_basic >= $this->_level);
		if ($logging_wanted) {
			fwrite($this->_file, $output . "\n\n");
			fflush($this->_file);
		}
		if ($this->_log_plus) {
			fwrite($this->_file_plus, $output . "\n\n");
			fflush($this->_file_plus);
		}

		$output = "$message";
		$logging_wanted_in_browser = in_array('screen', $this->_destination) || in_array('buffer', $this->_destination);
		if ($logging_wanted && $logging_wanted_in_browser) {
			$output_safe = call_user_func_array('htmlentities', array(
				&$output,
				ENT_COMPAT,
				'UTF-8'
			));
			if (! $output_safe) {
				$output_safe = call_user_func_array('mb_convert_encoding', array(
					&$output,
					'HTML-ENTITIES',
					'UTF-8'
				));
				if (! $output_safe) {
					$output_safe = $output;
				} else {
					$output_safe = " ~ $output_safe";
				}
			}
			$output = "$backtrace_date\n<b>$level_text</b> - $output";
			$echo = "<pre>$output</pre>";
			if (in_array('buffer', $this->_destination) || in_array('buffer!', $this->_destination)) {
				$this->_buffer .= $echo;
			} else {
				echo $echo;
				if (!$this->_firephp || !in_array('firephp', $this->_destination)) {
					ob_flush();
				}
			}
		}
	}

	/**
	 * Custom error handler
	 * @param numeric $errno
	 * @param string $errstr
	 * @param string $errfile
	 * @param numeric $errline
	 * @param unknown_type $errcontext
	 */
	public function error_handler($errno, $errstr, $errfile, $errline, $errcontext) {
		$errtype = array(
			E_ERROR => 'E_ERROR',
			E_WARNING => 'E_WARNING',
			E_PARSE => 'E_PARSE',
			E_NOTICE => 'E_NOTICE',
			E_CORE_ERROR => 'E_CORE_ERROR',
			E_CORE_WARNING => 'E_CORE_WARNING',
			E_COMPILE_ERROR => 'E_COMPILE_ERROR',
			E_COMPILE_WARNING => 'E_COMPILE_WARNING',
			E_USER_ERROR => 'E_USER_ERROR',
			E_USER_WARNING => 'E_USER_WARNING',
			E_USER_NOTICE => 'E_USER_NOTICE',
			E_STRICT => 'E_STRICT',
            E_RECOVERABLE_ERROR => 'E_RECOVERABLE_ERROR',
            E_DEPRECATED => 'E_DEPRECATED',
            E_USER_DEPRECATED => 'E_USER_DEPRECATED'
		);
		$errtype_long = array(
			E_ERROR => 'Error',
			E_WARNING => 'Warning',
			E_PARSE => 'Parsing Error',
			E_NOTICE => 'Notice',
			E_CORE_ERROR => 'Core Error',
			E_CORE_WARNING => 'Core Warning',
			E_COMPILE_ERROR => 'Compile Error',
			E_COMPILE_WARNING => 'Compile Warning',
			E_USER_ERROR => 'User Error',
			E_USER_WARNING => 'User Warning',
			E_USER_NOTICE => 'User Notice',
			E_STRICT => 'Runtime Notice: Strict',
            E_RECOVERABLE_ERROR => 'Catchable Fatal Error',
            E_DEPRECATED => 'Runtime Notice: Deprecated',
            E_USER_DEPRECATED => 'Runtime Notice: User Deprecated'
		);
		$warnings = E_WARNING | E_CORE_WARNING | E_COMPILE_WARNING | E_USER_WARNING;
		$notices = E_NOTICE | E_USER_NOTICE;
		$errors = E_ERROR | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR;
		$parse = E_PARSE;
		if (($errno & error_reporting()) != 0) {
			$this->log(self::PHP_ERROR, array(
				'errno' => $errno,
				'errtype' => $errtype[$errno],
				'errtype_long' => $errtype_long[$errno],
				'errstr' => $errstr,
				'errfile' => $errfile,
				'errline' => $errline,
				'errcontext' => $errcontext
			));
			if ($errno & $errors) {
				die();
			}
		}

		if (! $errno) {
			return;
		}

	//email if in errors ?!
	}
}


/*function myflush() {
	//echo (str_repeat(' ', 256));
	//echo ("\n" . str_repeat(' ', 4096) . "\n");
	// check that buffer is actually set before flushing
	if (ob_get_length()) {
		@ob_flush();
		@flush();
		@ob_end_flush();
	}
	@ob_start();
	//usleep(3);
}*/
