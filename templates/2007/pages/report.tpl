
<div class="sb">
	<div class="yui-gf">
		<div class="yui-u first lltextc">
			<{if $report.id}>
				<{if $report.registered && ($report.school.registered || $school.registered)}>
					report no.
					<div class="h1"><{$report.id}></div>
				<{else}>
					report no. <{$report.id}>
					<div class="h2">awaiting approval</div>
				<{/if}>
			<{else}>
				report no. ***
				<div class="h2">awaiting approval</div>
			<{/if}>
		</div>
		<div class="yui-u">
			<{foreach from=$report.actions item=action}>
				<div class="llfloatr">
					<{include file="pages/sectionlinks.action.tpl"}>
				</div>
				<{$action.actionnumber}> <span class="h2" title="<{$action.name|escape}>"><{$action.name|truncate:50}></span>
				<span class="llclear"></span>
			<{/foreach}>
			Action<{if $smarty.now|date_format:"%Y-%m-%d" < $report.perfdate}> to be<{/if}> performed on <strong><{$report.perfdate|date_format:$tpl.date_format}></strong>
			<{if $report.perfdays > 1}>
				, and the next <{$report.perfdays}> days
			<{/if}>
		</div>
	</div>
	<blockquote>
		<{if $report.media}>
			<div class="llfloatr summary nomousescroll" style="width: 70px">
				<{foreach from=$report.media item=mediafile}>
					<a href="<{$mediafile.url}>" rel="lightbox[<{$mediafile.report_id}>]" title="<{$mediafile.title}>" class="llbordernone"><img src="<{$mediafile.thumbnail}>" width="50" height="30" alt="<{$mediafile.title}>"></a><br>
				<{/foreach}>
			</div>
		<{/if}>
		<div class="lltextsmall summary lljustify">
			<{$report.description}>
			<{if $report.addinfo}>
				<span class="llclear h20"></span>
				<div class="h2">Supplimentary</div>
				<div class="llpaddingl"><{$report.addinfo}></div>
			<{/if}>
		</div>
		<span class="llclear h05"></span>
		<{if $report.actioncontact}>
			<div>
				<small>You can contact <{$report.actioncontact}> in order to ask specific questions about this action.</small>
			</div>
		<{/if}>
		<div class="yui-gd">
			<div class="yui-u first">
				<small>Reported on <strong><{$report.regdate|date_format:$tpl.date_format}></strong></small>
			</div>
			<div class="yui-u">
			<{if $report.info}>
				<strong><{$report.info}></strong> <small>were involved!</small>
			<{/if}>
			</div>
		</div>
	</blockquote>
</div>