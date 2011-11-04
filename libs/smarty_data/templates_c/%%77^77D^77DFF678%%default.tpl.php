<?php /* Smarty version 2.6.16, created on 2011-06-15 06:24:05
         compiled from pages/members/./default.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'selected', 'pages/members/./default.tpl', 19, false),)), $this); ?>
<div id="llpagetitle">Schools &amp; Actions</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl']['current'])."search.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<span class="llclear h10"></span>
<form method="get" action="<?php echo $this->_tpl_vars['tpl']['links']['report']; ?>
" id="form-members-report">
<div class="h2">Report a new Action performed by School</div>
<fieldset>
	<select name="schoolnumber" id="form-members-report-schoolnumber" class="required">
		<option value=""></option>
		<optgroup label="<?php echo $this->_tpl_vars['schools_cc'][0]['countryname']; ?>
, <?php echo $this->_tpl_vars['schools_cc'][0]['city']; ?>
">
			<?php $this->assign('currentcountry', ($this->_tpl_vars['schools_cc'][0]['countryname'])); ?>
			<?php $this->assign('currentcity', ($this->_tpl_vars['schools_cc'][0]['city'])); ?>
			<?php $_from = $this->_tpl_vars['schools_cc']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['school'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['school']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['school']):
        $this->_foreach['school']['iteration']++;
?>
				<?php if (( $this->_tpl_vars['school']['countryname'] != $this->_tpl_vars['currentcountry'] ) || ( $this->_tpl_vars['school']['city'] != $this->_tpl_vars['currentcity'] )): ?>
					<?php if (! ($this->_foreach['school']['iteration'] <= 1)): ?></optgroup><?php endif; ?>
					<?php if (! ($this->_foreach['school']['iteration'] == $this->_foreach['school']['total'])): ?><optgroup label="<?php echo $this->_tpl_vars['school']['countryname']; ?>
, <?php echo $this->_tpl_vars['school']['city']; ?>
"><?php endif; ?>
					<?php $this->assign('currentcountry', ($this->_tpl_vars['school']['countryname'])); ?>
					<?php $this->assign('currentcity', ($this->_tpl_vars['school']['city'])); ?>
				<?php endif; ?>
				<option value="<?php echo $this->_tpl_vars['school']['schoolnumber']; ?>
"<?php echo mySmarty::function_option_selected(array('value' => $_GET['schoolnumber'],'current' => $this->_tpl_vars['school']['schoolnumber']), $this);?>
><?php echo $this->_tpl_vars['school']['name']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</optgroup>
	</select>
	<button type="submit" id="form-members-report-submit">Fill in Report Form</button>
</fieldset>
</form>

<span class="llclear h10"></span>
<form method="get" action="<?php echo $this->_tpl_vars['tpl']['links']['join']; ?>
" id="form-members-join">
<div class="h2">Want to join in?</div>
<fieldset>
	<button type="submit" id="form-members-join-submit">Fill in Application Form</button>
</fieldset>
</form>