<?php /* Smarty version 2.6.16, created on 2011-06-14 21:34:54
         compiled from pages/members/list/item_school.tpl */ ?>
<a href="<?php echo $this->_tpl_vars['tpl']['links']['members_get_country'];  echo $this->_tpl_vars['school']['country']; ?>
" title="Click to see member schools in <?php echo $this->_tpl_vars['school']['countryname']; ?>
" class="llfloatr"><strong><?php echo $this->_tpl_vars['school']['countryname']; ?>
</strong>
	<?php if ($this->_tpl_vars['school']['countryflag']): ?>
		<img src="<?php echo $this->_tpl_vars['tpl']['links']['flag_get'];  echo $this->_tpl_vars['school']['countryflag']; ?>
">
	<?php endif; ?>
</a>
<?php if (! $this->_tpl_vars['school']['registered']): ?><span class="llfloatr"><small>awaiting approval&nbsp;</small></span><?php endif; ?>
<a href="<?php echo $this->_tpl_vars['tpl']['links']['member'];  echo $this->_tpl_vars['school']['schoolnumber']; ?>
"><?php echo $this->_tpl_vars['school']['name']; ?>
</a>, <a href="<?php echo $this->_tpl_vars['tpl']['links']['members_get_country'];  echo $this->_tpl_vars['school']['country']; ?>
&list_city=<?php echo $this->_tpl_vars['school']['city']; ?>
" title="Click to see member schools in <?php echo $this->_tpl_vars['school']['city']; ?>
, <?php echo $this->_tpl_vars['school']['countryname']; ?>
"><strong><?php echo $this->_tpl_vars['school']['city']; ?>
</strong></a>
<span class="llclear"></span>