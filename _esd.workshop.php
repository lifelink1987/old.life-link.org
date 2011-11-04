<?

require_once('libs/funcs.php');

$smarty->prepare_display();
if (!$_REQUEST['ajax'])
{
	$smarty->display('header.tpl');
}

?>

<div id="llpagetitle">INTERNATIONAL SCHOOL-NETWORKS for a historical world-wide Education for Sustainable Development CAMPAIGN 2010-2014</div>
<div class="yui-gc">
	<div class="yui-u first">
		<h1>Workshop - 5-7 May - Uppsala, Sweden</h1>
		<ol>
			<li><a href="http://files.life-link.org/events/201005_workshop_se/20100302_Invitation_Letter.pdf">Invitation to Workshop in Uppsala, 5-7 May</a></li>
			<li><a href="http://files.life-link.org/events/201005_workshop_se/!latest!School-Networks_List.pdf">List of School-Networks</a></li>
			<li><a href="http://files.life-link.org/events/201005_workshop_se/!latest!Program_Tentative.pdf">Program (Tentative)</a></li>
		</ol>
	</div>
	<div class="yui-u">
		<img src="http://shared.life-link.org/toaster/_Graphics/Logo%20(Official)/2006%20-%20with%20Care/Graphic1-250x100.png" width="200"><br>
		<img src="http://shared.life-link.org/toaster/_Graphics/Logos%20(Other)/Dag%20Hammarskjold%20Foundation/logo_dag_hammarskjold_foundation.png" width="200"><br>
		<img src="http://shared.life-link.org/toaster/_Graphics/Logos%20(Other)/UNESCO%20ESD/logo_esd.png" width="200"><br>
		<img src="http://shared.life-link.org/toaster/_Graphics/Logos%20(Other)/UN%202005-2015%20Water%20for%20Life%20Decade/logo_wfl_decade.png" width="200">
	</div>
</div>

<?

if (!$_REQUEST['ajax'])
{
	$smarty->display('footer.tpl');
}

?>