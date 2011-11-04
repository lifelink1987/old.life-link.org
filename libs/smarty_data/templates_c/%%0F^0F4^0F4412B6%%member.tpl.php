<?php /* Smarty version 2.6.16, created on 2011-06-16 13:58:55
         compiled from mail/member.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'mail/member.tpl', 12, false),)), $this); ?>
<h1>School Information</h1>

<blockquote>
	<h2><?php echo $this->_tpl_vars['school']['name']; ?>
 from <strong><?php echo $this->_tpl_vars['school']['city']; ?>
, <?php echo $this->_tpl_vars['school']['countryname']; ?>
</strong></h2>
	<?php if ($this->_tpl_vars['school']['registered']): ?>
		registered with no. <?php echo $this->_tpl_vars['school']['schoolnumber']; ?>

	<?php endif; ?>
	
	<br><br>
	<blockquote>
		<strong>Address</strong>: <?php echo $this->_tpl_vars['school']['address']; ?>
<br>
		<strong>City/Village, ZipCode/PostCode, Country</strong>: <?php echo $this->_tpl_vars['school']['city']; ?>
, <?php echo $this->_tpl_vars['school']['zipcode']; ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['school']['countryname'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>

		
		<br><br>
		<strong>Telephone(s)</strong>: <?php echo $this->_tpl_vars['school']['tel']; ?>
<br>
		<strong>Fax(s)</strong>: <?php echo $this->_tpl_vars['school']['fax']; ?>

		
		<br><br>
		<strong>E-mail(s)</strong>: <?php echo $this->_tpl_vars['school']['email']; ?>
<br>
		<strong>Website</strong>: <?php echo $this->_tpl_vars['school']['website']; ?>

		
		<br><br>
		<strong>Contact Student(s)</strong>: <?php echo $this->_tpl_vars['school']['studentcontact']; ?>
<br>
		<strong>Contact Teacher(s)</strong>: <?php echo $this->_tpl_vars['school']['teachercontact']; ?>

	</blockquote>
</blockquote>