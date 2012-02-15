{include file="/obj/js_nivoslider.tpl"}
{include file="/obj/js_form.tpl"}
<section class="sidebar contact">
	<h1>Contact <em>the</em> School</h1>
	<div>
		{if $report.contact}
			<h2>Action Coordinator</h2>
			<a href="mailto:{$report_contact_email}">{$report_contact}</a>
		{/if}
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
		{if $school.county}{$school.county}, {/if}{$school.country}
	</div>
</section>
<section>
	<h1>Action Report #{$report.member_reports_id}</h1>
	{include file="/obj/byline.tpl"}
	<h3 class="center"><em>from</em> <a href="{$uri.school}{$school.member_schools_number}">{$school.school|escape}</a><br />
		<em>in</em> <a href="{$uri.city}{$school.country}/{$school.city}">{$school.city}</a>, <a href="{$uri.city}{$school.country}">{$school.country}</a> <img src="{$uri.icon_flag_16}{$school.iso2}" class="icon" /></h3>
	{include file="/obj/report.tpl" show_full=true}
</section>
<section>
	<h1 class="simple">Explore <a href="{$report.actions_full.0.link}">{$report.actions_full.0.action|truncate:40:'...'}</a>.</h1>
</section>