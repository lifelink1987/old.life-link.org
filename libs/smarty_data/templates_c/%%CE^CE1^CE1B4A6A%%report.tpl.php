<?php /* Smarty version 2.6.16, created on 2011-06-16 13:58:55
         compiled from mail/report.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'mail/report.tpl', 6, false),)), $this); ?>
<br><br>
<h1>Action Report</h1>

<blockquote>
	<h2><strong><?php echo $this->_tpl_vars['report']['actions'][0]['actionnumber']; ?>
</strong> <a href="<?php echo $this->_tpl_vars['tpl']['links']['action'];  echo $this->_tpl_vars['report']['actions'][0]['actionnumber_raw']; ?>
"><?php echo $this->_tpl_vars['report']['actions'][0]['name']; ?>
</a></h2>
	<?php if (((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")) < $this->_tpl_vars['report']['perfdate']): ?>to be <?php endif; ?>performed on <?php echo ((is_array($_tmp=$this->_tpl_vars['report']['perfdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['tpl']['date_format']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['tpl']['date_format']));  if ($this->_tpl_vars['report']['perfdays']): ?>, and lasted for <?php echo $this->_tpl_vars['report']['perfdays']; ?>
 days<?php endif; ?>
	
	<br><br>
	<strong>involving</strong>
	<?php echo $this->_tpl_vars['report']['students']; ?>
 students<?php if ($this->_tpl_vars['report']['age']): ?> aged <?php echo $this->_tpl_vars['report']['age'];  endif; ?>
	<?php if ($this->_tpl_vars['report']['teachers']): ?>, <?php echo $this->_tpl_vars['report']['teachers']; ?>
 teachers<?php endif; ?>
	<?php if ($this->_tpl_vars['report']['parents']): ?>, <?php echo $this->_tpl_vars['report']['parents']; ?>
 parents<?php endif; ?>
	
	<br><br>
	<strong>Summary of activities</strong>:
	<blockquote><?php echo $this->_tpl_vars['report']['description']; ?>
</blockquote>
</blockquote>