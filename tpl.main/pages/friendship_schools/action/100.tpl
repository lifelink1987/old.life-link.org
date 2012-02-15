{title value="Care for Myself"}
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
	{include file="/friendship_schools/excerpt/how_to_perform.tpl"}
</section>
<section>
	<h1 class="simple">
		Care for <a href="{$uri.theme_1}">Myself</a>, <a href="{$uri.theme_2}">Others</a>, <a href="{$uri.theme_3}">Nature</a>,<br />
		and <a href="{$uri.theme_4}">Let's Get Organised!</a>
	</h1>
</section>