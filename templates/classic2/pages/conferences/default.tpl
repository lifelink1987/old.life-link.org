<div id="pageContentHeader">
  <{include file="official:`$tpl.current`header.tpl"}>
</div>
<div id="pageContentBody">
	<div class="llpagetitle">In the Spotlight</div>
	<{if $conferences_now}>
	<div class="llboxlightyellow llround llboxbd">
		<{foreach from=$conferences_now item=conference}>
		<{include file="pages/conference.tpl"}>
		<span class="llclear" style="height: 1em"></span>
		<{/foreach}>
	</div>
	<span class="llclear" style="height: 2em"></span>
	<{/if}>
	<{if $conferences_latest}>
	<div class="llboxlightyellow llborderb llroundt llboxbd h1">
		Most Recent
	</div>
	<div class="llboxlightyellow llroundb llboxbd">
		<{foreach from=$conferences_latest item=conference name=conference}>
		<{include file="pages/conference.tpl"}>
		<{if !$smarty.foreach.conference.last}><span class="llclear" style="height: 1em"></span><{/if}>
		<{/foreach}>
	</div>
	<{/if}>
</div>