<?

require_once('libs/funcs.php');

$smarty->prepare_display();
if (!$_REQUEST['ajax'])
{
	$smarty->display('header.tpl');
}

?>

<div id="llpagetitle">Education for Sustainable Development</div>
<div class="yui-gc">
	<div class="yui-u first">
		<h1>2010-2014 Earth Care Campaign</h1>
		<ol>
			<li><a href="http://earthcare.life-link.org">Campaign Website</a></li>
			<li><a href="http://earthcare.life-link.org/calendar/2010-uppsala-workshop">Workshop in Uppsala, 5-7 May</a></li>
			<li>Teacher Guidelines
				<ul class="indent">
					<li><a href="http://files.life-link.org/campaigns/2010_2014_esd_wfl/Three_Guidelines_and_Handbook.png?preview">Overview</a></li>
					<li><a href="http://files.life-link.org/campaigns/2010_2014_esd_wfl/Support_Material_Handbook_Rel_1.0.pdf">English</a>
					&middot; Arabic
					&middot; Spanish
					&middot; <b>Support Material Handbook</b></li>
					<li><a href="http://files.life-link.org/campaigns/2010_2014_esd_wfl/Teacher's_Guidelines_Water_for_Life_Rel_1.0.pdf">English</a>
					&middot; Arabic
					&middot; <a href="http://files.life-link.org/campaigns/2010_2014_esd_wfl/Teacher's_Guidelines_Water_for_Life_Rel_1.0_spanish.pdf">Spanish</a>
					&middot; <b>Water for Life</b></li>
					<li>English
					&middot; Arabic
					&middot; Spanish
					&middot; <b>Culture of Care</b></li>
					<li>English
					&middot; Arabic
					&middot; Spanish
					&middot; <b>Reuse-Reduce-Recycle</b></li>
				</ul>
			</li>
		</ol>
		<br><br>
		<h1>2009 ESD Bonn Conference</h1>
		<ol>
			<li><a href="http://files.life-link.org/events/200904_esd_de/Flyer - Life-Link and UNESCO Project.pdf">Flyer - Life-Link & UNESCO Project</a></li>
			<li><a href="http://files.life-link.org/events/200904_esd_de/Roll up - Life-Link Basic.pdf">Roll up - Life-Link Basic</a></li>
			<li><a href="http://files.life-link.org/events/200904_esd_de/Roll up - Life-Link and UNESCO Project.pdf">Roll up - Life-Link & UNESCO Project</a></li>
			<li><a href="http://files.life-link.org/events/200904_esd_de/media/">Conference Photos</a></li>
		</ol>
		<br><br>
		<h1>2007-2008 Life-Link &amp; UNESCO Pilot Project</h1>
		<ol>
			<li><a href="http://files.life-link.org/conferences/2008_jo/conference-report.pdf">Life-Link Report, Petra Concluding Conference June '08</a></li>
			<li><a href="http://files.life-link.org/conferences/2008_jo/pilot-project-evaluation-report.pdf">Life-Link & UNESCO Pilot Evaluation Report</a></li>
		</ol>
		<br><br>
		<h1>1987 Life-Link Friendship-Schools Programme</h1>
		<ol>
			<li><a href="http://files.life-link.org/programme/2009 Life-Link Summary.pdf">Life-Link Summary</a></li>
			<li><a href="http://files.life-link.org/manual/2007_english.pdf">Life-Link Manual - Basic Program (English)</a></li>
			<li><a href="http://files.life-link.org/programme/Campaign Study Form - Green School Garden.pdf">Campaign Study Form - Green School Garden</a></li>
			<li><a href="http://files.life-link.org/programme/Campaign Study Form - Reuse-Reduce-Recycle.pdf">Campaign Study Form - Reuse-Reduce-Recycle</a></li>
			<li><a href="http://files.life-link.org/programme/Campaign Study Form - Water for Life.pdf">Campaign Study Form - Water for Life</a></li>
			<li><a href="http://files.life-link.org/programme/2008 HREA Evaluation of Life-Link Program.pdf">HREA Evaluation of Life-Link Program</a></li>
		</ol>
	</div>
	<div class="yui-u">
		<img src="http://shared.life-link.org/toaster/_Graphics/Logo%20(Official)/2006%20-%20with%20Care/Graphic1-250x100.png" width="200"><br>
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