<div id="pageContentBody">
		<div class="llpagetitle">
			Schools &amp; Actions
		</div>
		<{include file="`$tpl.current`search.tpl"}>
		<form method="get" action="<{$tpl.links.report}>" id="form_members_simple_report" class="horizontalForm" anchor="results">
		<fieldset class="llmarginl">
		<legend class="h1"><button type="submit">Report</button> a new action</legend>
		<div class="llboxlightyellow llboxbd llroundt llborderb">
			<label for="report_schoolnumber">
				on behalf of school
				<select name="schoolnumber" id="report_schoolnumber">
					<{assign var="currentcountry" value="`$schools[0].countryname`"}>
					<{foreach from=$schools_cc item=school name=school}>
					<{if $school.countryname neq $currentcountry}>
						<{if !$smarty.foreach.school.first}></optgroup><{/if}>
						<{if !$smarty.foreach.school.last}><optgroup label="<{$school.countryname}>"><{/if}>
						<{assign var="currentcountry" value="`$school.countryname`"}>
					<{else}>
						<option value="<{$school.schoolnumber}>"<{selected value=$smarty.get.schoolnumber current=$school.schoolnumber}>><{$school.city}>, <{$school.name}></option>
					<{/if}>
					<{if $smarty.foreach.school.last}></optgroup><{/if}>
					<{/foreach}>
				</select>
			</label>
			<span class="llclear"></span>
		</div>
		</fieldset>
		</form>
</div>
