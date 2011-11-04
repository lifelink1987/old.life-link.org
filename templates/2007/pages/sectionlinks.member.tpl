<{if !$nosectionlinks}>
	<{if $smarty.session.lltemplatelevel > 0}>
		<div class="yuimenu sectionlinks">
			<div class="bd">
				<ul>
					<li class="yuimenuitem"><a href="<{$tpl.links.members_get_country}><{$school.country}>&list_sr=r&list_order=latest&list_city=<{$school.city}>"><{$school.countryname|upper}>, <{$school.city}> : Most recent reports</a></li>
					<li class="yuimenuitem"><a href="<{$tpl.links.members_get_country}><{$school.country}>&list_city=<{$school.city}>"><{$school.countryname|upper}>, <{$school.city}> : Life-Link schools</a></li>
					<li class="yuimenuitem"><a href="<{$tpl.links.members_get_country}><{$school.country}>&list_sr=r&list_order=latest"><{$school.countryname|upper}> : Most recent reports</a></li>
					<li class="yuimenuitem"><a href="<{$tpl.links.members_get_country}><{$school.country}>"><{$school.countryname|upper}> : Life-Link schools</a></li>
				</ul>
			</div>
		</div>
	<{/if}>
<{/if}>