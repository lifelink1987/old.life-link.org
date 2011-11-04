<div class="h1"><{$country}></div>
<{foreach from=$country_reactions item=reaction name=reaction}>
	<{if !$smarty.foreach.reaction.first}><span class="llclear" style="height:1em"></span><{/if}>
	<{include file="pages/reaction.tpl"}>
<{/foreach}>