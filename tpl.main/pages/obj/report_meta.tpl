{* template for report *}
{js file="/obj/report.js" merge=true}
{css file="/obj/report.css"}

<div class="row_report_alone{if $show_full} row_report_alone_full{/if}">
	<div class="row_report">
		{include file="/obj/row_report_date_logo.tpl"}
		{if $show_full}
		<div class="line first report">
			<span>&nbsp;</span>
			<span class="justify">{$report_description|escape|nl2br|autolink}</span>
		</div>
		{else}
		{include file="/obj/row_report_description.tpl"}
		{/if}
		{include file="/obj/row_report_action.tpl"}
		{include file="/obj/row_report_numbers_contact.tpl"}
		{if $report_feedback}
			{include file="/obj/row_report_feedback.tpl"}
		{/if}
		{include file="/obj/row_report_attachments.tpl"}
	</div>
	{if $show_school}
		{include
			file="/obj/row_school.tpl"
			show_country=true
			school_number=$report.member_schools_number
			school_name=$report.school
			school_link="`$uri.school``$report.member_schools_number`"
			school_city=$report.city
			school_city_link="`$uri.country``$report.country_short|escape:'url'`/`$report.city|escape:'url'`"
			school_country=$report.country_short
			school_country_link="`$uri.country``$report.country_short|escape:'url'`"
			school_flag="`$uri.icon_flag_16``$report.iso2`"}
	{/if}
</div>