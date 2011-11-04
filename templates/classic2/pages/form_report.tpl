<fieldset><div class="LL_box">
	We have performed an action under the guidelines of
	<label for="actionnumber" class="column">the Life-Link Action</label>
		<select name="actionnumber" class="compulsory">
		<{foreach from=$actions item=action name=action}>
			<{if $action.ischapter}>
			<{if !$smarty.foreach.action.first}></optgroup><{/if}>
			<{if !$smarty.foreach.action.last}><optgroup label="<{$action.name}>"><{/if}>
			<{else}>
			<option value="<{$action.actionnumber_raw}>"<{selected value=$smarty.get.guideline_action current=$action.actionnumber_raw}>><{$action.actionnumber}> <{$action.name}></option>
			<{/if}>
			<{if $smarty.foreach.action.last}></optgroup><{/if}>
		<{/foreach}>
		</select>,
	<span class="LL_clearer"></span>
	
	<label for="perfdate" class="column">on the date of</label><input type="text" name="perfdate" value="<{$default.perfdate}>" class="compulsory">,
	<div class="column">(use the YYYY-MM-DD (year-month-day) format; e.g. 2006-10-29)</div>
	<span class="LL_clearer"></span>
	<label for="perfdays" class="column">for this many days</label><input type="text" name="perfdays" value="<{$default.perfdays}>">,
	<div class="column">(it means that your activity lasted for more than 1 day)</div>
	<span class="LL_clearer"></span>
	
	involving<br>
	<label for="students" class="column">this many students</label><input type="text" name="students" value="<{$default.students}>">,
	<span class="LL_clearer"></span>
	<label for="age" class="column">aged</label><input type="text" name="age" value="<{$default.age}>">,
	<div class="column">(use specific age or range; e.g. "14", "12-15")</div>
	<span class="LL_clearer"></span>
	<label for="parents" class="column">this many parents</label><input type="text" name="parents" value="<{$default.parents}>">,
	<span class="LL_clearer"></span>
	<label for="teachers" class="column">and this many teachers</label><input type="text" name="teachers" value="<{$default.teachers}>">.
</div></fieldset>
	
	A summary of our activities:
	<textarea name="description" class="compulsory"><{$default.description}></textarea>
	<span class="LL_clearer" style="height: 1em"></span>
	
	<{if $school}>
	<fieldset><div class="LL_box">
	For more information, please contact this<br>
	<label for="teachercontact" class="column">teacher/student</label><input type="text" name="actioncontact" value="<{$default.actioncontact}>">,
	<span class="LL_clearer"></span>
	<div class="column">(only one person; First Name Family/Surname; e.g. "John Forrester")</div>
	<span class="LL_clearer" style="height: 1em"></span>
	
	<label for="teachercontactemail" class="column">using this E-mail</label><input type="text" name="actioncontactemail" value="<{$default.actioncontactemail}>">,
	<span class="LL_clearer"></span>
	<div class="column">(only one address; e.g. "friendship-schools@life-link.org")</div>
	<span class="LL_clearer" style="height: 1em"></span>
	</div></fieldset>
	<{/if}>
	
	<fieldset><div class="LL_box">
		We have photos too!<br>
		<label for="photo1" class="column">Photo 1</label><input type="file" id="photo1" name="photos[]">
		<span class="LL_clearer"></span>
		<label for="photo2" class="column">Photo 2</label><input type="file" id="photo2" name="photos[]">
		<span class="LL_clearer"></span>
		<label for="photo3" class="column">Photo 3</label><input type="file" id="photo3" name="photos[]">
		<span class="LL_clearer"></span>
		<label for="photo4" class="column">Photo 4</label><input type="file" id="photo4" name="photos[]">
		<span class="LL_clearer"></span>
		<label for="photo5" class="column">Photo 5</label><input type="file" id="photo5" name="photos[]">
		<div class="column">(JPEG format, smaller than 500 KB)</div>
		
	</div></fieldset>
	
	<fieldset><div class="LL_box">
	<img src="captcha.php" class="LL_fright">
	Please write the same letters you read on the right.
	<input type="text" name="captcha" id="captcha" autocomplete="off" class="compulsory">
	<span class="LL_clearer"></span>
	</div></fieldset>
