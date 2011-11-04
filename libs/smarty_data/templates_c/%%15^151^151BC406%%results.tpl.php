<?php /* Smarty version 2.6.16, created on 2011-06-15 07:46:48
         compiled from pages/conferences/old/results.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/paging.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_from = $this->_tpl_vars['conferences']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['conference'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['conference']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['conference']):
        $this->_foreach['conference']['iteration']++;
?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/conference.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php if (! ($this->_foreach['conference']['iteration'] == $this->_foreach['conference']['total'])): ?><span class="llclear h30"></span><?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/paging.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>