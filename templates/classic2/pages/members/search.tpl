<{if $result_message}>
<div class="llboxbd llboxlightorange llround lltextc">
	<{$result_message}>
</div>
<{/if}>
<{if $smarty.get.search neq "advanced"}>
<a class="llbutton llfloatr" href="<{$tpl.links.members}>?search=advanced">Advanced Search</a>
<h1>I would like to</h1>
<span class="llclear"></span>
<form method="get" action="<{$tpl.links.members}>" id="form_members_simple_sactions" class="horizontalForm" anchor="results">
	<input type="hidden" name="sub" value="list">
	<input type="hidden" name="list_sr" value="s">
	<input type="hidden" name="list_order" value="latest">
	<fieldset class="llmarginl">
	<legend class="h1"><button type="submit">Search</button> for school(s)</legend>
	<div class="llboxlightyellow llboxbd llroundt llborderb">
		<label for="guideline_action">
			that have reports on Action
			<select name="guideline_action">
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
	</div>
	</fieldset>
</form>
<form method="get" action="<{$tpl.links.members}>" id="form_members_simple_sid" class="simpleForm">
	<input type="hidden" name="sub" value="school">
	<fieldset class="llmarginl">
	<legend class="h1"><button type="submit">View</button> information on the school</legend>
	<div class="llboxlightyellow llboxbd llroundt llborderb">
		<label for="schoolnumber">
			that has this Life-Link number/ID
			<input type="text" name="schoolnumber" autocomplete="off" value="<{$smarty.get.schoolnumber}>" class="compulsory">
		</label>
		<span class="llclear"></span>
	</div>
	</fieldset>
</form>
<form method="get" action="<{$tpl.links.members}>" id="form_members_simple_scountry" class="simpleForm" anchor="results">
	<input type="hidden" name="sub" value="list">
	<input type="hidden" name="list_sr" value="s">
	<input type="hidden" name="list_order" value="alphabetical">
	<fieldset class="llmarginl">
	<legend class="h1"><button type="submit">Search</button> for school(s)</legend>
	<div class="llboxlightyellow llboxbd llroundt llborderb">
		<label for="list_country">from
		<select name="list_country" class="compulsory">
			<option value=""></option>
			<{foreach from=$countries item=country}>
				<option value="<{$country.codenumber}>"<{selected value=$smarty.get.list_country current=$country.codenumber}>><{$country.name}></option>
			<{/foreach}>
		</select>
		</label>
		<span class="llclear"></span>
	</div>
	</fieldset>
</form>
<form method="get" action="<{$tpl.links.members}>" id="form_members_simple_rtimespan" class="horizontalForm" anchor="results">
	<input type="hidden" name="sub" value="list">
	<input type="hidden" name="list_sr" value="r">
	<input type="hidden" name="between" value="1">
	<fieldset class="llmarginl">
	<legend class="h1"><button type="submit">Search</button> for reports</legend>
	<div class="llboxlightyellow llboxbd llroundt llborderb">
		<label for="between_pr">
			of activities
			<select name="between_pr">
				<option value="p"<{selected value=$smarty.get.between_pr current='p'}>>performed</option>
				<option value="r"<{selected value=$smarty.get.between_pr current='r'}>>reported</option>
			</select>
		</label>
		<label><br>between</label>
		<label for="between_month">(month)
		<select name="between_month">
			<{foreach from=$months key=month item=monthname name=month}>
			<option value="<{$month}>"<{selected value=$smarty.get.between_month current=$month}>><{$monthname}></option>
			<{/foreach}>
		</select>
		</label>
		<label for="between_year">(year)
		<select name="between_year">
			<{foreach from=$years item=year}>
			<option value="<{$year}>"<{selected value=$smarty.get.between_year current=$year}>><{$year}></option>
			<{/foreach}>
		</select>
		</label>
		<label><br>and</label>
		<label for="between_and_month">(month)
		<select name="between_and_month">
			<{foreach from=$months_and key=month item=monthname name=month}>
			<option value="<{$month}>"<{selected value=$smarty.get.between_and_month current=$month}>><{$monthname}></option>
			<{/foreach}>
		</select>
		</label>
		<label for="between_and_year">(year)
		<select name="between_and_year">
			<{foreach from=$years_and item=year}>
			<option value="<{$year}>"<{selected value=$smarty.get.between_and_year current=$year}>><{$year}></option>
			<{/foreach}>
		</select>	
		</label>
		<span class="llclear"></span>
	</div>
	</fieldset>
</form>






<{else}>






<a class="llbutton llfloatr" href="<{$tpl.links.members}>">Basic Search</a>
<h1>I would like to</h1>
<span class="llclear"></span>
<form method="get" action="<{$tpl.links.members}>" id="form_members_advanced_sr" class="horizontalForm" anchor="results">
	<input type="hidden" name="search" value="advanced">
	<input type="hidden" name="sub" value="list">
	<fieldset class="llmarginl">
	<legend class="h1"> see </legend>
	<div class="llboxlightyellow llboxbd llroundt llborderb">
		<button type="submit" class="llfloatr">Go!</button>
		<label for="list_sr">a list of
		<select name="list_sr">
			<option value="r"<{selected value=$smarty.get.list_sr current='r'}>>reports</option>
			<option value="s"<{selected value=$smarty.get.list_sr current='s'}>>schools</option>
		</select>
		</label>
		<label for="list_order">ordered by
		<select name="list_order">
			<option value="latest"<{selected value=$smarty.get.list_order current='latest'}>>the most recent reports</option>
			<option value="alphabetical"<{selected value=$smarty.get.list_order current='alphabetical'}>>the schools' name</option>
		</select>
		</label>
		<span class="llclear"></span>
		<label for="list_city">in
		<select name="list_city">
			<option value="">all of the cities</option>
		</select>
		</label>
		<label for="list_country">from
		<select name="list_country">
			<option value="">the world</option>
			<{foreach from=$countries item=country}>
				<option value="<{$country.codenumber}>"<{selected value=$smarty.get.list_country current=$country.codenumber}>><{$country.name}></option>
			<{/foreach}>
		</select>
		</label>
		<span class="llclear"></span>
	</div>
	<div class="llboxbd llboxlightgrey llroundb">
		<div class="llfloatr">This is optional.</div>
		Consider only those
		
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
	</fieldset>
</form>
<form method="get" action="<{$tpl.links.members}>" id="form_members_advanced_specifics" class="simpleForm" anchor="results">
	<input type="hidden" name="search" value="advanced">
	<input type="hidden" name="sub" value="name">
	<fieldset class="llmarginl">
	<legend class="h1">search for the school(s)</legend>
	<div class="llboxlightyellow llboxbd llroundt llborderb">
		<button type="submit" class="llfloatr">Go!</button>
		<label for="namelike">
			that have the word
			<input type="text" name="namelike" for="namesearch" autocomplete="off" value="<{$smarty.get.namelike}>" class="compulsory">
			inside their name
			<div class="textsmall">
				* minimum 4 letters, or simply use numbers<br>
				* do not use words like &quot;primary&quot;, &quot;secondary&quot;, &quot;high&quot;, &quot;school&quot;
			</div>
		</label>
		<span class="llclear"></span>
	</div>
	</fieldset>
</form>
<form method="get" action="<{$tpl.links.members}>" id="form_members_advanced_specifics" class="simpleForm">
	<input type="hidden" name="search" value="advanced">
	<input type="hidden" name="sub" value="school">
	<fieldset class="llmarginl">
	<legend class="h1">search for the school</legend>
	<div class="llboxlightyellow llboxbd llroundt llborderb">
		<button type="submit" class="llfloatr">Go!</button>
		<label for="schoolnumber">
			with Life-Link number/ID
			<input type="text" name="schoolnumber" for="schoolsearch" autocomplete="off" value="<{$smarty.get.schoolnumber}>" class="compulsory">
		</label>
		<span class="llclear"></span>
	</div>
	</fieldset>
</form>
<{/if}>
