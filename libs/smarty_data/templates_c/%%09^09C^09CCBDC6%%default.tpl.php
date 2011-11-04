<?php /* Smarty version 2.6.16, created on 2011-06-15 07:46:48
         compiled from pages/conferences/./old/default.tpl */ ?>
<div id="related">
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "official:".($this->_tpl_vars['tpl']['current'])."related.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<div id="llpagetitle">Conferences</div>
<div id="llpagesubtitle">Previous</div>
<?php if ($this->_tpl_vars['conferences']): ?>
<a name="resultsAnchor"></a>
<div id="wait"></div>
<div id="results">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl']['current'])."old/results.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php endif; ?>