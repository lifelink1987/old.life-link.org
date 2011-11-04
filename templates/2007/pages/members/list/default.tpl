<div id="llpagetitle">Schools &amp; Actions</div>
<div id="llpagesubtitle">Search results for</div>
<form method="get" action="<{$tpl.links.members}>" id="form-advanced" anchor="resultsAnchor">
	<input type="hidden" name="sub" value="list">
	<fieldset>
		<{include file="`$tpl.current`search.advanced.tpl"}>
		<button type="submit" class="ajax llfloatr" id="form-advanced-submit">Click!</button>
	</fieldset>
</form>
<span class="llclear h10"></span>
<a name="resultsAnchor"></a>
<div id="wait"></div>
<div id="results">
	<{include file="`$tpl.current`list/results.tpl"}>
</div>
