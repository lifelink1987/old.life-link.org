<div id="related">
  <{include file="official:`$tpl.current`related.tpl"}>
</div>
<div id="llpagetitle">Conferences</div>
<div id="llpagesubtitle">In the Spotlight</div>
<{if $conferences_now}>
	<h1>Now &amp; Upcoming</h1>
	<{foreach from=$conferences_now item=conference}>
	<{include file="pages/conference.tpl"}>
	<span class="llclear h30"></span>
	<{/foreach}>
	<span class="llclear h30"></span>
<{/if}>
<{if $conferences_latest}>
	<h1>Most Recent</h1>
	<{foreach from=$conferences_latest item=conference name=conference}>
	<{include file="pages/conference.tpl"}>
	<{if !$smarty.foreach.conference.last}><span class="llclear h30"></span><{/if}>
	<{/foreach}>
<{/if}>