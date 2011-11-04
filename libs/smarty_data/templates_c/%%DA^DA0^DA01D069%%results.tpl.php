<?php /* Smarty version 2.6.16, created on 2011-06-15 14:49:46
         compiled from pages/members/./school/results.tpl */ ?>
<?php if ($this->_tpl_vars['result_message']): ?>
	<h3><?php echo $this->_tpl_vars['result_message']; ?>
</h3>
<?php endif; ?>
<?php $this->assign('page_link', ($this->_tpl_vars['page_link'])."#results"); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/paging.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_from = $this->_tpl_vars['reports']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['report'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['report']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['report']):
        $this->_foreach['report']['iteration']++;
?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/report.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php if (! ($this->_foreach['report']['iteration'] == $this->_foreach['report']['total'])): ?><span class="llclear h30"></span><?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/paging.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>