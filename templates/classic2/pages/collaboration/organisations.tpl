<div id="pageContentHeader">
  <{include file="official:`$tpl.current`header.tpl"}>
</div>
<div id="pageContentBody">
	<div class="llpagetitle">Organisations</div>
	<form method="get" action="<{$tpl.links.collaboration}>" id="form_organisations">
		<fieldset>
			<div class="llboxlightyellow llborderb llroundt llboxbd">
				<input type="hidden" name="sub" value="organisations">
				Show only the organisations which have
				<input type="text" name="namelike" value="<{$smarty.request.namelike}>">
				in their name.<br>
				They must also have <input type="checkbox" name="email"<{if $smarty.request.email}> checked<{/if}>>
				<label for="email">an E-m@il address</label>
				and/or <input type="checkbox" name="website"<{if $smarty.request.website}> checked<{/if}>>
				<label for="website">a website address</label>
			</div>
			<div class="llboxlightgrey llroundb llboxbd">
				<button type="submit">Go!</button>
			</div>
		</fieldset>
	</form>
	<br>
	<a name="results"></a>
	<{include file="pages/paging_header.tpl"}>
	<{foreach from=$organisations item=organisation}>
	<br>
	<{include file="pages/organisation.tpl"}>
	<{/foreach}>
	<{include file="pages/paging_footer.tpl"}> 
</div>