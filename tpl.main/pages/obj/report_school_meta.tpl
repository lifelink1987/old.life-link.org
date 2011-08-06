{js file="/obj/report.js" merge=true}
{css file="/css/source/report.css"}
<div class="row_report_school">
	<div class="row_report">
		{include file="/obj/row_report_date_logo.tpl"}
		{include file="/obj/row_report_description.tpl"}
		{include file="/obj/row_report_action.tpl"}
		{include file="/obj/row_report_numbers_contact.tpl"}
	</div>
	{include
		file="/obj/row_school.tpl"
		show_country=true}
</div>