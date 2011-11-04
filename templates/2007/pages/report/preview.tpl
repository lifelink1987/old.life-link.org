<span class="llclear h30"></span>

<div class="lltextsmall">
	<{assign var='nosectionlinks' value=true}>
	<{include file="pages/report.member.tpl"}>
</div>

<span class="llclear h10"></span>
<form method="post" action="<{$tpl.links.report}>" id="form-report" class="major">
	<input type="hidden" name="confirmed" id="form-report-confirmed" value="1">
	
	<{foreach from=$default item=defaultitem key=defaultkey}>
		<input type="hidden" name="<{$defaultkey}>" value="<{$defaultitem}>">
	<{/foreach}>

	<dl>
		<dt>
			<label for="form-report-catpcha">Signature:</label>
			<em>*</em>
		</dt>
		<dd>
			<div class="yui-g">
				<div class="yui-u first">
					<input type="text" name="captcha" id="form-report-captcha" class="captcha required" tabindex="58" autocomplete="off" maxlength="5"><br>
					<small>as a mean of signing, please write above<br><strong>the letters you read on the right</strong></small>
				</div>
				<div class="yui-u">
					<img src="<{$tpl.links.captcha}>" alt="Signature" id="form-report-captcha-image">
				</div>
			</div>
		</dd>
	</dl>

	If everything looks in order
	<button type="submit" id="form-report-submit" class="ajax submit">Press this button to confirm this Action Report!</button><br>
	<small>We hope you enjoyed your action!</small>
</form>

<div class="hr"></div>
<span class="llclear h30"></span>
<form method="post" action="<{$tpl.links.report}>" id="form-report-edit" class="major lltextsmall">
	<input type="hidden" name="edit" id="form-report-edit-edit" value="1">
	
	<{foreach from=$default item=defaultitem key=defaultkey}>
		<input type="hidden" name="<{$defaultkey}>" value="<{$defaultitem}>">
	<{/foreach}>
	
	If not, and you want to change something<br>
	<button type="submit" id="form-report-edit-submit" class="ajax submit">Press this button to edit this Action Report!</button>
</form>