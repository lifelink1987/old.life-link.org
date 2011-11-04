<span class="llclear" style="height: 2em"></span>
<{if $result_message}>
<div class="llboxbd llboxlightorange llround lltextc">
	<{$result_message}>
</div>
<{/if}>
<h1>Advanced Search</h1>
<form method="get" action="<{$tpl.links.members}>" id="form_school" class="horizontalForm" anchor="results">
	<input type="hidden" name="sub" value="school">
	<input type="hidden" name="schoolnumber" value="<{$school.schoolnumber}>">
	<fieldset>
	<div class="llboxbd llboxlightgrey llroundt">
		<button type="submit" class="llfloatr">Go!</button>
		Consider only those reports
		
		<label for="guideline">
			that <input type="checkbox" name="guideline"<{checked value=$smarty.get.guideline}>>
		</label>
		<label for="guideline_action">
			connect to Action
			<select name="guideline_action" for="guideline">
				<{foreach from=$actions item=action name=action}>
				<{if $action.ischapter}>
				<{if !$smarty.foreach.action.first}></optgroup><{/if}>
				<{if !$smarty.foreach.action.last}><optgroup label="<{$action.name}>"><{/if}>
				<{else}>
				<option value="<{$action.actionnumber_raw}>"<{selected value=$smarty.get.guideline_action current=$action.actionnumber_raw}>><{$action.actionnumber}> <{$action.name}></option>
				<{/if}>
				<{if $smarty.foreach.action.last}></optgroup><{/if}>
				<{/foreach}>
			</select>
		</label>
		<span class="llclear"></span>
		
		<label for="between">
			that connect to <input type="checkbox" name="between" for="list"<{checked value=$smarty.get.between}>>
		</label>
		<label for="between_pr">
			an activity
			<select name="between_pr" for="between">
				<option value="p"<{selected value=$smarty.get.between_pr current='p'}>>performed</option>
				<option value="r"<{selected value=$smarty.get.between_pr current='r'}>>reported</option>
			</select>
		</label>
		<span class="llclear"></span>
		<div class="llfloatr">
			<label><br>between</label>
			<label for="between_month">(month)
			<select name="between_month" for="between">
				<{foreach from=$months key=month item=monthname name=month}>
				<option value="<{$month}>"<{selected value=$smarty.get.between_month current=$month}>><{$monthname}></option>
				<{/foreach}>
			</select>
			</label>
			<label for="between_year">(year)
			<select name="between_year" for="between">
				<{foreach from=$years item=year}>
				<option value="<{$year}>"<{selected value=$smarty.get.between_year current=$year}>><{$year}></option>
				<{/foreach}>
			</select>
			</label>
			<label><br>and</label>
			<label for="between_and_month">(month)
			<select name="between_and_month" for="between">
				<{foreach from=$months_and key=month item=monthname name=month}>
				<option value="<{$month}>"<{selected value=$smarty.get.between_and_month current=$month}>><{$monthname}></option>
				<{/foreach}>
			</select>
			</label>
			<label for="between_and_year">(year)
			<select name="between_and_year" for="between">
				<{foreach from=$years_and item=year}>
				<option value="<{$year}>"<{selected value=$smarty.get.between_and_year current=$year}>><{$year}></option>
				<{/foreach}>
			</select>	
			</label>
		</div>
		<span class="llclear"></span>
		
		<label for="photos">
			that have photos
			<input type="checkbox" name="photos"<{checked value=$smarty.get.photos}>>
		</label>
		<span class="llclear"></span>
	</div>
	<div class="llboxlightyellow llboxbd llroundb llbordert">
		<label for="all">
			Show all reports in one page
			<input type="checkbox" name="all"<{checked value=$smarty.get.all}>>
		</label>
		<span class="llclear"></span>
	</div>
	</fieldset>
</form>
