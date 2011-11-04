<a href="<{$tpl.links.members_get_country}><{$school.country}>" title="Click to see member schools in <{$school.countryname}>" class="llfloatr"><strong><{$school.countryname}></strong>
	<{if $school.countryflag}>
		<img src="<{$tpl.links.flag_get}><{$school.countryflag}>">
	<{/if}>
</a>
<{if !$school.registered}><span class="llfloatr"><small>awaiting approval&nbsp;</small></span><{/if}>
<a href="<{$tpl.links.member}><{$school.schoolnumber}>"><{$school.name}></a>, <a href="<{$tpl.links.members_get_country}><{$school.country}>&list_city=<{$school.city}>" title="Click to see member schools in <{$school.city}>, <{$school.countryname}>"><strong><{$school.city}></strong></a>
<span class="llclear"></span>