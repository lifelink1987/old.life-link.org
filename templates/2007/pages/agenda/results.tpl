<h3><{$monthtitle}> <{$year}></h3>
<ul class="llheaderh" id="paging-header">
	<li><a href="<{$tpl.links.agenda}>?month=<{$prevmonth}>&amp;year=<{$prevyear}>#resultsAnchor">&laquo; <{$prevmonthtitle}> <{$prevyear}></a></li>
	<li><a href="<{$tpl.links.agenda}>?month=<{$nextmonth}>&amp;year=<{$nextyear}>#resultsAnchor"><{$nextmonthtitle}> <{$nextyear}> &raquo;</a></li>
	<span class="llclear"></span>
</ul>
<span class="llclear"></span>

<{foreach from=$calendar item=event}>
<{include file="pages/event.tpl"}>
<{/foreach}>