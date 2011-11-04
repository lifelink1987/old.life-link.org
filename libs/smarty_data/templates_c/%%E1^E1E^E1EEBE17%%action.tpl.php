<?php /* Smarty version 2.6.16, created on 2011-06-14 22:02:21
         compiled from pages/actions/action.tpl */ ?>
<?php if ($this->_tpl_vars['chapter']['actionnumber_raw'] == $this->_tpl_vars['action']['actionnumber_raw']): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl']['current'])."chapter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>
	<div id="related">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "official:".($this->_tpl_vars['tpl']['current'])."related.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<br>
		<ul>
			<li><?php echo $this->_tpl_vars['chapter']['name']; ?>

			<ul><li>
			<?php $_from = $this->_tpl_vars['actions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['actions_item']):
?>
			<a href="<?php echo $this->_tpl_vars['tpl']['links']['action'];  echo $this->_tpl_vars['actions_item']['actionnumber_raw']; ?>
" title="<?php echo $this->_tpl_vars['actions_item']['actionnumber']; ?>
 <?php echo $this->_tpl_vars['actions_item']['name'];  if ($this->_tpl_vars['actions_item']['old']): ?> OUT OF DATE<?php endif; ?>"><?php if ($this->_tpl_vars['actions_item']['old']): ?><strike><?php endif;  echo $this->_tpl_vars['actions_item']['actionnumber'];  if ($this->_tpl_vars['actions_item']['old']): ?></strike><?php endif; ?></a>&nbsp;
			<?php endforeach; endif; unset($_from); ?>
			</li></ul>
			</li>
		</ul>
	</div>
	
	<div id="llpagesuptitle">
		Peace Actions &middot; <?php echo $this->_tpl_vars['chapter']['name']; ?>

	</div>
	<div id="llpagetitle">
		<?php echo $this->_tpl_vars['action']['name']; ?>

	</div>
	<div id="llpagesubtitle">
		<?php echo $this->_tpl_vars['action']['actionnumber']; ?>

		<?php if ($this->_tpl_vars['action']['old']): ?>
			&middot; This action is out of date, so reports should use another action as guideline.
		<?php else: ?>
			&middot; <a href="<?php echo $this->_tpl_vars['tpl']['links']['report_get_action'];  echo $this->_tpl_vars['action']['actionnumber_raw']; ?>
">Report by using this as Guideline Action</a>
		<?php endif; ?>
	</div>
	
	<div class="sb">
		<div class="yui-g">
			<div class="yui-u first">
				<h2>Theory</h2>
				<blockquote class="lltextsmall"><?php echo $this->_tpl_vars['action']['theory']; ?>
</blockquote>
			</div>
			<div class="yui-u">
				<h2>Step by Step</h2>
				<blockquote class="lltextsmall"><?php echo $this->_tpl_vars['action']['stepbystep']; ?>
</blockquote>
			</div>
		</div>
		
		<h1>Action Proposals</h1>
		<?php echo $this->_tpl_vars['action']['action']; ?>

	
		<?php if ($this->_tpl_vars['action']['addtitle']): ?>
			<h3><?php echo $this->_tpl_vars['action']['addtitle']; ?>
</h3>
			<?php echo $this->_tpl_vars['action']['addinfo']; ?>

		<?php endif; ?>
	</div>

	<?php if ($this->_tpl_vars['reports']): ?>
		<span class="llclear h30"></span>
		<div class="h1"><strong>Examples of reports on this action</strong></div>
		<a href="<?php echo $this->_tpl_vars['tpl']['links']['members_get']; ?>
list&amp;list_sr=r&amp;list_order=latest&amp;guideline_action=<?php echo $this->_tpl_vars['action']['actionnumber_raw']; ?>
">Show all reports</a>
		&middot; <a href="<?php echo $this->_tpl_vars['tpl']['links']['members_get']; ?>
list&amp;guideline_action=<?php echo $this->_tpl_vars['action']['actionnumber_raw']; ?>
">Show all reporting schools</a>
		<?php $_from = $this->_tpl_vars['reports']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['report']):
?>
			<span class="llclear" style="height:2em"></span>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/report.member.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
<?php endif; ?>