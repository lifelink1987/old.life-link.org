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
			<h1><{$school.name}></h1>
		</div>
	</div>
	<div class="yui-gf">
		<div class="yui-u first lltextc">
			<a href="<{$tpl.links.report_get}><{$school.schoolnumber}>"><strong>Report a New Action</strong></a>
		</div>
		<div class="yui-u lltextr">
			<a href="<{$tpl.links.member}><{$school.schoolnumber}>">List all Action Reports</a> &middot;
			<{if $smarty.session.llschoolnumber != 0}>
				<a href="<{switcher key='llschoolnumber' value='0'}>">This is not my school!</a>
			<{else}>
				<a href="<{switcher key='llschoolnumber' value=$school.schoolnumber}>">Remember this as my school!</a>
			<{/if}>
		</div>
	</div>
</div>