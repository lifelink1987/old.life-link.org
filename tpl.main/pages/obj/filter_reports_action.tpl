{if $label}{$label}{else}Based on{/if}
<select name="action" id="form-action">
	<option value="">any Care Action</option>
	{get_actions var=actions}
	{foreach from=$actions item=action name=action}
		{if $action.actions_number % 100 eq 0}
			{if !$smarty.foreach.action.first}</optgroup>{/if}
			{if !$smarty.foreach.action.last}<optgroup label="{$action.action|escape}">{/if}
		{else}
			<option value="{$action.actions_number}"{selected value=$smarty.get.action current=$action.actions_number}>
			{$action.actions_number_nice}
			{$action.action|escape}
			</option>
		{/if}
		{if $smarty.foreach.action.last}</optgroup>{/if}
	{/foreach}
</select>
