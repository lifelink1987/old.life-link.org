<?

include('libs/funcs.php');

$smarty->prepare_display();

$requested = $_REQUEST['item'];
$original = $smarty->template_dir . 'js/' . $requested;
$parsed = $smarty->template_dir . 'js/built/' . basename($requested);

if (file_exists($original))
{
	header('Content-type: application/x-javascript');
	foreach ($tpl['basics'] as $key => $value)
	{
		$smarty->assign($key, $value);
	}
	$smarty->left_delimiter = '<{';
	$smarty->right_delimiter = '}>';
	$output = $smarty->fetch('js/' . $requested);
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