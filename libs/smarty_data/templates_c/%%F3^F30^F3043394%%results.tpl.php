<?php /* Smarty version 2.6.16, created on 2011-06-14 21:24:44
         compiled from pages/contact/results.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'selected', 'pages/contact/results.tpl', 36, false),)), $this); ?>
<?php if ($this->_tpl_vars['result_message']): ?>
	<?php $_from = $this->_tpl_vars['result_message']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['message']):
?>
		<h3><?php echo $this->_tpl_vars['message']; ?>
</h3>
	<?php endforeach; endif; unset($_from); ?>
	<div class="hr"></div>
	<?php if ($this->_tpl_vars['school']): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/member.short.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/report.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
<?php endif; ?>
<?php if (! $this->_tpl_vars['result_noform']): ?>
<form method="post" action="<?php echo $this->_tpl_vars['tpl']['links']['contact']; ?>
" id="form-contact" class="major">
<input type="hidden" name="send" id="form-contact-send" value="1">
<?php if ($this->_tpl_vars['contact']): ?><input type="hidden" name="to" id="form-contact-to" value="<?php echo $this->_tpl_vars['contact']['nickname']; ?>
"><?php endif; ?>

<div class="sb">
	<dl>
		<dt>
			<label for="form-contact-name">Your name:</label>
			<em>*</em>
		</dt>
		<dd>
			<input type="text" name="name" id="form-contact-name" tabindex="1" class="name required" value="<?php echo $_POST['name']; ?>
" maxlength="255"><br>
			<div id="form-contact-name-help" class="fieldHelp">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/forms/help.name.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>
		</dd>
		
		<dt>
			<label for="form-contact-country">Your country:</label>
			<em>*</em>
		</dt>
		<dd>
			<select name="country" id="form-contact-country" tabindex="2" class="required">
			<?php $_from = $this->_tpl_vars['countries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['country']):
?>
			<option value="<?php echo $this->_tpl_vars['country']['codenumber']; ?>
"<?php if ($_POST['country']):  echo mySmarty::function_option_selected(array('value' => $_POST['country'],'current' => $this->_tpl_vars['country']['codenumber']), $this); else:  echo mySmarty::function_option_selected(array('value' => $this->_tpl_vars['geo']->country_code3,'current' => $this->_tpl_vars['country']['iso']), $this); endif; ?>><?php echo $this->_tpl_vars['country']['name']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
			</select>
		</dd>
		
		<dt>
			<label for="form-contact-message">Message:</label>
			<em>*</em>
		</dt>
		<dd>
			<textarea name="message" id="form-contact-message" tabindex="3" class="required limitation ondemandhelp" rows="6"><?php echo $this->_tpl_vars['default']['message']; ?>
</textarea><br>
			<small><strong>English please!</strong> Please use no more than <strong>500 characters</strong> (out of which, <strong id="form-contact-message-limitation">500</strong> left).</small>
			<div id="form-contact-message-help" class="fieldHelp">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/forms/help.limitation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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
					<input type="text" name="email" id="form-contact-email" tabindex="5" class="email" value="<?php echo $_POST['email']; ?>
" maxlength="255">
					<div id="form-contact-email-help" class="fieldHelp">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/forms/help.email.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					</div>
				</dd>
				
				<dt>
					<label for="form-contact-mail">Your Full Address:</label>
					<em></em>
				</dt>
				<dd>
					<input type="text" name="mail" id="form-contact-mail" tabindex="6" value="<?php echo $_POST['mail']; ?>
" maxlength="255">
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
					<input type="text" name="tel" id="form-contact-tel" tabindex="7" class="phone" value="<?php echo $_POST['tel']; ?>
" maxlength="255">
					<div id="form-contact-tel-help" class="fieldHelp">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/forms/help.phone.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					</div>
				</dd>
				
				<dt>
					<label for="form-contact-fax">Your Fax:</label>
					<em></em>
				</dt>
				<dd>
					<input type="text" name="fax" id="form-contact-fax" tabindex="8" class="phone" value="<?php echo $_POST['fax']; ?>
" maxlength="255">
					<div id="form-contact-fax-help" class="fieldHelp">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/forms/help.phone.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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
				<img src="<?php echo $this->_tpl_vars['tpl']['links']['captcha']; ?>
" alt="Signature" id="form-contact-captcha-image">
			</div>
		</div>
	</dd>
</dl>

<span class="llclear h10"></span>

<button type="submit" tabindex="9" id="form-contact-submit" class="ajax submit">Thank you for your time!</button><br>
<small>Press this button to send your message</small>
</form>
<?php endif; ?>