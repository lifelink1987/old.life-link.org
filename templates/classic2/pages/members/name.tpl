<div class="LL_page_title">Schools &amp; Actions</div>
<form method="get" action="<{$tpl.links.members}>" id="form_name">
	<input type="hidden" name="sub" value="name">
	<fieldset>
	<div class="LL_box">
		Search for a school that is named like
		<input type="text" name="namelike" autocomplete="off" value="<{$smarty.get.namelike}>">
		<div class="LL_margin">
			* minimum 4 letters, or simply use numbers<br>
			* do not use words like &quot;primary&quot;, &quot;secondary&quot;, &quot;high&quot;, &quot;school&quot;
		</div>
	</div>
	</fieldset>
	<p><a href="<{$tpl.links.members}>" class="LL_button">Back to Advanced Search</a>
		<input type="submit" value="Apply new Filters!">
	</p>
</form>
<span class="LL_clearer" style="height: 2em"></span>
<div class="LL_fright LL_h3">Country</div>
School Name,
<h3>City</h3>
<span class="LL_clearer"></span>
<hr>
<{foreach from=$schools item=school}>
<{include file="pages/members/list/item_school.tpl"}>
<{/foreach}>