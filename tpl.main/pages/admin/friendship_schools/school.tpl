{css file="/css/source/admin.css"}
{include file="/obj/js_form.tpl"}
<section>
	<h1>#{$school.member_schools_number}{if $reports[0].datetime_approval} on <a href="{$uri.school}{$school.member_schools_number}">Life-Link.org</a>{/if}</h1>
	{include file="/obj/byline.tpl"}
	<h3 class="center">{$school.school}, {$school.city}, {$school.country}</h3>
</section>
<section>
	{include file="/obj/js_form.tpl"}
	<form method="POST" id="schoolform">
		<input type="hidden" name="save" value="1">
		<label class="width2">
			Name
			<input type="text" name="school" id="form-school" value="{$school.school}" required="required">
		</label>
		
		<div class="first"></div>
		<label class="width2">
			Postal address (not visiting address)
			<input type="text" name="address" id="form-address" value="{$school.address}" required="required">
			<span>Street name &amp; number OR P.O. Box</span>
		</label>
		<label class="width1">
			Zipcode
			<input type="text" name="zipcode" id="form-zipcode" value="{$school.address_zipcode}" required="required">
		</label>
		
		<div class="first"></div>
		<label class="width1">
			City
			<input type="text" name="city" id="form-city" value="{$school.city}" required="required">
		</label>
		<label class="width1 optional">
			County [optional]
			<input type="text" name="county" id="form-county" value="{$school.county}">
		</label>
		<label class="width1">
			Country
			<select name="country" id="form-country" required="required">
				{get_countries var=countries}
				{foreach from=$countries item=country name=country}
				<option value="{$country.countries_iso}" style="background:url({$uri.icon_flag_16}{$country.iso2}) no-repeat;"{selected value=$school.countries_iso current=$country.countries_iso}>
				{$country.country}
				</option>
				{/foreach}
			</select>
		</label>
		
		<div class="first"></div>
		<label class="unitx3">
			Email address(es)
			<input type="text" name="email" id="form-email" value="{$school.email}" required="required">
			<span>address@email.com, second.address@email.com</span>
		</label>
		<label class="unitx3 optional">
			Website address [optional]
			<input type="text" name="website" id="form-website" value="{$school.website}">
			<span>www.website.com</span>
		</label>
		
		<div class="first"></div>
		<label class="unitx3 optional">
			Phone number(s) [optional]
			<input type="text" name="tel" id="form-tel" value="{$school.tel}">
			<span>+country area local</span>
		</label>
		<label class="unitx3 optional">
			Fax number(s) [optional]
			<input type="text" name="fax" id="form-fax" value="{$school.fax}">
			<span>+country area local</span>
		</label>
		
		<div class="first"></div>
		<label class="unitx3">
			Student(s)
			<input type="text" name="junior" id="form-junior" value="{$school.contact_junior}" required="required">
			<span>Mr. First Family, Mr. First Family</span>
		</label>
		<label class="unitx3 optional">
			and their Email address(es) [optional]
			<input type="text" name="junior-email" id="form-junior-email" value="{$school.contact_junior_email}" required="required">
			<span>address@email.com, second.address@email.com</span>
		</label>
		<div class="first"></div>
		<label class="unitx3">
			Teacher(s)
			<input type="text" name="senior" id="form-senior" value="{$school.contact_senior}" required="required">
			<span>Mr. First Family, Mr. First Family</span>
		</label>
		<label class="unitx3 optional">
			and their Email address(es) [optional]
			<input type="text" name="senior-email" id="form-senior-email" value="{$school.contact_senior_email}" required="required">
			<span>address@email.com, second.address@email.com</span>
		</label>
		
		<div class="first"></div>
		<label class="unitx1">
			Students #
			<input type="text" name="students" id="form-students" value="{$school.students}" required="required">
		</label>
		<label class="unitx1">
			Age of students
			<input type="text" name="students-age" id="form-students-age" value="{$school.students_age}" required="required">
			<span>12-15</span>
		</label>
		<label class="unitx1">
			Teachers #
			<input type="text" name="teachers" id="form-teachers" value="{$school.teachers}" required="required">
		</label>
		<label class="unitx1">
			Registered on
			<input type="text" value="{$school.datetime_registration|dateformat:'%Y-%m-%d'}" readonly="readonly">
		</label>
		{if $school.datetime_update}
			<label class="unitx1">
				Updated on
				<input type="text" value="{$school.datetime_update|dateformat:'%Y-%m-%d'}" readonly="readonly">
			</label>
		{/if}
		{if $reports|@count > 0}
			<label class="unitx1 highlight">
				{if $school.datetime_approval}Approved on{else}Approved{/if}
				<select type="text" name="datetime-approval" id="form-datetime-approval">
					{if $school.datetime_approval}
						<option value="">{$school.datetime_approval|dateformat:'%Y-%m-%d'}</option>
						<option value="0">Unapprove</option>
					{else}
						<option value="">No</option>
						<option value="1">Yes</option>
					{/if}
				</select>
			</label>
			
			<script type="text/javascript">
				$('#form-datetime-approval').change(function() {
					($(this).val() == '')?$('#form-datetime-approval-change').show():$('#form-datetime-approval-change').hide();
				});
			</script>

			<div class="first"></div>
			<div id="#form-datetime-approval-change" class="highlight" style="display:none">
				Changing approval status will send out an automatic email (to all the above address and friendship-schools@life-link.org).<br/>
				<label class="width1">
					Your email address
					<input type="email" name="reply-from" id="form-reply-from" value="{$reply_form}" />
				</label>
				<label class="width2">
					Personal message
					<textarea name="reply" id="form-reply" maxlength="255" rows="3">{$reply}</textarea>
				</label>
			</div>
		{/if}
		
		<div class="first"></div>
		<input type="submit" class="unitx1" value="Save" />
	</form>
</section>
{if $reports|@count <= 1}
	<section>
		<h1>#{$reports.0.member_reports_id}{if $reports.0.datetime_approval} on <a href="{$reports.0.link}">Life-Link.org</a>{/if}</h1>
		{include file="/obj/byline.tpl"}
		<h3 class="center">{$reports.0.actions_full.0.action}</h3>
		{include file="/admin/friendship_schools/report_form.tpl" report=$reports.0}
		{if !$reports.0.datetime_approval}<br />Pressing the Save button above, after choosing Approved:Yes for the action report, will automatically approve the school registration as well.{/if}
	</section>
{else}
	<section>
		<form method="GET">
			<input type="hidden" name="search" value="1">
			<label class="unitx1 first right">Reports</label>
			<label for="form-action" class="unitx1">
				{include file="/obj/filter_reports_action.tpl"}
			</label>
			<label for="form-period" class="width1 double">
				{include file="/obj/filter_period.tpl" label="Performed between"}
			</label>
			<input type="submit" class="unitx1" value="Filter" />
		</form>
	</section>
	<section id="results">
		{include file="/admin/friendship_schools/school_more.tpl"}
		{if $reports|@count gt $pagination.reports_in_admin}
			<h1 class="simple secret" id="more_results_loading">&nbsp;</h1>
			<h1 class="simple" id="more_results_heading">There are {$count} schools in total, <span id="more_results_from">{$reports|@count-1}</span> showing. See <a href="#" id="more_results_more">more</a>.</h1>
		{/if}
	</section>
{/if}