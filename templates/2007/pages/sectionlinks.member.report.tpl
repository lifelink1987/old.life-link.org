<{if !$nosectionlinks}>
	<{if $smarty.session.lltemplatelevel > 0}>
		<div class="yuimenu sectionlinks">
			<div class="bd">
				<ul>
					<li class="yuimenuitem"><a href="<{$tpl.links.member}><{$report.school.schoolnumber}>">Information about the school</a></li>
					<li class="yuimenuitem"><a href="<{$tpl.links.members_get_country}><{$report.school.country}>&amp;list_sr=r&amp;list_order=latest&amp;list_city=<{$report.school.city}>"><{$report.school.countryname}>, <{$report.school.city|upper}> : Most recent reports</a></li>
					<li class="yuimenuitem"><a href="<{$tpl.links.members_get_country}><{$report.school.country}>&amp;list_city=<{$report.school.city}>"><{$report.school.countryname}>, <{$report.school.city|upper}> : Life-Link schools</a></li>
					<li class="yuimenuitem"><a href="<{$tpl.links.members_get_country}><{$report.school.country}>&amp;list_sr=r&amp;list_order=latest"><{$report.school.countryname|upper}> : Most recent reports</a></li>
					<li class="yuimenuitem"><a href="<{$tpl.links.members_get_country}><{$report.school.country}>"><{$report.school.countryname|upper}> : Life-Link schools</a></li>
				</ul>
			</div>
		</div>
	<{else}>
		<a href="<{$tpl.links.member}><{$report.school.schoolnumber}>">Details</a>
	<{/if}>
<{/if}>