<?php /* Smarty version 2.6.16, created on 2011-06-14 21:17:55
         compiled from pages/paging.header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'page', 'pages/paging.header.tpl', 5, false),array('function', 'math', 'pages/paging.header.tpl', 22, false),)), $this); ?>
<?php if ($this->_tpl_vars['pages'] > 1): ?>
<ul class="llheaderh" id="paging-header">
	<li class="lltitle llpaddingr">Page <?php echo $this->_tpl_vars['page']; ?>
 out of <?php echo $this->_tpl_vars['pages']; ?>
</li>
	<?php if ($this->_tpl_vars['page'] > 1): ?>
		<li><a href="<?php echo mySmarty::function_page(array('link' => $this->_tpl_vars['page_link'],'number' => $this->_tpl_vars['page']-1), $this);?>
">Previous</a></li>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['page'] < $this->_tpl_vars['pages']): ?>
		<li><a href="<?php echo mySmarty::function_page(array('link' => $this->_tpl_vars['page_link'],'number' => $this->_tpl_vars['page']+1), $this);?>
">Next</a></li>
	<?php endif; ?>
	<span class="llclear"></span>
	<ul class="llheaderhsub">
	<?php if ($this->_tpl_vars['pages'] <= 15): ?>
		<?php $_from = $this->_tpl_vars['pages_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page_array_item']):
?>
		<?php if ($this->_tpl_vars['page_array_item'] != $this->_tpl_vars['page']): ?>
			<li><a href="<?php echo mySmarty::function_page(array('link' => $this->_tpl_vars['page_link'],'number' => $this->_tpl_vars['page_array_item']), $this);?>
"><?php echo $this->_tpl_vars['page_array_item']; ?>
</a></li>
		<?php else: ?>
			<li class="current"><a><?php echo $this->_tpl_vars['page_array_item']; ?>
</a></li>
		<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	<?php else: ?>
		<?php if ($this->_tpl_vars['page'] <= 5): ?>
			<?php echo smarty_function_math(array('equation' => "max(3,x)",'x' => $this->_tpl_vars['page']+2,'assign' => 'max_page'), $this);?>

			<?php echo smarty_function_math(array('equation' => 'x','x' => $this->_tpl_vars['pages']-2,'assign' => 'min_page'), $this);?>

		<?php endif; ?>
		<?php if ($this->_tpl_vars['page'] > $this->_tpl_vars['pages']-5): ?>
			<?php echo smarty_function_math(array('equation' => '3','assign' => 'max_page'), $this);?>

			<?php echo smarty_function_math(array('equation' => "min(x,y)",'x' => $this->_tpl_vars['page']-2,'y' => $this->_tpl_vars['pages']-2,'assign' => 'min_page'), $this);?>

		<?php endif; ?>
		<?php if ($this->_tpl_vars['page'] <= 5 || $this->_tpl_vars['page'] > $this->_tpl_vars['pages']-5): ?>
			<?php $_from = $this->_tpl_vars['pages_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page_array_item']):
?>
				<?php if ($this->_tpl_vars['page_array_item'] <= $this->_tpl_vars['max_page'] || $this->_tpl_vars['page_array_item'] >= $this->_tpl_vars['min_page']): ?>
					<?php if ($this->_tpl_vars['page_array_item'] != $this->_tpl_vars['page']): ?>
					<li><a href="<?php echo mySmarty::function_page(array('link' => $this->_tpl_vars['page_link'],'number' => $this->_tpl_vars['page_array_item']), $this);?>
"><?php echo $this->_tpl_vars['page_array_item']; ?>
</a></li>
					<?php else: ?>
					<li class="current"><a><?php echo $this->_tpl_vars['page_array_item']; ?>
</a></li>
					<?php endif; ?>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['page_array_item'] == $this->_tpl_vars['max_page'] && $this->_tpl_vars['max_page'] != $this->_tpl_vars['min_page']): ?>
				<li>...</li>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
			<?php $_from = $this->_tpl_vars['pages_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page_array_item']):
?>
				<?php if ($this->_tpl_vars['page_array_item'] <= 3 || $this->_tpl_vars['page_array_item'] >= $this->_tpl_vars['pages']-2): ?>
				<li><a href="<?php echo mySmarty::function_page(array('link' => $this->_tpl_vars['page_link'],'number' => $this->_tpl_vars['page_array_item']), $this);?>
"><?php echo $this->_tpl_vars['page_array_item']; ?>
</a></li>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['page_array_item'] <= $this->_tpl_vars['page']+2 && $this->_tpl_vars['page_array_item'] >= $this->_tpl_vars['page']-2): ?>
					<?php if ($this->_tpl_vars['page_array_item'] != $this->_tpl_vars['page']): ?>
					<li><a href="<?php echo mySmarty::function_page(array('link' => $this->_tpl_vars['page_link'],'number' => $this->_tpl_vars['page_array_item']), $this);?>
"><?php echo $this->_tpl_vars['page_array_item']; ?>
</a></li>
					<?php else: ?>
					<li class="current"><a><?php echo $this->_tpl_vars['page_array_item']; ?>
</a></li>
					<?php endif; ?>
				<?php endif; ?>
				<?php if (( $this->_tpl_vars['page_array_item'] == $this->_tpl_vars['page']-3 && $this->_tpl_vars['page_array_item'] != 3 ) || ( $this->_tpl_vars['page_array_item'] == $this->_tpl_vars['page']+3 && $this->_tpl_vars['page_array_item'] != $this->_tpl_vars['pages']-2 )): ?>
				<li>...</li>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
	<?php endif; ?>
	</ul>
</ul>
<span class="llclear"></span>
<?php endif; ?>