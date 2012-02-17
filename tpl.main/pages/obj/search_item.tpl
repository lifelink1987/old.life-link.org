{if $smarty.get.type eq 'school'}
	{include file="/obj/school.tpl" school=$result}
{else}
	{include file="/obj/report_school.tpl" report=$result}
{/if}