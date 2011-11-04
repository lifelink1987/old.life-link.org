<div id="llpagetitle">Schools &amp; Actions</div>
<{include file="`$tpl.current`search.tpl"}>
<span class="llclear h10"></span>
<form method="get" action="<{$tpl.links.report}>" id="form-members-report">
<div class="h2">Report a new Action performed by School</div>
<fieldset>
	<select name="schoolnumber" id="form-members-report-schoolnumber" class="required">
		<option value=""></option>
		<optgroup label="<{$schools_cc[0].countryname}>, <{$schools_cc[0].city}>">
			<{assign var="currentcountry" value="`$schools_cc[0].countryname`"}>
			<{assign var="currentcity" value="`$schools_cc[0].city`"}>
			<{foreach from=$schools_cc item=school name=school}>
				<{if ($school.countryname neq $currentcountry) or ($school.city neq $currentcity)}>
					<{if !$smarty.foreach.school.first}></optgroup><{/if}>
					<{if !$smarty.foreach.school.last}><optgroup label="<{$school.countryname}>, <{$school.city}>"><{/if}>
					<{assign var="currentcountry" value="`$school.countryname`"}>
					<{assign var="currentcity" value="`$school.city`"}>
				<{/if}>
				<option value="<{$school.schoolnumber}>"<{selected value=$smarty.get.schoolnumber current=$school.schoolnumber}>><{$school.name}></option>
			<{/foreach}>
		</optgroup>
	</select>
	<button type="submit" id="form-members-report-submit">Fill in Report Form</button>
</fieldset>
</form>

<span class="llclear h10"></span>
<form method="get" action="<{$tpl.links.join}>" id="form-members-join">
<div class="h2">Want to join in?</div>
<fieldset>
	<button type="submit" id="form-members-join-submit">Fill in Application Form</button>
</fieldset>
</form>
