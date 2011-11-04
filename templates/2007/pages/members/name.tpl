<div id="llpagetitle">Schools &amp; Actions</div>
<form method="get" action="<{$tpl.links.members}>" id="form-members-name" anchor="resultsAnchor">
	<input type="hidden" name="search" value="advanced">
	<input type="hidden" name="sub" value="name">
	<div class="h2">Schools that have the word</div>
	<fieldset>
		<input type="text" name="namelike" autocomplete="off" value="<{$smarty.get.namelike}>" class="required" maxlength="255"> inside their name<button type="submit" id="form-members-name-submit">Click!</button><br>
		<small>* minimum 3 letters, or simply use numbers</small>
	</fieldset>
</form>
<span class="llclear h10"></span>
<a name="resultsAnchor"></a>
<div class="llfloatr">COUNTRY</div>
School Name, CITY
<span class="llclear"></span>
<div class="hr"></div>
<{foreach from=$schools item=school}>
	<{include file="pages/members/list/item_school.tpl"}>
<{/foreach}>