<div id="pageContentBody">
	<div class="llpagetitle"> Schools &amp; Actions </div>
	<div class="llboxbd llboxlightorange llroundt llborderb">
		<div class="llfloatl">
			<div class="yuimenu sectionlinks">
				<div class="bd">
					<ul>
						<li class="yuimenuitem"><a href="<{$tpl.links.members_get_country}><{$school.country}>&list_sr=r&list_order=latest&list_city=<{$school.city}>"><u><{$school.countryname|upper}>, <{$school.city}></u> : <b>Most recent reports</b></a></li>
						<li class="yuimenuitem"><a href="<{$tpl.links.members_get_country}><{$school.country}>&list_city=<{$school.city}>"><u><{$school.countryname|upper}>, <{$school.city}></u> : <b>Life-Link schools</b></a></li>
						<li class="yuimenuitem"><a href="<{$tpl.links.members_get_country}><{$school.country}>&list_sr=r&list_order=latest"><u><{$school.countryname|upper}></u> : <b>Most recent reports</b></a></li>
						<li class="yuimenuitem"><a href="<{$tpl.links.members_get_country}><{$school.country}>"><u><{$school.countryname|upper}></u> : <b>Life-Link schools</b></a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="paddingl">
			<h1><{$school.name}></h1>
			<div><b><{$school.countryname|upper}>, <{$school.city}></b>, Life-Link School #<{$school.schoolnumber}></div>
		</div>
	</div>
	<div class="llboxbd llboxllgreen llroundb">
		<div class="llboxbd llboxwatergreen llround">
			<div class="llfloatl">
				<div class="lltextc"><{$tpl.images.leaf}></div>
				<h2>Life-Link Contacts</h2>
				<div class="llpaddingl">
					<b>Student<{$school.studentcontactplural}></b>: <{$school.studentcontact}><br>
					<b>Teacher<{$school.teachercontactplural}></b>: <{$school.teachercontact}>
				</div>
			</div>
			<div class="llfloatr">
				<h2>School Contact</h2>
				<div class="llpaddingl">
					<b>Website</b>: <{$school.website}><br>
					<b>E-mail</b>: <{$school.email}><br><br>
					<div class="llfloatl"><b>Telephone</b>:&nbsp;<br><b>Fax</b>:&nbsp;<br><b>Address</b>:&nbsp;</div>
					<div class="llfloatl"><{$school.tel}><br><{$school.fax}><br><{$school.address}>,<br><{$school.city}>&nbsp;<{$school.zipcode}><br><{$school.countryname|upper}></div>
				</div>
			</div>
			<span class="llclear"></span>
		</div>
		<a class="llbutton" disabled="true">Update Contact Information</a>
		<a class="llbutton" href="<{$tpl.links.report_get}><{$school.schoolnumber}>">Report a New Action</a>
	</div>
	
	<span class="llclear" style="height: 3em"></span>
	<a name="reports"></a>
	
	<{assign var="page_link" value="`$page_link`#reports"}>
	<{include file="pages/paging_header.tpl"}>
	<{foreach from=$reports item=report}>
		<span class="llclear" style="height:1.5em"></span>
		<{include file="pages/report.tpl"}>
	<{/foreach}>
	<{include file="pages/paging_footer.tpl"}>
	
	<span class="LL_clearer" style="height: 1em"> </span>
	<a name="filters"></a>
	<{include file="`$tpl.current`school/search.tpl"}>
</div>