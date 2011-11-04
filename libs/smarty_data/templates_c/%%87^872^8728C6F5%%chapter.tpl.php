<?php /* Smarty version 2.6.16, created on 2011-06-15 16:32:33
         compiled from pages/actions/chapter.tpl */ ?>
<div id="related">
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "official:".($this->_tpl_vars['tpl']['current'])."related.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<div id="llpagesuptitle">Peace Actions</div>
<div id="llpagetitle"><?php echo $this->_tpl_vars['chapter']['name']; ?>
</div>
<dl>
<?php $_from = $this->_tpl_vars['actions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['action']):
?>
<dt><?php echo $this->_tpl_vars['action']['actionnumber']; ?>
</dt>
<dd><a href="<?php echo $this->_tpl_vars['tpl']['links']['action'];  echo $this->_tpl_vars['action']['actionnumber_raw']; ?>
" class="h2"><?php echo $this->_tpl_vars['action']['name']; ?>
</a> <?php if ($this->_tpl_vars['action']['old']): ?>OUT OF DATE<?php endif; ?></dd>
<?php endforeach; endif; unset($_from); ?>
</dl>

<?php if ($this->_tpl_vars['reports']): ?>
<span class="llclear h30"></span>
<h1><strong>Examples of reports on this action</strong></h1>
<a href="<?php echo $this->_tpl_vars['tpl']['links']['members_get']; ?>
list&amp;list_sr=r&amp;list_order=latest&amp;guideline_action=<?php echo $this->_tpl_vars['action']['actionnumber_raw']; ?>
">Show all reports</a>
&middot; <a href="<?php echo $this->_tpl_vars['tpl']['links']['members_get']; ?>
list&amp;guideline_action=<?php echo $this->_tpl_vars['action']['actionnumber_raw']; ?>
">Show all reporting schools</a>
<?php $_from = $this->_tpl_vars['reports']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['report']):
?>
	<span class="llclear" style="height:2em"></span>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/member_report.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>