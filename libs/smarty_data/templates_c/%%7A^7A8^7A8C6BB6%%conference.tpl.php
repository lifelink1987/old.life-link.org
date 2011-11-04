<?php /* Smarty version 2.6.16, created on 2011-06-15 02:17:36
         compiled from pages/conference.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'pages/conference.tpl', 3, false),array('modifier', 'truncate', 'pages/conference.tpl', 3, false),array('modifier', 'date_format', 'pages/conference.tpl', 12, false),array('modifier', 'upper', 'pages/conference.tpl', 55, false),)), $this); ?>
<div class="yui-ge">
	<div class="yui-u first">
		<div class="h2" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['conference']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['conference']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 60) : smarty_modifier_truncate($_tmp, 60)); ?>
</div>
		<?php if ($this->_tpl_vars['conference']['major_title']): ?>
			<span class="lltextsmall"><?php echo $this->_tpl_vars['conference']['major_title']; ?>
</span>
		<?php else: ?>
			&nbsp;
		<?php endif; ?>
		<div class="hr"></div>
	</div>
	<div class="yui-u">
		<strong><?php echo ((is_array($_tmp=$this->_tpl_vars['conference']['startdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['tpl']['date_format']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['tpl']['date_format'])); ?>
</strong>
		<?php if ($this->_tpl_vars['conference']['startdate'] != $this->_tpl_vars['conference']['enddate']): ?>
			<br>Until <?php echo ((is_array($_tmp=$this->_tpl_vars['conference']['enddate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['tpl']['date_format']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['tpl']['date_format'])); ?>

		<?php endif; ?>
	</div>
</div>

<div class="yui-ge">
	<div class="yui-u first">
		<div class="lljustify llpaddingl"><?php echo $this->_tpl_vars['conference']['description']; ?>
</div>
		<span class="llclear h10"></span>
		<dl class="llpaddingl">
			<?php $_from = $this->_tpl_vars['conference']['links']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['link']):
?>
				<?php if ($this->_tpl_vars['link']['post_type'] == 'post'): ?>
					<dt><a href="<?php echo $this->_tpl_vars['link']['guid']; ?>
"><?php echo $this->_tpl_vars['link']['post_title']; ?>
</a></dt>
					<dd class="lltextsmall"><?php echo $this->_tpl_vars['link']['post_content']; ?>
</dd>
				<?php else: ?>
					<dt><a href="<?php echo $this->_tpl_vars['link']['guid']; ?>
" class="<?php echo $this->_tpl_vars['link']['post_extension']; ?>
"><?php echo $this->_tpl_vars['link']['post_title']; ?>
</a></dt>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
			<?php if ($this->_tpl_vars['conference']['survey_slug']): ?>
				<dt><a href="<?php echo $this->_tpl_vars['tpl']['links']['surveys_get'];  echo $this->_tpl_vars['conference']['survey_slug']; ?>
">Survey</a></dt>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['conference']['gallery_slug']): ?>
				<dt><a href="<?php echo $this->_tpl_vars['tpl']['links']['gallery_get'];  echo $this->_tpl_vars['conference']['gallery_slug']; ?>
" class="jpg">This conference has Photos! Check them out!</a></dt>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['conference']['actions']): ?>
			<dt>
				<span class="llclear h10"></span>
				Related Guideline Action(s):<br>
				<?php $_from = $this->_tpl_vars['conference']['actions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['action']):
?>
					<div class="llfloatr">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/sectionlinks.action.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					</div>
					<?php echo $this->_tpl_vars['action']['actionnumber']; ?>
 <span class="h2"><?php echo $this->_tpl_vars['action']['name']; ?>
</span>
					<span class="llclear"></span>
				<?php endforeach; endif; unset($_from); ?>
			</dt>
			<?php endif; ?>
			<dt><small>conference no. <strong><?php echo $this->_tpl_vars['conference']['id']; ?>
</strong></small></dt>
		</dl>
	</div>
	<div class="yui-u lltextc">
		<strong><?php echo ((is_array($_tmp=$this->_tpl_vars['conference']['countryname'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</strong>
		<?php if ($this->_tpl_vars['conference']['logo']): ?>
			<span class="llclear h10"></span>
			<div>
				<a href="<?php echo $this->_tpl_vars['tpl']['links']['conference_get_lphoto'];  echo $this->_tpl_vars['conference']['id']; ?>
" rel="lightbox" class="llbordernone"><img style="border: 1px <?php echo $this->_tpl_vars['tpl']['basics']['lightgrey']; ?>
 solid" src="<?php echo $this->_tpl_vars['tpl']['links']['conference_get_lthumbnail'];  echo $this->_tpl_vars['conference']['id']; ?>
"></a>
			</div>
		<?php endif; ?>
	</div>
</div>