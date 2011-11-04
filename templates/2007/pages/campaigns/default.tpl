<div id="related">
  <{include file="official:`$tpl.current`related.tpl"}>
</div>
<div id="llpagetitle">Campaigns</div>
<div id="llpagesubtitle">In the Spotlight</div>
<{if $campaigns_now}>
	<h1>Now &amp; Upcoming</h1>
	<{foreach from=$campaigns_now item=campaign}>
	<{include file="pages/campaign.tpl"}>
	<span class="llclear h30"></span>
	<{/foreach}>
	<span class="llclear h30"></span>
<{/if}>
<{if $campaigns_latest}>
	<h1>Most Recent</h1>
	<{foreach from=$campaigns_latest item=campaign name=campaign}>
	<{include file="pages/campaign.tpl"}>
	<{if !$smarty.foreach.campaign.last}><span class="llclear h30"></span><{/if}>
	<{/foreach}>
<{/if}>