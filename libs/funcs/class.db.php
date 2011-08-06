<?php

require_once 'class.extendedclass.php';
require_once 'php_newer.php';

/**
 * Implements Db class
 *
 * This class enhances database work
 *
 * @author	Andrei Neculau <andrei.neculau@gmail.com>, http://www.andreineculau.com
 * @version	0.1.$LastChangedRevision
 * @date	$LastChangedDate
 */

class Db extends mysqli {

	public $schema_prefix;

	protected $_debug = FALSE;

	public function __construct($host = null, $user = null, $pass = null, $schema = null, $port = null, $debug = FALSE) {
		$this->_debug = $debug;
		
		parent::__construct("p:$host", $user, $pass, $schema);
		
		//On error
		if (PHP_VERSION_ID < 502090) {
			if (mysqli_connect_errno($this) && $this->_debug) {
				trigger_error('SQL Error#' . mysqli_connect_errno($this) . ': ' . mysqli_connect_error($this), E_USER_ERROR);
			}
		} else {
			if ($this->connect_errno && $this->_debug) {
				trigger_error('SQL Error#' . $this->connect_errno . ': ' . $this->connect_error, E_USER_ERROR);
			}
		}
		
		$this->set_charset('UTF8');
		$this->schema_prefix = "`$schema`.";
	}

	public function query($sql) {
		//Generate log message
		if ($this->_debug) {
			trigger_error("SQL \t" . trim_ws($sql), E_USER_NOTICE);
		}
		
		//Execute query
		$result = parent::query($sql);
		
		//On error
		if ($result === FALSE && $this->_debug) {
			trigger_error('SQL Error#' . $this->errno . ': ' . $this->error, E_USER_ERROR);
		}
		
		//Return result
		return $result;
	}

	public function query_all($sql) {
		if (($result = $this->query($sql)) !== FALSE) {
			$items = array();
			if ($result->num_rows) {
				while ($item = $result->fetch_assoc()) {
					$items[] = $item;
				}
			}
			return $items;
		} else {
			return FALSE;
		}
	}

	public function execute($sql) {
		$this->query($sql);
	}
	
	public function last_insert_id() {
		$result = $this->query("SELECT LAST_INSERT_ID()");
		return array_shift($result->fetch_assoc());
	}
}
