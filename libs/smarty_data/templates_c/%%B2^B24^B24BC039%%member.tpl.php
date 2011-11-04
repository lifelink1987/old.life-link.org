<?php /* Smarty version 2.6.16, created on 2011-06-14 21:17:55
         compiled from pages/member.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'pages/member.tpl', 21, false),array('modifier', 'escape', 'pages/member.tpl', 25, false),array('modifier', 'truncate', 'pages/member.tpl', 25, false),array('modifier', 'date_format', 'pages/member.tpl', 56, false),array('function', 'switcher', 'pages/member.tpl', 72, false),)), $this); ?>
<div class="sb">
	<div class="yui-gf">
		<div class="yui-u first lltextc">
			<?php if ($this->_tpl_vars['school']['schoolnumber']): ?>
				<?php if ($this->_tpl_vars['school']['registered']): ?>
					school no.
					<div class="h1"><?php echo $this->_tpl_vars['school']['schoolnumber']; ?>
</div>
				<?php else: ?>
					school no. <?php echo $this->_tpl_vars['school']['schoolnumber']; ?>

					<div class="h2">awaiting approval</div>
				<?php endif; ?>
			<?php else: ?>
				school no. ***
				<div class="h2">awaiting approval</div>
			<?php endif; ?>
		</div>
		<div class="yui-u">
			<div class="llfloatr">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/sectionlinks.member.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>
			<?php echo $this->_tpl_vars['school']['city']; ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['school']['countryname'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>

			<?php if ($this->_tpl_vars['school']['countryflag']): ?>
				<img src="<?php echo $this->_tpl_vars['tpl']['links']['flag_get'];  echo $this->_tpl_vars['school']['countryflag']; ?>
">
			<?php endif; ?>
			<h1 title="<?php echo ((is_array($_tmp=$this->_tpl_vars['school']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['school']['name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 40) : smarty_modifier_truncate($_tmp, 40)); ?>
</h1>
		</div>
	</div>
	<div class="yui-gf<?php if (! $_GET['contact'] && ! $this->_tpl_vars['notoggler']): ?> hidden toggler<?php endif; ?>" id="school-contact-<?php echo $this->_tpl_vars['school']['schoolnumber']; ?>
">
		<div class="yui-u first">
			&nbsp;
		</div>
		<div class="yui-u">
			<?php if ($this->_tpl_vars['school']['studentcontact'] != '-' || $this->_tpl_vars['school']['teachercontact'] != '-'): ?>
				<span class="h2"><strong>Life-Link Contacts</strong></span>
				<blockquote>
					<?php if ($this->_tpl_vars['school']['studentcontact'] != '-'): ?>
						<div>Student<?php echo $this->_tpl_vars['school']['studentcontactplural']; ?>
: <?php echo $this->_tpl_vars['school']['studentcontact']; ?>
</div>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['school']['teachercontact'] != '-'): ?>
						<div>Teacher<?php echo $this->_tpl_vars['school']['teachercontactplural']; ?>
: <?php echo $this->_tpl_vars['school']['teachercontact']; ?>
</div>
					<?php endif; ?>
				</blockquote>
				<span class="llclear h10"></span>
			<?php endif; ?>
			<span class="h2"><strong>School Contact</strong></span>
			<blockquote>
				E-mail: <?php echo $this->_tpl_vars['school']['email']; ?>
<br>
				Website: <?php echo $this->_tpl_vars['school']['website']; ?>

				<span class="llclear h10"></span>
				Tel: <strong><?php echo $this->_tpl_vars['school']['tel']; ?>
</strong><br>
				Fax: <strong><?php echo $this->_tpl_vars['school']['fax']; ?>
</strong><br>
				Address: <strong><?php echo $this->_tpl_vars['school']['address']; ?>
, <?php echo $this->_tpl_vars['school']['city']; ?>
 <?php echo $this->_tpl_vars['school']['zipcode']; ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['school']['countryname'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</strong>
			</blockquote>
			<span class="llclear h10"></span>
			<?php if ($this->_tpl_vars['school']['update']): ?>
				<div>Information Updated on <?php echo ((is_array($_tmp=$this->_tpl_vars['school']['update'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['tpl']['date_format']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['tpl']['date_format'])); ?>
</div>
			<?php endif; ?>
			<?php if (! $this->_tpl_vars['nolinks']): ?>
				<div class="hr"></div>
				<div class="lltextr"><a href="<?php echo $this->_tpl_vars['tpl']['links']['contact_school_info'];  echo $this->_tpl_vars['school']['schoolnumber']; ?>
 - <?php echo ((is_array($_tmp=$this->_tpl_vars['school']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp));  echo $this->_tpl_vars['tpl']['links']['contact_school_info_end']; ?>
" rel="nofollow">Update the above information</a></div>
			<?php endif; ?>
		</div>
	</div>
	<?php if (! $this->_tpl_vars['nolinks']): ?>
		<div class="yui-gf">
			<div class="yui-u first lltextc">
				<a href="<?php echo $this->_tpl_vars['tpl']['links']['report_get'];  echo $this->_tpl_vars['school']['schoolnumber']; ?>
" class="h3"><strong>Report a New Action</strong></a>
			</div>
			<div class="yui-u lltextr">
				<?php if (! $_GET['contact']): ?>
					<span id="school-contact-<?php echo $this->_tpl_vars['school']['schoolnumber']; ?>
-activator-once">
						<a href="<?php echo mySmarty::function_switcher(array('key' => 'contact','value' => 1), $this);?>
" id="school-contact-<?php echo $this->_tpl_vars['school']['schoolnumber']; ?>
-activator" class="Tshow Tonce">Show Contact Information</a> &middot;
					</span>
				<?php endif; ?>
				<?php if ($_SESSION['llschoolnumber'] != 0): ?>
					<a href="<?php echo mySmarty::function_switcher(array('key' => 'llschoolnumber','value' => '0'), $this);?>
">This is not my school!</a>
				<?php else: ?>
					<a href="<?php echo mySmarty::function_switcher(array('key' => 'llschoolnumber','value' => $this->_tpl_vars['school']['schoolnumber']), $this);?>
">Remember this as my school!</a>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
</div>