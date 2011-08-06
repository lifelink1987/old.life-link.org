<?php

/**
 * Implements DOMDocument2XPath class
 *
 * This class helps parse HTML into DOM trees
 *
 * @author	Andrei Neculau <andrei.neculau@gmail.com>, http://www.andreineculau.com
 * @version	0.1.$LastChangedRevision
 * @date	$LastChangedDate
 */

class DOMDocument2XPath extends DOMDocument {

	/**
	 * Constructor
	 * @param string $source
	 * @param string $xpath
	 * @param string $version
	 * @param string $encoding
	 */
	function __construct($source = NULL, &$xpath = NULL, $version = '1.0', $encoding = 'utf-8') {
		parent::__construct($version, $encoding);
		$this->preserveWhiteSpace = FALSE;
		$this->substituteEntities = TRUE;
		
		if ($source) {
			$source = preg_replace('/<head[^>]*>/', '<head><meta http-equiv="Content-Type" content="text/html; charset=' . $this->encoding . '">', $source);
			$source = preg_replace('/>\s+/', '>', $source);
			$source = preg_replace('/\s+</', '<', $source);
			$source = preg_replace('/\s{2,}/', ' ', $source);
			@$this->loadHTML($source);
			$xpath = new DOMXPath($this);
		}
	}
}
