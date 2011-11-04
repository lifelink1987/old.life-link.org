<?

include('libs/funcs.php');

$smarty->prepare_display();

$requested = $_REQUEST['item'];
$original = $smarty->template_dir . 'css/' . $requested;
$parsed = $smarty->template_dir . 'css/built/' . $requested;

if (file_exists($original))
{
	header('Content-type: text/css');
	foreach ($tpl['basics'] as $key => $value)
	{
		$smarty->assign($key, $value);
	}
	$smarty->left_delimiter = '<';
	$smarty->right_delimiter = '>';
	$output = $smarty->fetch('css/' . $requested);
	@mkdir(dirname($parsed));
	@$parsed_handle = fopen($parsed, 'w');
	@fwrite($parsed_handle, $output);
	@fclose($parsed_handle);
	echo $output;
}
else
{
	header("HTTP/1.1 404 Not Found");
}

?>