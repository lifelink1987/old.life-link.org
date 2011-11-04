<div id="pageContentHeader">
  <{include file="official:`$tpl.current`header.tpl"}>
</div>
<div id="pageContentBody">
  <div class="llpagetitle">
    <{$chapter.name}>
  </div>
  <ul class="llbullets llbulletred">
    <{foreach from=$actions item=action}>
    <li><span class="h3"><{$action.actionnumber}></span> <a href="<{$tpl.links.action}><{$action.actionnumber_raw}>"><{$action.name}></a> <{if $action.old}>OUT OF DATE<{/if}></li>
    <{/foreach}>
  </ul>

	<{if $reports}> <span class="llclear" style="height: 3em"></span>
	<h1>Examples of reports on this action</h1>
	<a href="<{$tpl.links.members_get}>list&list_sr=r&list_order=latest& guideline_action=<{$action.actionnumber_raw}>" class="llbutton">Show all</a>
	<a href="<{$tpl.links.members_get}>list&guideline_action=<{$action.actionnumber_raw}>" class="llbutton">Life-Link schools performing this</a>
	<{foreach from=$reports item=report}>
		<span class="llclear" style="height:1.5em"></span>
		<{include file="pages/member_report.tpl"}>
	<{/foreach}>
	<{/if}>
</div>
