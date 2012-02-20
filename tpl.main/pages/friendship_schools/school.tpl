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
		<h3>{$school.count_reports} Reports</h3> out of {variable name="reports_counter"}<br />
		<h3>{$school.count_actions} Care Actions</h3> out of {variable name="actions_counter"}<br />
		{if $school.students}<h3>cca. {$school.students} Students</h3>{if $school.students_age}aged {$school.students_age}<br />{/if}{/if}
		{if $school.teachers}<h3>cca. {$school.teachers} Teachers</h3>{/if}
	</div>
	<h2>Nearby schools</h2>
		{foreach from=$nearby_schools item=school name=school}
			{include
				file="/obj/school_country.tpl"}
		{/foreach}
</section>
<section>
	<h1><a href="#">Report new action</a> or <a href="#">update school information</a>.</h1>
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
{include file="/obj/section_fb_comments.tpl" fb_comments_id="school_`$school.member_schools_number`" fb_comments_url="`$uri.school``$school.member_schools_number`"}
