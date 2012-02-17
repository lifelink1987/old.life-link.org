<div class="row_school_alone">
{include
	file="/admin/obj/row_school.tpl"
	school_number=$school.member_schools_number
	school_name=$school.school
	school_link="`$uri.admin_fs_school``$school.member_schools_number`"
	school_city=$school.city
	school_country=$school.country_short
	school_flag="`$uri.icon_flag_16``$school.iso2`"
	school_approved=$school.datetime_approval}
</div>