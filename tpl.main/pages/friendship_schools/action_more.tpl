{foreach from=$latest_reports item=report name=report}
{if $smarty.foreach.report.iteration eq $pagination.reports_in_action and !$smarty.get.all}
	<script type="text/javascript">
		more_results_from = 0;
	</script>
{/if}
{if $smarty.foreach.report.iteration <= $pagination.reports_in_action or $smarty.get.all}
	{include file="/obj/report_school.tpl" show_country=true}
{else}
	<script type="text/javascript">
		more_results_from = more_results_from ? more_results_from+{$pagination.reports_in_action} : {$pagination.reports_in_action};
	</script>
	<div id="more_results">
	</div>
{/if}
{/foreach}