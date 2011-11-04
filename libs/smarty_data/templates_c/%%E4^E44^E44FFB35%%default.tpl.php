<?php /* Smarty version 2.6.16, created on 2011-06-14 21:18:27
         compiled from pages/members/./list/default.tpl */ ?>
<div id="llpagetitle">Schools &amp; Actions</div>
<div id="llpagesubtitle">Search results for</div>
<form method="get" action="<?php echo $this->_tpl_vars['tpl']['links']['members']; ?>
" id="form-advanced" anchor="resultsAnchor">
	<input type="hidden" name="sub" value="list">
	<fieldset>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl']['current'])."search.advanced.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<button type="submit" class="ajax llfloatr" id="form-advanced-submit">Click!</button>
	</fieldset>
</form>
<span class="llclear h10"></span>
<a name="resultsAnchor"></a>
<div id="wait"></div>
<div id="results">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl']['current'])."list/results.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>