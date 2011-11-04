<?php /* Smarty version 2.6.16, created on 2011-06-14 21:17:17
         compiled from pages/report.member.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'pages/report.member.tpl', 9, false),array('modifier', 'truncate', 'pages/report.member.tpl', 9, false),array('modifier', 'upper', 'pages/report.member.tpl', 10, false),)), $this); ?>
<div class="yui-gf" style="padding-left: 6px; padding-right: 6px">
	<div class="yui-u first">
	</div>
	<div class="yui-u">
		<div class="llfloatr">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/sectionlinks.member.report.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
		<div class="llfloatl">
			<span class="h2"><strong title="<?php echo ((is_array($_tmp=$this->_tpl_vars['report']['school']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['report']['school']['name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 60) : smarty_modifier_truncate($_tmp, 60)); ?>
</strong></span><br>
			in <?php echo $this->_tpl_vars['report']['school']['city']; ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['report']['school']['countryname'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>

			<?php if ($this->_tpl_vars['report']['school']['countryflag']): ?>
				<img src="<?php echo $this->_tpl_vars['tpl']['links']['flag_get'];  echo $this->_tpl_vars['report']['school']['countryflag']; ?>
">
			<?php endif; ?>
		</div>
	</div>
</div>
<span class="llclear"></span>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/report.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>