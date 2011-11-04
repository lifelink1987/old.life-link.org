<?php /* Smarty version 2.6.16, created on 2011-06-14 21:39:15
         compiled from pages/form.report.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'selected', 'pages/form.report.tpl', 17, false),)), $this); ?>
<span class="llclear h10"></span>
<span class="h2"><strong>Action Report</strong></span>
<div class="sb">
	<dl>
		<dt>
			<label for="form-report-actionnumber">Guideline Action:</label>
			<em>*</em>
		</dt>
		<dd>
			<select name="actionnumber" id="form-report-actionnumber" class="required" tabindex="50">
			<option value=""></option>
			<?php $_from = $this->_tpl_vars['actions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['action'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['action']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['action']):
        $this->_foreach['action']['iteration']++;
?>
				<?php if ($this->_tpl_vars['action']['ischapter']): ?>
				<?php if (! ($this->_foreach['action']['iteration'] <= 1)): ?></optgroup><?php endif; ?>
				<?php if (! ($this->_foreach['action']['iteration'] == $this->_foreach['action']['total'])): ?><optgroup label="<?php echo $this->_tpl_vars['action']['name']; ?>
"><?php endif; ?>
				<?php else: ?>
				<option value="<?php echo $this->_tpl_vars['action']['actionnumber_raw']; ?>
"<?php echo mySmarty::function_option_selected(array('value' => $this->_tpl_vars['default']['actionnumber'],'current' => $this->_tpl_vars['action']['actionnumber_raw']), $this);?>
><?php echo $this->_tpl_vars['action']['actionnumber']; ?>
 <?php echo $this->_tpl_vars['action']['name']; ?>
</option>
				<?php endif; ?>
				<?php if (($this->_foreach['action']['iteration'] == $this->_foreach['action']['total'])): ?></optgroup><?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
			</select>
		</dd>
	</dl>
	
	<div class="yui-g">
		<div class="yui-u first">
			<dl>
				<dt>
					<label for="form-report-perfdate">Date:</label>
					<em>*</em>
				</dt>
				<dd>
					<input type="text" name="perfdate" id="form-report-perfdate" value="<?php echo $this->_tpl_vars['default']['perfdate']; ?>
" class="calendar required" tabindex="51" maxlength="255" autocomplete="off">
					<div id="form-report-perfdate-help" class="fieldHelp">
						<div class="bd">
							FORMAT<br>
							<blockquote>
								YYYY-MM-DD
							</blockquote>
						</div>
					</div>
					<small>YYYY-MM-DD</small>
				</dd>
			</dl>
		</div>
		<div class="yui-u">
			<dl>
				<dt>
					<label for="form-report-perfdays">Duration:</label>
				</dt>
				<dd>
					<input type="text" name="perfdays" id="form-report-perfdays" value="<?php if ($this->_tpl_vars['default']['perfdays']):  echo $this->_tpl_vars['default']['perfdays'];  else: ?>1<?php endif; ?>" maxlength="3" tabindex="52" class="numbers" autocomplete="off"><br>
					<small>day(s)</small>
				</dd>
			</dl>
		</div>
	</div>

	<div class="yui-g">
		<div class="yui-u first">
			<dl>
				<dt>
					<label for="form-report-students">Number of Students:</label>
					<em>*</em>
				</dt>
				<dd>
					<input type="text" name="students" id="form-report-students" value="<?php echo $this->_tpl_vars['default']['students']; ?>
" class="numbers required" tabindex="53" maxlength="5" autocomplete="off">
				</dd>
			</dl>
		</div>
		<div class="yui-u">
			<dl>
				<dt>
					<label for="form-report-age">Students' Age:</label>
				</dt>
				<dd>
					<input type="text" name="age" id="form-report-age" value="<?php echo $this->_tpl_vars['default']['age']; ?>
" class="number-range" tabindex="54" maxlength="5" autocomplete="off"><br>
					<small>years old</small>
					<div id="form-report-age-help" class="fieldHelp">
						<div class="bd">
							FORMAT<br>
							<blockquote>
								12<br>
								12-15
							</blockquote>
						</div>
					</div>
				</dd>
			</dl>
		</div>
	</div>

	<div class="yui-g">
		<div class="yui-u first">
			<dl>
				<dt>
					<label for="form-report-teachers">Number of Teachers:</label>
				</dt>
				<dd>
					<input type="text" name="teachers" id="form-report-teachers" value="<?php echo $this->_tpl_vars['default']['teachers']; ?>
" class="numbers" tabindex="55" maxlength="5" autocomplete="off">
				</dd>
			</dl>
		</div>
		<div class="yui-u">
			<dl>
				<dt>
					<label for="form-report-parents">Number of Parents:</label>
				</dt>
				<dd>
					<input type="text" name="parents" id="form-report-parents" value="<?php echo $this->_tpl_vars['default']['parents']; ?>
" class="numbers" tabindex="56" maxlength="5" autocomplete="off">
				</dd>
			</dl>
		</div>
	</div>
	
	<dl>
		<dt>
			<label for="form-report-description">Summary of Activities:</label>
			<em>*</em>
		</dt>
		<dd>
			<textarea name="description" id="form-report-description" class="required limitation ondemandhelp" tabindex="57" rows="6"><?php echo $this->_tpl_vars['default']['description']; ?>
</textarea><br>
			<small><strong>English please!</strong> Please use no more than <strong>500 characters</strong><?php if ($_SESSION['templatelevel']): ?> (out of which, <strong id="form-report-description-limitation">500</strong> left)<?php endif; ?>.</small>
			<div id="form-report-description-help" class="fieldHelp">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/forms/help.limitation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>
		</dd>
	</dl>
</div>

<?php if ($this->_tpl_vars['school']): ?>
	<span class="llclear h10"></span>
	<span class="h2"><strong>Specific Contact</strong> for this Action Report</span>
	<?php if ($this->_tpl_vars['school']): ?>
		<blockquote>
			<?php if ($this->_tpl_vars['school']['teachercontact'] != '-'): ?>
				<div>different from the school's contact teacher(s) - <?php echo $this->_tpl_vars['school']['teachercontact']; ?>
</div>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['school']['studentcontact'] != '-'): ?>
				<div>different from the contact student(s) - <?php echo $this->_tpl_vars['school']['studentcontact']; ?>
</div>
			<?php endif; ?>
		</blockquote>
		<span class="llclear h05"></span>
	<?php endif; ?>
	
	<blockquote>
		<div class="yui-gc sb">
			<div class="yui-u first">
				<dl>
					<dt>
						<label for="form-report-actioncontact">Name:</label>
					</dt>
					<dd>
						<input type="text" name="actioncontact" id="form-report-actioncontact" value="<?php echo $this->_tpl_vars['default']['actioncontact']; ?>
" class="name" tabindex="65" maxlength="255" autocomplete="off">
						<div id="form-report-actioncontact-help" class="fieldHelp">
							<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/forms/help.name.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						</div>
					</dd>
					<dt>
						<label for="form-report-actioncontactemail">E-m@il:</label>
					</dt>
					<dd>
						<input type="text" name="actioncontactemail" id="form-report-actioncontactemail" value="<?php echo $this->_tpl_vars['default']['actioncontactemail']; ?>
" class="email" tabindex="67" rel="form-report-actioncontact required" maxlength="255" autocomplete="off">
						<div id="form-report-actioncontactemail-help" class="fieldHelp">
							<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/forms/help.email.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						</div>
					</dd>
				</dl>
			</div>
			<div class="yui-u">
				<dl>
					<dt>
						<label for="form-report-actioncontactgender">Title/Gender:</label>
					</dt>
					<dd>
						<select name="actioncontactgender" id="form-report-actioncontactgender" rel="form-report-actioncontact" tabindex="66">
							<option value=""></option>
							<option value="f"<?php echo mySmarty::function_option_selected(array('value' => $this->_tpl_vars['default']['actioncontactgender'],'current' => 'f'), $this);?>
>Ms./Female</option>
							<option value="m"<?php echo mySmarty::function_option_selected(array('value' => $this->_tpl_vars['default']['actioncontactgender'],'current' => 'm'), $this);?>
>Mr./Male</option>
						</select>
					</dd>
				</dl>
			</div>
		</div>
	</blockquote>
<?php endif; ?>

<span class="llclear h10"></span>

<input type="hidden" name="continue" value="<?php echo $_REQUEST['continue']; ?>
">
<input type="hidden" name="continuetitle" value="<?php echo $_REQUEST['continuetitle']; ?>
">