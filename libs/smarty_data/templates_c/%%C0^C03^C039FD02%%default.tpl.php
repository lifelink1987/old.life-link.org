<?php /* Smarty version 2.6.16, created on 2011-06-15 04:46:16
         compiled from pages/reactions/default.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'selected', 'pages/reactions/default.tpl', 9, false),)), $this); ?>
<div id="llpagetitle">Reactions</div>
<div id="filters">
	<form method="get" action="<?php echo $this->_tpl_vars['tpl']['links']['reactions']; ?>
" id="form-reactions" anchor="resultsAnchor">
		<fieldset>
			from
			<select name="country" id="form-reactions-country">
				<option value="">the whole world</option>
				<?php $_from = $this->_tpl_vars['countries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['country']):
?>
				<option value="<?php echo $this->_tpl_vars['country']['codenumber']; ?>
"<?php echo mySmarty::function_option_selected(array('value' => $_GET['country'],'current' => $this->_tpl_vars['country']['codenumber']), $this);?>
><?php echo $this->_tpl_vars['country']['name']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
			<button type="submit" class="ajax" id="form-reactions-submit">Click!</button>
		</fieldset>
	</form>
</div>
<a name="resultsAnchor"></a>
<div id="wait"></div>
<div id="results">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl']['current'])."results.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>