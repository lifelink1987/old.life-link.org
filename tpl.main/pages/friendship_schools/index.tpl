{nocache}
{include file="/obj/js_nivoslider.tpl"}
{/nocache}

<section class="colgroup inline">
	<h1>Life-Link Friendship-Schools</h1>
	{include file="/obj/byline.tpl"}
	<h3 class="center"><em>the</em> Programme</h3>
	<div class="column width75 first">
		<div id="slider" class="bcenter nivoSlider" title="Photos from the latest Action Reports">
			{foreach from=$latest_reports_with_photos item=report name=report}
			{foreach from=$report.media item=media name=media}
				<img src="{$media.uri}/400/240" title="{$report.action_full.0.action}" />
			{/foreach}
			{/foreach}
		</div>
	</div>
	<div class="column width25 statistics">
		<h3>{variable name="countries_counter"} Countries</h3><br />
		<h3>{variable name="schools_counter"} Schools</h3><br />
		<h3>{variable name="reports_counter"} Reports</h3><br />
		<h3>{variable name="actions_counter"} Care Actions</h3>
	</div>
	{include file="/about/prog.tpl"}
	<h1 class="simple"><a href="{$uri.programme}">Read more on the Programme</a> and <a href="{$uri.join}">join</a>!</h1>
</section>
{include file="/obj/section_map.tpl"}
<section>
	<h1>Most Recent Schools</h1>
	{include file="/obj/byline.tpl"}
	<h3 class="center">joining <em>the</em> Programme</h3>
	{foreach from=$latest_schools item=school name=school}
		{include
			file="/obj/school.tpl"}
	{/foreach}
</section>
<section>
	<h1>Most Recent Action Reports</h1>
	{include file="/obj/byline.tpl"}
	<h3 class="center"><em>within the</em> Programme</h3>
	{foreach from=$latest_reports item=report name=report}
		{include file="/obj/report_school.tpl"}
	{/foreach}
</section>