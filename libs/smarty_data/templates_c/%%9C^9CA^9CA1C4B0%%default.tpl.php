<?php /* Smarty version 2.6.16, created on 2011-06-14 21:39:14
         compiled from pages/report/default.tpl */ ?>
<div id="llpagetitle">Action Report</div>

<div id="wait"></div>
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
		If something goes wrong, you can always <a href="<?php echo $this->_tpl_vars['tpl']['links']['download']; ?>
report/action_report.doc" class="doc">download the form</a> and send it to us by post mail, E-m@il or fax. We would be grateful if you drop us a line telling what went wrong with the online form.</small>
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
		Fax: +46 (0)18 50 85 03
	</div>
</div>