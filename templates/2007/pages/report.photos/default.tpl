<div id="llpagetitle">Action Report</div>

<{if $school and $report}>
	<div id="llpagesubtitle">Would you like to add Action Photos to your most recent Report? &middot; <a href="#report"> Review the Action Report</a></div>
<{/if}>

<div id="wait"></div>
<a name="resultsAnchor"></a>
<div class="yui-gc">
	<div class="yui-u first" id="results">
		<{include file="`$tpl.current`results.tpl"}>
	</div>
	<div class="yui-u">
		<small><strong>Please fill in the fields on the left.<br>
		Compulsory fields are marked with *.</strong><br><br>
		If something goes wrong, you can always send your action photos by post mail or E-m@il. Remember to attach the Report Number! We would be grateful if you drop us a line telling what went wrong with the online form.</small>
		<span class="llclear h20"></span>
		<{$tpl.images.leaf}>
		<span class="llclear h05"></span>
		<h2>Life-Link Friendship-Schools</h2>
		Uppsala Science Park<br>
		SE-751 83 Uppsala<br>
		SWEDEN
		<span class="llclear h05"></span>
		<div class="hr"></div>
		<span class="llclear h05"></span>
		<a href="mailto:actions@life-link.org">actions@life-link.org</a><br>
		JPEG images only
	</div>
</div>

<{if $school and $report}>
	<span class="llclear h30"></span>
	<span class="llclear h30"></span>
	<a name="report"></a>
	<{assign var='nosectionlinks' value=true}>
	<{include file="pages/report.member.tpl"}>
<{/if}>