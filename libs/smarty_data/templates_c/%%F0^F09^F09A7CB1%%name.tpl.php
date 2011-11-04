<?php /* Smarty version 2.6.16, created on 2011-08-13 07:36:27
         compiled from pages/members/./name.tpl */ ?>
<div id="llpagetitle">Schools &amp; Actions</div>
<form method="get" action="<?php echo $this->_tpl_vars['tpl']['links']['members']; ?>
" id="form-members-name" anchor="resultsAnchor">
	<input type="hidden" name="search" value="advanced">
	<input type="hidden" name="sub" value="name">
	<div class="h2">Schools that have the word</div>
	<fieldset>
		<input type="text" name="namelike" autocomplete="off" value="<?php echo $_GET['namelike']; ?>
" class="required" maxlength="255"> inside their name<button type="submit" id="form-members-name-submit">Click!</button><br>
		<small>* minimum 3 letters, or simply use numbers</small>
	</fieldset>
</form>
<span class="llclear h10"></span>
<a name="resultsAnchor"></a>
<div class="llfloatr">COUNTRY</div>
School Name, CITY
<span class="llclear"></span>
<div class="hr"></div>
<?php $_from = $this->_tpl_vars['schools']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['school']):
?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/members/list/item_school.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endforeach; endif; unset($_from); ?>