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
					<input type="text" name="teachercontact1" id="form-report-teachercontact1" value="<{$default.teachercontact1}>" class="name required" tabindex="19" maxlength="255" autocomplete="off">
					<div id="form-report-teachercontact1-help" class="fieldHelp">
						<{include file="pages/forms/help.name.tpl"}>
					</div>
				</dd>
				<dt>
					<label for="form-report-teachercontactemail1">E-m@il:</label>
				</dt>
				<dd>
					<input type="text" name="teachercontactemail1" id="form-report-teachercontactemail1" value="<{$default.teachercontactemail1}>" class="email" tabindex="19" rel="form-report-teachercontact1" maxlength="255" autocomplete="off">
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
					<select name="teachercontactgender1" id="form-report-teachercontactgender1" rel="form-report-teachercontact1 required" class="required">
						<option value=""></option>
						<option value="f"<{selected value=$smarty.get.teachercontactgender1 current=f}>>Ms./Female</option>
						<option value="m"<{selected value=$smarty.get.teachercontactgender1 current=m}>>Mr./Male</option>
					</select>
				</dd>
			</dl>
		</div>
	</div>
</blockquote>

<!--Teacher contact 2-->
<div class="llfloatl"><span class="h2">2.</span></div>
<blockquote>
	<div class="yui-gc sb">
		<div class="yui-u first">
			<dl>
				<dt>
					<label for="form-report-teachercontact2">Name:</label>
					<em>*</em>
				</dt>
				<dd>
					<input type="text" name="teachercontact2" id="form-report-teachercontact2" value="<{$default.teachercontact2}>" class="name required" tabindex="19" maxlength="255" autocomplete="off">
					<div id="form-report-teachercontact1-help" class="fieldHelp">
						<{include file="pages/forms/help.name.tpl"}>
					</div>
				</dd>
				<dt>
					<label for="form-report-teachercontactemail1">E-m@il:</label>
				</dt>
				<dd>
					<input type="text" name="teachercontactemail2" id="form-report-teachercontactemail2" value="<{$default.teachercontactemail2}>" class="email" tabindex="19" rel="form-report-teachercontact2" maxlength="255" autocomplete="off">
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
					<em>*</em>
				</dt>
				<dd>
					<select name="teachercontactgender2" id="form-report-teachercontactgender2" rel="form-report-teachercontact2 required" class="required">
						<option value=""></option>
						<option value="f"<{selected value=$smarty.get.teachercontactgender2 current=f}>>Ms./Female</option>
						<option value="m"<{selected value=$smarty.get.teachercontactgender2 current=m}>>Mr./Male</option>
					</select>
				</dd>
			</dl>
		</div>
	</div>
</blockquote>
