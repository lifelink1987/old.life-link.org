<?php

require_once(XAJAX_DIR . 'xajax.inc.php');
require_once(XAJAX_DIR . 'xajaxResponse.inc.php');

$xajax = new xajax;
$xajax->waitCursorOn();
//$xajax->debugOn();
$xajax->statusMessagesOn();

class myAjaxResponse extends xajaxResponse
{
	function addAddOption($select_field, $value, $text = null)
	{
		if (!$text)
		{
			$text = $value;
		}
		$script  = <<<JS
			var xajax_option = new Option('$text', '$value');
			$('$select_field').options.add(xajax_option);
JS;
		$this->addScript($script);
	}
	
	function addAddResult($result_field, $info, $link = null)
	{
		if ($link)
		{
			$info = '<a href="' . $link . '">' . $info . '</a>';
		}
		$info .= '<br>';
		$this->addAppend($result_field, 'innerHTML', $info);
	}
}
$response = new myAjaxResponse;

?>