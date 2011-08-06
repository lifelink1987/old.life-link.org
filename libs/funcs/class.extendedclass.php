<?php

require_once 'php_newer.php';

/**
 * Implements ExtendedClass class
 *
 * @author	Andrei Neculau <andrei.neculau@gmail.com>, http://www.andreineculau.com
 * @version	0.1.$LastChangedRevision
 * @date	$LastChangedDate
 */

class ExtendedClass {

	function get_var($var) {
		$var2 = "_$var";
		return ($this->$var) ? ($this->$var) : ($this->$var2);
	}

	function get_called_class() {
		return get_class($this);
	}
}