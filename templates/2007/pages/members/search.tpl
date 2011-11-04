<{if $result_message}>
	<h3><{$result_message|escape:"html"}></h3>
	<div class="hr"></div>
<{/if}>
<{if $smarty.get.search neq "advanced"}>
	<{include file="`$tpl.current`search.simple.tpl"}>
<{else}>

<a class="llfloatr" href="<{$tpl.links.members}>">Basic Search</a>
<h1>Advanced Search</h1>
<span class="llclear"></span>
<form method="get" action="<{$tpl.links.members}>" id="form-advanced" anchor="resultsAnchor">
	<input type="hidden" name="search" value="advanced">
	<input type="hidden" name="sub" value="list">
	<fieldset>
		<{include file="`$tpl.current`search.advanced.tpl"}>
		<button type="submit" class="llfloatr" id="form-advanced-submit">Click!</button>
	</fieldset>
</form>

<span class="llclear h10"></span>
<div class="yui-gc">
	<div class="yui-u first">
		<form method="get" action="<{$tpl.links.members}>" id="form-members-name" anchor="resultsAnchor">
			<input type="hidden" name="search" value="advanced" id="form-members-name-search">
			<input type="hidden" name="sub" value="name" id="form-members-name-sub">
			<div class="h2">Schools that have this word/phrase inside their name</div>
			<fieldset>
				<input type="text" name="namelike" autocomplete="off" value="<{$smarty.get.namelike}>" class="required membername" id="form-members-name-namelike" size="50" maxlength="255">
				<button type="submit" id="form-members-name-submit">Click!</button><br>
				<small>* minimum 3 letters, or simply use numbers</small>
				<div id="form-members-name-namelike-autocomplete" class="autocomplete" rel="<{$tpl.links.member}>"></div>
			</fieldset>
		</form>
	</div>
	<div class="yui-u">
		<form method="get" action="<{$tpl.links.members}>" id="form-members-schoolnumber" anchor="resultsAnchor">
			<input type="hidden" name="sub" id="form-members-schoolnumber-sub" value="school">
			<div class="h2">School with Life-Link number</div>
			<fieldset>
				<input type="text" name="schoolnumber" id="form-members-schoolnumber-schoolnumber" value="<{$smarty.get.schoolnumber}>" class="numbers required" size="3" maxlength="3">
				<button type="submit" id="form-members-schoolnumber-submit">Click!</button><br>
				<small>&nbsp;</small>
			</fieldset>
		</form>
	</div>
</div>
<{/if}>
