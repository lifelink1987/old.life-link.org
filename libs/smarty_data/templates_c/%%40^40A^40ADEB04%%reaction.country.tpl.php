<?php /* Smarty version 2.6.16, created on 2011-06-15 04:46:16
         compiled from pages/reaction.country.tpl */ ?>
<div class="h1"><?php echo $this->_tpl_vars['country']; ?>
</div>
<?php $_from = $this->_tpl_vars['country_reactions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['reaction'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['reaction']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['reaction']):
        $this->_foreach['reaction']['iteration']++;
?>
	<?php if (! ($this->_foreach['reaction']['iteration'] <= 1)): ?><span class="llclear" style="height:1em"></span><?php endif; ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/reaction.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endforeach; endif; unset($_from); ?>