<?php /* Smarty version 2.6.16, created on 2011-07-14 14:16:27
         compiled from pages/join/preview.tpl */ ?>
<span class="llclear h30"></span>

<div class="lltextsmall">
	<?php $this->assign('nosectionlinks', true); ?>
	<?php $this->assign('nolinks', true); ?>
	<?php $this->assign('notoggler', true); ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/member.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	
	<?php if (! $this->_tpl_vars['context']['name']): ?>
		<span class="llclear h10"></span>
		<?php $this->assign('nosectionlinks', true); ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/report.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
</div>

<span class="llclear h10"></span>
<form method="post" action="<?php echo $this->_tpl_vars['tpl']['links']['join']; ?>
" id="form-report" class="major">
	<input type="hidden" name="confirmed" id="form-report-confirmed" value="1">
	
	<?php $_from = $this->_tpl_vars['default']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['defaultkey'] => $this->_tpl_vars['defaultitem']):
?>
		<input type="hidden" name="<?php echo $this->_tpl_vars['defaultkey']; ?>
" value="<?php echo $this->_tpl_vars['defaultitem']; ?>
">
	<?php endforeach; endif; unset($_from); ?>

	<dl>
		<dt>
			<label for="form-report-catpcha">Signature:</label>
			<em>*</em>
		</dt>
		<dd>
			<div class="yui-g">
				<div class="yui-u first">
					<input type="text" name="captcha" id="form-report-captcha" class="captcha required" tabindex="58" autocomplete="off" maxlength="5"><br>
					<small>as a mean of signing, please write above<br><strong>the letters you read on the right</strong></small>
				</div>
				<div class="yui-u">
					<img src="<?php echo $this->_tpl_vars['tpl']['links']['captcha']; ?>
" alt="Signature" id="form-report-captcha-image">
				</div>
			</div>
		</dd>
	</dl>

	If everything looks in order
	<button type="submit" id="form-report-submit" class="ajax submit">Press this button to confirm this Registration!</button>
	<?php if (! $this->_tpl_vars['context']): ?>
		<br>
		<small>We hope you enjoyed your action!</small>
	<?php endif; ?>
</form>

<div class="hr"></div>
<span class="llclear h30"></span>
<form method="post" action="<?php echo $this->_tpl_vars['tpl']['links']['join']; ?>
" id="form-report-edit" class="major lltextsmall">
	<input type="hidden" name="edit" id="form-report-edit-edit" value="1">
	
	<?php $_from = $this->_tpl_vars['default']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['defaultkey'] => $this->_tpl_vars['defaultitem']):
?>
		<input type="hidden" name="<?php echo $this->_tpl_vars['defaultkey']; ?>
" value="<?php echo $this->_tpl_vars['defaultitem']; ?>
">
	<?php endforeach; endif; unset($_from); ?>
	
	If not, and you want to change something<br>
	<button type="submit" id="form-report-edit-submit" class="ajax submit">Press this button to edit this Registration!</button>
</form>