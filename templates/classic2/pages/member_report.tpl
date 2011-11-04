<div class="llboxbdsmall">
	<div class="llfloatl">
		<div class="yuimenu sectionlinks">
			<div class="bd">
				<ul>
					<li class="yuimenuitem"><a href="<{$tpl.links.member}><{$report.school.schoolnumber}>"><u><{$report.school.name}></u> : <b>School Information</b></a></li>
					<hr>
					<li class="yuimenuitem"><a href="<{$tpl.links.members_get_country}><{$report.school.country}>&list_sr=r&list_order=latest&list_city=<{$report.school.city}>"><u><{$report.school.countryname|upper}>, <{$report.school.city}></u> : <b>Most recent reports</b></a></li>
					<li class="yuimenuitem"><a href="<{$tpl.links.members_get_country}><{$report.school.country}>&list_city=<{$report.school.city}>"><u><{$report.school.countryname|upper}>, <{$report.school.city}></u> : <b>Life-Link schools</b></a></li>
					<li class="yuimenuitem"><a href="<{$tpl.links.members_get_country}><{$report.school.country}>&list_sr=r&list_order=latest"><u><{$report.school.countryname|upper}></u> : <b>Most recent reports</b></a></li>
					<li class="yuimenuitem"><a href="<{$tpl.links.members_get_country}><{$report.school.country}>"><u><{$report.school.countryname|upper}></u> : <b>Life-Link schools</b></a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="llfloatl">
		<h1><{$report.school.name}></h1>
		<div class="textsmall"><b><{$report.school.countryname|upper}>, <{$report.school.city}></b>, Life-Link School #<{$report.school.schoolnumber}></div>
	</div>
	<span class="llclear" style="height: 0.1em"></span>
</div>
<{include file="pages/report.tpl"}>
