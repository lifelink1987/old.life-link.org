<span class="llclear h10"></span>
<span class="h2"><strong>Action Report</strong></span>
<div class="sb">
	<dl>
		<dt>
			<label for="form-report-actionnumber">Guideline Action:</label>
			<em>*</em>
		</dt>
		<dd>
			<select name="actionnumber" id="form-report-actionnumber" class="required" tabindex="50">
			<option value=""></option>
			<{foreach from=$actions item=action name=action}>
				<{if $action.ischapter}>
				<{if !$smarty.foreach.action.first}></optgroup><{/if}>
				<{if !$smarty.foreach.action.last}><optgroup label="<{$action.name}>"><{/if}>
				<{else}>
				<option value="<{$action.actionnumber_raw}>"<{selected value=$default.actionnumber current=$action.actionnumber_raw}>><{$action.actionnumber}> <{$action.name}></option>
				<{/if}>
				<{if $smarty.foreach.action.last}></optgroup><{/if}>
			<{/foreach}>
			</select>
		</dd>
	</dl>
	
	<div class="yui-g">
		<div class="yui-u first">
			<dl>
				<dt>
					<label for="form-report-perfdate">Date:</label>
					<em>*</em>
				</dt>
				<dd>
					<input type="text" name="perfdate" id="form-report-perfdate" value="<{$default.perfdate}>" class="calendar required" tabindex="51" maxlength="255" autocomplete="off">
					<div id="form-report-perfdate-help" class="fieldHelp">
						<div class="bd">
							FORMAT<br>
							<blockquote>
								YYYY-MM-DD
							</blockquote>
						</div>
					</div>
					<small>YYYY-MM-DD</small>
				</dd>
			</dl>
		</div>
		<div class="yui-u">
			<dl>
				<dt>
					<label for="form-report-perfdays">Duration:</label>
				</dt>
				<dd>
					<input type="text" name="perfdays" id="form-report-perfdays" value="<{if $default.perfdays}><{$default.perfdays}><{else}>1<{/if}>" maxlength="3" tabindex="52" class="numbers" autocomplete="off"><br>
					<small>day(s)</small>
				</dd>
			</dl>
		</div>
	</div>

	<div class="yui-g">
		<div class="yui-u first">
			<dl>
				<dt>
					<label for="form-report-students">Number of Students:</label>
					<em>*</em>
				</dt>
				<dd>
					<input type="text" name="students" id="form-report-students" value="<{$default.students}>" class="numbers required" tabindex="53" maxlength="5" autocomplete="off">
				</dd>
			</dl>
		</div>
		<div class="yui-u">
			<dl>
				<dt>
					<label for="form-report-age">Students' Age:</label>
				</dt>
				<dd>
					<input type="text" name="age" id="form-report-age" value="<{$default.age}>" class="number-range" tabindex="54" maxlength="5" autocomplete="off"><br>
					<small>years old</small>
					<div id="form-report-age-help" class="fieldHelp">
						<div class="bd">
							FORMAT<br>
							<blockquote>
								12<br>
								12-15
							</blockquote>
						</div>
					</div>
				</dd>
			</dl>
		</div>
	</div>

	<div class="yui-g">
		<div class="yui-u first">
			<dl>
				<dt>
					<label for="form-report-teachers">Number of Teachers:</label>
				</dt>
				<dd>
					<input type="text" name="teachers" id="form-report-teachers" value="<{$default.teachers}>" class="numbers" tabindex="55" maxlength="5" autocomplete="off">
				</dd>
			</dl>
		</div>
		<div class="yui-u">
			<dl>
				<dt>
					<label for="form-report-parents">Number of Parents:</label>
				</dt>
				<dd>
					<input type="text" name="parents" id="form-report-parents" value="<{$default.parents}>" class="numbers" tabindex="56" maxlength="5" autocomplete="off">
				</dd>
			</dl>
		</div>
	</div>
	
	<dl>
		<dt>
			<label for="form-report-description">Summary of Activities:</label>
			<em>*</em>
		</dt>
		<dd>
			<textarea name="description" id="form-report-description" class="required limitation ondemandhelp" tabindex="57" rows="6"><{$default.description}></textarea><br>
			<small><strong>English please!</strong> Please use no more than <strong>500 characters</strong><{if $smarty.session.templatelevel}> (out of which, <strong id="form-report-description-limitation">500</strong> left)<{/if}>.</small>
			<div id="form-report-description-help" class="fieldHelp">
				<{include file="pages/forms/help.limitation.tpl"}>
			</div>
		</dd>
	</dl>
</div>

<{if $school}>
	<span class="llclear h10"></span>
	<span class="h2"><strong>Specific Contact</strong> for this Action Report</span>
	<{if $school}>
		<blockquote>
			<{if $school.teachercontact neq '-'}>
				<div>different from the school's contact teacher(s) - <{$school.teachercontact}></div>
			<{/if}>
			<{if $school.studentcontact neq '-'}>
				<div>different from the contact student(s) - <{$school.studentcontact}></div>
			<{/if}>
		</blockquote>
		<span class="llclear h05"></span>
	<{/if}>
	
	<blockquote>
		<div class="yui-gc sb">
			<div class="yui-u first">
				<dl>
					<dt>
						<label for="form-report-actioncontact">Name:</label>
					</dt>
					<dd>
						<input type="text" name="actioncontact" id="form-report-actioncontact" value="<{$default.actioncontact}>" class="name" tabindex="65" maxlength="255" autocomplete="off">
						<div id="form-report-actioncontact-help" class="fieldHelp">
							<{include file="pages/forms/help.name.tpl"}>
						</div>
					</dd>
					<dt>
						<label for="form-report-actioncontactemail">E-m@il:</label>
					</dt>
					<dd>
						<input type="text" name="actioncontactemail" id="form-report-actioncontactemail" value="<{$default.actioncontactemail}>" class="email" tabindex="67" rel="form-report-actioncontact required" maxlength="255" autocomplete="off">
						<div id="form-report-actioncontactemail-help" class="fieldHelp">
							<{include file="pages/forms/help.email.tpl"}>
						</div>
					</dd>
				</dl>
			</div>
			<div class="yui-u">
				<dl>
					<dt>
						<label for="form-report-actioncontactgender">Title/Gender:</label>
					</dt>
					<dd>
						<select name="actioncontactgender" id="form-report-actioncontactgender" rel="form-report-actioncontact" tabindex="66">
							<option value=""></option>
							<option value="f"<{selected value=$default.actioncontactgender current=f}>>Ms./Female</option>
							<option value="m"<{selected value=$default.actioncontactgender current=m}>>Mr./Male</option>
						</select>
					</dd>
				</dl>
			</div>
		</div>
	</blockquote>
<{/if}>

<span class="llclear h10"></span>

<input type="hidden" name="continue" value="<{$smarty.request.continue}>">
<input type="hidden" name="continuetitle" value="<{$smarty.request.continuetitle}>">