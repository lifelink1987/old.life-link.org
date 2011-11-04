<?php /* Smarty version 2.6.16, created on 2011-06-14 23:55:58
         compiled from pages/live/appendix/item.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'pages/live/appendix/item.tpl', 3, false),)), $this); ?>
<div class="yui-gf">
	<div class="yui-u first lltextr">
		<strong><?php echo ((is_array($_tmp=$this->_tpl_vars['post']['post_date_gmt'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['tpl']['date_format']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['tpl']['date_format'])); ?>
</strong>
	</div>
	<div class="yui-u">
		<?php $_from = $this->_tpl_vars['post']['attachments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['attachment'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['attachment']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['attachment']):
        $this->_foreach['attachment']['iteration']++;
?>
			<a href="<?php echo $this->_tpl_vars['attachment']['guid']; ?>
" class="<?php echo $this->_tpl_vars['attachment']['post_extension']; ?>
"><?php echo $this->_tpl_vars['attachment']['post_title']; ?>
</a><br>
		<?php endforeach; endif; unset($_from); ?>
	</div>
</div>