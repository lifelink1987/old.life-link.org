{* school *}
{include
	file="/obj/school_meta.tpl"
	school_number=$school.member_schools_number
	school_name=$school.school
	school_link="`$uri.school``$school.member_schools_number`"
	school_city=$school.city
	school_city_link="`$uri.country``$school.country_short|escape:'url'`/`$school.city|escape:'url'`"
	school_country=$school.country_short
	school_country_link="`$uri.country``$school.country_short|escape:'url'`"
	school_flag="`$uri.icon_flag_16``$school.iso2`"}