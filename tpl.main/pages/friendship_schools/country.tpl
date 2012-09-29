{include file="/obj/js_nivoslider.tpl"}

<section class="colgroup inline">
	<h1>Schools <em>from</em>
		{if $type eq 'city'}{$schools.0.city}, {/if}{$country.country} <img src="{$uri.icon_flag_32}{$country.iso2}" class="icon" />
	</h1>
	{include file="/obj/byline.tpl"}
	<h3 class="center"><em>in the</em> Life-Link Friendship-Schools programme </h3>
	<div class="column width75 first">
		<div id="slider" class="bcenter nivoSlider" title="Photos from the latest Action Reports from {if $type eq 'city'}{$schools.0.city}, {/if}{$country.country_short}">
			{foreach from=$latest_reports_with_photos item=report name=report}
			{foreach from=$report.media item=media name=media}
				<img src="{$media.uri}/400/240" title="{$report.action_full.0.action}" />
			{/foreach}
			{/foreach}
		</div>
		{foreach from=$schools item=school name=school}
			{if $smarty.foreach.school.iteration <= $pagination.schools_in_country or $smarty.get.all}
			{include
				file="/obj/school.tpl"}
			{/if}
		{/foreach}
		{variable name="schools_counter_`$country.iso3`" var="total_schools"}
		{if $schools|@count gt $pagination.schools_in_country and !$smarty.get.all}
			{if $type eq 'country'}
				{include
					file="/obj/row_school.tpl"
					school_name="View all the schools from `$school.country_short`"
					school_link="`$uri.country``$school.country_short`?all=1"
					school_city='&raquo;'
					school_city_link="`$uri.country``$school.country_short`?all=1"}
			{elseif $type eq 'city'}
				{include
					file="/obj/row_school.tpl"
					school_name="View all the schools from `$school.country_short`, `$school.city`"
					school_link="`$uri.country``$school.country_short`/`$school.city`?all=1"
					school_city='&raquo;'
					school_city_link="`$uri.country``$school.country_short`/`$school.city`?all=1"}
			{/if}
		{/if}
	</div>
	<div class="column width25 statistics">
		<h3>{variable name="schools_counter_`$country.iso3`"} Schools</h3>{if $type eq 'city'}in {$country.country}<br />{/if} out of {variable name="schools_counter"}<br />
		<h3>{variable name="reports_counter_`$country.iso3`"} Reports</h3> out of {variable name="reports_counter"}<br />
		<h3>{variable name="actions_counter_`$country.iso3`"} Care Actions</h3> out of {variable name="actions_counter"}<br />
		<h3>Active since<br />{variable name="date_report_first_`$country.iso3`"}</h3> until {variable name="date_report_last_`$country.iso3`"}
	</div>
</section>

<section>
	<h1>Action Reports <em>from</em>
		{if $type eq 'city'}{$schools.0.city}, {/if}{$country.country} <img src="{$uri.icon_flag_32}{$country.iso2}" class="icon" />
	</h1>
	{include file="/obj/byline.tpl"}
	<h3 class="center"><em>in the</em> Life-Link Friendship-Schools programme</h3>
	{foreach from=$latest_reports item=report name=report}
		{include file="/obj/report_school.tpl"}
	{/foreach}
</section>

{if $events}
<section>
	<h1>Events <em>in</em>
		{if $type eq 'city'}{$schools.0.city}, {/if}{$country.country} <img src="{$uri.icon_flag_32}{$country.iso2}" class="icon" />
	</h1>
	{include file="/obj/byline.tpl"}
	{foreach from=$events item=event name=event}
		{include file="/obj/event.tpl"}
	{/foreach}
	<div class="first"></div>
</section>
{/if}

{include file="/obj/section_fb_comments.tpl" fb_comments_id="country_`$country.iso3`" fb_comments_url="`$uri.country``$country.country_short`"}

<section class="colgroup inline">
	<h1>
		{$country.country}
	</h1>
	{include file="/obj/byline.tpl"}
	<h3 class="center">Overview</h3>
	<div class="column width50 first worldbank">
		{if $worldbank}
		<span title="{$worldbank.population_total.year}">Population:</span> {$worldbank.population_total.value|number_format:0:',':' '}<br />
		<span title="{$worldbank.population_rural_percent.year}">Rural population:</span> {$worldbank.population_rural_percent.value|number_format:2:'.':' '}%<br />
		<span title="{$worldbank.population_urban_percent.year}">Urban population:</span> {$worldbank.population_urban_percent.value|number_format:2:'.':' '}%<br />
		<span title="{$worldbank.internet_users_per_100.year}">Internet users:</span> {$worldbank.internet_users_per_100.value|number_format:0:'.':' '} per 100 people<br />
		<br />
		<span title="{$worldbank.land_area.year}">Land area:</span> {$worldbank.land_area.value|number_format:0:'.':' '} km<sup>2</sup><br />
		<span title="{$worldbank.forest_area.year}">Forest area:</span> {$worldbank.forest_area.value|number_format:0:'.':' '} km<sup>2</sup><br />
		<br />
		<span title="{$worldbank.energy_use_per_capita.year}">Energy use:</span> {$worldbank.energy_use_per_capita.value|number_format:0:'.':' '} oil kg per capita<br />
		<span title="{$worldbank.co2_per_capita.year}">CO<sub>2</sub> emmisions:</span> {$worldbank.co2_per_capita.value|number_format:0:'.':' '} metric tons per capita<br />
		<br />
		<span title="{$worldbank.freshwater_annual_total.year}">Freshwater withdrawals:</span> {$worldbank.freshwater_annual_total.value|number_format:0:'.':' '} million m<sup>3</sup> per year<br />
		<span title="{$worldbank.freshwater_renewable_total.year}">Renewable internal freshwater resources:</span> {$worldbank.freshwater_renewable_total.value * 1000|number_format:0:'.':' '} million m<sup>3</sup><br />
		<br />
		<span>Water pollution</span>% of total <a href="http://en.wikipedia.org/wiki/Biochemical_oxygen_demand" title="Biochemical Oxygen Demand">BOD</a> emmisions<br />
		<span title="{$worldbank.water_pollution_chemical_percent.year}">Chemical industry:</span> {$worldbank.water_pollution_chemical_percent.value|number_format:2:'.':' '}%<br />
		<span title="{$worldbank.water_pollution_food_percent.year}">Food industry:</span> {$worldbank.water_pollution_food_percent.value|number_format:2:'.':' '}%<br />
		<span title="{$worldbank.water_pollution_metal_percent.year}">Metal industry:</span> {$worldbank.water_pollution_metal_percent.value|number_format:2:'.':' '}%<br />
		<span title="{$worldbank.water_pollution_textile_percent.year}">Textile industry:</span> {$worldbank.water_pollution_textile_percent.value|number_format:2:'.':' '}%<br />
		<span title="{$worldbank.water_pollution_wood_percent.year}">Wood industry:</span> {$worldbank.water_pollution_wood_percent.value|number_format:2:'.':' '}%
		{else}
			WorldBank data on {$country.country} is not available at the moment.
		{/if}
	</div>
	<div class="column width50">
		<div class="flag"><img src="{$uri.icon_flag_48}{$country.iso2}" /></div>
		<img src="http://maps.google.com/maps/api/staticmap?center={$country.country|escape:'url'}&zoom={$worldbank.map_zoom}&size=282x282&maptype=terrain&sensor=false" class="map" />
	</div>
</section>
<section>
	<h1 class="simple">Explore {$country.country} further on<br/><a href="http://data.worldbank.org/country/{$country.iso2}">WorldBank.org</a> or <a href="http://en.wikipedia.org/wiki/{$country.country}">Wikipedia.org</a></h1>
</section>