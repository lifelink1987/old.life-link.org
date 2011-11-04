<{if $chapter.actionnumber_raw == $action.actionnumber_raw}>
	<{include file="`$tpl.current`chapter.tpl"}>
<{else}>
	<div id="related">
		<{include file="official:`$tpl.current`related.tpl"}>
		<br>
		<ul>
			<li><{$chapter.name}>
			<ul><li>
			<{foreach from=$actions item=actions_item}>
			<a href="<{$tpl.links.action}><{$actions_item.actionnumber_raw}>" title="<{$actions_item.actionnumber}> <{$actions_item.name}><{if $actions_item.old}> OUT OF DATE<{/if}>"><{if $actions_item.old}><strike><{/if}><{$actions_item.actionnumber}><{if $actions_item.old}></strike><{/if}></a>&nbsp;
			<{/foreach}>
			</li></ul>
			</li>
		</ul>
	</div>
	
	<div id="llpagesuptitle">
		Peace Actions &middot; <{$chapter.name}>
	</div>
	<div id="llpagetitle">
		<{$action.name}>
	</div>
	<div id="llpagesubtitle">
		<{$action.actionnumber}>
		<{if $action.old}>
			&middot; This action is out of date, so reports should use another action as guideline.
		<{else}>
			&middot; <a href="<{$tpl.links.report_get_action}><{$action.actionnumber_raw}>">Report by using this as Guideline Action</a>
		<{/if}>
	</div>
	
	<div class="sb">
		<div class="yui-g">
			<div class="yui-u first">
				<h2>Theory</h2>
				<blockquote class="lltextsmall"><{$action.theory}></blockquote>
			</div>
			<div class="yui-u">
				<h2>Step by Step</h2>
				<blockquote class="lltextsmall"><{$action.stepbystep}></blockquote>
			</div>
		</div>
		
		<h1>Action Proposals</h1>
		<{$action.action}>
	
		<{if $action.addtitle}>
			<h3><{$action.addtitle}></h3>
			<{$action.addinfo}>
		<{/if}>
	</div>

	<{if $reports}>
		<span class="llclear h30"></span>
		<div class="h1"><strong>Examples of reports on this action</strong></div>
		<a href="<{$tpl.links.members_get}>list&amp;list_sr=r&amp;list_order=latest&amp;guideline_action=<{$action.actionnumber_raw}>">Show all reports</a>
		&middot; <a href="<{$tpl.links.members_get}>list&amp;guideline_action=<{$action.actionnumber_raw}>">Show all reporting schools</a>
		<{foreach from=$reports item=report}>
			<span class="llclear" style="height:2em"></span>
			<{include file="pages/report.member.tpl"}>
		<{/foreach}>
	<{/if}>
<{/if}>