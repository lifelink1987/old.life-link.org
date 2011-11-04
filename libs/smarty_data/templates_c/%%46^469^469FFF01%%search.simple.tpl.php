<?php /* Smarty version 2.6.16, created on 2011-06-14 22:36:42
         compiled from pages/members/search.simple.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'selected', 'pages/members/search.simple.tpl', 17, false),)), $this); ?>
<a class="llfloatr" href="<?php echo $this->_tpl_vars['tpl']['links']['members']; ?>
?search=advanced">Advanced Search</a>
<h1>Browse/Basic Search</h1>
<span class="llclear"></span>
<form method="get" action="<?php echo $this->_tpl_vars['tpl']['links']['members']; ?>
" id="form-members-action" anchor="resultsAnchor">
	<input type="hidden" name="sub" id="form-members-action-sub" value="list">
	<input type="hidden" name="guideline" id="form-members-guideline" value="on">
	<input type="hidden" name="list_sr" id="form-members-action-list_sr" value="s">
	<input type="hidden" name="list_order" id="form-members-action-list_order" value="latest">
	<div class="h2">Schools with reports under Guideline Action</div>
	<fieldset>
		<select name="guideline_action" id="form-members-action-guideline_action" class="required">
			<?php $_from = $this->_tpl_vars['actions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['action'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['action']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['action']):
        $this->_foreach['action']['iteration']++;
?>
			<?php if ($this->_tpl_vars['action']['ischapter']): ?>
			<?php if (! ($this->_foreach['action']['iteration'] <= 1)): ?></optgroup><?php endif; ?>
			<?php if (! ($this->_foreach['action']['iteration'] == $this->_foreach['action']['total'])): ?><optgroup label="<?php echo $this->_tpl_vars['action']['name']; ?>
"><?php endif; ?>
			<?php else: ?>
			<option value="<?php echo $this->_tpl_vars['action']['actionnumber_raw']; ?>
"<?php echo mySmarty::function_option_selected(array('value' => $_GET['guideline_action'],'current' => $this->_tpl_vars['action']['actionnumber_raw']), $this);?>
><?php echo $this->_tpl_vars['action']['actionnumber']; ?>
 <?php echo $this->_tpl_vars['action']['name']; ?>
</option>
			<?php endif; ?>
			<?php if (($this->_foreach['action']['iteration'] == $this->_foreach['action']['total'])): ?></optgroup><?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
		</select>
		<button type="submit" id="form-members-action-submit">Click!</button>
	</fieldset>
</form>

<span class="llclear h10"></span>
<div class="yui-g">
	<div class="yui-u first">
		<form method="get" action="<?php echo $this->_tpl_vars['tpl']['links']['members']; ?>
" id="form-members-country" anchor="resultsAnchor">
			<input type="hidden" name="sub" id="form-members-country-sub" value="list">
			<input type="hidden" name="list_sr" id="form-members-country-list_sr" value="s">
			<input type="hidden" name="list_order" id="form-members-country-list_order" value="alphabetical">
			<div class="h2">Schools in the country of</div>
			<fieldset>
				<select name="list_country" id="form-members-country-list_country" class="required">
					<?php $_from = $this->_tpl_vars['countries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['country']):
?>
						<option value="<?php echo $this->_tpl_vars['country']['codenumber']; ?>
"<?php if ($_GET['list_country']):  echo mySmarty::function_option_selected(array('value' => $_GET['list_country'],'current' => $this->_tpl_vars['country']['codenumber']), $this); else:  echo mySmarty::function_option_selected(array('value' => $this->_tpl_vars['geo']->country_code3,'current' => $this->_tpl_vars['country']['iso']), $this); endif; ?>><?php echo $this->_tpl_vars['country']['name']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
				</select>
				<button type="submit" id="form-members-country-submit">Click!</button>
			</fieldset>
		</form>
	</div>
	<div class="yui-u">
		<form method="get" action="<?php echo $this->_tpl_vars['tpl']['links']['members']; ?>
" id="form-members-schoolnumber" anchor="resultsAnchor">
			<input type="hidden" name="sub" id="form-members-schoolnumber-sub" value="school">
			<div class="h2">School with Life-Link number</div>
			<fieldset>
				<input type="text" name="schoolnumber" id="form-members-schoolnumber-schoolnumber" value="<?php echo $_GET['schoolnumber']; ?>
" class="numbers required" size="3" maxlength="3">
				<button type="submit" id="form-members-schoolnumber-submit">Click!</button>
			</fieldset>
		</form>
	</div>
</div>

<span class="llclear h10"></span>
<div class="yui-g">
	<div class="yui-u first">
		<form method="get" action="<?php echo $this->_tpl_vars['tpl']['links']['members']; ?>
" id="form-members-name" anchor="resultsAnchor">
			<input type="hidden" name="search" value="advanced" id="form-members-name-search">
			<input type="hidden" name="sub" value="name" id="form-members-name-sub">
			<div class="h2">Schools with a name containing</div>
			<fieldset>
				<input type="text" name="namelike" autocomplete="off" value="<?php echo $_GET['namelike']; ?>
" class="required membername" id="form-members-name-namelike" size="45" maxlength="255">
				<button type="submit" id="form-members-name-submit">Click!</button><br>
				<small>* minimum 3 letters, or simply use numbers</small>
				<div id="form-members-name-namelike-autocomplete" class="autocomplete" rel="<?php echo $this->_tpl_vars['tpl']['links']['member']; ?>
"></div>
			</fieldset>
		</form>
	</div>
	<div class="yui-u">
		<form method="get" action="<?php echo $this->_tpl_vars['tpl']['links']['members']; ?>
" id="form-members-tag" anchor="resultsAnchor">
			<input type="hidden" name="sub" id="form-members-tag-sub" value="list">
			<input type="hidden" name="list_sr" id="form-members-tag-list_sr" value="s">
			<input type="hidden" name="list_order" id="form-members-tag-list_order" value="alphabetical">
			<input type="hidden" name="tagged" id="form-members-tag-tagged" value="1">
			<div class="h2">Schools part of a campaign/conference</div>
			<fieldset>
				<select name="tag" id="form-members-tag-tag">
					<option value="aspnet">2007-2008 Life-Link &amp; UNESCO ASPnet Project</option> 
				</select>
				<button type="submit" id="form-members-tag-submit">Click!</button>
			</fieldset>
		</form>
	</div>
</div>

<span class="llclear h10"></span>
<form method="get" action="<?php echo $this->_tpl_vars['tpl']['links']['members']; ?>
" id="form-members-timespan" anchor="resultsAnchor">
	<input type="hidden" name="sub" id="form-members-timespan-sub" value="list">
	<input type="hidden" name="between" id="form-members-timespan-between" value="on">
	<input type="hidden" name="list_sr" id="form-members-timespan-list_sr" value="r">
	<div class="h2">Action Reports of activities</div>
	<fieldset>
		<select name="between_pr" id="form-members-timespan-between_pr">
			<option value="p"<?php echo mySmarty::function_option_selected(array('value' => $_GET['between_pr'],'current' => 'p'), $this);?>
>performed</option>
			<option value="r"<?php echo mySmarty::function_option_selected(array('value' => $_GET['between_pr'],'current' => 'r'), $this);?>
>reported</option>
		</select>
		
		between
		<select name="between_month" id="form-members-timespan-between_month" class="timespan">
			<?php $_from = $this->_tpl_vars['months']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['month'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['month']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['month'] => $this->_tpl_vars['monthname']):
        $this->_foreach['month']['iteration']++;
?>
			<option value="<?php echo $this->_tpl_vars['month']; ?>
"<?php echo mySmarty::function_option_selected(array('value' => $_GET['between_month'],'current' => $this->_tpl_vars['month']), $this);?>
><?php echo $this->_tpl_vars['monthname']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>
		<select name="between_year" id="form-members-timespan-between_year" class="timespan">
			<?php $_from = $this->_tpl_vars['years']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['year']):
?>
			<option value="<?php echo $this->_tpl_vars['year']; ?>
"<?php echo mySmarty::function_option_selected(array('value' => $_GET['between_year'],'current' => $this->_tpl_vars['year']), $this);?>
><?php echo $this->_tpl_vars['year']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>

		and
		<select name="between_and_month" id="form-members-timespan-between_and_month" class="timespan">
			<?php $_from = $this->_tpl_vars['months']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['month'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['month']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['month'] => $this->_tpl_vars['monthname']):
        $this->_foreach['month']['iteration']++;
?>
			<option value="<?php echo $this->_tpl_vars['month']; ?>
"<?php echo mySmarty::function_option_selected(array('value' => $_GET['between_and_month'],'current' => $this->_tpl_vars['month']), $this);?>
><?php echo $this->_tpl_vars['monthname']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>
		<select name="between_and_year" id="form-members-timespan-between_and_year" class="timespan">
			<?php $_from = $this->_tpl_vars['years']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['year']):
?>
			<option value="<?php echo $this->_tpl_vars['year']; ?>
"<?php echo mySmarty::function_option_selected(array('value' => $_GET['between_and_year'],'current' => $this->_tpl_vars['year']), $this);?>
><?php echo $this->_tpl_vars['year']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>
		<button type="submit" id="form-members-timespan-submit">Click!</button>
	</fieldset>
</form>
<script language="JavaScript" type="text/javascript">
	YAHOO.ll.event.pageLoadIndividual.subscribe(function (type, args) {
		var formMembersTimespan = YAHOO.util.Dom.get('form-members-timespan');
		formMembersTimespan.timespanCheck = function() {
			YAHOO.Andrei.field.timespan([this.id+'-between_month', this.id+'-between_year', this.id+'-between_and_month', this.id+'-between_and_year']);
		}
		formMembersTimespan.timespanCheck();
	});
</script>