{foreach from=$events item=event name=event}
{if $smarty.foreach.event.iteration eq $pagination.events and !$smarty.get.all}
	<script type="text/javascript">
		more_results_from = 0;
	</script>
{/if}
{if $smarty.foreach.event.iteration <= $pagination.events or $smarty.get.all}
	{include file="/obj/event.tpl"}
{else}
	<script type="text/javascript">
		more_results_from = more_results_from ? more_results_from+{$pagination.events} : {$pagination.events};
	</script>
	<div id="more_results">
	</div>
{/if}
{/foreach}
<div class="first"></div>