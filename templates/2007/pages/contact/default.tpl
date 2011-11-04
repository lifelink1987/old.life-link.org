<div id="llpagetitle">Send a Message<{if $contact}> to <{$contact.firstname}><{/if}></div>
<{if $contact}><div id="llpagesubtitle">to <strong><{$contact.titlename}></strong> - <{$contact.title|replace:"<br />":","}></div><{/if}>

<div id="wait"></div>
<div class="yui-gc">
	<div class="yui-u first" id="results">
		<{include file="`$tpl.current`results.tpl"}>
	</div>
	<div class="yui-u">
		<small><strong>Please fill in the fields on the left.<br>
		Compulsory fields are marked with *.</strong><br><br>
		If something goes wrong, you can always contact us through post mail, E-m@il, telephone or fax.</small>
		<span class="llclear h20"></span>
		<{$tpl.images.leaf}><br>
		<span class="llclear h05"></span>
		<h2>Life-Link Friendship-Schools</h2>
		Uppsala Science Park<br>
		SE-751 83 Uppsala<br>
		SWEDEN
		<span class="llclear h05"></span>
		<div class="hr"></div>
		<span class="llclear h05"></span>
		<a href="mailto:friendship-schools@life-link.org">friendship-schools@life-link.org</a><br>
		Tel: +46 (0)18 50 43 44<br>
		Fax: +46 (0)18 50 85 03
		<div class="hr"></div>
		<span class="llclear h05"></span>
		<h2>Visiting Address</h2>
		Majoren building<br>
		Uppsala Science Park<br>
		Dag Hammarsjölds väg 26<br>
		SE-752 37 Uppsala<br>
		<a href="http://maps.google.com/maps?ie=UTF8&hl=en&view=map&cid=17044912778302789962&q=Life-Link+Friendship-Schools+Association&iwloc=A&ved=0CDIQpQY&sa=X&ei=ljK0TqXNHNeQ_AaU0_g7" title="Google Map"><img src="http://maps.googleapis.com/maps/api/staticmap?center=Dag%20Hammarsk%C3%B6lds%20v%C3%A4g%2026,%20Uppsala,%20Sweden&sensor=false&zoom=15&size=128x128&maptype=hybrid" border="0"></a><br>
		<a href="http://maps.google.com/maps/place?cid=17044912778302789962">Google Places</a>
	</div>
</div>