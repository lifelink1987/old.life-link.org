<!--List Type-->
<select name="list_sr" id="form-advanced-list_sr">
	<option value="s"<{selected value=$smarty.get.list_sr current='s'}>>Schools</option>
	<option value="r"<{selected value=$smarty.get.list_sr current='r'}>>Reports</option>
</select>
<!--List Type end-->
in
<!--Countries-->
<select name="list_country" id="form-advanced-list_country" style="width: 200px">
	<option value="">all of the countries</option>
	<{foreach from=$countries item=country}>
		<option value="<{$country.codenumber}>"<{selected value=$smarty.request.list_country current=$country.codenumber}>><{$country.name}></option>
	<{/foreach}>
</select>
<!--Countries end-->
<!--Cities-->
<select name="list_city" id="form-advanced-list_city" style="width: 150px" class="list_city">
	<option value="">all of the cities</option>
	<{foreach from=$cities item=city}>
	<option value="<{$city}>"<{selected value=$smarty.get.list_city current=$city}>><{$city}></option>
	<{/foreach}>
</select>
<!--Cities end-->
ordered by
<!--List Order-->
<select name="list_order" id="form-advanced-list_order">
	<option value="alphabetical"<{selected value=$smarty.get.list_order current='alphabetical'}>>schools' name</option>
	<option value="latest"<{selected value=$smarty.get.list_order current='latest'}>>most recent reports</option>
</select>
<!--List Order end-->
<span class="llclear h05"></span>

<input type="checkbox" name="guideline" id="form-advanced-guideline"<{checked value=$smarty.get.guideline}>> <label for="form-advanced-guideline">Only (with) Reports under Guideline Action</label>
<select name="guideline_action" id="form-advanced-guideline_action" style="width: 400px">
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

<input type="checkbox" name="between" id="form-advanced-between" for="list"<{checked value=$smarty.get.between}>> <label for="form-advanced-between">Only (with) Reports of activities</label>
<select name="between_pr" id="form-advanced-between_pr">
	<option value="p"<{selected value=$smarty.get.between_pr current='p'}>>performed</option>
	<option value="r"<{selected value=$smarty.get.between_pr current='r'}>>reported</option>
</select>

between
<select name="between_month" id="form-advanced-between_month" class="timespan">
	<{foreach from=$months key=month item=monthname name=month}>
	<option value="<{$month}>"<{selected value=$smarty.get.between_month current=$month}>><{$monthname}></option>
	<{/foreach}>
</select>
<select name="between_year" id="form-advanced-between_year" class="timespan">
	<{foreach from=$years item=year}>
	<option value="<{$year}>"<{selected value=$smarty.get.between_year current=$year}>><{$year}></option>
	<{/foreach}>
</select>

and
<select name="between_and_month" id="form-advanced-between_and_month">
	<{foreach from=$months key=month item=monthname name=month}>
	<option value="<{$month}>"<{selected value=$smarty.get.between_and_month current=$month}>><{$monthname}></option>
	<{/foreach}>
</select>
<select name="between_and_year" id="form-advanced-between_and_year" class="timespan">
	<{foreach from=$years item=year}>
	<option value="<{$year}>"<{selected value=$smarty.get.between_and_year current=$year}>><{$year}></option>
	<{/foreach}>
</select>
<span class="llclear h05"></span>
<!--
<input type="checkbox" name="photos" id="form-advanced-photos"<{checked value=$smarty.get.photos}>> <label for="form-advanced-photos">Only (with) Reports with Photos</label>
<span class="llclear h05"></span>-->

<input type="checkbox" name="tagged" id="form-advanced-tagged"<{checked value=$smarty.get.tagged}>> <label for="form-advanced-tagged">Only Schools part of a campaign/conference</label>
<select name="tag" id="form-advanced-tag">
	<option value="aspnet"<{selected value=$smarty.get.tag current="aspnet"}>>2007-2008 Life-Link &amp; UNESCO ASPnet Project</option>
</select>
<span class="llclear h05"></span>

<input type="checkbox" name="all" id="form-advanced-all"<{checked value=$smarty.get.all}>> <label for="form-advanced-all">Show all on one page (No paging)</label>

<script language="JavaScript" type="text/javascript">
	YAHOO.ll.event.pageLoadIndividual.subscribe(function (type, args) {
		var formAdvanced = YAHOO.util.Dom.get('form-advanced');
		formAdvanced.timespanCheck = function() {
			YAHOO.Andrei.field.timespan([this.id+'-between_month', this.id+'-between_year', this.id+'-between_and_month', this.id+'-between_and_year']);
		}
		formAdvanced.timespanCheck();
	});
</script>