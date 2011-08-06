{include
	file="/obj/report_meta.tpl"

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
	report_media=$report.media
	
	report_feedback=$report.feedback
	report_feedback_date=$report.datetime_approval}