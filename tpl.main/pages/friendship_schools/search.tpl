{include file="/obj/js_form.tpl"}
<section>
	<h1>Search Friendship-Schools</h1>
	{include file="/obj/byline.tpl"}
	<h3 class="center"><em>and their</em> Action Reports</h3>
	<form method="GET">
		<input type="hidden" name="search" value="1">
		<label class="unitx1 first">&nbsp;</label>
		<label for="form-type" class="unitx1">
			Show
			<select name="type" id="form-type">
				<option value="school"{selected value=$smarty.get.type current="school"}>schools</option>
				<option value="report"{selected value=$smarty.get.type current="report"}>reports</option>
			</select>
		</label>
		<label for="form-order" class="unitx1">
			Ordered by<br />
			<select name="order" id="form-order">
				<option value="school"{selected value=$smarty.get.order current="school"}>school name</option>
				<option value="report_date"{selected value=$smarty.get.order current="report_date"}>recent reports</option>
			</select>
		</label>
		<label for="form-country" class="unitx1">
			{include file="/obj/filter_schools_country.tpl"}
		</label>
		<label for="form-city" class="unitx1" style="display:none">
			{include file="/obj/filter_schools_city.tpl"}
		</label>
		<div class="first"></div>
		<label class="unitx1 first right"><span id="form-placeholder1">{if $smarty.get.type neq 'report'}with Reports{/if}</span></label>
		<label for="form-action" class="unitx1">
			{include file="/obj/filter_reports_action.tpl"}
		</label>
		<label for="form-period" class="width1 double">
			{include file="/obj/filter_period.tpl" label="Performed between"}
		</label>
		<label for="form-photos" class="unitx1">
			{include file="/obj/filter_reports_photo.tpl"}
		</label>
		<div class="first"></div>
		<label class="unitx1 first">&nbsp;</label>
		<input type="submit" class="unitx1" value="Search" />
	</form>
</section>
<section id="results">
	{if $smarty.get.search}
		{include file="/friendship_schools/search_more.tpl"}
		{if $results|@count gt $pagination.results_in_search}
			<h1 class="simple secret" id="more_results_loading">&nbsp;</h1>
			<h1 class="simple" id="more_results_heading">There are more {if $smarty.get.type eq 'school'}schools{else}reports{/if} available. See <a href="#" id="more_results_more">more</a>.</h1>
		{/if}
	{/if}
</section>
