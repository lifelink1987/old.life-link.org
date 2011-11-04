<?php /* Smarty version 2.6.16, created on 2011-06-15 08:05:06
         compiled from mail/header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'mail/header.tpl', 8, false),)), $this); ?>
<html>
<head>
<title>Life-Link Friendship-Schools</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!--CSS files-->
<style type="text/css">
<?php $_from = $this->_tpl_vars['tpl']['email_css_files']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['css_item']):
?>
	<?php $this->assign('temp', ((is_array($_tmp=$this->_tpl_vars['css_item'])) ? $this->_run_mod_handler('replace', true, $_tmp, $this->_tpl_vars['tpl']['host'], '') : smarty_modifier_replace($_tmp, $this->_tpl_vars['tpl']['host'], ''))); ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=$this->_tpl_vars['temp'])) ? $this->_run_mod_handler('replace', true, $_tmp, $this->_tpl_vars['tpl']['webpath'], $this->_tpl_vars['tpl']['root']) : smarty_modifier_replace($_tmp, $this->_tpl_vars['tpl']['webpath'], $this->_tpl_vars['tpl']['root'])), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endforeach; endif; unset($_from); ?>
</style>
<!--CSS files end-->
<body>
<div id="page-content">