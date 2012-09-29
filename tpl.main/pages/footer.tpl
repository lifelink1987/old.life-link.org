	</article>
	{include file="sidebar.tpl"}
	<!-- Footer -->
	<footer id="footer" class="colgroup first">
		<div class="column width1 first latest">
			<h1><em>the</em> Latest</h1>
			<ul class="links">
				{foreach from=$rss_news item=rss_news_item name=rss_news}
				<li><a href="{$rss_news_item.link}"{if strlen($rss_news_item.title) > 35} title="{$rss_news_item.title}"{/if}>{$rss_news_item.title|truncate:35:'...'}<span>Read more &amp; give feedback</span></a></li>
				{/foreach}
			</ul>
			<h1><em>our</em> Online Community</h1>
			<ul class="community">
				<li class="facebook">Join us on <a href="{$uri.facebook}">Facebook</a>. See the latest and be in touch with others.</li>
				<li class="twitter"><a href="{$uri.twitter}">@lifelink</a> is on Twitter. If you're on Twitter too, follow for the latest.</li>
				<li class="flickr">A <a href="{$uri.flickr}">lifelink</a> photo is worth a 1000 words.</li>
				<!--<li class="newsletter">If you want the latest in your E-mail, then <a href="#">register</a> for our newsletter.</li>-->
				<li class="feed">You can also subscribe to our <a href="{$uri.rss}"><acronym title="Really Simple Sindication">RSS</acronym> feed</a> if you're into feed readers.</li>
			</ul>
		</div>
		<div class="column width1 sitemap">
			<h1><em>the</em> Sitemap</h1>
			<ul>
				<li><a href="{$uri.home}">Home</a></li>
				<li>&nbsp;</li>
				<li><em>in</em> Practice</li>
				<li>&middot; <a href="{$uri.friendship_schools}">Schools &amp; Actions</a></li>
				<li>&middot; <a href="{$uri.campaigns}">Campaigns</a></li>
				<li>&middot; <a href="{$uri.conferences}">Conferences</a></li>
				<li>&middot; <a href="{$uri.events}">Events</a></li>
				<li>&middot; <a href="{$uri.join}">Join</a> Life-Link</li>
				<li>&middot; <a href="{$uri.support}">Support</a> Life-Link</li>
				<li>&nbsp;</li>
				<li><em>in</em> Theory</li>
				<li>&middot; <a href="{$uri.about}"><em>the</em> Organization</a></li>
				<li>&middot; <a href="{$uri.board}">Statute &amp; Board</a></li>
				<li>&middot; <a href="{$uri.programme}"><em>the</em> Programme</a></li>
				<li>&middot; <a href="{$uri.benefits}">Benefits</a></li>
				<li>&middot; <a href="{$uri.manual}">Manual</a></li>
			</ul>
		</div>
		<div class="column width1 contact">
			<h1><img src="{$tpl_uri}/img/layout/leaf_dark.png"><br />
				Life-Link<br />
				Friendship-Schools</h1>
			<ul>
				<li><a href="http://maps.google.com/maps/place?cid=17044912778302789962">Click here for visiting address!</a></li>
				<li>Post Address:<br />
					Uppsala Science Park<br />
					SE-751 83 Uppsala, Sweden</li>
				<li><a href="mailto:friendship-schools@life-link.org">friendship-schools@life-link.org</a></li>
				<li><em>tel</em> <a href="callto:+4618504344">+46 18 50 43 44</a><br />
					<em>fax</em> <a href="callto:+4618508503">+46 18 50 85 03</a></li>
				<!--<li><em>or</em> <a href="{$uri.contact}">click here to write us!</a></li>-->
			</ul>
			<ul>
				<li>&copy; 1987-{$smarty.now|date_format:"%Y"}<br />
					Life-Link Friendship-Schools<br />
					Association</li>
				<li>{$version}<br />
					rev. {$version_minor}</li>
			</ul>
		</div>
		<div class="column width1 facts">
			<a href="{$uri.map}" class="map" title="Life-Link on the World Map"><img src="{$tpl_uri}/img/layout/map.png"></a>
			<div class="headingbox">
				<h1>Facts, Keywords &amp; Figures</h1>
				<div class="colgroup">
					<div class="column unitx1 first">
						<div>
							<a href="http://en.wikipedia.org/wiki/Ngo" title="Non-Governmental Organization">N.G.O.</a><br />
							Since <b>1987</b><br />
							A small rose leaf<br />
							<br />
							<b>1</b> Office<br />
							<b>15</b> <a href="{$uri.board}">on Board</a><br />
							<br />
							<b>Supporters</b><br />
							world-wide! <a href="{$uri.support}">You?</a>
						</div>
					</div>
					<div class="column unitx1">
						<div>
							<b>{variable name="countries_counter"}</b> <a href="{$uri.friendship_schools}">Countries</a><br />
							<b>{variable name="schools_counter"}</b> <a href="{$uri.friendship_schools}">Schools</a><br />
							<b>{variable name="reports_counter"}</b> <a href="{$uri.friendship_schools}">Reports</a><br />
							<b>{variable name="actions_counter"}</b> <a href="{$uri.actions}">Care Actions</a><br />
							<br />
							<b>{variable name="conferences_counter"}</b> <a href="{$uri.conferences}">Conferences</a><br />
							<b>{variable name="campaigns_counter"}</b> <a href="{$uri.campaigns}">Campaigns</a><br />
							<br />
							<b>{variable name="reactions_counter"}</b> <a href="{$uri.reactions}">Reactions</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>
<div id="fb-root"></div>
<!-- BODY JS files -->
{foreach from=$js.post_body item=js_item}
<script type="text/javascript" src="{$js_item}"></script>
{/foreach}
<script src="http://max.jotfor.ms/min/g=feedback2" type="text/javascript">
  new JotformFeedback({
     formId     : "22723383622350",
     buttonText : "Write us!",
     windowTitle: "Send us a message from www.life-link.org",
     base       : "http://jotformeu.com/",
     background : "#006A33",
     fontColor  : "#FFFFFF",
     buttonSide : "right",
     buttonAlign: "top",
     type       : false,
     width      : 700,
     height     : 500
  });
  new JotformFeedback({
     formId      : "22724158453353",
     buttonText  : "Website Feedback",
     windowTitle : "Mark up the screenshot to describe a problem or suggestion",
     base        : "http://jotformeu.com/",
     background  : "#006A33",
     fontColor   : "#FFFFFF",
     buttonSide  : "left",
     buttonAlign : "bottom",
     type        : false,
     width       : 280,
     height      : 420,
     instant     : true
  });
</script>
</body>
</html>