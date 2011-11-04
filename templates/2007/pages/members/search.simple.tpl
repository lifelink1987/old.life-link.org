<a class="llfloatr" href="<{$tpl.links.members}>?search=advanced">Advanced Search</a>
<h1>Browse/Basic Search</h1>
<span class="llclear"></span>
<form method="get" action="<{$tpl.links.members}>" id="form-members-action" anchor="resultsAnchor">
	<input type="hidden" name="sub" id="form-members-action-sub" value="list">
	<input type="hidden" name="guideline" id="form-members-guideline" value="on">
	<input type="hidden" name="list_sr" id="form-members-action-list_sr" value="s">
	<input type="hidden" name="list_order" id="form-members-action-list_order" value="latest">
	<div class="h2">Schools with reports under Guideline Action</div>
	<fieldset>
		<select name="guideline_action" id="form-members-action-guideline_action" class="required">
			<{foreach from=$actions item=action name=action}>
			<{if $action.ischapter}>
			<{if !$smarty.foreach.action.first}></optgroup><{/if}>
			<{if !$smarty.foreach.action.last}><optgroup label="<{$action.name}>"><{/if}>
			<{else}>
			<option value="<{$action.actionnumber_raw}>"<{selected value=$smarty.get.guideline_action current=$action.actionnumber_raw}>><{$action.actionnumber}> <{$action.name}></option>
			<{/if}>
			<{if $smarty.foreach.action.last}></optgroup><{/if}>
			<{/foreach}>
		</select>
		<button type="submit" id="form-members-action-submit">Click!</button>
	</fieldset>
</form>

<span class="llclear h10"></span>
<div class="yui-g">
	<div class="yui-u first">
		<form method="get" action="<{$tpl.links.members}>" id="form-members-country" anchor="resultsAnchor">
			<input type="hidden" name="sub" id="form-members-country-sub" value="list">
			<input type="hidden" name="list_sr" id="form-members-country-list_sr" value="s">
			<input type="hidden" name="list_order" id="form-members-country-list_order" value="alphabetical">
			<div class="h2">Schools in the country of</div>
			<fieldset>
				<select name="list_country" id="form-members-country-list_country" class="required">
					<{foreach from=$countries item=country}>
						<option value="<{$country.codenumber}>"<{if $smarty.get.list_country}><{selected value=$smarty.get.list_country current=$country.codenumber}><{else}><{selected value=$geo->country_code3 current=$country.iso}><{/if}>><{$country.name}></option>
					<{/foreach}>
				</select>
				<button type="submit" id="form-members-country-submit">Click!</button>
			</fieldset>
		</form>
	</div>
	<div class="yui-u">
		<form method="get" action="<{$tpl.links.members}>" id="form-members-schoolnumber" anchor="resultsAnchor">
			<input type="hidden" name="sub" id="form-members-schoolnumber-sub" value="school">
			<div class="h2">School with Life-Link number</div>
			<fieldset>
				<input type="text" name="schoolnumber" id="form-members-schoolnumber-schoolnumber" value="<{$smarty.get.schoolnumber}>" class="numbers required" size="3" maxlength="3">
				<button type="submit" id="form-members-schoolnumber-submit">Click!</button>
			</fieldset>
		</form>
	</div>
</div>

<span class="llclear h10"></span>
<div class="yui-g">
	<div class="yui-u first">
		<form method="get" action="<{$tpl.links.members}>" id="form-members-name" anchor="resultsAnchor">
			<input type="hidden" name="search" value="advanced" id="form-members-name-search">
			<input type="hidden" name="sub" value="name" id="form-members-name-sub">
			<div class="h2">Schools with a name containing</div>
			<fieldset>
				<input type="text" name="namelike" autocomplete="off" value="<{$smarty.get.namelike}>" class="required membername" id="form-members-name-namelike" size="45" maxlength="255">
				<button type="submit" id="form-members-name-submit">Click!</button><br>
				<small>* minimum 3 letters, or simply use numbers</small>
				<div id="form-members-name-namelike-autocomplete" class="autocomplete" rel="<{$tpl.links.member}>"></div>
			</fieldset>
		</form>
	</div>
	<div class="yui-u">
		<form method="get" action="<{$tpl.links.members}>" id="form-members-tag" anchor="resultsAnchor">
			<input type="hidden" name="sub" id="form-members-tag-sub" value="list">
			<input type="hidden" name="list_sr" id="form-members-tag-list_sr" value="s">
			<input type="hidden" name="list_order" id="form-members-tag-list_order" value="alphabetical">
			<input type="hidden" name="tagged" id="form-members-tag-tagged" value="1">
			<div class="h2">Schools part of a campaign/conference</div>
			<fieldset>
				<select name="tag" id="form-members-tag-tag">
					<option value="aspnet">2007-2008 Life-Link &amp; UNESCO ASPnet Project</option> 
				</select>
				<button type="submit" id="form-members-tag-submit">Click!</button>
			</fieldset>
		</form>
	</div>
</div>

<span class="llclear h10"></span>
<form method="get" action="<{$tpl.links.members}>" id="form-members-timespan" anchor="resultsAnchor">
	<input type="hidden" name="sub" id="form-members-timespan-sub" value="list">
	<input type="hidden" name="between" id="form-members-timespan-between" value="on">
	<input type="hidden" name="list_sr" id="form-members-timespan-list_sr" value="r">
	<div class="h2">Action Reports of activities</div>
	<fieldset>
		<select name="between_pr" id="form-members-timespan-between_pr">
			<option value="p"<{selected value=$smarty.get.between_pr current='p'}>>performed</option>
			<option value="r"<{selected value=$smarty.get.between_pr current='r'}>>reported</option>
		</select>
		
		between
		<select name="between_month" id="form-members-timespan-between_month" class="timespan">
			<{foreach from=$months key=month item=monthname name=month}>
			<option value="<{$month}>"<{selected value=$smarty.get.between_month current=$month}>><{$monthname}></option>
			<{/foreach}>
		</select>
		<select name="between_year" id="form-members-timespan-between_year" class="timespan">
			<{foreach from=$years item=year}>
			<option value="<{$year}>"<{selected value=$smarty.get.between_year current=$year}>><{$year}></option>
			<{/foreach}>
		</select>

		and
		<select name="between_and_month" id="form-members-timespan-between_and_month" class="timespan">
			<{foreach from=$months key=month item=monthname name=month}>
			<option value="<{$month}>"<{selected value=$smarty.get.between_and_month current=$month}>><{$monthname}></option>
			<{/foreach}>
		</select>
		<select name="between_and_year" id="form-members-timespan-between_and_year" class="timespan">
			<{foreach from=$years item=year}>
			<option value="<{$year}>"<{selected value=$smarty.get.between_and_year current=$year}>><{$year}></option>
			<{/foreach}>
		</select>
		<button type="submit" id="form-members-timespan-submit">Click!</button>
	</fieldset>
</form>
<script language="JavaScript" type="text/javascript">
	YAHOO.ll.event.pageLoadIndividual.subscribe(function (type, args) {
		var formMembersTimespan = YAHOO.util.Dom.get('form-members-timespan');
		formMembersTimespan.timespanCheck = function() {
			YAHOO.Andrei.field.timespan([this.id+'-between_month', this.id+'-between_year', this.id+'-between_and_month', this.id+'-between_and_year']);
		}
		formMembersTimespan.timespanCheck();
	});
</script>