<div class="llboxbd llboxlightorange llroundt h3">
	<{$conference.title}>
	<{if $conference.major_title}>
		<div class="textsmall"><{$conference.major_title}></div>
	<{/if}>
</div>
<div class="llboxblack llboxtextwhite llpaddingl">
	<{$conference.countryname|upper}> - <{$conference.startdate|date_format:$tpl.date_format}>
	<{if $conference.startdate != $conference.enddate}>
		- <{$conference.enddate|date_format:$tpl.date_format}>
	<{/if}>
</div>
<div class="llboxwhite llroundb">
	<{if $conference.logo}>
		<div class="llfloatr llboxbd">
			<img class="llboxwatergrey llborder" src="<{$tpl.links.conferences_get}>logo&id=<{$conference.id}>">
		</div>
	<{/if}>
	<div class="lljustify llboxbd"><{$conference.description}></div>
	<ul class="llbullets llbulletnone llmarginl">
		<{if $conference.gallery_slug}>
			<li><a href="<{$tpl.links.gallery_get}><{$conference.gallery_slug}>" target="_blank">This conference has Photos! Check them out!</a></li>
		<{/if}>
	</ul>
	<span class="llclear" style="height: 0.5em"></span>
</div>
