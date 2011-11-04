<div class="LL_page_title">Schools &amp; Actions</div>
<form method="get" action="<{$tpl.links.members}>" id="form_list">
	<input type="hidden" name="sub" value="list">
	<fieldset>
	<div class="LL_box">
		Showing
		<!--List Type-->
		<select name="list_sr">
			<option value="r"<{selected value=$smarty.get.list_sr current='r'}>>reports</option>
			<option value="s"<{selected value=$smarty.get.list_sr current='s'}>>schools</option>
		</select>
		<!--List Type end-->
		ordered
		<!--List Order-->
		<select name="list_order">
			<option value="latest"<{selected value=$smarty.get.list_order current='latest'}>>by most recent reports</option>
			<option value="alphabetical"<{selected value=$smarty.get.list_order current='alphabetical'}>>by schools' name</option>
		</select>
		<!--List Order end-->
		<br>
		<div class="LL_right">
			in
			<!--Countries-->
			<select name="list_country" style="width: 225px">
				<option value="">all of the countries</option>
				<{foreach from=$countries item=country}>
					<option value="<{$country.codenumber}>"<{selected value=$smarty.get.list_country current=$country.codenumber}>><{$country.name}></option>
				<{/foreach}>
			</select>
			<!--Countries end-->
			<!--Cities-->
			<select name="list_city" style="width: 225px">
				<option value="">all of the cities</option>
				<{foreach from=$cities item=city}>
				<option value="<{$city}>"<{selected value=$smarty.get.list_city current=$city}>><{$city}></option>
				<{/foreach}>
			</select>
			<!--Cities end-->
		</div>
		<br>
		<div class="LL_margin">
			Consider only those<br>
			a) <input type="checkbox" name="guideline"<{checked value=$smarty.get.guideline}>>
			<label for="guideline">that connect to </label>
			<!--Actions-->
			<select name="guideline_action" for="guideline" style="width: 350px">
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
			<!--Actions end-->
			<br>
			b) <input type="checkbox" name="between"<{checked value=$smarty.get.between}>>
			<label for="between">that connect to an activity</label>
			<!--Date Type-->
			<select name="between_pr" for="between">
				<option value="p"<{selected value=$smarty.get.between_pr current='p'}>>performed</option>
				<option value="r"<{selected value=$smarty.get.between_pr current='r'}>>reported</option>
			</select>
			<!--Date Type end-->
			<br>
			<div class="LL_right">
				<label for="between">between</label>
				<!--From Month-->
				<select name="between_month" for="between">
					<{foreach from=$months key=month item=monthname name=month}>
					<option value="<{$month}>"<{selected value=$smarty.get.between_month current=$month}>><{$monthname}></option>
					<{/foreach}>
				</select>
				<!--From Month end-->
				<!--From Year-->
				<select name="between_year" for="between">
					<{foreach from=$years item=year}>
					<option value="<{$year}>"<{selected value=$smarty.get.between_year current=$year}>><{$year}>
					</option>
					<{/foreach}>
				</select>
				<!--From Year end-->
				<label for="between">and</label>
				<!--To Month-->
				<select name="between_and_month" for="between">
					<{foreach from=$months_and key=month item=monthname name=month}>
					<option value="<{$month}>"<{selected value=$smarty.get.between_and_month current=$month}>><{$monthname}></option>
					<{/foreach}>
				</select>
				<!--To Month end-->
				<!--To Year-->
				<select name="between_and_year" for="between">
					<{foreach from=$years_and item=year}>
					<option value="<{$year}>"<{selected value=$smarty.get.between_and_year current=$year}>><{$year}></option>
					<{/foreach}>
				</select>
				<!--To Year end-->
			</div>
			c) <input type="checkbox" name="photos"<{checked value=$smarty.get.photos}>>
			<label for="photos">that have photos</label>
		</div>
	</div>
	</fieldset>
	<p><a href="<{$tpl.links.members}>" class="LL_button">Back to Advanced Search</a>
		<input type="submit" value="Apply new Filters!">
	</p>
</form>
<span class="LL_clearer" style="height: 1em"> </span>
<div class="LL_box4">
	<div class="LL_box">
		<{include file="pages/paging_header.tpl"}>
		<{if $schools}>
		<div class="LL_fright LL_h3">Country</div>
		School Name,
		<h3>City</h3>
		<span class="LL_clearer"></span>
		<hr>
		<{foreach from=$schools item=school}>
		<{include file="pages/members/list/item_school.tpl"}>
		<{/foreach}>
		<{elseif $reports}>
		<{foreach from=$reports item=report}>
		<{include file="pages/member_report.tpl"}>
		<{/foreach}>
		<{/if}>
		<{include file="pages/paging_footer.tpl"}>
	</div>
</div>
