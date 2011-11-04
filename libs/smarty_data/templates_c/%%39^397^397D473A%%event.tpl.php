<?php /* Smarty version 2.6.16, created on 2011-06-14 23:16:46
         compiled from pages/event.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'pages/event.tpl', 17, false),)), $this); ?>
<blockquote>
	<dl>
		<dt>
			<div class="h2">
				<?php if ($this->_tpl_vars['event']['link']): ?>
					<a href="<?php echo $this->_tpl_vars['event']['link']; ?>
" title="click for more information">
				<?php endif; ?>
				<?php echo $this->_tpl_vars['event']['title']; ?>

				<?php if ($this->_tpl_vars['event']['link']): ?>
					</a>
				<?php endif; ?>
			</div>
		</dt>
		<dd>
			<div>
				<div class="lltextsmall">
					<strong><?php echo $this->_tpl_vars['event']['typetitle']; ?>
 &middot; <?php echo ((is_array($_tmp=$this->_tpl_vars['event']['startdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['tpl']['date_format']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['tpl']['date_format'])); ?>
</strong>
					<?php if ($this->_tpl_vars['event']['startdate'] != $this->_tpl_vars['event']['enddate']): ?>
						- <?php echo ((is_array($_tmp=$this->_tpl_vars['event']['enddate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['tpl']['date_format']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['tpl']['date_format'])); ?>

					<?php endif; ?>
				</div>
				<?php if (! $this->_tpl_vars['event']['link']): ?>
					<?php echo $this->_tpl_vars['event']['description']; ?>

					<?php if ($this->_tpl_vars['event']['actions']): ?>
						<div>
							Related Guideline Actions:<br>
							<?php $_from = $this->_tpl_vars['event']['actions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
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
 <a href="<?php echo $this->_tpl_vars['tpl']['links']['action'];  echo $this->_tpl_vars['action']['actionnumber_raw']; ?>
"><?php echo $this->_tpl_vars['action']['name']; ?>
</a>
								<span class="llclear"></span>
							<?php endforeach; endif; unset($_from); ?>
						</div>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</dd>
	<dl>
</blockquote>