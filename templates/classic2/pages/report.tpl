<div class="llboxbd llboxlightorange llborderb llroundt">
	<div class="llfloatr">Action #<b><{$report.id}></b></div>
	<{foreach from=$report.actions item=action}>
	<div class="llfloatl">
		<div class="yuimenu sectionlinks">
			<div class="bd">
				<ul>
					<li class="yuimenuitem"><a href="<{$tpl.links.action}><{$action.actionnumber_raw}>"><u>Action <{$action.actionnumber}></u> : <b>Information</b></a></li>
					<li class="yuimenuitem"><a href="<{$tpl.links.members_get}>list&list_sr=r&guideline=<{$action.actionnumber_raw}>"><u>Action <{$action.actionnumber}></u> : <b>Most recent reports</b> on this</a></li>
					<li class="yuimenuitem"><a href="<{$tpl.links.members_get}>list&list_sr=s&guideline=<{$action.actionnumber_raw}>"><u>Action <{$action.actionnumber}></u> : <b>Life-Link schools</b> performing this</a></li>
					<hr>
					<li class="yuimenuitem"><a href="<{$tpl.links.action}><{$action.chapter.actionnumber_raw}>"><u><{$action.chapter.name}></u> : <b>Actions</b> under this chapter</a></li>
					<li class="yuimenuitem"><a href="<{$tpl.links.members_get}>list&list_sr=r&guideline=<{$action.chapter.actionnumber_raw}>"><u><{$action.chapter.name}></u> : <b>Most recent reports</b> on this</a></li>
					<li class="yuimenuitem"><a href="<{$tpl.links.members_get}>list&list_sr=s&guideline=<{$action.chapter.actionnumber_raw}>"><u><{$action.chapter.name}></u> : <b>Life-Link schools</b> performing this</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="llfloatl">
		<span class="h1"><{$action.actionnumber}> - <i><{$action.chapter.name}></i></span>
		<h3><{$action.name}></h3>
	</div>
	<span class="llclear"></span>
	<{/foreach}>
</div>
<div class="llboxbd llboxlightyellow llroundb">
	<{if $report.photos}>
		<div class="llboxwhite llbordert llborderb llborderr llfloatr lloverflow" style="max-height: 90px; min-height: 90px; _height: 90px; width: 80px"><div style="padding-left: 2px; padding-right: 2px">
			<{foreach from=$report.photos item=photo name=photos}>
				<a href="<{$photo.photo}>" rel="lightbox[<{$photo.report_id}>]" title="<{$photo.title}>" icon="none" class="llbordernone"><img src="<{$photo.thumbnail}>" width="50" height="30"></a><br>
			<{/foreach}>
		</div></div>
	<{/if}>
	<div class="llboxwhite llborder summary">
		<div class="llboxbdsmall textsmall">
			<{if $report.actioncontact}>
				<div class="llboxbdsmall llfloatr lltextr llborderl"><h3 class="llinline">Contact Person</h3><br><{$report.actioncontact}></div>
			<{/if}>
			<{$report.description}>
			<{if $report.addinfo}><br><br>
				<h3>Supplimentary</h3>
				<div class="llboxbdsmall llboxlightyellow llborder"><{$report.addinfo}></div>
			<{/if}>
		</div>
	</div>
	<span class="llclear" style="height: 0.5em"></span>
	<{if $report.info}>
		<div class="llboxbdsmall llboxtextwhite llboxblack">
			<b><{$report.info}></b> were involved!
		</div>
	<{/if}>
	<div class="llboxwhite llboxbd llbordert llroundb">
		<div class="llfloatr">Reported on <b><{$report.regdate|date_format:$tpl.date_format}></b></b></div>
		Performed on <b><{$report.perfdate|date_format:$tpl.date_format}></b>
		<{if $report.perfdays > 1}>
			, and the next <{$report.perfdays}> days
		<{/if}>
	</div>
</div>