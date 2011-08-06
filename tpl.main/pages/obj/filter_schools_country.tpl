{if $label}{$label}{else}In{/if}
<select name="country" id="form-country">
	<option value="">any country</option>
	{get_countries var=countries}
	{foreach from=$countries item=country name=country}
	<option value="{$country.countries_iso}" style="background:url({$uri.icon_flag_16}{$country.iso2}) no-repeat;"{selected value=$smarty.get.country current=$country.countries_iso}>
	{$country.country}
	</option>
	{/foreach}
</select>
