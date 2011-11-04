<?php /* Smarty version 2.6.16, created on 2011-06-16 13:58:56
         compiled from pages/report.photos/results.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'pages/report.photos/results.tpl', 43, false),)), $this); ?>
<?php if ($this->_tpl_vars['result_message']): ?>
	<h3><?php echo $this->_tpl_vars['result_message']; ?>
</h3>
	<div class="hr"></div>
<?php endif; ?>
<?php if (! $this->_tpl_vars['result_noform']): ?>

<span class="llclear h10"></span>
<h1><strong>Action Photos</strong></h1>
<blockquote>
	<?php if (! $this->_tpl_vars['result_noupload']): ?>
		<form method="post" action="<?php echo $this->_tpl_vars['tpl']['links']['report_photos']; ?>
" id="form-upload" enctype="multipart/form-data" class="upload major" anchor="resultsAnchor">
		<input type="hidden" name="upload" id="form-upload-upload" value="1">
		<div class="yui-gc">
			<div class="yui-u first">
				<dl>
					<dt>
						<label for="form-upload-document">JPEG Image File</label>
						<em>*</em>
					</dt>
					<dd>
						<input type="file" name="document" id="form-upload-document" tabindex="1" class="required jpeg">
					</dd>
				</dl>
			</div>
			<div class="yui-u lltextc">
				<button type="submit" id="form-upload-submit" class="ajax" tabindex="2">Add Action Photo</button>
			</div>
		</div>
		</form>
		<div class="hr"></div>
		<span class="llclear h10"></span>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['photos']): ?>
		<form method="post" action="<?php echo $this->_tpl_vars['tpl']['links']['report_photos']; ?>
" id="form-titles" anchor="resultsAnchor" class="major">
		<input type="hidden" name="titles" id="form-titles-titles" value="1">
		<?php $_from = $this->_tpl_vars['photos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['photos'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['photos']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['photo']):
        $this->_foreach['photos']['iteration']++;
?>
		<?php if (! ($this->_foreach['photos']['iteration'] <= 1)): ?>
			<span class="llclear h10"></span>
		<?php endif; ?>
		<div class="yui-gc sb">
			<div class="yui-u first">
				<span class="h2 llfloatr"><strong><?php echo $this->_foreach['photos']['iteration']; ?>
</strong></span>
				<h2><?php echo ((is_array($_tmp=$this->_tpl_vars['photo']['filename'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30, '...', true) : smarty_modifier_truncate($_tmp, 30, '...', true)); ?>
</h2>
				<dl>
					<dt>Photo Title</dt>
					<dd>
						<input type="text" name="title<?php echo $this->_foreach['photos']['iteration']; ?>
" id="form-photos-photo<?php echo $this->_foreach['photos']['iteration']; ?>
" value="<?php echo $this->_tpl_vars['photo']['title']; ?>
" tabindex="<?php echo $this->_foreach['photos']['iteration']*2+10; ?>
" autocomplete="off" maxlength="255">
					</dd>
				</dl>
			</div>
			<div class="yui-u lltextc">
				<a href="<?php echo $this->_tpl_vars['photo']['photo']; ?>
" rel="lightbox" title="<?php echo $this->_tpl_vars['photo']['title']; ?>
" class="llbordernone"><img src="<?php echo $this->_tpl_vars['photo']['thumbnail']; ?>
" alt="<?php echo $this->_tpl_vars['photo']['title']; ?>
"></a><br>
				<a href="<?php echo $this->_tpl_vars['tpl']['links']['report_photos_get_photo'];  echo $this->_tpl_vars['photo']['filename_url']; ?>
&delete=1#resultsAnchor">Delete this photo</a>
			</div>
		</div>
		<?php endforeach; endif; unset($_from); ?>
		<div class="yui-gc">
			<div class="yui-u first">
				<button type="submit" id="form-titles-submit" class="ajax" tabindex="<?php echo $this->_foreach['photos']['iteration']*2+11; ?>
">Save the titles for the photos</button>
			</div>
			<div class="yui-u lltextc">
			</div>
		</div>
		</form>
	<?php else: ?>
		No Action Photos added to this Report!
	<?php endif; ?>
</blockquote>

<span class="llclear h10"></span>
<form method="post" action="<?php echo $this->_tpl_vars['tpl']['links']['report_photos']; ?>
" id="form-photos" anchor="resultsAnchor" class="major">
<input type="hidden" name="photos" id="form-photos-photos" value="1">
<button type="submit" id="form-photos-submit" class="ajax submit" tabindex="20">
<?php if ($this->_tpl_vars['photos']): ?>
	Press this button to Register with this/these Photo(s)!
<?php else: ?>
	Press this button to Register without Photos!
<?php endif; ?>
</button><br>
<small>We hope you enjoyed your action!</small>
</form>

<?php endif; ?>