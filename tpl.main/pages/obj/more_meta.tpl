{* template for more *}
{if !$smarty.get.skip and !$smarty.get.all}
	<script type="text/javascript">
		more_results_from = 0;
	</script>
{/if}
{foreach from=$items item=$item name=result}
{if $smarty.foreach.result.iteration <= $max_items or $smarty.get.all}
	{include file=$template}
{/if}
{/foreach}
{if ($items|@count gt $max_items) and !$smarty.get.all}
	<script type="text/javascript">
		more_results_from = {$smarty.get.skip + $max_items};
	</script>
	{if !$smarty.get.skip}
		<div id="more_results">
		</div>
	{/if}
{else}
	<script type="text/javascript">
		more_results_from = 0;
	</script>
{/if}
