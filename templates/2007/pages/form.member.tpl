<!--Address-->
<div class="sb">
	<dl>
		<dt>
			<label for="form-report-name">Our school:</label>
			<em>*</em>
		</dt>
		<dd>
			<input type="text" name="name" id="form-report-name" value="<{$default.name}>" class="membername required" tabindex="9" maxlength="255" autocomplete="off">
			<div id="form-report-name-help" class="fieldHelp">
				<div class="bd">
					NATIVE EXAMPLES (recommended)<br>
					<blockquote>
						Årstaskolan &middot; Escuela de Enseñanza Media No. 432 "Bernardino Rivadavia" &middot; Lycee du Lac Tanganyika &middot; Colegiul Naţional "Vasile Alecsandri"
					</blockquote>
					Please write the name as correctly as possible by using every Latin character in your native language.<br><br>
					ENGLISH EQUIVALENTS<br>
					<blockquote>
						Årsta School &middot; Secondary School No. 432 "Bernardino Rivadavia" &middot; Lake Tanganyika High School &middot; "Vasile Alecsandri" High School
					</blockquote>
				</div>
			</div>
			<div id="form-report-name-autocomplete" class="autocomplete" rel="<{$tpl.links.report_get}>"></div>
		</dd>
		<dt>
			<label for="form-report-country">Country:</label>
			<em>*</em>
		</dt>
		<dd>
			<select name="country" id="form-report-country" class="required" tabindex="10">
			<option value=""></option>
				<{foreach from=$countries item=country}>
					<option value="<{$country.codenumber}>"<{if $default.country}><{selected value=$default.country current=$country.codenumber}><{else}><{selected value=$default.countryiso current=$country.iso}><{/if}>><{$country.name}></option>
				<{/foreach}>
			</select>
		</dd>
	</dl>
	<div class="yui-g">
		<div class="yui-u first">
			<dl>
				<dt>
					<label for="form-report-city">City or Village:</label>
					<em>*</em>
				</dt>
				<dd>
					<input type="text" name="city" id="form-report-city" value="<{$default.city}>" class="name city required" tabindex="11" maxlength="255" autocomplete="off">
					<div id="form-report-city-autocomplete" class="autocomplete"></div>
				</dd>
			</dl>
		</div>
		<div class="yui-u">
			<dl>
				<dt>
					<label for="form-report-city">ZipCode/PostCode:</label>
					<em>*</em>
				</dt>
				<dd>
					<input type="text" name="zipcode" id="form-report-zipcode" value="<{$default.zipcode}>" class="zipcode required" tabindex="12" maxlength="255" autocomplete="off">
				</dd>
			</dl>
		</div>
	</div>
	<dl>
		<dt>
			<label for="form-report-address">Address:</label>
			<em>*</em>
		</dt>
		<dd>
			<input type="text" name="address" id="form-report-address" value="<{$default.address}>" class="required" tabindex="14" maxlength="255" autocomplete="off"><br>
			<small>include State/County/Province with CAPITALS if applicable<br>but not city/village nor country</small>
		</dd>
	</dl>

	<div class="yui-g">
		<div class="yui-u first">
			<dl>
				<dt>
					<label for="form-report-sstudents">Number of Students:</label>
				</dt>
				<dd>
					<input type="text" name="sstudents" id="form-report-sstudents" value="<{$default.sstudents}>" class="numbers" tabindex="14" maxlength="5" autocomplete="off">
				</dd>
			</dl>
		</div>
		<div class="yui-u">
			<dl>
				<dt>
					<label for="form-report-steachers">Number of Teachers:</label>
				</dt>
				<dd>
					<input type="text" name="steachers" id="form-report-steachers" value="<{$default.steachers}>" class="numbers" tabindex="15" maxlength="5" autocomplete="off">
				</dd>
			</dl>
		</div>
	</div>
	

</div>

<!--School contact-->
<span class="llclear h10"></span>
<span class="h2">Contact Information</span>
<div class="yui-g sb">
	<div class="yui-u first">
		<dl>
			<dt>
				<label for="form-report-tel">School's Telephone(s):</label>
			</dt>
			<dd>
				<input type="text" name="tel" id="form-report-tel" value="<{$default.tel}>" class="phones" tabindex="16" maxlength="255" autocomplete="off"><br>
				<small>separate by comma (,) for multiple</small>
				<div id="form-report-tel-help" class="fieldHelp">
					<{include file="pages/forms/help.phones.tpl"}>
				</div>
			</dd>
			<dt>
				<label for="form-report-email">School's E-m@il(s):</label>
			</dt>
			<dd>
				<input type="text" name="email" id="form-report-email" value="<{$default.email}>" class="emails" tabindex="17" maxlength="255" autocomplete="off"><br>
				<small>separate by comma (,) for multiple</small>
				<div id="form-report-email-help" class="fieldHelp">
					<{include file="pages/forms/help.emails.tpl"}>
				</div>
			</dd>
		</dl>
	</div>
	<div class="yui-u">
		<dl>
			<dt>
				<label for="form-report-fax">School's Fax(s):</label>
			</dt>
			<dd>
				<input type="text" name="fax" id="form-report-fax" value="<{$default.fax}>" class="phones" tabindex="16" maxlength="255" autocomplete="off"><br>
				<small>separate by comma (,) for multiple</small>
				<div id="form-report-fax-help" class="fieldHelp">
					<{include file="pages/forms/help.phones.tpl"}>
				</div>
			</dd>
			<dt>
				<label for="form-report-city">School's Website:</label>
			</dt>
			<dd>
				<input type="text" name="website" id="form-report-website" value="<{$default.website}>" class="website" tabindex="18" maxlength="255" autocomplete="off"><br>
				<small>&nbsp;</small>
				<div id="form-report-website-help" class="fieldHelp">
					<{include file="pages/forms/help.website.tpl"}>
				</div>
			</dd>
		</dl>
	</div>
</div>

<span class="llclear h20"></span>
<span class="h2">Student Contacts</span>

<!--Student contact 1-->
<div class="llfloatl"><span class="h2">1.</span></div>
<blockquote>
	<div class="yui-gc sb">
		<div class="yui-u first">
			<dl>
				<dt>
					<label for="form-report-studentcontact1">Name:</label>
					<em>*</em>
				</dt>
				<dd>
					<input type="text" name="studentcontact1" id="form-report-studentcontact1" value="<{$default.studentcontact1}>" class="name required" tabindex="19" maxlength="255" autocomplete="off">
					<div id="form-report-studentcontact1-help" class="fieldHelp">
						<{include file="pages/forms/help.name.tpl"}>
					</div>
				</dd>
				<dt>
					<label for="form-report-studentcontactemail1">E-m@il:</label>
				</dt>
				<dd>
					<input type="text" name="studentcontactemail1" id="form-report-studentcontactemail1" value="<{$default.studentcontactemail1}>" class="email" tabindex="21" rel="form-report-studentcontact1" maxlength="255" autocomplete="off">
					<div id="form-report-studentcontactemail1-help" class="fieldHelp">
						<{include file="pages/forms/help.email.tpl"}>
					</div>
				</dd>
			</dl>
		</div>
		<div class="yui-u">
			<dl>
				<dt>
					<label for="form-report-studentcontactgender1">Title/Gender:</label>
					<em>*</em>
				</dt>
				<dd>
					<select name="studentcontactgender1" id="form-report-studentcontactgender1" rel="form-report-studentcontact1 required" tabindex="20">
						<option value=""></option>
						<option value="f"<{selected value=$default.studentcontactgender1 current=f}>>Ms./Female</option>
						<option value="m"<{selected value=$default.studentcontactgender1 current=m}>>Mr./Male</option>
					</select>
				</dd>
			</dl>
		</div>
	</div>
</blockquote>

<span class="llclear h05"></span>
<!--Student contact 2-->
<div class="llfloatl"><span class="h2">2.</span></div>
<blockquote>
	<div class="yui-gc sb">
		<div class="yui-u first">
			<dl>
				<dt>
					<label for="form-report-studentcontact2">Name:</label>
				</dt>
				<dd>
					<input type="text" name="studentcontact2" id="form-report-studentcontact2" value="<{$default.studentcontact2}>" class="name" tabindex="22" maxlength="255" autocomplete="off">
					<div id="form-report-studentcontact2-help" class="fieldHelp">
						<{include file="pages/forms/help.name.tpl"}>
					</div>
				</dd>
				<dt>
					<label for="form-report-studentcontactemail1">E-m@il:</label>
				</dt>
				<dd>
					<input type="text" name="studentcontactemail2" id="form-report-studentcontactemail2" value="<{$default.studentcontactemail2}>" class="email" tabindex="24" rel="form-report-studentcontact2" maxlength="255" autocomplete="off">
					<div id="form-report-studentcontactemail2-help" class="fieldHelp">
						<{include file="pages/forms/help.email.tpl"}>
					</div>
				</dd>
			</dl>
		</div>
		<div class="yui-u">
			<dl>
				<dt>
					<label for="form-report-studentcontactgender2">Title/Gender:</label>
				</dt>
				<dd>
					<select name="studentcontactgender2" id="form-report-studentcontactgender2" rel="form-report-studentcontact2 required" tabindex="23">
						<option value=""></option>
						<option value="f"<{selected value=$default.studentcontactgender2 current=f}>>Ms./Female</option>
						<option value="m"<{selected value=$default.studentcontactgender2 current=m}>>Mr./Male</option>
					</select>
				</dd>
			</dl>
		</div>
	</div>
</blockquote>

<span class="llclear h10"></span>
<span class="h2">Teacher Contacts</span>

<!--Teacher contact 1-->
<div class="llfloatl"><span class="h2">1.</span></div>
<blockquote>
	<div class="yui-gc sb">
		<div class="yui-u first">
			<dl>
				<dt>
					<label for="form-report-teachercontact1">Name:</label>
					<em>*</em>
				</dt>
				<dd>
					<input type="text" name="teachercontact1" id="form-report-teachercontact1" value="<{$default.teachercontact1}>" class="name required" tabindex="25" maxlength="255" autocomplete="off">
					<div id="form-report-teachercontact1-help" class="fieldHelp">
						<{include file="pages/forms/help.name.tpl"}>
					</div>
				</dd>
				<dt>
					<label for="form-report-teachercontactemail1">E-m@il:</label>
				</dt>
				<dd>
					<input type="text" name="teachercontactemail1" id="form-report-teachercontactemail1" value="<{$default.teachercontactemail1}>" class="email" tabindex="27" rel="form-report-teachercontact1" maxlength="255" autocomplete="off">
					<div id="form-report-teachercontactemail1-help" class="fieldHelp">
						<{include file="pages/forms/help.email.tpl"}>
					</div>
				</dd>
			</dl>
		</div>
		<div class="yui-u">
			<dl>
				<dt>
					<label for="form-report-teachercontactgender1">Title/Gender:</label>
					<em>*</em>
				</dt>
				<dd>
					<select name="teachercontactgender1" id="form-report-teachercontactgender1" rel="form-report-teachercontact1 required" tabindex="26">
						<option value=""></option>
						<option value="f"<{selected value=$default.teachercontactgender1 current=f}>>Ms./Female</option>
						<option value="m"<{selected value=$default.teachercontactgender1 current=m}>>Mr./Male</option>
					</select>
				</dd>
			</dl>
		</div>
	</div>
</blockquote>

<span class="llclear h05"></span>
<!--Teacher contact 2-->
<div class="llfloatl"><span class="h2">2.</span></div>
<blockquote>
	<div class="yui-gc sb">
		<div class="yui-u first">
			<dl>
				<dt>
					<label for="form-report-teachercontact2">Name:</label>
				</dt>
				<dd>
					<input type="text" name="teachercontact2" id="form-report-teachercontact2" value="<{$default.teachercontact2}>" class="name" tabindex="28" maxlength="255" autocomplete="off">
					<div id="form-report-teachercontact1-help" class="fieldHelp">
						<{include file="pages/forms/help.name.tpl"}>
					</div>
				</dd>
				<dt>
					<label for="form-report-teachercontactemail1">E-m@il:</label>
				</dt>
				<dd>
					<input type="text" name="teachercontactemail2" id="form-report-teachercontactemail2" value="<{$default.teachercontactemail2}>" class="email" tabindex="30" rel="form-report-teachercontact2" maxlength="255" autocomplete="off">
					<div id="form-report-teachercontactemail2-help" class="fieldHelp">
						<{include file="pages/forms/help.email.tpl"}>
					</div>
				</dd>
			</dl>
		</div>
		<div class="yui-u">
			<dl>
				<dt>
					<label for="form-report-teachercontactgender2">Title/Gender:</label>
				</dt>
				<dd>
					<select name="teachercontactgender2" id="form-report-teachercontactgender2" rel="form-report-teachercontact2 required" tabindex="29">
						<option value=""></option>
						<option value="f"<{selected value=$default.teachercontactgender2 current=f}>>Ms./Female</option>
						<option value="m"<{selected value=$default.teachercontactgender2 current=m}>>Mr./Male</option>
					</select>
				</dd>
			</dl>
		</div>
	</div>
</blockquote>