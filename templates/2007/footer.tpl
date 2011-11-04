
				</div>
				<div id="page-footer">
				</div>
			</div>
			<div id="sidebar">
				<div id="sidebar-header">
					<{if $smarty.session.lltemplatelevel > -1}>
						<div id="template-level">
							<{if $smarty.session.lltemplatelevel == 0}>
								Switch to <a href="<{switcher key=lltemplatelevel value=1}>">Enhanced</a> Interface<br>
								to improve appearance<br>
								on fast/new computers
							<{else}>
								Switch to <a href="<{switcher key=lltemplatelevel value=0}>">Basic</a> Interface<br>
								to improve performance<br>
								on slow/old computers
							<{/if}>
						</div>
					<{/if}>
				</div>
				<div id="sidebar-content">
					<div id="news" class="block">
						<h2>Latest News</h2>
						<div style="padding:5px">
							<{foreach from=$twitter_rss item=twitter_rss_item name=twitter_rss}>
								<div<{if !$smarty.foreach.twitter_rss.first}> style="font-size:90%"<{/if}>><b><{$twitter_rss_item.pubdate|date_format:$tpl.date_format}></b> <a href="<{$twitter_rss_item.link}>">&rang;&rang;&rang;</a><br/><{$twitter_rss_item.title}></div><br/>
							<{/foreach}>
							<div style="text-align:center">
								More news on<br/>
								<a href="<{$smarty.const.LL_FACEBOOK}>" style="border-bottom:none"><img src="http://creative.ak.facebook.com/ads3/creative/pressroom/jpg/t_1234209334_facebook_logo.jpg" border="0"></a><br/>
								<a href="<{$smarty.const.LL_TWITTER}>" style="border-bottom:none"><img src="http://assets1.twitter.com/images/twitter_logo_s.png" width="100" border="0"></a>
							</center>
						</div>
					</div>
					<{if $smarty.session.lltemplatelevel == -1}>
					<div id="sitemap" class="block">
						<h2>Overview/Sitemap</h2>
						<!--Sitemap-->
						<ul>
							<li><a href="<{$tpl.links.home}>" title="Home Page">home</a></li>
							<{foreach from=$menu item=cat_content key=cat_title name=category}>
								<li><{$cat_title}>
									<!--Submenu-->
									<ul>
									<{foreach from=$cat_content item=menu_item name=menu}>
										<li>
										<{if $menu_item[2]}>
											<{$menu_item[0]}>
											<ul>
											<{foreach from=$menu_item[2] item=menu_subitem key=menu_subitem_title name=submenu}>
												<li><a href="<{$menu_subitem[0]}>" title="<{$menu_subitem[1]}>"><{$menu_subitem_title}></a></li>
											<{/foreach}>
											</ul>
										<{else}>
											<a href="<{$menu_item[1]}>" title="<{$menu_item[3]}>"><{$menu_item[0]}></a>
										<{/if}>
										</li>
									<{/foreach}>
									</ul>
									<!--Submenu End-->
								</li>
							<{/foreach}>
						</ul>
						<!--Sitemap End-->
					</div>
					<{else}>
						<br>
					<{/if}>
					<{if $tpl.website.live}>
						<div id="live" class="block">
							<h2>In the <a href="<{$tpl.links.blog}>" title="News, Newsletters &amp; Board Meetings">News</a></h2>
							<dl>
							<{foreach from=$tpl.website.live item=section key=key}>
								<{foreach from=$section item=event}>
									<dt><{$event.post_date_gmt|date_format:$tpl.date_format}></dt>
									<dd>
										<strong>
											<{if $key eq 'news' or !$event.attachments}>
												<a href="<{$event.guid}>">
											<{/if}>
											<{$event.post_title}>
											<{if $key eq 'news' or !$event.attachments}>
												</a>
											<{/if}>
										</strong>
										<{if $event.post_excerpt}>
											<div><{$event.post_excerpt}></div>
										<{/if}>
										<{if $key neq 'news' and $event.attachments}>
											<{foreach from=$event.attachments item=attachment}>
												<div><a href="<{$attachment.guid}>" class="<{$attachment.post_extension}>">download</a></div>
											<{/foreach}>
										<{/if}>
									</dd>
									<br>
								<{/foreach}>
							<{/foreach}>
							</dl>
						</div>
					<{/if}>
					<{if $tpl.website.future_agenda}>
						<div id="future-agenda" class="block">
							<h2>Next on the <a href="<{$tpl.links.agenda}>" title="Campaigns, Conferences, UN Days &amp; Events">Agenda</a></h2>
							<dl>
							<{foreach from=$tpl.website.future_agenda item=event}>
								<dt><{$event.startdate|date_format:$tpl.date_format}><br><{$event.typetitle}></dt>
								<dd>
									<strong>
										<{if $event.link}>
											<a href="<{$event.link}>">
										<{/if}>
										<{$event.title}>
										<{if $event.link}>
											</a>
										<{/if}>
									</strong>
								</dd>
								<br>
							<{/foreach}>
							</dl>
						</div>
					<{/if}>
					<{if $tpl.website.recent_agenda}>
						<div id="recent-agenda" class="block">
							<h2>Recently on the <a href="<{$tpl.links.agenda}>" title="Campaigns, Conferences, UN Days &amp; Events">Agenda</a></h2>
							<dl>
							<{foreach from=$tpl.website.recent_agenda item=event}>
								<dt><{$event.startdate|date_format:$tpl.date_format}><br><{$event.typetitle}></dt>
								<dd>
									<strong>
										<{if $event.link}>
											<a href="<{$event.link}>">
										<{/if}>
										<{$event.title}>
										<{if $event.link}>
											</a>
										<{/if}>
									</strong>
								</dd>
								<br>
							<{/foreach}>
							</dl>
						</div>
					<{/if}>
					<br>
					<div id="donate" class="block">
						<h2>Support Life-Link!</h2>
						<div style="text-align:center; padding:5px">
							<a href="<{$tpl.links.support}>">
							<img src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG_global.gif" border="0" alt="">
							</a>
						</div>
					</div>
					<div id="website" class="block">
						<h2>Website - Ver. <acronym title="Backbone"><{$tpl.website.version.major}>.<{$tpl.website.version.minor}></acronym> (<acronym title="Interface"><{$tpl.version.major}>.<{$tpl.version.minor}></acronym>)</h2>
						<ul>
							<li><a href="<{$tpl.links.website}>">Information</a></li>
							<li><a href="<{$tpl.links.contact_get}>andrei&amp;message=I ran into website errors or I would like to make some comments. Here are the details!">Problems? Tell us!</a></li>
							<li>
								Design &amp; Concept
								<ul>
									<li><a href="<{$tpl.links.andrei}>">Andrei NECULAU</a></li>
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
						
						<{if $tpl.debugjs}>
							<br>
							<code>
								JS Entire Page: <span id="debug-time">unknown</span><br>
								JS Indiv. Page: <span id="debug-individual-time">unknown</span>
							</code>
						<{/if}>
					</div>
				</div>
			</div>
		</div>
		<!-- time tests: <{$timetest}> -->
	</body>
</html>