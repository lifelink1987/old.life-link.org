<div id="pageContentBody">
	<div class="llpagetitle">
		Reactions
	</div>
	<div class="llpagesubtitle">
		on Life-Link
	</div>
	<{if $country_selected}>
		<div class="llpagesubtitle">from <{$country_selected}></div>
		<span class="llclear" style="height: 1em"></span>
	<{/if}>
	<form method="get" action="<{$tpl.links.reactions}>" id="form_reactions">
		<fieldset>
			<div class="llboxlightyellow llborderb llroundt llboxbd">
				Show reactions from
				<select name="country" style="width: 225px">
					<option value="">the whole world</option>
					<{foreach from=$countries item=country}>
					<option value="<{$country.codenumber}>"<{selected value=$smarty.get.country current=$country.codenumber}>><{$country.name}></option>
					<{/foreach}>
				</select>
				<button type="submit">Go!</button>
			</div>
		</fieldset>
	</form>
	<br>
	<a name="results"></a>
	<{include file="pages/paging_header.tpl"}>
	<{foreach from=$reactions item=country_reactions key=country}>
	<{include file="pages/country_reactions.tpl"}>
	<{/foreach}>
	<{include file="pages/paging_footer.tpl"}> 
</div>