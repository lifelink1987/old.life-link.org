{foreach from=$latest_reports item=report name=report}
{if $smarty.foreach.report.iteration eq $pagination.reports_in_school and !$smarty.get.all}
	<script type="text/javascript">
		more_results_from = 0;
	</script>
{/if}
{if $smarty.foreach.report.iteration <= $pagination.reports_in_school or $smarty.get.all}
	{include file="/obj/report.tpl"}
{else}
	<script type="text/javascript">
		more_results_from = more_results_from ? more_results_from+{$pagination.reports_in_school} : {$pagination.reports_in_school};
	</script>
	<div id="more_results">
	</div>
{/if}
{/foreach}