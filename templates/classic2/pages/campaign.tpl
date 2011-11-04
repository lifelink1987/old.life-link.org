<div class="llboxbd llboxlightorange llroundt h3">
	<{$campaign.title}>
	<{if $campaign.subtitle}>
		<div class="textsmall"><{$campaign.subtitle}></div>
	<{/if}>
</div>
<div class="llboxblack llboxtextwhite llpaddingl">
	<{$campaign.startdate|date_format:$tpl.date_format}>
	<{if $campaign.startdate != $campaign.enddate}>
		- <{$campaign.enddate|date_format:$tpl.date_format}>
	<{/if}>
</div>
<div class="llboxwhite llroundb">
	<{if $campaign.logo}>
		<div class="llfloatr llboxbd">
			<img class="llboxwatergrey llborder" src="<{$tpl.links.campaigns_get}>logo&id=<{$campaign.id}>">
		</div>
	<{/if}>
	<div class="lljustify llboxbd"><{$campaign.description}></div>
	<ul class="llbullets llbulletnone llmarginl">
		<{if $campaign.gallery_slug}>
			<li><a href="<{$tpl.links.gallery_get}><{$campaign.gallery_slug}>" target="_blank">This conference has Photos! Check them out!</a></li>
		<{/if}>
	</ul>
	<span class="llclear" style="height: 0.5em"></span>
</div>