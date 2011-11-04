<?php /* Smarty version 2.6.16, created on 2011-08-04 15:15:52
         compiled from pages/report.photos/default.tpl */ ?>
<div id="llpagetitle">Action Report</div>

<?php if ($this->_tpl_vars['school'] && $this->_tpl_vars['report']): ?>
	<div id="llpagesubtitle">Would you like to add Action Photos to your most recent Report? &middot; <a href="#report"> Review the Action Report</a></div>
<?php endif; ?>

<div id="wait"></div>
<a name="resultsAnchor"></a>
<div class="yui-gc">
	<div class="yui-u first" id="results">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl']['current'])."results.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
	<div class="yui-u">
		<small><strong>Please fill in the fields on the left.<br>
		Compulsory fields are marked with *.</strong><br><br>
		If something goes wrong, you can always send your action photos by post mail or E-m@il. Remember to attach the Report Number! We would be grateful if you drop us a line telling what went wrong with the online form.</small>
		<span class="llclear h20"></span>
		<?php echo $this->_tpl_vars['tpl']['images']['leaf']; ?>

		<span class="llclear h05"></span>
		<h2>Life-Link Friendship-Schools</h2>
		Uppsala Science Park<br>
		SE-751 83 Uppsala<br>
		SWEDEN
		<span class="llclear h05"></span>
		<div class="hr"></div>
		<span class="llclear h05"></span>
		<a href="mailto:actions@life-link.org">actions@life-link.org</a><br>
		JPEG images only
	</div>
</div>

<?php if ($this->_tpl_vars['school'] && $this->_tpl_vars['report']): ?>
	<span class="llclear h30"></span>
	<span class="llclear h30"></span>
	<a name="report"></a>
	<?php $this->assign('nosectionlinks', true); ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/report.member.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>