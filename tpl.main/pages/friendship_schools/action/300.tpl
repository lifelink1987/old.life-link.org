{title value="Care for Nature"}

<section>
	<h1>Care <em>for</em> Nature</h1>
	{include file="/obj/byline.tpl"}
	{get_actions var=actions}
	{foreach from=$actions item=action name=action}
		{if $action.actions_number > 300 and $action.actions_number < 400}
		<h2><a href="{$action.link}">{$action.actions_number_nice}</a><a href="{$action.link}">{$action.action}</a></h2>
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