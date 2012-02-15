<section>
	<h1>Reactions</h1>
	{include file="/obj/byline.tpl"}
	<h3 class="center"><em>to</em> Life-Link Friendship-Schools</h3>
	{foreach from=$reactions item=reaction name=reaction}
		{if $reaction.countries_iso neq $last_countries_iso}
			<br class="clear" /><br />
			<h1 id="{$reaction.country_short}"><em>from</em> {$reaction.country} <img src="{$uri.icon_flag_32}{$reaction.iso2}" class="icon" /></h1>
			{include file="/obj/byline.tpl"}
		{/if}
		<h2>{$reaction.who}</h2>
		{if $reaction.info}<p>{$reaction.info}</p>{/if}
		<blockquote class="post-it"><span>{$reaction.year}</span>{$reaction.reaction|escape|autolink}</blockquote>
		{assign var=last_countries_iso value=$reaction.countries_iso}
	{/foreach}
</section>
<section>
</section>