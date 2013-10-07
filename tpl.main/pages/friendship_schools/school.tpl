{include file="/obj/js_nivoslider.tpl"}
{include file="/obj/js_form.tpl"}
{if $school.tags}
	{related tags=$school.tags multiple=true}
{/if}

<section class="sidebar contact">
	<h1>Contact <em>this</em> School</h1>
	<div>
		{if $school.contact_junior or $school.contact_senior}
			<h2>Life-Link People</h2>
			{if $school.contact_junior}
				{if $school.email_contact_junior}
				<a href="mailto:{$school.email_contact_junior}">{$school.contact_junior}</a>
				{else}
				{$school.contact_junior}
				{/if}
				{if $school.email_contact_senior}, {/if}
			{/if}
			{if $school.contact_senior}
				{if $school.email_contact_senior}
				<a href="mailto:{$school.email_contact_senior}">{$school.contact_senior}</a>
				{else}
				{$school.contact_senior}
				{/if}
			{/if}
		{/if}
		{if $school.email}<h2><em>by</em> Email</h2>{$school.email}{/if}
		{if $school.website}<h2><em>by</em> WWW</h2><a href="http://{$school.website}">{$school.website}</a>{/if}
		{if $school.tel}<h2><em>by</em> Tel</h2>{$school.tel}{/if}
		{if $school.fax}<h2><em>by</em> Fax</h2>{$school.fax}{/if}
		<h2><em>by</em> Post</h2>{$school.address}<br />
		{$school.address_zipcode} {$school.city}<br />
		{if $school.county}{$school.county}<br />{/if}
		{$school.country}
	</div>
</section>

<section class="colgroup inline box_school">
	<h1>{$school.school|escape}</h1>
	{include file="/obj/byline.tpl"}
	<h3 class="center"><em>in</em> <a href="{$uri.city}{$school.country_short}/{$school.city}">{$school.city}</a>, <a href="{$uri.city}{$school.country_short}">{$school.country_short}</a> <img src="{$uri.icon_flag_16}{$school.iso2}" class="icon" /></h3>
	<div class="column width75 first">
		<div id="slider" class="bcenter nivoSlider" title="Photos from the latest action reports from {$school.school|escape}">
			{foreach from=$latest_reports_with_photos item=report name=report}
			{foreach from=$report.media item=media name=media}
				<img src="{$media.uri}/400/240" title="{$report.action_full.0.action}" />
			{/foreach}
			{/foreach}
		</div>
	</div>
	<div class="column width25 statistics">
		<h3>Life-Link School #{$school.member_schools_number}</h3>
		<h3>{$school.count_reports} Report{if $school.count_reports > 1}s{/if}</h3> out of {variable name="reports_counter"}<br />
		<h3>{$school.count_actions} Care Action{if $school.count_actions > 1}s{/if}</h3> out of {variable name="actions_counter"}<br />
		{if $school.students}<h3>cca. {$school.students} Student{if $school.students > 1}s{/if}</h3>{if $school.students_age}aged {$school.students_age}<br />{/if}{/if}
		{if $school.teachers}<h3>cca. {$school.teachers} Teacher{if $school.teachers > 1}s{/if}</h3>{/if}
		<h3>Active since<br />{$school.date_report_first}</h3><!-- until {$school.date_report_last}-->
	</div>
</section>

<section>
	<h1><a href="{$uri.report_gdoc}&entry_19={$school.email|escape:'url'}&entry_1={$school.member_schools_number|escape:'url'}">Report new action</a> or <a href="{$uri.report_gdoc}&entry_19={$school.email|escape:'url'}&entry_1={$school.member_schools_number|escape:'url'}&entry_4=403&entry_5=NA&entry_6=NA&entry_7=NA&entry_8=NA&entry_9=NA&entry_0={$school.school|escape:'url'}&entry_2={$school.city|escape:'url'}&entry_3={$school.country|escape:'url'}&entry_15={$school.address|escape:'url'}&entry_16={$school.address_zipcode|escape:'url'}&entry_17={$school.tel|escape:'url'}&entry_20={$school.contact_senior|escape:'url'}&entry_18={$school.email_contact_senior|escape:'url'}&entry_24={$school.contact_junior|escape:'url'}&entry_22={$school.email_contact_junior|escape:'url'}">update school information</a>.</h1>
</section>

<section>
	<h1 id="reports">Action Reports</h1>
	{include file="/obj/byline.tpl"}
	{if !$smarty.get.all}
		<form method="GET" class="filter">
			<input type="hidden" name="filter" value="1">
			{include file="/friendship_schools/school_filter.tpl"}
			<input type="submit" class="unitx1" value="Filter" />
		</form>
	{/if}
	{include file="/obj/report.tpl" show_full=true report=$latest_reports|@array_shift}
	{include file="/friendship_schools/school_more.tpl"}
	{if $latest_reports|@count gt $pagination.reports_in_school}
		<h1 class="simple secret" id="more_results_loading">&nbsp;</h1>
		<h1 class="simple" id="more_results_heading">There are more reports available. See <a href="#" id="more_results_more">more</a> or <a href="?all=1#reports" id="more_results_all">all</a>.</h1>
	{/if}
</section>

{if $events}
<section>
	<h1>Events</h1>
	{include file="/obj/byline.tpl"}
	{foreach from=$events item=event name=event}
		{include file="/obj/event.tpl"}
	{/foreach}
	<div class="first"></div>
</section>
{/if}

<section>
	<h1>Nearby schools</h1>
		{assign var="original_school" value=$school}
		{foreach from=$nearby_schools item=school name=school}
			{include
				file="/obj/school_country.tpl"}
		{/foreach}
		{assign var="school" value=$original_school}
</section>

{include file="/obj/section_fb_comments.tpl" fb_comments_id="school_`$school.member_schools_number`" fb_comments_url="`$uri.school``$school.member_schools_number`"}
