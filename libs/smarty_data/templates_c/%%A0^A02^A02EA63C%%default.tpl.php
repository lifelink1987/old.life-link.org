<?php /* Smarty version 2.6.16, created on 2011-06-14 21:17:17
         compiled from pages/home/default.tpl */ ?>
<div id="llpagesuptitle">Welcome to</div>
<div id="llpagetitle">the Life-Link Friendship-Schools Programme!</div>

<!--<span class="llclear h10"></span>
<div class="yui-g">
	<div class="yui-u first">
		<div class="h1"><strong>What is Life-Link?</strong></div>
		<h2><p>A choice among more than <strong>50</strong> concrete peace actions/projects that will benefit your school's International Curriculum and promote a Global Classroom at low price.</p></h2>
		<p><a href="<?php echo $this->_tpl_vars['tpl']['links']['manual']; ?>
">The Life-Link Manual</a>, as well as <a href="<?php echo $this->_tpl_vars['tpl']['links']['actions']; ?>
">this website</a>, offers guidelines for each of the proposed peace actions. Your class or some classes together, or a youth club at your school can perform peace actions/projects/lectures either within the schools curriculum or during a few hours extracurricular activities, at low costs. <a href="<?php echo $this->_tpl_vars['tpl']['links']['whatis_get']; ?>
brief">Click here to read more.</a></p>
	</div>
	<div class="yui-u lltextc">
		<?php echo $this->_tpl_vars['tpl']['images']['leaf']; ?>

		<span class="llclear h20"></span>
		<h2>
		More than
		<strong><?php echo $this->_tpl_vars['tpl']['website']['total_reports']; ?>
 Peace Actions</strong>
		<br>
		have been performed and reported
		<span class="llclear h05"></span>
		by
		<strong><?php echo $this->_tpl_vars['tpl']['website']['total_schools']; ?>
 schools</strong>
		&nbsp;in
		<strong><?php echo $this->_tpl_vars['tpl']['website']['total_countries']; ?>
 countries</strong>
		<br>
		since year 2000, until today!
		</h2>
	</div>
</div>

<span class="llclear h10"></span>-->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl']['current'])."highlights.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<span class="llclear h30"></span>
<div class="h1 llbordernone"><strong>Most Recently Registered Action Report</strong></div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/report.member.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>