<div class="LL_page_title">Want to Join in?</div>
<{if $result_message}>
<div class="LL_box1">
	<div class="LL_box LL_center">
		<{$result_message}>
	</div>
</div>
<span class="LL_clearer" style="height: 2em"></span>
<{/if}>
<{if !$result_noform}>
<div class="LL_bcenter" style="width: 500px">
<form method="post" action="<{$tpl.links.join}>" id="form_join" enctype="multipart/form-data">
	<input type="hidden" name="join" value="1">
	
	Compulsory fields are underlined with red.<br>
	Please leave fields empty if you have no information for that specific field.<br><br>
	
	<{include file="pages/form_join.tpl"}>
	<{include file="pages/form_report.tpl"}>
	
	<p>
		<input type="submit" value="Please, register our school!">
	</p>
</form>

</div>
<{/if}>