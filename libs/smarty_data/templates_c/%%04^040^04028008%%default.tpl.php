<?php /* Smarty version 2.6.16, created on 2011-11-04 19:46:12
         compiled from pages/contact/default.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'pages/contact/default.tpl', 2, false),)), $this); ?>
<div id="llpagetitle">Send a Message<?php if ($this->_tpl_vars['contact']): ?> to <?php echo $this->_tpl_vars['contact']['firstname'];  endif; ?></div>
<?php if ($this->_tpl_vars['contact']): ?><div id="llpagesubtitle">to <strong><?php echo $this->_tpl_vars['contact']['titlename']; ?>
</strong> - <?php echo ((is_array($_tmp=$this->_tpl_vars['contact']['title'])) ? $this->_run_mod_handler('replace', true, $_tmp, "<br />", ",") : smarty_modifier_replace($_tmp, "<br />", ",")); ?>
</div><?php endif; ?>

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
		If something goes wrong, you can always contact us through post mail, E-m@il, telephone or fax.</small>
		<span class="llclear h20"></span>
		<?php echo $this->_tpl_vars['tpl']['images']['leaf']; ?>
<br>
		<span class="llclear h05"></span>
		<h2>Life-Link Friendship-Schools</h2>
		Uppsala Science Park<br>
		SE-751 83 Uppsala<br>
		SWEDEN
		<span class="llclear h05"></span>
		<div class="hr"></div>
		<span class="llclear h05"></span>
		<a href="mailto:friendship-schools@life-link.org">friendship-schools@life-link.org</a><br>
		Tel: +46 (0)18 50 43 44<br>
		Fax: +46 (0)18 50 85 03
		<div class="hr"></div>
		<span class="llclear h05"></span>
		<h2>Visiting Address</h2>
		Majoren building<br>
		Uppsala Science Park<br>
		Dag Hammarsjölds väg 26<br>
		SE-752 37 Uppsala<br>
		<a href="http://maps.google.com/maps?ie=UTF8&hl=en&view=map&cid=17044912778302789962&q=Life-Link+Friendship-Schools+Association&iwloc=A&ved=0CDIQpQY&sa=X&ei=ljK0TqXNHNeQ_AaU0_g7" title="Google Map"><img src="http://maps.googleapis.com/maps/api/staticmap?center=Dag%20Hammarsk%C3%B6lds%20v%C3%A4g%2026,%20Uppsala,%20Sweden&sensor=false&zoom=15&size=128x128&maptype=hybrid" border="0"></a><br>
		<a href="http://maps.google.com/maps/place?cid=17044912778302789962">Google Places</a>
	</div>
</div>