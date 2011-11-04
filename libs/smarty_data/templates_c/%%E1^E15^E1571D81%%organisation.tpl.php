<?php /* Smarty version 2.6.16, created on 2011-06-15 08:09:44
         compiled from pages/organisation.tpl */ ?>
<div>
	<h1><strong><?php echo $this->_tpl_vars['organisation']['name']; ?>
</strong></h1>
	<div class="yui-g">
		<div class="yui-u first">
			<?php echo $this->_tpl_vars['organisation']['address']; ?>

			<div class="hr"></div>
			<?php if ($this->_tpl_vars['organisation']['tel'] && $this->_tpl_vars['organisation']['tel'] != '-'): ?>
				<blockquote>
					Tel: <strong><?php echo $this->_tpl_vars['organisation']['tel']; ?>
</strong>
				</blockquote>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['organisation']['fax'] && $this->_tpl_vars['organisation']['fax'] != '-'): ?>
				<blockquote>
					Fax: <strong><?php echo $this->_tpl_vars['organisation']['fax']; ?>
</strong>
				</blockquote>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['organisation']['website'] && $this->_tpl_vars['organisation']['website'] != '-'): ?>
				<blockquote>
					Website: <?php echo $this->_tpl_vars['organisation']['website']; ?>

				</blockquote>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['organisation']['email'] && $this->_tpl_vars['organisation']['email'] != '-'): ?>
				<blockquote>
					E-m@il: <?php echo $this->_tpl_vars['organisation']['email']; ?>

				</blockquote>
			<?php endif; ?>
		</div>
		<div class="yui-u">
			<?php echo $this->_tpl_vars['organisation']['addinfo']; ?>

		</div>
	</div>
</div>