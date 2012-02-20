{nocache}
{js file="/obj/filter_period.js" merge=true}
{/nocache}

{if $label}{$label}{else}Between{/if}<br />
<select name="after" id="form-after">
	{get_months var=months}
	{get_years var=years start=1998}
	{foreach from=$years item=year}
	<optgroup label="{$year}">
	{foreach from=$months key=month item=month_name name=month}
	<option value="{$month+1}.{$year}"{selected value=$smarty.get.after current="`$month+1`.`$year`"}>
	{$month_name|substr:0:3}
	'{$year|substr:2:2}
	</option>
	{/foreach}
	</optgroup>
	{/foreach}
</select>
and
<select name="before" id="form-before">
	{foreach from=$years item=year}
	<optgroup label="{$year}">
	{foreach from=$months key=month item=month_name}
	<option value="{$month+1}.{$year}"{selected value=$smarty.get.before current="`$month+1`.`$year`"}{if !$smarty.get.before}{selected value=$smarty.foreach.month.iteration current=$smarty.foreach.month.total}{/if}>
	{$month_name|substr:0:3}
	'{$year|substr:2:2}
	</option>
	{/foreach}
	</optgroup>
	{/foreach}
</select>
