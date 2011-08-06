{include
	file="/obj/report_school_meta.tpl"
	school_number=$report.member_schools_number
	school_name=$report.school
	school_link="`$uri.school``$report.member_schools_number`"
	school_city=$report.city
	school_city_link="`$uri.country``$report.country_short|escape:'url'`/`$report.city|escape:'url'`"
	school_country=$report.country_short
	school_country_link="`$uri.country``$report.country_short|escape:'url'`"
	school_flag="`$uri.icon_flag_16``$report.iso2`"
	
	report_id=$report.member_reports_id
	report_date="`$report.date|relativedate`"
	report_days=$report.date_days
	report_description=$report.description
	report_link=$report.link
	
	report_action_link=$report.actions_full.0.link
	report_action_number=$report.actions_full.0.actions_number_nice
	report_action=$report.actions_full.0.action
	report_action_theme_link=$report.actions_full.0.theme.link
	report_action_theme=$report.actions_full.0.theme.action_short
	
	report_students=$report.students
	report_students_age=$report.students_age
	report_teachers=$report.teachers
	report_parents=$report.parents
	report_contact=$report.contact
	report_contact_email=$report.email_contact
	
	report_front_thumb=$report.media_front.uri_thumb
	report_front=$report.media_front.uri
	report_media=$report.media}