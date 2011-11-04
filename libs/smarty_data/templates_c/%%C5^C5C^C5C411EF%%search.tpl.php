<?php /* Smarty version 2.6.16, created on 2011-06-14 21:17:55
         compiled from pages/members/school/search.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'checked', 'pages/members/school/search.tpl', 5, false),array('function', 'selected', 'pages/members/school/search.tpl', 12, false),)), $this); ?>
<form method="get" action="<?php echo $this->_tpl_vars['tpl']['links']['members']; ?>
" id="form-school" anchor="resultsAnchor">
	<input type="hidden" name="sub" id="form-school-sub" value="school">
	<input type="hidden" name="schoolnumber" id="form-school-schoolnumber" value="<?php echo $this->_tpl_vars['school']['schoolnumber']; ?>
">
	<fieldset>
		<input type="checkbox" name="guideline" id="form-school-guideline"<?php echo mySmarty::function_checkboxradio_checked(array('value' => $_GET['guideline']), $this);?>
> <label for="form-school-guideline">Only Reports under Guideline Action</label>
		<select name="guideline_action" id="form-school-guideline_action" style="width: 400px">
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
		<span class="llclear h05"></span>
		
		<input type="checkbox" name="between" id="form-school-between" for="list"<?php echo mySmarty::function_checkboxradio_checked(array('value' => $_GET['between']), $this);?>
> <label for="form-school-between">Only Reports of activities</label>
		<select name="between_pr" id="form-school-between_pr">
			<option value="p"<?php echo mySmarty::function_option_selected(array('value' => $_GET['between_pr'],'current' => 'p'), $this);?>
>performed</option>
			<option value="r"<?php echo mySmarty::function_option_selected(array('value' => $_GET['between_pr'],'current' => 'r'), $this);?>
>reported</option>
		</select>

		between
		<select name="between_month" id="form-school-between_month" class="timespan">
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
		<select name="between_year" id="form-school-between_year" class="timespan">
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
		<select name="between_and_month" id="form-school-between_and_month">
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
		<select name="between_and_year" id="form-school-between_and_year" class="timespan">
			<?php $_from = $this->_tpl_vars['years']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['year']):
?>
			<option value="<?php echo $this->_tpl_vars['year']; ?>
"<?php echo mySmarty::function_option_selected(array('value' => $_GET['between_and_year'],'current' => $this->_tpl_vars['year']), $this);?>
><?php echo $this->_tpl_vars['year']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>
		<span class="llclear h05"></span>
		
		<input type="checkbox" name="photos" id="form-school-photos"<?php echo mySmarty::function_checkboxradio_checked(array('value' => $_GET['photos']), $this);?>
> <label for="form-school-photos">Only Reports with Photos</label>
		<span class="llclear h05"></span>
		<button type="submit" class="ajax llfloatr" id="form-school-submit">Click!</button>
		
		<input type="checkbox" name="all" id="form-school-all"<?php echo mySmarty::function_checkboxradio_checked(array('value' => $_GET['all']), $this);?>
> <label for="form-school-all">Show all Reports on one page (No paging)</label>
	</fieldset>
</form>
<script language="JavaScript" type="text/javascript">
	YAHOO.ll.event.pageLoadIndividual.subscribe(function (type, args) {
		var formSchool = YAHOO.util.Dom.get('form-school');
		formSchool.timespanCheck = function() {
			YAHOO.Andrei.field.timespan([this.id+'-between_month', this.id+'-between_year', this.id+'-between_and_month', this.id+'-between_and_year']);
		}
		formSchool.timespanCheck();
	});
</script>