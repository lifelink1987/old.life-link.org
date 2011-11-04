<{if $chapter.actionnumber_raw == $action.actionnumber_raw}>
	<{include file="`$tpl.current`chapter.tpl"}>
<{else}>
	<div id="pageContentHeader">
		<{include file="official:`$tpl.current`header.tpl"}>
		<ul class="llheaderh llmarginl">
			<li class="lltitle"><{$chapter.name}></li>
			<{foreach from=$actions item=actions_item}>
			<li><a href="<{$tpl.links.action}><{$actions_item.actionnumber_raw}>" title="<{$actions_item.actionnumber}> <{$actions_item.name}><{if $actions_item.old}> OUT OF DATE<{/if}>"><{if $actions_item.old}><strike><{/if}><{$actions_item.actionnumber}><{if $actions_item.old}></strike><{/if}></a></li>
			<{/foreach}>
		</ul>
	</div>
	<div id="pageContentBody">
		<div class="llpagetitle">
			<{$action.actionnumber}>
		</div>
		<div class="llpagesubtitle">
			<{$action.name}>
		</div>
		<{if $action.old}> <br>
		* This action is out of date, so reports should use another action as guideline. <br>
		<{/if}> <br>
		<div class="llfloatl" style="width: 49%">
			<div class="llboxbd textsmall">
				<h1>Theory</h1>
				<{$action.theory}>
			</div>
		</div>
		<div class="llfloatr textsmall" style="width: 49%">
			<div class="llboxbd">
				<h1>Step by Step</h1>
				<{$action.stepbystep}>
			</div>
		</div>
		<div class="llboxlightorange llborderb llroundt llboxbd h1 llclear">
			Action Proposals
		</div>
		<div class="llboxlightyellow llroundb llboxbd">
			<{$action.action}>
		</div>
		<{if $action.addtitle}>
		<div class="llboxlightgrey llborderb llboxbd">
			<h1><{$action.addtitle}></h1>
			<{$action.addinfo}>
		</div>
		<{/if}>

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
<{/if}>