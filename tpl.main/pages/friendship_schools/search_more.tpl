{foreach from=$results item=result name=result}
{if $smarty.foreach.result.iteration eq $pagination.results_in_search}
	<script type="text/javascript">
		more_results_from = 0;
	</script>
{/if}
{if $smarty.foreach.result.iteration <= $pagination.results_in_search}
	{if $smarty.get.type eq 'school'}
		{include file="/obj/school.tpl" school=$result}
	{else}
		{include file="/obj/report_school.tpl" report=$result}
	{/if}
{else}
	<script type="text/javascript">
		more_results_from = more_results_from ? more_results_from+{$pagination.results_in_search} : {$pagination.results_in_search};
	</script>
	<div id="more_results">
	</div>
{/if}
{/foreach}