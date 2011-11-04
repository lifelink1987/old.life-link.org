<div id="pageContentHeader">
  <{include file="official:`$tpl.current`header.tpl"}>
</div>
<div id="pageContentBody">
	<div class="llpagetitle">Previous</div>
	<{if $campaigns}>
		<a name="results"></a>
		<div class="llboxlightyellow llround llboxbd">
			<{include file="pages/paging_header.tpl"}>
			<{foreach from=$campaigns item=campaign name=campaign}>
			<{include file="pages/campaign.tpl"}>
			<{if !$smarty.foreach.campaign.last}><span class="llclear" style="height: 1em"></span><{/if}>
			<{/foreach}>
			<{include file="pages/paging_footer.tpl"}>
		</div>
	<{/if}>
</div>