<?php /* Smarty version 2.6.16, created on 2011-06-15 08:05:07
         compiled from mail/contact.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'mail/contact.tpl', 2, false),)), $this); ?>
<div class="h1">New message<?php if ($this->_tpl_vars['contact']): ?> for <strong><?php echo $this->_tpl_vars['contact']['firstname']; ?>
</strong><?php endif; ?></div>
<div class="h2">from <strong><?php echo $this->_tpl_vars['name']; ?>
</strong>, in  <strong><?php echo ((is_array($_tmp=$this->_tpl_vars['country'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</strong></div>

<br><br>
<blockquote>
	<?php echo $this->_tpl_vars['message']; ?>

</blockquote>
<br><br>

<strong><?php echo $this->_tpl_vars['name']; ?>
</strong><br>
---<br>
<strong>Address</strong>: <?php echo $this->_tpl_vars['mail']; ?>
 (<?php echo $this->_tpl_vars['country']; ?>
)<br>
<strong>E-mail</strong>: <?php echo $this->_tpl_vars['email']; ?>
<br>
<strong>Telephone</strong>: <?php echo $this->_tpl_vars['tel']; ?>
<br>
<strong>Fax</strong>: <?php echo $this->_tpl_vars['fax']; ?>
