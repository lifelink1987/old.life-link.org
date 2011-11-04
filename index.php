<?

require_once('libs/funcs.php');

if (!$_COOKIE['llrevisit']){
	setcookie('llrevisit', '1', time()+3600*24*7);
}else{
	header("Location: http://www.life-link.org/home.php");
}

$smarty->prepare_display();
$smarty->display(LL_ROOT . '/pages/index.tpl');

?>


