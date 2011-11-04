<{include file="pages/paging.header.tpl"}>
<{if $posts}>
<{foreach from=$posts item=post}>
<{if $post.attachments}>
	<{include file="`$tpl.current`appendix/item.tpl"}>
<{/if}>
<span class="llclear h20"></span>
<{/foreach}>
<{/if}>
<{include file="pages/paging.footer.tpl"}>