<{if $result_message}>
	<h3><{$result_message}></h3>
	<div class="hr"></div>
<{/if}>
<{if $result_noform}>
	<{if $smarty.post.join and !$smarty.post.confirmed}>
		<{include file="pages/join/preview.tpl"}>
	<{else}>
		<{assign var='result_noform' value=''}>
		<{assign var='result_message' value=''}>
		<{if !$context.name}>
			<{include file="pages/report.photos/results.tpl"}>
		<{/if}>
	<{/if}>
<{else}>
	<{assign var='result_message' value=''}>

	<span class="llclear h30"></span>
	<form method="post" action="<{$tpl.links.join}>" id="form-report" class="major">
	<input type="hidden" name="join" id="form-report-join" value="1">

	<{include file="pages/form.member.tpl"}>
	<{if $context.name}>
		<input type="hidden" name="actionnumber" value="<{$context.actionnumber}>">
		<input type="hidden" name="perfdate" value="<{$context.perfdate}>">
		<input type="hidden" name="perfdays" value="<{$context.perfdays}>">
		<input type="hidden" name="students" value="<{$context.students}>">
		<input type="hidden" name="age" value="<{$context.age}>">
		<input type="hidden" name="teachers" value="<{$context.teachers}>">
		<input type="hidden" name="parents" value="<{$context.parents}>">
		<input type="hidden" name="description" value="<{$context.description}>">
		<input type="hidden" name="context" value="<{$context.name}>">
	<{else}>
		<{include file="pages/form.report.tpl"}>
	<{/if}>
		
	<button type="submit" id="form-report-submit" class="ajax submit" tabindex="70">Press this button to preview your Registration!</button>
	<{if !$context.name}>
		<br>
		<small>We hope you enjoyed your action!</small>
	<{/if}>
	</form>
<{/if}>