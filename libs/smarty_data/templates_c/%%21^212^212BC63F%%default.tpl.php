<?php /* Smarty version 2.6.16, created on 2011-06-14 23:39:58
         compiled from pages/website/default.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'pages/website/default.tpl', 13, false),)), $this); ?>
<div id="related">
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "official:".($this->_tpl_vars['tpl']['current'])."related.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "official:".($this->_tpl_vars['tpl']['current'])."website.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<span class="llclear" style="height: 2em"></span>


<div class="h2"><strong>Current Website Version</strong>:</div>
<div class="yui-g">
	<div class="yui-u first">
		<dl>
			<dt>Backbone</dt>
			<dd><?php echo $this->_tpl_vars['tpl']['website']['version']['major']; ?>
.<?php echo $this->_tpl_vars['tpl']['website']['version']['minor']; ?>
 - Updated on <?php echo ((is_array($_tmp=$this->_tpl_vars['tpl']['website']['version']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['tpl']['date_format']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['tpl']['date_format'])); ?>
</dd>
		</dl>
	</div>
	<div class="yui-u">
		<dl>
			<dt>Interface</dt>
			<dd><?php echo $this->_tpl_vars['tpl']['version']['major']; ?>
.<?php echo $this->_tpl_vars['tpl']['version']['minor']; ?>
 - Updated on <?php echo ((is_array($_tmp=$this->_tpl_vars['tpl']['version']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['tpl']['date_format']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['tpl']['date_format'])); ?>
</dd>
		</dl>
	</div>
</div>
		
<div class="hr"></div>
<div class="yui-g">
	<div class="yui-u first">
		<h2>This site has been <strong>optimized for</strong>:</h2>
		<dl>
			<dt><a href="http://www.mozilla.com/en-US/firefox/" rel="nofollow"><?php echo $this->_tpl_vars['tpl']['images']['bfirefox']; ?>
</a> (Mozilla Corporation)</dt>
			<dd>tested on Windows version 2.0.0.1</dd>
			
			<dt><a href="http://www.opera.com/" rel="nofollow"><?php echo $this->_tpl_vars['tpl']['images']['bopera']; ?>
</a> (Opera Software)</dt>
			<dd>tested on Windows version 9.1</dd>
			
			<dt><a href="http://www.microsoft.com/windows/ie/" rel="nofollow"><?php echo $this->_tpl_vars['tpl']['images']['bie']; ?>
</a> (Microsoft Corporation)</dt>
			<dd>tested on Windows version 6.0 SP2 & 7.0</d>
			
			<dt><strong>1024x768 px</strong> resolution</dt>
			<dd>800x600 px resolution (minimum)</dd>
		</dl>
	</div>
	<div class="yui-u first">
		<h2>and has been built with/on:</h2>
		<dl>
			<dt><a href="http://www.apache.org" rel="nofollow"><?php echo $this->_tpl_vars['tpl']['images']['bapache']; ?>
</a> Apache HTTP Server 2</dt>
			<dt><a href="http://www.php.net" rel="nofollow"><?php echo $this->_tpl_vars['tpl']['images']['bphp']; ?>
</a> Hypertext Preprocessor 5</dt>
			<dt><a href="http://www.mysql.com" rel="nofollow"><?php echo $this->_tpl_vars['tpl']['images']['bmysql']; ?>
</a> MySQL Database 5</dt>
			<dt><a href="http://www.unicode.org" rel="nofollow"><?php echo $this->_tpl_vars['tpl']['images']['butf8']; ?>
</a> International UTF8 support</dt>
		</dl>
		
		<div class="hr"></div>

		<h2>and uses these <strong>technologies/frameworks</strong>:</h2>
		<dl>
			<dt><?php echo $this->_tpl_vars['tpl']['images']['bhtml']; ?>
</dt>
			<dd>Hyper Text Markup Language</dd>
			
			<dt><?php echo $this->_tpl_vars['tpl']['images']['bcss']; ?>
</dt>
			<dd>Cascading Style Sheets</dd>
			
			<dt><strong>DOM</strong></dt>
			<dd>Document Object Model</dd>
			
			<dt><strong>JS &amp; Web 2.0</strong></dt>
			<dd>
				Dynamic Hyper Text Markup Language<br>
				Java Script &amp; Web 2.0 elements
			</dd>
		</dl>		
	</div>
</div>