<?php /* Smarty version 2.6.16, created on 2011-06-14 21:17:17
         compiled from pages/report.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'pages/report.tpl', 23, false),array('modifier', 'truncate', 'pages/report.tpl', 23, false),array('modifier', 'date_format', 'pages/report.tpl', 26, false),)), $this); ?>

<div class="sb">
	<div class="yui-gf">
		<div class="yui-u first lltextc">
			<?php if ($this->_tpl_vars['report']['id']): ?>
				<?php if ($this->_tpl_vars['report']['registered'] && ( $this->_tpl_vars['report']['school']['registered'] || $this->_tpl_vars['school']['registered'] )): ?>
					report no.
					<div class="h1"><?php echo $this->_tpl_vars['report']['id']; ?>
</div>
				<?php else: ?>
					report no. <?php echo $this->_tpl_vars['report']['id']; ?>

					<div class="h2">awaiting approval</div>
				<?php endif; ?>
			<?php else: ?>
				report no. ***
				<div class="h2">awaiting approval</div>
			<?php endif; ?>
		</div>
		<div class="yui-u">
			<?php $_from = $this->_tpl_vars['report']['actions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
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
 <span class="h2" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['action']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['action']['name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 50) : smarty_modifier_truncate($_tmp, 50)); ?>
</span>
				<span class="llclear"></span>
			<?php endforeach; endif; unset($_from); ?>
			Action<?php if (((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")) < $this->_tpl_vars['report']['perfdate']): ?> to be<?php endif; ?> performed on <strong><?php echo ((is_array($_tmp=$this->_tpl_vars['report']['perfdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['tpl']['date_format']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['tpl']['date_format'])); ?>
</strong>
			<?php if ($this->_tpl_vars['report']['perfdays'] > 1): ?>
				, and the next <?php echo $this->_tpl_vars['report']['perfdays']; ?>
 days
			<?php endif; ?>
		</div>
	</div>
	<blockquote>
		<?php if ($this->_tpl_vars['report']['media']): ?>
			<div class="llfloatr summary nomousescroll" style="width: 70px">
				<?php $_from = $this->_tpl_vars['report']['media']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mediafile']):
?>
					<a href="<?php echo $this->_tpl_vars['mediafile']['url']; ?>
" rel="lightbox[<?php echo $this->_tpl_vars['mediafile']['report_id']; ?>
]" title="<?php echo $this->_tpl_vars['mediafile']['title']; ?>
" class="llbordernone"><img src="<?php echo $this->_tpl_vars['mediafile']['thumbnail']; ?>
" width="50" height="30" alt="<?php echo $this->_tpl_vars['mediafile']['title']; ?>
"></a><br>
				<?php endforeach; endif; unset($_from); ?>
			</div>
		<?php endif; ?>
		<div class="lltextsmall summary lljustify">
			<?php echo $this->_tpl_vars['report']['description']; ?>

			<?php if ($this->_tpl_vars['report']['addinfo']): ?>
				<span class="llclear h20"></span>
				<div class="h2">Supplimentary</div>
				<div class="llpaddingl"><?php echo $this->_tpl_vars['report']['addinfo']; ?>
</div>
			<?php endif; ?>
		</div>
		<span class="llclear h05"></span>
		<?php if ($this->_tpl_vars['report']['actioncontact']): ?>
			<div>
				<small>You can contact <?php echo $this->_tpl_vars['report']['actioncontact']; ?>
 in order to ask specific questions about this action.</small>
			</div>
		<?php endif; ?>
		<div class="yui-gd">
			<div class="yui-u first">
				<small>Reported on <strong><?php echo ((is_array($_tmp=$this->_tpl_vars['report']['regdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['tpl']['date_format']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['tpl']['date_format'])); ?>
</strong></small>
			</div>
			<div class="yui-u">
			<?php if ($this->_tpl_vars['report']['info']): ?>
				<strong><?php echo $this->_tpl_vars['report']['info']; ?>
</strong> <small>were involved!</small>
			<?php endif; ?>
			</div>
		</div>
	</blockquote>
</div>