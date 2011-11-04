<?php /* Smarty version 2.6.16, created on 2011-06-14 21:17:19
         compiled from footer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'switcher', 'footer.tpl', 11, false),array('modifier', 'date_format', 'footer.tpl', 27, false),)), $this); ?>

				</div>
				<div id="page-footer">
				</div>
			</div>
			<div id="sidebar">
				<div id="sidebar-header">
					<?php if ($_SESSION['lltemplatelevel'] > -1): ?>
						<div id="template-level">
							<?php if ($_SESSION['lltemplatelevel'] == 0): ?>
								Switch to <a href="<?php echo mySmarty::function_switcher(array('key' => 'lltemplatelevel','value' => 1), $this);?>
">Enhanced</a> Interface<br>
								to improve appearance<br>
								on fast/new computers
							<?php else: ?>
								Switch to <a href="<?php echo mySmarty::function_switcher(array('key' => 'lltemplatelevel','value' => 0), $this);?>
">Basic</a> Interface<br>
								to improve performance<br>
								on slow/old computers
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
				<div id="sidebar-content">
					<div id="news" class="block">
						<h2>Latest News</h2>
						<div style="padding:5px">
							<?php $_from = $this->_tpl_vars['twitter_rss']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['twitter_rss'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['twitter_rss']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['twitter_rss_item']):
        $this->_foreach['twitter_rss']['iteration']++;
?>
								<div<?php if (! ($this->_foreach['twitter_rss']['iteration'] <= 1)): ?> style="font-size:90%"<?php endif; ?>><b><?php echo ((is_array($_tmp=$this->_tpl_vars['twitter_rss_item']['pubdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['tpl']['date_format']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['tpl']['date_format'])); ?>
</b> <a href="<?php echo $this->_tpl_vars['twitter_rss_item']['link']; ?>
">&rang;&rang;&rang;</a><br/><?php echo $this->_tpl_vars['twitter_rss_item']['title']; ?>
</div><br/>
							<?php endforeach; endif; unset($_from); ?>
							<div style="text-align:center">
								More news on<br/>
								<a href="<?php echo @LL_FACEBOOK; ?>
" style="border-bottom:none"><img src="http://creative.ak.facebook.com/ads3/creative/pressroom/jpg/t_1234209334_facebook_logo.jpg" border="0"></a><br/>
								<a href="<?php echo @LL_TWITTER; ?>
" style="border-bottom:none"><img src="http://assets1.twitter.com/images/twitter_logo_s.png" width="100" border="0"></a>
							</center>
						</div>
					</div>
					<?php if ($_SESSION['lltemplatelevel'] == -1): ?>
					<div id="sitemap" class="block">
						<h2>Overview/Sitemap</h2>
						<!--Sitemap-->
						<ul>
							<li><a href="<?php echo $this->_tpl_vars['tpl']['links']['home']; ?>
" title="Home Page">home</a></li>
							<?php $_from = $this->_tpl_vars['menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['category'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['category']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['cat_title'] => $this->_tpl_vars['cat_content']):
        $this->_foreach['category']['iteration']++;
?>
								<li><?php echo $this->_tpl_vars['cat_title']; ?>

									<!--Submenu-->
									<ul>
									<?php $_from = $this->_tpl_vars['cat_content']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['menu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['menu']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['menu_item']):
        $this->_foreach['menu']['iteration']++;
?>
										<li>
										<?php if ($this->_tpl_vars['menu_item'][2]): ?>
											<?php echo $this->_tpl_vars['menu_item'][0]; ?>

											<ul>
											<?php $_from = $this->_tpl_vars['menu_item'][2]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['submenu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['submenu']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['menu_subitem_title'] => $this->_tpl_vars['menu_subitem']):
        $this->_foreach['submenu']['iteration']++;
?>
												<li><a href="<?php echo $this->_tpl_vars['menu_subitem'][0]; ?>
" title="<?php echo $this->_tpl_vars['menu_subitem'][1]; ?>
"><?php echo $this->_tpl_vars['menu_subitem_title']; ?>
</a></li>
											<?php endforeach; endif; unset($_from); ?>
											</ul>
										<?php else: ?>
											<a href="<?php echo $this->_tpl_vars['menu_item'][1]; ?>
" title="<?php echo $this->_tpl_vars['menu_item'][3]; ?>
"><?php echo $this->_tpl_vars['menu_item'][0]; ?>
</a>
										<?php endif; ?>
										</li>
									<?php endforeach; endif; unset($_from); ?>
									</ul>
									<!--Submenu End-->
								</li>
							<?php endforeach; endif; unset($_from); ?>
						</ul>
						<!--Sitemap End-->
					</div>
					<?php else: ?>
						<br>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['tpl']['website']['live']): ?>
						<div id="live" class="block">
							<h2>In the <a href="<?php echo $this->_tpl_vars['tpl']['links']['blog']; ?>
" title="News, Newsletters &amp; Board Meetings">News</a></h2>
							<dl>
							<?php $_from = $this->_tpl_vars['tpl']['website']['live']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['section']):
?>
								<?php $_from = $this->_tpl_vars['section']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['event']):
?>
									<dt><?php echo ((is_array($_tmp=$this->_tpl_vars['event']['post_date_gmt'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['tpl']['date_format']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['tpl']['date_format'])); ?>
</dt>
									<dd>
										<strong>
											<?php if ($this->_tpl_vars['key'] == 'news' || ! $this->_tpl_vars['event']['attachments']): ?>
												<a href="<?php echo $this->_tpl_vars['event']['guid']; ?>
">
											<?php endif; ?>
											<?php echo $this->_tpl_vars['event']['post_title']; ?>

											<?php if ($this->_tpl_vars['key'] == 'news' || ! $this->_tpl_vars['event']['attachments']): ?>
												</a>
											<?php endif; ?>
										</strong>
										<?php if ($this->_tpl_vars['event']['post_excerpt']): ?>
											<div><?php echo $this->_tpl_vars['event']['post_excerpt']; ?>
</div>
										<?php endif; ?>
										<?php if ($this->_tpl_vars['key'] != 'news' && $this->_tpl_vars['event']['attachments']): ?>
											<?php $_from = $this->_tpl_vars['event']['attachments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['attachment']):
?>
												<div><a href="<?php echo $this->_tpl_vars['attachment']['guid']; ?>
" class="<?php echo $this->_tpl_vars['attachment']['post_extension']; ?>
">download</a></div>
											<?php endforeach; endif; unset($_from); ?>
										<?php endif; ?>
									</dd>
									<br>
								<?php endforeach; endif; unset($_from); ?>
							<?php endforeach; endif; unset($_from); ?>
							</dl>
						</div>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['tpl']['website']['future_agenda']): ?>
						<div id="future-agenda" class="block">
							<h2>Next on the <a href="<?php echo $this->_tpl_vars['tpl']['links']['agenda']; ?>
" title="Campaigns, Conferences, UN Days &amp; Events">Agenda</a></h2>
							<dl>
							<?php $_from = $this->_tpl_vars['tpl']['website']['future_agenda']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['event']):
?>
								<dt><?php echo ((is_array($_tmp=$this->_tpl_vars['event']['startdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['tpl']['date_format']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['tpl']['date_format'])); ?>
<br><?php echo $this->_tpl_vars['event']['typetitle']; ?>
</dt>
								<dd>
									<strong>
										<?php if ($this->_tpl_vars['event']['link']): ?>
											<a href="<?php echo $this->_tpl_vars['event']['link']; ?>
">
										<?php endif; ?>
										<?php echo $this->_tpl_vars['event']['title']; ?>

										<?php if ($this->_tpl_vars['event']['link']): ?>
											</a>
										<?php endif; ?>
									</strong>
								</dd>
								<br>
							<?php endforeach; endif; unset($_from); ?>
							</dl>
						</div>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['tpl']['website']['recent_agenda']): ?>
						<div id="recent-agenda" class="block">
							<h2>Recently on the <a href="<?php echo $this->_tpl_vars['tpl']['links']['agenda']; ?>
" title="Campaigns, Conferences, UN Days &amp; Events">Agenda</a></h2>
							<dl>
							<?php $_from = $this->_tpl_vars['tpl']['website']['recent_agenda']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['event']):
?>
								<dt><?php echo ((is_array($_tmp=$this->_tpl_vars['event']['startdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['tpl']['date_format']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['tpl']['date_format'])); ?>
<br><?php echo $this->_tpl_vars['event']['typetitle']; ?>
</dt>
								<dd>
									<strong>
										<?php if ($this->_tpl_vars['event']['link']): ?>
											<a href="<?php echo $this->_tpl_vars['event']['link']; ?>
">
										<?php endif; ?>
										<?php echo $this->_tpl_vars['event']['title']; ?>

										<?php if ($this->_tpl_vars['event']['link']): ?>
											</a>
										<?php endif; ?>
									</strong>
								</dd>
								<br>
							<?php endforeach; endif; unset($_from); ?>
							</dl>
						</div>
					<?php endif; ?>
					<br>
					<div id="donate" class="block">
						<h2>Support Life-Link!</h2>
						<div style="text-align:center; padding:5px">
							<a href="<?php echo $this->_tpl_vars['tpl']['links']['support']; ?>
">
							<img src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG_global.gif" border="0" alt="">
							</a>
						</div>
					</div>
					<div id="website" class="block">
						<h2>Website - Ver. <acronym title="Backbone"><?php echo $this->_tpl_vars['tpl']['website']['version']['major']; ?>
.<?php echo $this->_tpl_vars['tpl']['website']['version']['minor']; ?>
</acronym> (<acronym title="Interface"><?php echo $this->_tpl_vars['tpl']['version']['major']; ?>
.<?php echo $this->_tpl_vars['tpl']['version']['minor']; ?>
</acronym>)</h2>
						<ul>
							<li><a href="<?php echo $this->_tpl_vars['tpl']['links']['website']; ?>
">Information</a></li>
							<li><a href="<?php echo $this->_tpl_vars['tpl']['links']['contact_get']; ?>
andrei&amp;message=I ran into website errors or I would like to make some comments. Here are the details!">Problems? Tell us!</a></li>
							<li>
								Design &amp; Concept
								<ul>
									<li><a href="<?php echo $this->_tpl_vars['tpl']['links']['andrei']; ?>
">Andrei NECULAU</a></li>
								</ul>
							</li>
						</ul>
						
						<br>
						<div style="text-align: center">
							<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
							<script type="text/javascript">
								_uacct = "UA-1944438-1";
								urchinTracker();
							</script>
						</div>
						
						<?php if ($this->_tpl_vars['tpl']['debugjs']): ?>
							<br>
							<code>
								JS Entire Page: <span id="debug-time">unknown</span><br>
								JS Indiv. Page: <span id="debug-individual-time">unknown</span>
							</code>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<!-- time tests: <?php echo $this->_tpl_vars['timetest']; ?>
 -->
	</body>
</html>