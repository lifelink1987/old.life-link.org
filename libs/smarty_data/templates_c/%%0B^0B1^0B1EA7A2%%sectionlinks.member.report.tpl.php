<?php /* Smarty version 2.6.16, created on 2011-06-14 21:17:17
         compiled from pages/sectionlinks.member.report.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'pages/sectionlinks.member.report.tpl', 7, false),)), $this); ?>
<?php if (! $this->_tpl_vars['nosectionlinks']): ?>
	<?php if ($_SESSION['lltemplatelevel'] > 0): ?>
		<div class="yuimenu sectionlinks">
			<div class="bd">
				<ul>
					<li class="yuimenuitem"><a href="<?php echo $this->_tpl_vars['tpl']['links']['member'];  echo $this->_tpl_vars['report']['school']['schoolnumber']; ?>
">Information about the school</a></li>
					<li class="yuimenuitem"><a href="<?php echo $this->_tpl_vars['tpl']['links']['members_get_country'];  echo $this->_tpl_vars['report']['school']['country']; ?>
&amp;list_sr=r&amp;list_order=latest&amp;list_city=<?php echo $this->_tpl_vars['report']['school']['city']; ?>
"><?php echo $this->_tpl_vars['report']['school']['countryname']; ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['report']['school']['city'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
 : Most recent reports</a></li>
					<li class="yuimenuitem"><a href="<?php echo $this->_tpl_vars['tpl']['links']['members_get_country'];  echo $this->_tpl_vars['report']['school']['country']; ?>
&amp;list_city=<?php echo $this->_tpl_vars['report']['school']['city']; ?>
"><?php echo $this->_tpl_vars['report']['school']['countryname']; ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['report']['school']['city'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
 : Life-Link schools</a></li>
					<li class="yuimenuitem"><a href="<?php echo $this->_tpl_vars['tpl']['links']['members_get_country'];  echo $this->_tpl_vars['report']['school']['country']; ?>
&amp;list_sr=r&amp;list_order=latest"><?php echo ((is_array($_tmp=$this->_tpl_vars['report']['school']['countryname'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
 : Most recent reports</a></li>
					<li class="yuimenuitem"><a href="<?php echo $this->_tpl_vars['tpl']['links']['members_get_country'];  echo $this->_tpl_vars['report']['school']['country']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['report']['school']['countryname'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
 : Life-Link schools</a></li>
				</ul>
			</div>
		</div>
	<?php else: ?>
		<a href="<?php echo $this->_tpl_vars['tpl']['links']['member'];  echo $this->_tpl_vars['report']['school']['schoolnumber']; ?>
">Details</a>
	<?php endif; ?>
<?php endif; ?>