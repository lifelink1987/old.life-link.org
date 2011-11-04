<{include file="pages/paging.header.tpl"}>
<{if $schools}>
	<div class="llfloatr">COUNTRY</div>
	School Name, CITY
	<span class="llclear"></span>
	<div class="hr"></div>
	<{foreach from=$schools item=school}>
	<{include file="pages/members/list/item_school.tpl"}>
	<{/foreach}>
<{elseif $reports}>
	<{foreach from=$reports item=report}>
	<span class="llclear h30"></span>
	<{include file="pages/report.member.tpl"}>
	<{/foreach}>
<{/if}>
<{include file="pages/paging.footer.tpl"}>