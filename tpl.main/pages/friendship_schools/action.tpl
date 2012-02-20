{nocache}
{include file="/obj/js_nivoslider.tpl"}
{include file="/obj/js_form.tpl"}
{related tag="`$action.theme.actions_number`"}
{if $action.tags}
	{related tags=$action.tags multiple=true}
{/if}
{/nocache}

<section class="colgroup inline theory_step">
	<h1>{$action.actions_number_nice} {$action.action|escape}</h1>
	{include file="/obj/byline.tpl"}
	<h3 class="center"><a href="{$report.action.theme.link}">{$action.theme.action|escape}</a></h3>
	<div class="column width50 first justify">
		<h2><em>in</em> Theory</h2>
		<ul>
			{$action.description_theory|escape|nl2li|autolink}
		</ul>
	</div>
	<div class="column width50 justify">
		<h2>Step <em>by</em> Step</h2>
		<ul>
			{$action.description_stepbystep|escape|nl2li|autolink}
		</ul>
	</div>
</section>
<section class="action">
	<h1><em>in</em> Action</h1>
	{include file="/obj/byline.tpl"}
	<h3 class="center">Concrete proposals <em>to</em> enact {$action.action|escape}</h3>
	<ul>
		{$action.description_action|escape|nl2li|autolink}
	</ul>
</section>
{if $delicious}
<section>
	<h1>Attachments</h1>
	{include file="/obj/byline.tpl"}
	{foreach from=$delicious item=link name=link}
		{include file="/obj/link.tpl"}
	{/foreach}
	<div class="first"></div>
</section>
{/if}
<section>
	<h1 id="reports">Action Reports</h1>
	{include file="/obj/byline.tpl"}
	<h3 class="center"><em>of</em> {$action.action|escape}</h3>
	{if !$smarty.get.all}
		<form method="GET" class="filter">
			<input type="hidden" name="filter" value="1">
			{include file="/friendship_schools/action_filter.tpl"}
			<input type="submit" class="unitx1" value="Filter" />
		</form>
	{/if}
	{include file="/obj/report.tpl" show_full=true show_school=true report=$latest_reports|@array_shift}
	{include file="/friendship_schools/action_more.tpl"}
	{if $latest_reports|@count gt $pagination.reports_in_action}
		<h1 class="simple secret" id="more_results_loading">&nbsp;</h1>
		<h1 class="simple" id="more_results_heading">There are more reports available. See <a href="#" id="more_results_more">more</a> or <a href="?all=1#reports" id="more_results_all">all</a>.</h1>
	{/if}
</section>
{include file="/obj/section_fb_comments.tpl" fb_comments_id="action_`$action.actions_number`" fb_comments_url=$action.link}
<section>
	<h1 class="simple">Explore other <a href="{$uri.theme}{$action.theme.link}">{$action.theme.action}</a> Care Actions.</h1>
</section>