<div class="sb">
	<div class="yui-gf">
		<div class="yui-u first lltextc">
			<{if $school.schoolnumber}>
				<{if $school.registered}>
					school no.
					<div class="h1"><{$school.schoolnumber}></div>
				<{else}>
					school no. <{$school.schoolnumber}>
					<div class="h2">awaiting approval</div>
				<{/if}>
			<{else}>
				school no. ***
				<div class="h2">awaiting approval</div>
			<{/if}>
		</div>
		<div class="yui-u">
			<div class="llfloatr">
				<{include file="pages/sectionlinks.member.tpl"}>
			</div>
			<{$school.city}>, <{$school.countryname|upper}>
			<{if $school.countryflag}>
				<img src="<{$tpl.links.flag_get}><{$school.countryflag}>">
			<{/if}>
			<h1 title="<{$school.name|escape}>"><{$school.name|truncate:40}></h1>
		</div>
	</div>
	<div class="yui-gf<{if !$smarty.get.contact and !$notoggler}> hidden toggler<{/if}>" id="school-contact-<{$school.schoolnumber}>">
		<div class="yui-u first">
			&nbsp;
		</div>
		<div class="yui-u">
			<{if $school.studentcontact neq '-' or $school.teachercontact neq '-'}>
				<span class="h2"><strong>Life-Link Contacts</strong></span>
				<blockquote>
					<{if $school.studentcontact neq '-'}>
						<div>Student<{$school.studentcontactplural}>: <{$school.studentcontact}></div>
					<{/if}>
					<{if $school.teachercontact neq '-'}>
						<div>Teacher<{$school.teachercontactplural}>: <{$school.teachercontact}></div>
					<{/if}>
				</blockquote>
				<span class="llclear h10"></span>
			<{/if}>
			<span class="h2"><strong>School Contact</strong></span>
			<blockquote>
				E-mail: <{$school.email}><br>
				Website: <{$school.website}>
				<span class="llclear h10"></span>
				Tel: <strong><{$school.tel}></strong><br>
				Fax: <strong><{$school.fax}></strong><br>
				Address: <strong><{$school.address}>, <{$school.city}> <{$school.zipcode}>, <{$school.countryname|upper}></strong>
			</blockquote>
			<span class="llclear h10"></span>
			<{if $school.update}>
				<div>Information Updated on <{$school.update|date_format:$tpl.date_format}></div>
			<{/if}>
			<{if !$nolinks}>
				<div class="hr"></div>
				<div class="lltextr"><a href="<{$tpl.links.contact_school_info}><{$school.schoolnumber}> - <{$school.name|escape}><{$tpl.links.contact_school_info_end}>" rel="nofollow">Update the above information</a></div>
			<{/if}>
		</div>
	</div>
	<{if !$nolinks}>
		<div class="yui-gf">
			<div class="yui-u first lltextc">
				<a href="<{$tpl.links.report_get}><{$school.schoolnumber}>" class="h3"><strong>Report a New Action</strong></a>
			</div>
			<div class="yui-u lltextr">
				<{if !$smarty.get.contact}>
					<span id="school-contact-<{$school.schoolnumber}>-activator-once">
						<a href="<{switcher key='contact' value=1}>" id="school-contact-<{$school.schoolnumber}>-activator" class="Tshow Tonce">Show Contact Information</a> &middot;
					</span>
				<{/if}>
				<{if $smarty.session.llschoolnumber != 0}>
					<a href="<{switcher key='llschoolnumber' value='0'}>">This is not my school!</a>
				<{else}>
					<a href="<{switcher key='llschoolnumber' value=$school.schoolnumber}>">Remember this as my school!</a>
				<{/if}>
			</div>
		</div>
	<{/if}>
</div>