{* event *}

{include
	file="/obj/event_meta.tpl"
	event_id=$event.events_id
	event_name=$event.event
	event_type=$event.type_nice
	event_year_start=$event.year_start
	event_year_end=$event.year_end
	event_link=$event.link
	event_country=$event.country_short
	event_country_link="`$uri.country``$event.country_short|escape:'url'`"
	event_flag="`$uri.icon_flag_16``$event.iso2`"}