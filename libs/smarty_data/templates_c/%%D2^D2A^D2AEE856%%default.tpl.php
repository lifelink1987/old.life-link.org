<?php /* Smarty version 2.6.16, created on 2011-06-15 04:55:45
         compiled from pages/conferences/default.tpl */ ?>
<div id="related">
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "official:".($this->_tpl_vars['tpl']['current'])."related.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<div id="llpagetitle">Conferences</div>
<div id="llpagesubtitle">In the Spotlight</div>
<?php if ($this->_tpl_vars['conferences_now']): ?>
	<h1>Now &amp; Upcoming</h1>
	<?php $_from = $this->_tpl_vars['conferences_now']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['conference']):
?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/conference.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<span class="llclear h30"></span>
	<?php endforeach; endif; unset($_from); ?>
	<span class="llclear h30"></span>
<?php endif; ?>
<?php if ($this->_tpl_vars['conferences_latest']): ?>
	<h1>Most Recent</h1>
	<?php $_from = $this->_tpl_vars['conferences_latest']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['conference'] = array('total' => count($_from), 'iteration' => 0);
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
<?php endif; ?>