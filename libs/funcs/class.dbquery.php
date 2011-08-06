<?php

require_once 'class.extendedclass.php';
require_once 'class.db.php';

/**
 * Implements DbQuery class
 *
 * This class enhances database work
 *
 * @author	Andrei Neculau <andrei.neculau@gmail.com>, http://www.andreineculau.com
 * @version	0.1.$LastChangedRevision
 * @date	$LastChangedDate
 */

class DbQuery extends ExtendedClass {

	protected $_db;

	protected $_debug = FALSE;

	public function __construct($db, $debug = FALSE) {
		$this->_db = $db;
		$this->_debug = $debug;
	}
}