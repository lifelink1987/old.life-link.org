<?php /* Smarty version 2.6.16, created on 2011-06-14 23:58:28
         compiled from pages/whatis/./board.tpl */ ?>
<div id="related">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "official:".($this->_tpl_vars['tpl']['current'])."related.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<div id="llpagetitle">Statute</div>
<p>
	Life-Link Friendship-Schools statute is only available in Swedish.<br/>
	You can download it by clicking <a href="<?php echo $this->_tpl_vars['tpl']['links']['files_get']; ?>
programme/Life-Link stadgar.pdf">here</a>.
</p>
<div id="llpagetitle">Board</div>
<div>
	<div class="yui-g">
		<div class="yui-u first">
			<dl>
			<?php $_from = $this->_tpl_vars['members']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['members'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['members']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['member']):
        $this->_foreach['members']['iteration']++;
?>
			<dt class="h2"><?php echo $this->_tpl_vars['member']['name']; ?>
</dt>
			<dd>
				<?php echo $this->_tpl_vars['member']['title']; ?>

				<?php if ($this->_tpl_vars['member']['email']): ?><br>
				<a href="<?php echo $this->_tpl_vars['tpl']['links']['contact_get'];  echo $this->_tpl_vars['member']['nickname']; ?>
" class="mail">Send a message to <?php echo $this->_tpl_vars['member']['firstname']; ?>
</a> <?php endif; ?>
			</dd>
			<?php if ($this->_foreach['members']['iteration'] == 2): ?>
				<div class="hr"></div>
				<span class="llclear h10"></span>
			<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
			</dl>
		</div>
		<div class="yui-u">
			<h2>Office Secretary</h2>
			<blockquote>
				<dl>
				<?php $_from = $this->_tpl_vars['secretary']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['member']):
?>
				<dt><strong><?php echo $this->_tpl_vars['member']['name']; ?>
</strong></dt>
				<dd>
					<?php echo $this->_tpl_vars['member']['title']; ?>

					<?php if ($this->_tpl_vars['member']['email']): ?><br>
					<a href="<?php echo $this->_tpl_vars['tpl']['links']['contact_get'];  echo $this->_tpl_vars['member']['nickname']; ?>
" class="mail">Send a message to <?php echo $this->_tpl_vars['member']['firstname']; ?>
</a><?php endif; ?>
				</dd>
				<?php endforeach; endif; unset($_from); ?>
				</dl>
			</blockquote>
			<span class="llclear h10"></span>
			<h2>Office Consultants</h2>
			<blockquote>
				<dl>
				<?php $_from = $this->_tpl_vars['consultants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['member']):
?>
				<dt><strong><?php echo $this->_tpl_vars['member']['name']; ?>
</strong></dt>
				<dd>
					<?php echo $this->_tpl_vars['member']['title']; ?>

					<?php if ($this->_tpl_vars['member']['email']): ?><br>
					<a href="<?php echo $this->_tpl_vars['tpl']['links']['contact_get'];  echo $this->_tpl_vars['member']['nickname']; ?>
" class="mail">Send a message to <?php echo $this->_tpl_vars['member']['firstname']; ?>
</a> <?php endif; ?>
				</dd>
				<?php endforeach; endif; unset($_from); ?>
				</dl>
			</blockquote>
			<span class="llclear h10"></span>
			<h2>International Advisors</h2>
			<blockquote>
				<dl>
				<?php $_from = $this->_tpl_vars['advisors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['member']):
?>
				<dt><strong><?php echo $this->_tpl_vars['member']['name']; ?>
</strong></dt>
				<dd>
					<?php echo $this->_tpl_vars['member']['title']; ?>

					<?php if ($this->_tpl_vars['member']['email']): ?><br>
					<a href="<?php echo $this->_tpl_vars['tpl']['links']['contact_get'];  echo $this->_tpl_vars['member']['nickname']; ?>
" class="mail">Send a message to <?php echo $this->_tpl_vars['member']['firstname']; ?>
</a> <?php endif; ?>
				</dd>
				<?php endforeach; endif; unset($_from); ?>
				</dl>
			</blockquote>
		</div>
	</div>
</div>