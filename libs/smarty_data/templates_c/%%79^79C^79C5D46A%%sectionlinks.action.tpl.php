<?php /* Smarty version 2.6.16, created on 2011-06-14 21:17:17
         compiled from pages/sectionlinks.action.tpl */ ?>
<?php if (! $this->_tpl_vars['nosectionlinks']): ?>
	<?php if ($_SESSION['lltemplatelevel'] > 0): ?>
		<div class="yuimenu sectionlinks">
			<div class="bd">
				<ul>
					<li class="yuimenuitem"><a href="<?php echo $this->_tpl_vars['tpl']['links']['action'];  echo $this->_tpl_vars['action']['actionnumber_raw']; ?>
">Action <?php echo $this->_tpl_vars['action']['actionnumber']; ?>
</a></li>
					<li class="yuimenuitem"><a href="<?php echo $this->_tpl_vars['tpl']['links']['members_get']; ?>
list&amp;list_sr=r&amp;guideline=on&amp;guideline_action=<?php echo $this->_tpl_vars['action']['actionnumber_raw']; ?>
">Action <?php echo $this->_tpl_vars['action']['actionnumber']; ?>
 : Reports</a></li>
					<li class="yuimenuitem"><a href="<?php echo $this->_tpl_vars['tpl']['links']['members_get']; ?>
list&amp;list_sr=s&amp;guideline=on&amp;guideline_action=<?php echo $this->_tpl_vars['action']['actionnumber_raw']; ?>
">Action <?php echo $this->_tpl_vars['action']['actionnumber']; ?>
 : Reporting Schools</a></li>
					<li class="yuimenuitem"><a href="<?php echo $this->_tpl_vars['tpl']['links']['action'];  echo $this->_tpl_vars['action']['chapter']['actionnumber_raw']; ?>
"><?php echo $this->_tpl_vars['action']['chapter']['name']; ?>
</a></li>
					<li class="yuimenuitem"><a href="<?php echo $this->_tpl_vars['tpl']['links']['members_get']; ?>
list&amp;list_sr=r&amp;guideline=on&amp;guideline_action=<?php echo $this->_tpl_vars['action']['chapter']['actionnumber_raw']; ?>
"><?php echo $this->_tpl_vars['action']['chapter']['name']; ?>
 : Reports</a></li>
					<li class="yuimenuitem"><a href="<?php echo $this->_tpl_vars['tpl']['links']['members_get']; ?>
list&amp;list_sr=s&amp;guideline=on&amp;guideline_action=<?php echo $this->_tpl_vars['action']['chapter']['actionnumber_raw']; ?>
"><?php echo $this->_tpl_vars['action']['chapter']['name']; ?>
 : Reporting Schools</a></li>
				</ul>
			</div>
		</div>
	<?php else: ?>
		<a href="<?php echo $this->_tpl_vars['tpl']['links']['action'];  echo $this->_tpl_vars['action']['actionnumber_raw']; ?>
">Details</a>
	<?php endif; ?>
<?php endif; ?>