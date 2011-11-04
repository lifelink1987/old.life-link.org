<?php /* Smarty version 2.6.16, created on 2011-06-14 23:16:46
         compiled from pages/agenda/results.tpl */ ?>
<h3><?php echo $this->_tpl_vars['monthtitle']; ?>
 <?php echo $this->_tpl_vars['year']; ?>
</h3>
<ul class="llheaderh" id="paging-header">
	<li><a href="<?php echo $this->_tpl_vars['tpl']['links']['agenda']; ?>
?month=<?php echo $this->_tpl_vars['prevmonth']; ?>
&amp;year=<?php echo $this->_tpl_vars['prevyear']; ?>
#resultsAnchor">&laquo; <?php echo $this->_tpl_vars['prevmonthtitle']; ?>
 <?php echo $this->_tpl_vars['prevyear']; ?>
</a></li>
	<li><a href="<?php echo $this->_tpl_vars['tpl']['links']['agenda']; ?>
?month=<?php echo $this->_tpl_vars['nextmonth']; ?>
&amp;year=<?php echo $this->_tpl_vars['nextyear']; ?>
#resultsAnchor"><?php echo $this->_tpl_vars['nextmonthtitle']; ?>
 <?php echo $this->_tpl_vars['nextyear']; ?>
 &raquo;</a></li>
	<span class="llclear"></span>
</ul>
<span class="llclear"></span>

<?php $_from = $this->_tpl_vars['calendar']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['event']):
?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/event.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endforeach; endif; unset($_from); ?>