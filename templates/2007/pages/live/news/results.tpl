<{include file="pages/paging.header.tpl"}>
<{if $posts}>
<{foreach from=$posts item=post}>
<{include file="`$tpl.current`news/item.tpl"}>
<span class="llclear h20"></span>
<{/foreach}>
<{/if}>
<{include file="pages/paging.footer.tpl"}>