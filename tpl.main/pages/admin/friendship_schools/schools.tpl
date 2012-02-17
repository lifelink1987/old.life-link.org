{css file="/css/source/admin.css"}
{include file="/obj/js_form.tpl"}
<section>
	<h1>Manage Schools</h1>
	{include file="/obj/byline.tpl"}
	<h3 class="center"><em>in</em> the Life-Link Friendship-Schools programme</h3>
	<form method="GET">
		<input type="hidden" name="search" value="1">
		<label for="form-period" class="width1 double first">
			{include file="/obj/filter_period.tpl" label="Registered between"}
		</label>
		<label for="form-country" class="unitx1">
			{include file="/obj/filter_schools_country.tpl"}
		</label>
		<label for="form-city" class="unitx1" style="display:none">
			{include file="/obj/filter_schools_city.tpl"}
		</label>
		<label for="form-name" class="unitx1">
			Named ~<br />
			<input type="text" name="name" id="form-name" placeholder="anything">
		</label>
		<label for="form-order" class="unitx1">
			Ordered by<br />
			<select name="order" id="form-order">
				<option value="school_date"{selected value=$smarty.get.order current="school_date"}>recent registration</option>
				<option value="report_date"{selected value=$smarty.get.order current="report_date"}>recent reports</option>
			</select>
		</label>
		<div class="first"></div>
		<label for="form-number" class="unitx1 first">
			School number<br />
			<input type="text" name="number" id="form-number" placeholder="any">
		</label>
		<input type="submit" class="unitx1" value="Filter" />
	</form>
</section>
<section id="results">
	{include file="/admin/friendship_schools/schools_more.tpl"}
	{if $schools|@count gt $pagination.schools_in_admin}
		<h1 class="simple secret" id="more_results_loading">&nbsp;</h1>
		<h1 class="simple" id="more_results_heading">There are {$count} schools in total, <span id="more_results_from">{$schools|@count-1}</span> showing. See <a href="#" id="more_results_more">more</a>.</h1>
	{/if}
</section>