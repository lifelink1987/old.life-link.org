<form method="POST" id="reportform">
	<input type="hidden" name="save" value="report">
	<label class="width3">
		Description
		<textarea name="description" id="form-description" maxlength="500" rows="10" required="required">{$report.description}</textarea>
	</label>
	
	<div class="first"></div>
	<label class="unitx1">
		Students #
		<input type="text" name="students" id="form-students-report" value="{$report.students}" required="required">
	</label>
	<label class="unitx1">
		Age of students
		<input type="text" name="students-age" id="form-students-age-report" value="{$report.students_age}" required="required">
		<span>12-15</span>
	</label>
	<label class="unitx1">
		Teachers #
		<input type="text" name="teachers" id="form-teachers-report" value="{$report.teachers}" required="required">
	</label>
	<label class="unitx1">
		Parents #
		<input type="text" name="teachers" id="form-teachers-report" value="{$report.teachers}" required="required">
	</label>
	
	<div class="first"></div>
	<label class="unitx1">
		Guideline action
		<input type="text" name="action" id="form-action" value="{$report.actions}" required="required">
	</label>
	<label class="unitx1">
		Performed on
		<input type="text" name="date" id="form-date" value="{$report.date|dateformat:'%Y-%m-%d'}" required="required">
	</label>
	<label class="unitx1">
		for (days)
		<input type="text" name="date-days" id="form-date-days" value="{$report.date_days}" required="required">
	</label>
	<label class="unitx1">
		Registered on
		<input type="text" value="{$report.datetime_registration|dateformat:'%Y-%m-%d'}" readonly="readonly">
	</label>
	<label class="unitx1 highlight">
		{if $report.datetime_approval}Approved on{else}Approved{/if}
		<select type="text" name="datetime-approval" id="form-datetime-approval-report">
			{if $report.datetime_approval}
				<option value="">{$report.datetime_approval|dateformat:'%Y-%m-%d'}</option>
				<option value="0">Unapprove</option>
			{else}
				<option value="">No</option>
				<option value="1">Yes</option>
			{/if}
		</select>
	</label>
	
	<div class="first"></div>
	<label class="width3 highlight">
		Feedback from the Life-Link Office (visible on www.life-link.org)
		<textarea name="feedback" id="form-feedback" maxlength="255" rows="1">{$report.feedback}</textarea>
		<span>This message will also be emailed upon approving the action report.</span>
	</label>
			
	<script type="text/javascript">
		$('#form-datetime-approval-report').change(function() {
			($(this).val() == '')?$('#form-datetime-approval-report-change').show():$('#form-datetime-approval-report-change').hide();
		});
	</script>

	<div class="first"></div>
	<div id="#form-datetime-approval-report-change" class="highlight" style="display:none">
		Changing approval status will send out an automatic email (to all the above address and friendship-schools@life-link.org).<br/>
		<label class="width1">
			Your email address
			<input type="email" name="reply-from-report" id="form-reply-from-report" value="{$reply_form}" />
		</label>
		<label class="width2">
			Personal message
			<textarea name="reply-report" id="form-reply-report" maxlength="255" rows="3">{$reply_report}</textarea>
		</label>
	</div>

	<div class="first"></div>
	<input type="submit" class="unitx1" value="Save" />
</form>

<script type="text/javascript">
	if ($('#schoolform')) {
		$('#reportform').submit(function(){
			$('#form-datetime-approval').unbind('change');
			$(this).append('<input type="hidden" name="school" value="' + $('#schoolform').serialize() + '">');
		});
	}
</script>