<?php /* Smarty version 2.6.16, created on 2011-06-14 21:39:15
         compiled from pages/report/results.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'pages/report/results.tpl', 32, false),array('modifier', 'escape', 'pages/report/results.tpl', 36, false),array('modifier', 'truncate', 'pages/report/results.tpl', 36, false),array('function', 'switcher', 'pages/report/results.tpl', 39, false),array('function', 'selected', 'pages/report/results.tpl', 55, false),)), $this); ?>
<?php if ($this->_tpl_vars['result_message']): ?>
	<h3><?php echo $this->_tpl_vars['result_message']; ?>
</h3>
	<div class="hr"></div>
<?php endif; ?>
<?php if ($this->_tpl_vars['result_noform']): ?>
	<?php if ($_POST['report'] && ! $_POST['confirmed']): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/report/preview.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php else: ?>
		<?php $this->assign('result_noform', ''); ?>
		<?php $this->assign('result_message', ''); ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/report.photos/results.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
<?php else: ?>

<?php if ($_SESSION['llreport'] && $_SESSION['unique'] && ! $this->_tpl_vars['result_message']): ?>
	You have previously reported another Action. Do you want to add Action Photos to the report? <a href="<?php echo $this->_tpl_vars['tpl']['links']['report_photos']; ?>
">Click Here!</a>
<?php endif; ?>
<?php $this->assign('result_message', ''); ?>

<span class="llclear h30"></span>
<form method="post" action="<?php echo $this->_tpl_vars['tpl']['links']['report']; ?>
" id="form-report" class="major">
<input type="hidden" name="report" id="form-report-report" value="1">

<div class="sb">
	<dl>
		<dt>
			<label for="form-report-schoolnumber">Our school:</label>
			<em>*</em>
		</dt>
		<dd>
			<?php if ($this->_tpl_vars['school']): ?>
				<?php echo $this->_tpl_vars['school']['city']; ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['school']['countryname'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>

				<?php if ($this->_tpl_vars['school']['countryflag']): ?>
					<img src="<?php echo $this->_tpl_vars['tpl']['links']['flag_get'];  echo $this->_tpl_vars['school']['countryflag']; ?>
">
				<?php endif; ?>
				<div class="h1" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['school']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['school']['name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 40) : smarty_modifier_truncate($_tmp, 40)); ?>
</div>
				<a href="<?php echo $this->_tpl_vars['tpl']['links']['member'];  echo $this->_tpl_vars['school']['schoolnumber']; ?>
">List all Action Reports</a>
				<?php if ($_SESSION['llschoolnumber']): ?>
					&middot; <a href="<?php echo mySmarty::function_switcher(array('key' => 'llschoolnumber','value' => '0'), $this);?>
">This is not my school!</a>
				<?php endif; ?>
				<input type="hidden" name="schoolnumber" id="form-report-schoolnumber" class="required" value="<?php echo $this->_tpl_vars['school']['schoolnumber']; ?>
">
			<?php else: ?>
				<select name="schoolnumber" id="form-report-schoolnumber" tabindex="1" class="required">
					<option value=""></option>
					<optgroup label="<?php echo $this->_tpl_vars['schools'][0]['countryname']; ?>
, <?php echo $this->_tpl_vars['schools'][0]['city']; ?>
">
						<?php $this->assign('currentcountry', ($this->_tpl_vars['schools'][0]['countryname'])); ?>
						<?php $this->assign('currentcity', ($this->_tpl_vars['schools'][0]['city'])); ?>
						<?php $_from = $this->_tpl_vars['schools']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['school'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['school']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['school_item']):
        $this->_foreach['school']['iteration']++;
?>
							<?php if (( $this->_tpl_vars['school_item']['countryname'] != $this->_tpl_vars['currentcountry'] ) || ( $this->_tpl_vars['school_item']['city'] != $this->_tpl_vars['currentcity'] )): ?>
								<?php if (! ($this->_foreach['school']['iteration'] <= 1)): ?></optgroup><?php endif; ?>
								<?php if (! ($this->_foreach['school']['iteration'] == $this->_foreach['school']['total'])): ?><optgroup label="<?php echo $this->_tpl_vars['school_item']['countryname']; ?>
, <?php echo $this->_tpl_vars['school_item']['city']; ?>
"><?php endif; ?>
								<?php $this->assign('currentcountry', ($this->_tpl_vars['school_item']['countryname'])); ?>
								<?php $this->assign('currentcity', ($this->_tpl_vars['school_item']['city'])); ?>
							<?php endif; ?>
							<option value="<?php echo $this->_tpl_vars['school_item']['schoolnumber']; ?>
"<?php echo mySmarty::function_option_selected(array('value' => $_GET['schoolnumber'],'current' => $this->_tpl_vars['school_item']['schoolnumber']), $this);?>
><?php echo $this->_tpl_vars['school_item']['name']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</optgroup>
				</select>
			<?php endif; ?>
		</dd>
	</dl>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/form.report.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<button type="submit" id="form-report-submit" class="ajax submit" tabindex="70">Press this button to preview your Action Report!</button><br>
<small>We hope you enjoyed your action!</small>
</form>
<?php endif; ?>