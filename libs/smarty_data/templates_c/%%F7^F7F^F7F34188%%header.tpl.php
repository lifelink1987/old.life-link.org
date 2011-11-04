<?php /* Smarty version 2.6.16, created on 2011-06-14 21:17:17
         compiled from header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cache', 'header.tpl', 8, false),)), $this); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Life-Link Friendship-Schools</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<?php echo mySmarty::function_cache(array(), $this);?>

		<!--CSS files-->
		<?php $_from = $this->_tpl_vars['tpl']['css_files']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['css_item']):
?>
			<link rel="stylesheet" href="<?php echo $this->_tpl_vars['css_item']; ?>
" type="text/css">
		<?php endforeach; endif; unset($_from); ?>
		<!--CSS files end-->
		<?php if ($_SESSION['lltemplatelevel'] > -1): ?>
			<script type="text/javascript">
				lltemplatelevel = <?php echo $_SESSION['lltemplatelevel']; ?>
;
				lldebug = <?php echo $this->_tpl_vars['tpl']['debugjs']; ?>
;
			</script>
			<!--JS files-->
			<?php $_from = $this->_tpl_vars['tpl']['js_files']['head']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['js_item']):
?>
				<script type="text/javascript" src="<?php echo $this->_tpl_vars['js_item']; ?>
"></script>
			<?php endforeach; endif; unset($_from); ?>
			<!--JS files end-->
		<?php else: ?>
			<style type="text/css">
				body #custom-doc
				{
					visibility: visible;
				}
				#page-content form .fieldHelp
				{
					position: inherit;
					display: inherit;
					margin-top: 2px;
					width: 99%;
				}
				#page-content form .fieldHelp .bd
				{
					border-top: 1px <?php echo $this->_tpl_vars['tpl']['basics']['waterorange']; ?>
 solid;
					border-bottom: 0;
					outline: 0;
				}
				#page-content .summary
				{
					overflow: auto !important;
					overflow-y: auto !important;
				}
				.sb
				{
					border: 1px solid <?php echo $this->_tpl_vars['tpl']['basics']['lightorange']; ?>
;
					padding: 5px;
					margin: 2px;
					background-color: <?php echo $this->_tpl_vars['tpl']['basics']['white']; ?>
;
				}
			</style>
		<?php endif; ?>
	</head>
	<body>
		<!--Body JS files-->
		<?php if ($_SESSION['lltemplatelevel'] > -1): ?>
			<?php $_from = $this->_tpl_vars['tpl']['js_files']['body']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['js_item']):
?>
				<script type="text/javascript" src="<?php echo $this->_tpl_vars['js_item']; ?>
"></script>
			<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
		<!--Body JS files end-->
		
		<div id="custom-doc">
			<div id="page">
				<div id="page-header">
					<div id="page-header-menu">
					
						<?php if ($_SESSION['lltemplatelevel'] > -1): ?>
						<!--Menu-->
						<div id="menu" class="yuimenubar">
							<div class="bd">
								<ul class="first-of-type">
									<li class="yuimenubaritem first"><a href="<?php echo $this->_tpl_vars['tpl']['links']['home']; ?>
" title="Home Page">home</a></li>
									<?php $_from = $this->_tpl_vars['menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['category'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['category']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['cat_title'] => $this->_tpl_vars['cat_content']):
        $this->_foreach['category']['iteration']++;
?>
										<li class="yuimenubaritem"><?php echo $this->_tpl_vars['cat_title']; ?>

											<!--Submenu-->
											<div class="yuimenu" id="menu<?php echo $this->_foreach['category']['iteration']; ?>
">
												<div class="bd">
													<ul>
														<?php $_from = $this->_tpl_vars['cat_content']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['menu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['menu']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['menu_item']):
        $this->_foreach['menu']['iteration']++;
?>
															<li class="yuimenuitem">
															<?php if ($this->_tpl_vars['menu_item'][2]): ?>
																<?php echo $this->_tpl_vars['menu_item'][0]; ?>

																<div class="yuimenu" id="menu<?php echo $this->_foreach['category']['iteration']; ?>
_submenu<?php echo $this->_foreach['menu']['iteration']; ?>
">
																	<div class="bd">
																		<ul>
																		<?php $_from = $this->_tpl_vars['menu_item'][2]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['submenu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['submenu']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['menu_subitem_title'] => $this->_tpl_vars['menu_subitem']):
        $this->_foreach['submenu']['iteration']++;
?>
																			<li class="yuimenuitem"><a href="<?php echo $this->_tpl_vars['menu_subitem'][0]; ?>
" title="<?php echo $this->_tpl_vars['menu_subitem'][1]; ?>
"><?php echo $this->_tpl_vars['menu_subitem_title']; ?>
</a></li>
																		<?php endforeach; endif; unset($_from); ?>
																		</ul>
																	</div>
																</div>
															<?php else: ?>
																<a href="<?php echo $this->_tpl_vars['menu_item'][1]; ?>
" title="<?php echo $this->_tpl_vars['menu_item'][3]; ?>
"><?php echo $this->_tpl_vars['menu_item'][0]; ?>
</a>
															<?php endif; ?>
															</li>
														<?php endforeach; endif; unset($_from); ?>
													</ul>
												</div>
											</div>
											<!--Submenu End-->
										</li>
									<?php endforeach; endif; unset($_from); ?>
								</ul>
							</div>
						</div>
						<!--Menu End-->
						<?php endif; ?>
						
					</div>
				</div>
				<div id="page-content">