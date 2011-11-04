<?php /* Smarty version 2.6.16, created on 2011-06-14 23:15:26
         compiled from pages/join/results.tpl */ ?>
<?php if ($this->_tpl_vars['result_message']): ?>
	<h3><?php echo $this->_tpl_vars['result_message']; ?>
</h3>
	<div class="hr"></div>
<?php endif; ?>
<?php if ($this->_tpl_vars['result_noform']): ?>
	<?php if ($_POST['join'] && ! $_POST['confirmed']): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/join/preview.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php else: ?>
		<?php $this->assign('result_noform', ''); ?>
		<?php $this->assign('result_message', ''); ?>
		<?php if (! $this->_tpl_vars['context']['name']): ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/report.photos/results.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>
	<?php endif; ?>
<?php else: ?>
	<?php $this->assign('result_message', ''); ?>

	<span class="llclear h30"></span>
	<form method="post" action="<?php echo $this->_tpl_vars['tpl']['links']['join']; ?>
" id="form-report" class="major">
	<input type="hidden" name="join" id="form-report-join" value="1">

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/form.member.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php if ($this->_tpl_vars['context']['name']): ?>
		<input type="hidden" name="actionnumber" value="<?php echo $this->_tpl_vars['context']['actionnumber']; ?>
">
		<input type="hidden" name="perfdate" value="<?php echo $this->_tpl_vars['context']['perfdate']; ?>
">
		<input type="hidden" name="perfdays" value="<?php echo $this->_tpl_vars['context']['perfdays']; ?>
">
		<input type="hidden" name="students" value="<?php echo $this->_tpl_vars['context']['students']; ?>
">
		<input type="hidden" name="age" value="<?php echo $this->_tpl_vars['context']['age']; ?>
">
		<input type="hidden" name="teachers" value="<?php echo $this->_tpl_vars['context']['teachers']; ?>
">
		<input type="hidden" name="parents" value="<?php echo $this->_tpl_vars['context']['parents']; ?>
">
		<input type="hidden" name="description" value="<?php echo $this->_tpl_vars['context']['description']; ?>
">
		<input type="hidden" name="context" value="<?php echo $this->_tpl_vars['context']['name']; ?>
">
	<?php else: ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/form.report.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
		
	<button type="submit" id="form-report-submit" class="ajax submit" tabindex="70">Press this button to preview your Registration!</button>
	<?php if (! $this->_tpl_vars['context']['name']): ?>
		<br>
		<small>We hope you enjoyed your action!</small>
	<?php endif; ?>
	</form>
<?php endif; ?>