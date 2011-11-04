<div id="llpagetitle">Want to Join in?</div>
<{if $context}>
	<div id="llpagesubtitle">This registration is part of the <{$context.title}> registration!</div>
<{else}>
	<div id="llpagesubtitle">Is your school already registered and you just want to Report a New Action? <a href="<{$tpl.links.report}>">Click Here!</a></div>
<{/if}>
	
<div id="wait"></div>
<div class="yui-gc">
	<div class="yui-u first" id="results">
		<{include file="`$tpl.current`results.tpl"}>
	</div>
	<div class="yui-u">
		<small><strong>Please fill in the fields on the left.<br>
		Compulsory fields are marked with *.</strong><br><br>
		If something goes wrong, you can always <a href="<{$tpl.links.download}>report/action_report.doc" class="doc">download the form</a> and send it to us by post mail, E-m@il or fax. We would be grateful if you drop us a line telling what went wrong with the online form.</small>
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
		Fax: +46 (0)18 50 85 03
	</div>
</div>