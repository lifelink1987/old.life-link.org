<?php /* Smarty version 2.6.16, created on 2011-06-14 23:16:45
         compiled from pages/agenda/default.tpl */ ?>
<div id="llpagetitle">Agenda</div>
<div class="yui-g">
	<div class="yui-u first">
		<h3>Recently on the Agenda</h3>
		<?php $_from = $this->_tpl_vars['recent_agenda']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['event']):
?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/event.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endforeach; endif; unset($_from); ?>
	</div>
	<div class="yui-u">
		<h3>Next on the Agenda</h3>
		<?php $_from = $this->_tpl_vars['future_agenda']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['event']):
?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/event.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endforeach; endif; unset($_from); ?>
	</div>
</div>

<span class="llclear h20"></span>

<h1>Browse by month</h1>
<a name="resultsAnchor"></a>
<div id="wait"></div>
<div id="results" style="overflow:auto">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl']['current'])."results.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>