<?php /* Smarty version 2.6.16, created on 2011-08-09 12:20:53
         compiled from pages/campaigns/./old/results.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/paging.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_from = $this->_tpl_vars['campaigns']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['campaign'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['campaign']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['campaign']):
        $this->_foreach['campaign']['iteration']++;
?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/campaign.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php if (! ($this->_foreach['campaign']['iteration'] == $this->_foreach['campaign']['total'])): ?><span class="llclear h30"></span><?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/paging.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>