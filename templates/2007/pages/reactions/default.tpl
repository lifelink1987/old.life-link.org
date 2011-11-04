<div id="llpagetitle">Reactions</div>
<div id="filters">
	<form method="get" action="<{$tpl.links.reactions}>" id="form-reactions" anchor="resultsAnchor">
		<fieldset>
			from
			<select name="country" id="form-reactions-country">
				<option value="">the whole world</option>
				<{foreach from=$countries item=country}>
				<option value="<{$country.codenumber}>"<{selected value=$smarty.get.country current=$country.codenumber}>><{$country.name}></option>
				<{/foreach}>
			</select>
			<button type="submit" class="ajax" id="form-reactions-submit">Click!</button>
		</fieldset>
	</form>
</div>
<a name="resultsAnchor"></a>
<div id="wait"></div>
<div id="results">
	<{include file="`$tpl.current`results.tpl"}>
</div>