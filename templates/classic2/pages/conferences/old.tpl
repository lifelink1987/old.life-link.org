<div id="pageContentHeader">
  <{include file="official:`$tpl.current`header.tpl"}>
</div>
<div id="pageContentBody">
	<div class="llpagetitle">Previous</div>
	<{if $conferences}>
		<a name="results"></a>
		<div class="llboxlightyellow llround llboxbd">
			<{include file="pages/paging_header.tpl"}>
			<{foreach from=$conferences item=conference name=conference}>
			<{include file="pages/conference.tpl"}>
			<{if !$smarty.foreach.conference.last}><span class="llclear" style="height: 1em"></span><{/if}>
			<{/foreach}>
			<{include file="pages/paging_footer.tpl"}>
		</div>
	<{/if}>
</div>