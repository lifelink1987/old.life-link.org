<div class="llboxbd llboxlightorange llround">
	<h1><{$organisation.name}></h1>
	<div class="llboxbd llboxwhite llroundt">
		<div class="llfloatl" style="width: 49%">
			<b>Website</b>: <{$organisation.website}><br>
			<b>E-m@il</b>: <{$organisation.email}>
		</div>
		<div class="llfloatr" style="width: 49%">
			<b>Tel</b>: <{$organisation.tel}><br> 
			<b>Fax</b>: <{$organisation.fax}>
		</div>
		<span class="llclear"></span>
	</div>
	<div class="llboxbd llboxlightyellow llroundb llbordert lljustify textsmall">
		<{$organisation.address}>
	</div>
	<{if $organisation.addinfo}>
		<div class="textsmall llboxbd llboxtextblack"><{$organisation.addinfo}></div>
	<{/if}>
	<span class="llclear"></span>
</div>
