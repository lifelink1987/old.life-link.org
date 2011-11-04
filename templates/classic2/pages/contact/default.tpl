<div class="LL_page_title">Send a Message<{if $contact}> to <{$contact.firstname}><{/if}></div>
<{if $result_message}>
<div class="LL_box1">
	<div class="LL_box LL_center">
		<{$result_message}>
	</div>
</div>
<span class="LL_clearer" style="height: 2em"></span>
<{/if}>
<{if !$contact}>
<div class="LL_box0 LL_bcenter" style="width: 450px">
	<div class="LL_box LL_center">
		<div class="LL_box0counter LL_fleft" style="width: 175px">
			<div class="LL_box LL_center"><{$tpl.images.leaf}></div>
		</div>
		<div class="LL_bright LL_right">
			<h3>Life-Link Friendship-Schools</h3><br>
			Uppsala Science Park<br>
			SE-751 83 Uppsala<br>
			SWEDEN
		</div>
		<a href="mailto:friendship-schools@life-link.org">friendship-schools@life-link.org</a><br>
		Telephone: +46 (0)18 50 43 44<br>
		Facsimile: +46 (0)18 50 85 03
	</div>
	<span class="LL_clearer"></span>
</div>
<span class="LL_clearer" style="height: 2em"></span>
<{/if}>
<{if !$result_noform}>
<div class="LL_bcenter" style="width: 500px">
<form method="post" action="<{$tpl.links.contact}>" id="form_contact">
	<input type="hidden" name="send" value="1">
	<{if $contact}><input type="hidden" name="to" value="<{$contact.nickname}>"><{/if}>
	<h2>Dear <{if $contact}><{$contact.firstname}><{else}>Life-Link Office<{/if}>,</h2><br>
	<{if $contact}>(<{$contact.title|replace:"<br />":","}>)<br><{/if}>
	
	<fieldset><div class="LL_box">
	<label for="name" class="column">I am</label><input type="text" name="name" value="<{$smarty.post.name}>" class="compulsory">,<br>
	<label for="country" class="column">from</label>
		<select name="country" class="compulsory">
		<{foreach from=$countries item=country}>
		<option value="<{$country.codenumber}>"<{if $smarty.post.country}><{selected value=$smarty.post.country current=$country.codenumber}><{else}><{selected value=$geo->country_code3 current=$country.iso}><{/if}>><{$country.name}></option>
		<{/foreach}>
		</select>.
	</div></fieldset>
	
	<textarea name="message" class="compulsory"><{$default.message}></textarea>
	<span class="LL_clearer" style="height: 1em"></span>
	
	<fieldset><div class="LL_box">
	You can reply to me<br>
	<label for="email" class="column">by E-mail at</label><input type="text" name="email" value="<{$smarty.post.email}>"><br>
	<label for="mail" class="column">or by post mail at</label><input type="text" name="mail" value="<{$smarty.post.mail}>"><br>
	<label for="tel" class="column">or by telephone at</label><input type="text" name="tel" value="<{$smarty.post.tel}>"><br>
	<label for="fax" class="column">or by fax at</label><input type="text" name="fax" value="<{$smarty.post.fax}>">
	</div></fieldset>
	
	<fieldset><div class="LL_box">
	<img src="captcha.php" class="LL_fright">
	Please write the same letters you read on the right.
	<input type="text" name="captcha" id="captcha" autocomplete="off" class="compulsory">
	<span class="LL_clearer"></span>
	</div></fieldset>
	
	<{if $contact}>
	<div class="LL_fright LL_right">
		This message will be delivered to<br>
		<b><{$contact.titlename}></b><br>
		<{$contact.title}>
	</div>
	<{/if}>
	
	<p>
		<input type="submit" value="Thank you for your time">
	</p>
	<span class="LL_clearer"></span>
</form>

</div>
<{/if}>