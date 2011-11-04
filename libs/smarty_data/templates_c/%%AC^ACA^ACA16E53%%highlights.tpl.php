<?php /* Smarty version 2.6.16, created on 2011-06-26 10:54:48
         compiled from pages/home/highlights.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'pages/home/highlights.tpl', 6, false),)), $this); ?>
<!-- <div class="h1"><strong>Status Updates</strong></div> -->
<table border="0" width="100%"><tr>
	<td>
		<?php $_from = $this->_tpl_vars['twitter_rss']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['twitter_rss'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['twitter_rss']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['twitter_rss_item']):
        $this->_foreach['twitter_rss']['iteration']++;
?>
			<?php if (($this->_foreach['twitter_rss']['iteration']-1) < 3): ?>
			<div<?php if (($this->_foreach['twitter_rss']['iteration'] <= 1)): ?> style="font-size:140%"<?php endif; ?>><b><?php echo ((is_array($_tmp=$this->_tpl_vars['twitter_rss_item']['pubdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['tpl']['date_format']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['tpl']['date_format'])); ?>
</b> &middot; <a href="<?php echo $this->_tpl_vars['twitter_rss_item']['link']; ?>
">&rang;&rang;&rang;</a> <?php echo $this->_tpl_vars['twitter_rss_item']['title']; ?>

			<span class="llclear h05"></span></div>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	</td>
	<td width="100" style="padding-left:10px">
		<a href="<?php echo @LL_FACEBOOK; ?>
"><img src="http://creative.ak.facebook.com/ads3/creative/pressroom/jpg/t_1234209334_facebook_logo.jpg" border="0"></a><br/>
		<a href="<?php echo @LL_TWITTER; ?>
"><img src="http://assets1.twitter.com/images/twitter_logo_s.png" width="100" border="0"></a>
	</td>
</tr></table>

<!-- <span class="llclear h10"></span>
<div class="h1"><strong>Highlights</strong></div> -->

<!--<a href="/campaigns.php?sub=single&id=24" class="llbordernone"><img src="<?php echo $this->_tpl_vars['tpl']['webpath']; ?>
highlights/water_2010.png" class="png"></a>-->
<a href="http://conference.life-link.org" class="llbordernone"><img src="<?php echo $this->_tpl_vars['tpl']['webpath']; ?>
highlights/conference_2011.png" class="png"></a>
<a href="http://earthcare.life-link.org" class="llbordernone"><img src="<?php echo $this->_tpl_vars['tpl']['webpath']; ?>
highlights/earthcare_2010.png" class="png"></a>
<!--<a href="http://esd.life-link.org/workshop" class="llbordernone"><img src="<?php echo $this->_tpl_vars['tpl']['webpath']; ?>
highlights/esd_2010_workshop.png" class="png"></a>-->

<!--<a href="/conferences.php?sub=single&id=22" class="llbordernone"><img src="<?php echo $this->_tpl_vars['tpl']['webpath']; ?>
highlights/conference_2010.png" class="png"></a>-->
<!--<div style="text-align:right; margin-bottom:30px; margin-right:50px">
Petra, Jordan - June Conference :
<a href="/aspnet/download/Conference Agenda.pdf">Agenda</a>,
<a href="http://www.ahu.edu.jo/petra2008/">Website</a> |
<a href="/aspnet">More Information</a>
</div>-->