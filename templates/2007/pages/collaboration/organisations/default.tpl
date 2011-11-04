<div id="related">
  <{include file="official:`$tpl.current`related.tpl"}>
</div>
<div id="llpagesuptitle">Collaboration</div>
<div id="llpagetitle">Organisations</div>
<div id="filters">
	<form method="get" action="<{$tpl.links.collaboration}>" id="form-organisations" anchor="resultsAnchor">
		<input type="hidden" name="sub" id="form-organisations-sub" value="organisations">
		<fieldset class="yui-gb">
			<div class="yui-u first">
				with the word/phrase<br>
				<input type="text" name="namelike" id="form-organisations-namelike" size="20" maxlength="255" value="<{$smarty.request.namelike}>">
				<label for="form-organisations-namelike">in the title</label>
			</div>
			<div class="yui-u">
				with
				<input type="checkbox" name="email" id="form-organisations-email"<{if $smarty.request.email}> checked<{/if}>>
				<label for="form-organisations-email">an E-m@il address</label><br>
				with
				<input type="checkbox" name="website" id="form-organisations-website"<{if $smarty.request.website}> checked<{/if}>>
				<label for="form-organisations-website">a website</label>
			</div>
			<div class="yui-u">
				<button type="submit" class="ajax" id="form-organisations-submit">Click!</button>
			</div>
		</fieldset>
	</form>
</div>
<a name="resultsAnchor"></a>
<div id="wait"></div>
<div id="results">
	<{include file="`$tpl.current`organisations/results.tpl"}>
</div>