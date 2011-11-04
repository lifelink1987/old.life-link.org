<?php /* Smarty version 2.6.16, created on 2011-06-16 11:07:49
         compiled from pages/campaigns/./default.tpl */ ?>
<div id="related">
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "official:".($this->_tpl_vars['tpl']['current'])."related.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<div id="llpagetitle">Campaigns</div>
<div id="llpagesubtitle">In the Spotlight</div>
<?php if ($this->_tpl_vars['campaigns_now']): ?>
	<h1>Now &amp; Upcoming</h1>
	<?php $_from = $this->_tpl_vars['campaigns_now']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['campaign']):
?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/campaign.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<span class="llclear h30"></span>
	<?php endforeach; endif; unset($_from); ?>
	<span class="llclear h30"></span>
<?php endif; ?>
<?php if ($this->_tpl_vars['campaigns_latest']): ?>
	<h1>Most Recent</h1>
	<?php $_from = $this->_tpl_vars['campaigns_latest']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['campaign'] = array('total' => count($_from), 'iteration' => 0);
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
<?php endif; ?>