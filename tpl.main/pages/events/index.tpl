{nocache}
{include file="/obj/js_form.tpl"}
{title value="`$type` within Life-Link Friendship-Schools"}
{/nocache}

<section class="action">
	<h1>{$type}</h1>
	{include file="/obj/byline.tpl"}
	<h3 class="center"><em>within</em> Life-Link Friendship-Schools</h3>
</section>
<section id="results">
	{include file="/events/index_more.tpl"}
	{if $events|@count gt $pagination.events}
		<h1 class="simple secret" id="more_results_loading">&nbsp;</h1>
		<h1 class="simple" id="more_results_heading">There are more {$type|strtolower} available. See <a href="#" id="more_results_more">more</a> or <a href="?all=1#results" id="more_results_all">all</a>.</h1>
	{/if}
</section>