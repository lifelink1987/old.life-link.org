<div id="pageContentHeader">
  <{include file="official:`$tpl.current`header.tpl"}>
</div>
<div id="pageContentBody">
	<div class="llpagetitle">Board Meetings</div>
	<{include file="pages/paging_header.tpl"}>
	<{if $posts}>
	<{foreach from=$posts item=post}>
	<{include file="pages/live/appendix/item.tpl"}>
	<{/foreach}>
	<{/if}>
	<{include file="pages/paging_footer.tpl"}>
</div>
