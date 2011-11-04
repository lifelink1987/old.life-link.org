<?php /* Smarty version 2.6.16, created on 2011-06-16 15:29:31
         compiled from pages/live/news/item.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'pages/live/news/item.tpl', 4, false),)), $this); ?>
<div class="yui-gf">
	<div class="yui-u first lltextr">
		<a name="<?php echo $this->_tpl_vars['post']['id']; ?>
"></a>
		<strong><?php echo ((is_array($_tmp=$this->_tpl_vars['post']['post_date_gmt'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['tpl']['date_format']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['tpl']['date_format'])); ?>
</strong>
	</div>
	<div class="yui-u">
		<?php echo $this->_tpl_vars['post']['post_content']; ?>

	</div>
</div>