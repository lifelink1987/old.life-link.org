<div id="related">
  <{include file="official:`$tpl.current`related.tpl"}>
</div>
<div id="llpagesuptitle">Peace Actions</div>
<div id="llpagetitle"><{$chapter.name}></div>
<dl>
<{foreach from=$actions item=action}>
<dt><{$action.actionnumber}></dt>
<dd><a href="<{$tpl.links.action}><{$action.actionnumber_raw}>" class="h2"><{$action.name}></a> <{if $action.old}>OUT OF DATE<{/if}></dd>
<{/foreach}>
</dl>

<{if $reports}>
<span class="llclear h30"></span>
<h1><strong>Examples of reports on this action</strong></h1>
<a href="<{$tpl.links.members_get}>list&amp;list_sr=r&amp;list_order=latest&amp;guideline_action=<{$action.actionnumber_raw}>">Show all reports</a>
&middot; <a href="<{$tpl.links.members_get}>list&amp;guideline_action=<{$action.actionnumber_raw}>">Show all reporting schools</a>
<{foreach from=$reports item=report}>
	<span class="llclear" style="height:2em"></span>
	<{include file="pages/member_report.tpl"}>
<{/foreach}>
<{/if}>
