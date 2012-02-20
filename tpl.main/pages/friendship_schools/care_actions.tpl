{nocache}
{title value="Care Actions"}
{/nocache}

<section>
	<h1>Care Actions</h1>
	{include file="/obj/byline.tpl"}
	{include file="/about/prog.tpl"}
	{include file="/friendship_schools/excerpt/how_to_perform.tpl"}
</section>
<section>
	<h1>Care <em>for</em> Myself</h1>
	{include file="/obj/byline.tpl"}
	{get_actions var=actions}
	{foreach from=$actions item=action name=action}
		{if $action.actions_number > 100 and $action.actions_number < 200}
		<h2><a href="{$action.link}">{$action.actions_number}</a><a href="{$action.link}">{$action.action}</a></h2>
		<ul>{$action.description_theory|escape|nl2li|autolink}</ul>
		{/if}
	{/foreach}
</section>
<section>
	<h1>Care <em>for</em> Others</h1>
	{include file="/obj/byline.tpl"}
	{get_actions var=actions}
	{foreach from=$actions item=action name=action}
		{if $action.actions_number > 200 and $action.actions_number < 300}
		<h2><a href="{$action.link}">{$action.actions_number}</a><a href="{$action.link}">{$action.action}</a></h2>
		<ul>{$action.description_theory|escape|nl2li|autolink}</ul>
		{/if}
	{/foreach}
</section>
<section>
	<h1>Care <em>for</em> Nature</h1>
	{include file="/obj/byline.tpl"}
	{get_actions var=actions}
	{foreach from=$actions item=action name=action}
		{if $action.actions_number > 300 and $action.actions_number < 400}
		<h2><a href="{$action.link}">{$action.actions_number}</a><a href="{$action.link}">{$action.action}</a></h2>
		<ul>{$action.description_theory|escape|nl2li|autolink}</ul>
		{/if}
	{/foreach}
</section>
<section>
	<h1>Let's Get Organised!</h1>
	{include file="/obj/byline.tpl"}
	{get_actions var=actions}
	{foreach from=$actions item=action name=action}
		{if $action.actions_number > 400 and $action.actions_number < 500}
		<h2><a href="{$action.link}">{$action.actions_number}</a><a href="{$action.link}">{$action.action}</a></h2>
		<ul>{$action.description_theory|escape|nl2li|autolink}</ul>
		{/if}
	{/foreach}
</section>
<section>
	<h1 class="simple"><a href="{$uri.programme}">Read more on the Life-Link Friendship-Schools Programme</a>.</h1>
</section>