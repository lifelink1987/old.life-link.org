<section>
	<h1>{$title}</h1>
	{include file="/obj/byline.tpl"}
	<h3 class="center">Not Found</h3>
	<p>{$message}</p>
	{if $suggestions}
		<h2>Suggestions</h2>
		<p>
			{foreach from=$suggestions item=suggestion}
				<a href="{$suggestion.link}">{$suggestion.title}</a>
			{/foreach}
		</p>
	{/if}
</section>
