<form method="get" action="<{$tpl.links.members}>" id="form-school" anchor="resultsAnchor">
	<input type="hidden" name="sub" id="form-school-sub" value="school">
	<input type="hidden" name="schoolnumber" id="form-school-schoolnumber" value="<{$school.schoolnumber}>">
	<fieldset>
		<input type="checkbox" name="guideline" id="form-school-guideline"<{checked value=$smarty.get.guideline}>> <label for="form-school-guideline">Only Reports under Guideline Action</label>
		<select name="guideline_action" id="form-school-guideline_action" style="width: 400px">
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
		<span class="llclear h05"></span>
		
		<input type="checkbox" name="between" id="form-school-between" for="list"<{checked value=$smarty.get.between}>> <label for="form-school-between">Only Reports of activities</label>
		<select name="between_pr" id="form-school-between_pr">
			<option value="p"<{selected value=$smarty.get.between_pr current='p'}>>performed</option>
			<option value="r"<{selected value=$smarty.get.between_pr current='r'}>>reported</option>
		</select>

		between
		<select name="between_month" id="form-school-between_month" class="timespan">
			<{foreach from=$months key=month item=monthname name=month}>
			<option value="<{$month}>"<{selected value=$smarty.get.between_month current=$month}>><{$monthname}></option>
			<{/foreach}>
		</select>
		<select name="between_year" id="form-school-between_year" class="timespan">
			<{foreach from=$years item=year}>
			<option value="<{$year}>"<{selected value=$smarty.get.between_year current=$year}>><{$year}></option>
			<{/foreach}>
		</select>

		and
		<select name="between_and_month" id="form-school-between_and_month">
			<{foreach from=$months key=month item=monthname name=month}>
			<option value="<{$month}>"<{selected value=$smarty.get.between_and_month current=$month}>><{$monthname}></option>
			<{/foreach}>
		</select>
		<select name="between_and_year" id="form-school-between_and_year" class="timespan">
			<{foreach from=$years item=year}>
			<option value="<{$year}>"<{selected value=$smarty.get.between_and_year current=$year}>><{$year}></option>
			<{/foreach}>
		</select>
		<span class="llclear h05"></span>
		
		<input type="checkbox" name="photos" id="form-school-photos"<{checked value=$smarty.get.photos}>> <label for="form-school-photos">Only Reports with Photos</label>
		<span class="llclear h05"></span>
		<button type="submit" class="ajax llfloatr" id="form-school-submit">Click!</button>
		
		<input type="checkbox" name="all" id="form-school-all"<{checked value=$smarty.get.all}>> <label for="form-school-all">Show all Reports on one page (No paging)</label>
	</fieldset>
</form>
<script language="JavaScript" type="text/javascript">
	YAHOO.ll.event.pageLoadIndividual.subscribe(function (type, args) {
		var formSchool = YAHOO.util.Dom.get('form-school');
		formSchool.timespanCheck = function() {
			YAHOO.Andrei.field.timespan([this.id+'-between_month', this.id+'-between_year', this.id+'-between_and_month', this.id+'-between_and_year']);
		}
		formSchool.timespanCheck();
	});
</script>
