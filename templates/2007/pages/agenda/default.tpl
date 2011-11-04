<div id="llpagetitle">Agenda</div>
<div class="yui-g">
	<div class="yui-u first">
		<h3>Recently on the Agenda</h3>
		<{foreach from=$recent_agenda item=event}>
		<{include file="pages/event.tpl"}>
		<{/foreach}>
	</div>
	<div class="yui-u">
		<h3>Next on the Agenda</h3>
		<{foreach from=$future_agenda item=event}>
		<{include file="pages/event.tpl"}>
		<{/foreach}>
	</div>
</div>

<span class="llclear h20"></span>

<h1>Browse by month</h1>
<a name="resultsAnchor"></a>
<div id="wait"></div>
<div id="results" style="overflow:auto">
	<{include file="`$tpl.current`results.tpl"}>
</div>