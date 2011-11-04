<{if $result_message}>
	<h3><{$result_message}></h3>
	<div class="hr"></div>
<{/if}>
<{if $result_noform}>
	<{if $smarty.post.report and !$smarty.post.confirmed}>
		<{include file="pages/report/preview.tpl"}>
	<{else}>
		<{assign var='result_noform' value=''}>
		<{assign var='result_message' value=''}>
		<{include file="pages/report.photos/results.tpl"}>
	<{/if}>
<{else}>

<{if $smarty.session.llreport and $smarty.session.unique and not $result_message}>
	You have previously reported another Action. Do you want to add Action Photos to the report? <a href="<{$tpl.links.report_photos}>">Click Here!</a>
<{/if}>
<{assign var='result_message' value=''}>

<span class="llclear h30"></span>
<form method="post" action="<{$tpl.links.report}>" id="form-report" class="major">
<input type="hidden" name="report" id="form-report-report" value="1">

<div class="sb">
	<dl>
		<dt>
			<label for="form-report-schoolnumber">Our school:</label>
			<em>*</em>
		</dt>
		<dd>
			<{if $school}>
				<{$school.city}>, <{$school.countryname|upper}>
				<{if $school.countryflag}>
					<img src="<{$tpl.links.flag_get}><{$school.countryflag}>">
				<{/if}>
				<div class="h1" title="<{$school.name|escape}>"><{$school.name|truncate:40}></div>
				<a href="<{$tpl.links.member}><{$school.schoolnumber}>">List all Action Reports</a>
				<{if $smarty.session.llschoolnumber}>
					&middot; <a href="<{switcher key='llschoolnumber' value='0'}>">This is not my school!</a>
				<{/if}>
				<input type="hidden" name="schoolnumber" id="form-report-schoolnumber" class="required" value="<{$school.schoolnumber}>">
			<{else}>
				<select name="schoolnumber" id="form-report-schoolnumber" tabindex="1" class="required">
					<option value=""></option>
					<optgroup label="<{$schools[0].countryname}>, <{$schools[0].city}>">
						<{assign var="currentcountry" value="`$schools[0].countryname`"}>
						<{assign var="currentcity" value="`$schools[0].city`"}>
						<{foreach from=$schools item=school_item name=school}>
							<{if ($school_item.countryname neq $currentcountry) or ($school_item.city neq $currentcity)}>
								<{if !$smarty.foreach.school.first}></optgroup><{/if}>
								<{if !$smarty.foreach.school.last}><optgroup label="<{$school_item.countryname}>, <{$school_item.city}>"><{/if}>
								<{assign var="currentcountry" value="`$school_item.countryname`"}>
								<{assign var="currentcity" value="`$school_item.city`"}>
							<{/if}>
							<option value="<{$school_item.schoolnumber}>"<{selected value=$smarty.get.schoolnumber current=$school_item.schoolnumber}>><{$school_item.name}></option>
						<{/foreach}>
					</optgroup>
				</select>
			<{/if}>
		</dd>
	</dl>
</div>
<{include file="pages/form.report.tpl"}>

<button type="submit" id="form-report-submit" class="ajax submit" tabindex="70">Press this button to preview your Action Report!</button><br>
<small>We hope you enjoyed your action!</small>
</form>
<{/if}>