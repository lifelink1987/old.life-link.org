<div class="yui-gf" style="padding-left: 6px; padding-right: 6px">
	<div class="yui-u first">
	</div>
	<div class="yui-u">
		<div class="llfloatr">
			<{include file="pages/sectionlinks.member.report.tpl"}>
		</div>
		<div class="llfloatl">
			<span class="h2"><strong title="<{$report.school.name|escape}>"><{$report.school.name|truncate:60}></strong></span><br>
			in <{$report.school.city}>, <{$report.school.countryname|upper}>
			<{if $report.school.countryflag}>
				<img src="<{$tpl.links.flag_get}><{$report.school.countryflag}>">
			<{/if}>
		</div>
	</div>
</div>
<span class="llclear"></span>
<{include file="pages/report.tpl"}>
