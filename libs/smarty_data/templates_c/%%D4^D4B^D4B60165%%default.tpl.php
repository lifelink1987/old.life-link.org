<?php /* Smarty version 2.6.16, created on 2011-06-15 08:09:44
         compiled from pages/collaboration/organisations/default.tpl */ ?>
<div id="related">
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "official:".($this->_tpl_vars['tpl']['current'])."related.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<div id="llpagesuptitle">Collaboration</div>
<div id="llpagetitle">Organisations</div>
<div id="filters">
	<form method="get" action="<?php echo $this->_tpl_vars['tpl']['links']['collaboration']; ?>
" id="form-organisations" anchor="resultsAnchor">
		<input type="hidden" name="sub" id="form-organisations-sub" value="organisations">
		<fieldset class="yui-gb">
			<div class="yui-u first">
				with the word/phrase<br>
				<input type="text" name="namelike" id="form-organisations-namelike" size="20" maxlength="255" value="<?php echo $_REQUEST['namelike']; ?>
">
				<label for="form-organisations-namelike">in the title</label>
			</div>
			<div class="yui-u">
				with
				<input type="checkbox" name="email" id="form-organisations-email"<?php if ($_REQUEST['email']): ?> checked<?php endif; ?>>
				<label for="form-organisations-email">an E-m@il address</label><br>
				with
				<input type="checkbox" name="website" id="form-organisations-website"<?php if ($_REQUEST['website']): ?> checked<?php endif; ?>>
				<label for="form-organisations-website">a website</label>
			</div>
			<div class="yui-u">
				<button type="submit" class="ajax" id="form-organisations-submit">Click!</button>
			</div>
		</fieldset>
	</form>
</div>
<a name="resultsAnchor"></a>
<div id="wait"></div>
<div id="results">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl']['current'])."organisations/results.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>