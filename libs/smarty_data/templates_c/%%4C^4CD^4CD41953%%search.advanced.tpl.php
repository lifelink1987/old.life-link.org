<?php /* Smarty version 2.6.16, created on 2011-06-14 21:18:27
         compiled from pages/members/search.advanced.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'selected', 'pages/members/search.advanced.tpl', 3, false),array('function', 'checked', 'pages/members/search.advanced.tpl', 33, false),)), $this); ?>
<!--List Type-->
<select name="list_sr" id="form-advanced-list_sr">
	<option value="s"<?php echo mySmarty::function_option_selected(array('value' => $_GET['list_sr'],'current' => 's'), $this);?>
>Schools</option>
	<option value="r"<?php echo mySmarty::function_option_selected(array('value' => $_GET['list_sr'],'current' => 'r'), $this);?>
>Reports</option>
</select>
<!--List Type end-->
in
<!--Countries-->
<select name="list_country" id="form-advanced-list_country" style="width: 200px">
	<option value="">all of the countries</option>
	<?php $_from = $this->_tpl_vars['countries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['country']):
?>
		<option value="<?php echo $this->_tpl_vars['country']['codenumber']; ?>
"<?php echo mySmarty::function_option_selected(array('value' => $_REQUEST['list_country'],'current' => $this->_tpl_vars['country']['codenumber']), $this);?>
><?php echo $this->_tpl_vars['country']['name']; ?>
</option>
	<?php endforeach; endif; unset($_from); ?>
</select>
<!--Countries end-->
<!--Cities-->
<select name="list_city" id="form-advanced-list_city" style="width: 150px" class="list_city">
	<option value="">all of the cities</option>
	<?php $_from = $this->_tpl_vars['cities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['city']):
?>
	<option value="<?php echo $this->_tpl_vars['city']; ?>
"<?php echo mySmarty::function_option_selected(array('value' => $_GET['list_city'],'current' => $this->_tpl_vars['city']), $this);?>
><?php echo $this->_tpl_vars['city']; ?>
</option>
	<?php endforeach; endif; unset($_from); ?>
</select>
<!--Cities end-->
ordered by
<!--List Order-->
<select name="list_order" id="form-advanced-list_order">
	<option value="alphabetical"<?php echo mySmarty::function_option_selected(array('value' => $_GET['list_order'],'current' => 'alphabetical'), $this);?>
>schools' name</option>
	<option value="latest"<?php echo mySmarty::function_option_selected(array('value' => $_GET['list_order'],'current' => 'latest'), $this);?>
>most recent reports</option>
</select>
<!--List Order end-->
<span class="llclear h05"></span>

<input type="checkbox" name="guideline" id="form-advanced-guideline"<?php echo mySmarty::function_checkboxradio_checked(array('value' => $_GET['guideline']), $this);?>
> <label for="form-advanced-guideline">Only (with) Reports under Guideline Action</label>
<select name="guideline_action" id="form-advanced-guideline_action" style="width: 400px">
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

<input type="checkbox" name="between" id="form-advanced-between" for="list"<?php echo mySmarty::function_checkboxradio_checked(array('value' => $_GET['between']), $this);?>
> <label for="form-advanced-between">Only (with) Reports of activities</label>
<select name="between_pr" id="form-advanced-between_pr">
	<option value="p"<?php echo mySmarty::function_option_selected(array('value' => $_GET['between_pr'],'current' => 'p'), $this);?>
>performed</option>
	<option value="r"<?php echo mySmarty::function_option_selected(array('value' => $_GET['between_pr'],'current' => 'r'), $this);?>
>reported</option>
</select>

between
<select name="between_month" id="form-advanced-between_month" class="timespan">
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
<select name="between_year" id="form-advanced-between_year" class="timespan">
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
<select name="between_and_month" id="form-advanced-between_and_month">
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
<select name="between_and_year" id="form-advanced-between_and_year" class="timespan">
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
<!--
<input type="checkbox" name="photos" id="form-advanced-photos"<?php echo mySmarty::function_checkboxradio_checked(array('value' => $_GET['photos']), $this);?>
> <label for="form-advanced-photos">Only (with) Reports with Photos</label>
<span class="llclear h05"></span>-->

<input type="checkbox" name="tagged" id="form-advanced-tagged"<?php echo mySmarty::function_checkboxradio_checked(array('value' => $_GET['tagged']), $this);?>
> <label for="form-advanced-tagged">Only Schools part of a campaign/conference</label>
<select name="tag" id="form-advanced-tag">
	<option value="aspnet"<?php echo mySmarty::function_option_selected(array('value' => $_GET['tag'],'current' => 'aspnet'), $this);?>
>2007-2008 Life-Link &amp; UNESCO ASPnet Project</option>
</select>
<span class="llclear h05"></span>

<input type="checkbox" name="all" id="form-advanced-all"<?php echo mySmarty::function_checkboxradio_checked(array('value' => $_GET['all']), $this);?>
> <label for="form-advanced-all">Show all on one page (No paging)</label>

<script language="JavaScript" type="text/javascript">
	YAHOO.ll.event.pageLoadIndividual.subscribe(function (type, args) {
		var formAdvanced = YAHOO.util.Dom.get('form-advanced');
		formAdvanced.timespanCheck = function() {
			YAHOO.Andrei.field.timespan([this.id+'-between_month', this.id+'-between_year', this.id+'-between_and_month', this.id+'-between_and_year']);
		}
		formAdvanced.timespanCheck();
	});
</script>