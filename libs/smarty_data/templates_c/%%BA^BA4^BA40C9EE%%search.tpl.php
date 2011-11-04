<?php /* Smarty version 2.6.16, created on 2011-06-14 22:36:42
         compiled from pages/members/search.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'pages/members/search.tpl', 2, false),)), $this); ?>
<?php if ($this->_tpl_vars['result_message']): ?>
	<h3><?php echo ((is_array($_tmp=$this->_tpl_vars['result_message'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</h3>
	<div class="hr"></div>
<?php endif; ?>
<?php if ($_GET['search'] != 'advanced'): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl']['current'])."search.simple.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>

<a class="llfloatr" href="<?php echo $this->_tpl_vars['tpl']['links']['members']; ?>
">Basic Search</a>
<h1>Advanced Search</h1>
<span class="llclear"></span>
<form method="get" action="<?php echo $this->_tpl_vars['tpl']['links']['members']; ?>
" id="form-advanced" anchor="resultsAnchor">
	<input type="hidden" name="search" value="advanced">
	<input type="hidden" name="sub" value="list">
	<fieldset>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl']['current'])."search.advanced.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<button type="submit" class="llfloatr" id="form-advanced-submit">Click!</button>
	</fieldset>
</form>

<span class="llclear h10"></span>
<div class="yui-gc">
	<div class="yui-u first">
		<form method="get" action="<?php echo $this->_tpl_vars['tpl']['links']['members']; ?>
" id="form-members-name" anchor="resultsAnchor">
			<input type="hidden" name="search" value="advanced" id="form-members-name-search">
			<input type="hidden" name="sub" value="name" id="form-members-name-sub">
			<div class="h2">Schools that have this word/phrase inside their name</div>
			<fieldset>
				<input type="text" name="namelike" autocomplete="off" value="<?php echo $_GET['namelike']; ?>
" class="required membername" id="form-members-name-namelike" size="50" maxlength="255">
				<button type="submit" id="form-members-name-submit">Click!</button><br>
				<small>* minimum 3 letters, or simply use numbers</small>
				<div id="form-members-name-namelike-autocomplete" class="autocomplete" rel="<?php echo $this->_tpl_vars['tpl']['links']['member']; ?>
"></div>
			</fieldset>
		</form>
	</div>
	<div class="yui-u">
		<form method="get" action="<?php echo $this->_tpl_vars['tpl']['links']['members']; ?>
" id="form-members-schoolnumber" anchor="resultsAnchor">
			<input type="hidden" name="sub" id="form-members-schoolnumber-sub" value="school">
			<div class="h2">School with Life-Link number</div>
			<fieldset>
				<input type="text" name="schoolnumber" id="form-members-schoolnumber-schoolnumber" value="<?php echo $_GET['schoolnumber']; ?>
" class="numbers required" size="3" maxlength="3">
				<button type="submit" id="form-members-schoolnumber-submit">Click!</button><br>
				<small>&nbsp;</small>
			</fieldset>
		</form>
	</div>
</div>
<?php endif; ?>