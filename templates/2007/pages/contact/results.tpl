<{if $result_message}>
	<{foreach from=$result_message item=message}>
		<h3><{$message}></h3>
	<{/foreach}>
	<div class="hr"></div>
	<{if $school}>
		<{include file="pages/member.short.tpl"}>
		<{include file="pages/report.tpl"}>
	<{/if}>
<{/if}>
<{if !$result_noform}>
<form method="post" action="<{$tpl.links.contact}>" id="form-contact" class="major">
<input type="hidden" name="send" id="form-contact-send" value="1">
<{if $contact}><input type="hidden" name="to" id="form-contact-to" value="<{$contact.nickname}>"><{/if}>

<div class="sb">
	<dl>
		<dt>
			<label for="form-contact-name">Your name:</label>
			<em>*</em>
		</dt>
		<dd>
			<input type="text" name="name" id="form-contact-name" tabindex="1" class="name required" value="<{$smarty.post.name}>" maxlength="255"><br>
			<div id="form-contact-name-help" class="fieldHelp">
				<{include file="pages/forms/help.name.tpl"}>
			</div>
		</dd>
		
		<dt>
			<label for="form-contact-country">Your country:</label>
			<em>*</em>
		</dt>
		<dd>
			<select name="country" id="form-contact-country" tabindex="2" class="required">
			<{foreach from=$countries item=country}>
			<option value="<{$country.codenumber}>"<{if $smarty.post.country}><{selected value=$smarty.post.country current=$country.codenumber}><{else}><{selected value=$geo->country_code3 current=$country.iso}><{/if}>><{$country.name}></option>
			<{/foreach}>
			</select>
		</dd>
		
		<dt>
			<label for="form-contact-message">Message:</label>
			<em>*</em>
		</dt>
		<dd>
			<textarea name="message" id="form-contact-message" tabindex="3" class="required limitation ondemandhelp" rows="6"><{$default.message}></textarea><br>
			<small><strong>English please!</strong> Please use no more than <strong>500 characters</strong> (out of which, <strong id="form-contact-message-limitation">500</strong> left).</small>
			<div id="form-contact-message-help" class="fieldHelp">
				<{include file="pages/forms/help.limitation.tpl"}>
			</div>
		</dd>
	</dl>
</div>

<span class="llclear h20"></span>
<span class="h2">If you are looking for a reply to your message, <strong>fill in with</strong></span>
<div class="sb">
	<div class="yui-g">
		<div class="yui-u first">
			<dl>
				<dt>
					<label for="form-contact-email">Your E-m@il:</label>
					<em></em>
				</dt>
				<dd>
					<input type="text" name="email" id="form-contact-email" tabindex="5" class="email" value="<{$smarty.post.email}>" maxlength="255">
					<div id="form-contact-email-help" class="fieldHelp">
						<{include file="pages/forms/help.email.tpl"}>
					</div>
				</dd>
				
				<dt>
					<label for="form-contact-mail">Your Full Address:</label>
					<em></em>
				</dt>
				<dd>
					<input type="text" name="mail" id="form-contact-mail" tabindex="6" value="<{$smarty.post.mail}>" maxlength="255">
					<div id="form-contact-mail-help" class="fieldHelp">
						<div class="bd">
							GUIDELINE<br>
							<blockquote>
								StreetName #StreetNumber, BuildingInformation, City ZipCode
							</blockquote>
						</div>
					</div>
				</dd>
			</dl>
		</div>
		<div class="yui-u">
			<dl>
				<dt>
					<label for="form-contact-tel">Your Telephone:</label>
					<em></em>
				</dt>
				<dd>
					<input type="text" name="tel" id="form-contact-tel" tabindex="7" class="phone" value="<{$smarty.post.tel}>" maxlength="255">
					<div id="form-contact-tel-help" class="fieldHelp">
						<{include file="pages/forms/help.phone.tpl"}>
					</div>
				</dd>
				
				<dt>
					<label for="form-contact-fax">Your Fax:</label>
					<em></em>
				</dt>
				<dd>
					<input type="text" name="fax" id="form-contact-fax" tabindex="8" class="phone" value="<{$smarty.post.fax}>" maxlength="255">
					<div id="form-contact-fax-help" class="fieldHelp">
						<{include file="pages/forms/help.phone.tpl"}>
					</div>
				</dd>
			</dl>
		</div>
	</div>
</div>

<span class="llclear h20"></span>
<dl>
	<dt>
		<label for="form-contact-catpcha">Signature:</label>
		<em>*</em>
	</dt>
	<dd>
		<div class="yui-g">
			<div class="yui-u first">
				<input type="text" name="captcha" id="form-contact-captcha" class="captcha required" tabindex="4" autocomplete="off" maxlength="5"><br>
				<small>as a mean of signing, please write above<br><strong>the letters you read on the right</strong></small>
			</div>
			<div class="yui-u">
				<img src="<{$tpl.links.captcha}>" alt="Signature" id="form-contact-captcha-image">
			</div>
		</div>
	</dd>
</dl>

<span class="llclear h10"></span>

<button type="submit" tabindex="9" id="form-contact-submit" class="ajax submit">Thank you for your time!</button><br>
<small>Press this button to send your message</small>
</form>
<{/if}>