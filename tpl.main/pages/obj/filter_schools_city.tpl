{* form filter - school's city *}
{js file="/obj/filter_schools_city.js" merge=true}

{if $label}{$label}{else}in the city of{/if}
<select name="city" id="form-city">
	{get_cities var=cities country=$smarty.get.country}
	{foreach from=$cities item=city name=city}
	<option value="{$city.city}"{selected value=$smarty.get.city current=$city.city}>
	{$city.city}
	</option>
	{/foreach}
</select>
