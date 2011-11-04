<?php /* Smarty version 2.6.16, created on 2011-06-14 21:17:55
         compiled from pages/members/./school/default.tpl */ ?>
<div id="llpagetitle">Schools &amp; Actions</div>
<div id="llpagesubtitle">Life-Link School page</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/member.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<span class="llclear h20"></span>

<h2>Our School's Registered Action Reports</h2>
<a name="resultsAnchor"></a>
<div id="wait"></div>
<div id="results">	
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl']['current'])."school/results.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<span class="llclear h10"></span>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl']['current'])."school/search.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>