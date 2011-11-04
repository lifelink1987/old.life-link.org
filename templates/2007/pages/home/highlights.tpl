<!-- <div class="h1"><strong>Status Updates</strong></div> -->
<table border="0" width="100%"><tr>
	<td>
		<{foreach from=$twitter_rss item=twitter_rss_item name=twitter_rss}>
			<{if $smarty.foreach.twitter_rss.index < 3}>
			<div<{if $smarty.foreach.twitter_rss.first}> style="font-size:140%"<{/if}>><b><{$twitter_rss_item.pubdate|date_format:$tpl.date_format}></b> &middot; <a href="<{$twitter_rss_item.link}>">&rang;&rang;&rang;</a> <{$twitter_rss_item.title}>
			<span class="llclear h05"></span></div>
			<{/if}>
		<{/foreach}>
	</td>
	<td width="100" style="padding-left:10px">
		<a href="<{$smarty.const.LL_FACEBOOK}>"><img src="http://creative.ak.facebook.com/ads3/creative/pressroom/jpg/t_1234209334_facebook_logo.jpg" border="0"></a><br/>
		<a href="<{$smarty.const.LL_TWITTER}>"><img src="http://assets1.twitter.com/images/twitter_logo_s.png" width="100" border="0"></a>
	</td>
</tr></table>

<!-- <span class="llclear h10"></span>
<div class="h1"><strong>Highlights</strong></div> -->

<!--<a href="/campaigns.php?sub=single&id=24" class="llbordernone"><img src="<{$tpl.webpath}>highlights/water_2010.png" class="png"></a>-->
<a href="http://conference.life-link.org" class="llbordernone"><img src="<{$tpl.webpath}>highlights/conference_2011.png" class="png"></a>
<a href="http://earthcare.life-link.org" class="llbordernone"><img src="<{$tpl.webpath}>highlights/earthcare_2010.png" class="png"></a>
<!--<a href="http://esd.life-link.org/workshop" class="llbordernone"><img src="<{$tpl.webpath}>highlights/esd_2010_workshop.png" class="png"></a>-->

<!--<a href="/conferences.php?sub=single&id=22" class="llbordernone"><img src="<{$tpl.webpath}>highlights/conference_2010.png" class="png"></a>-->
<!--<div style="text-align:right; margin-bottom:30px; margin-right:50px">
Petra, Jordan - June Conference :
<a href="/aspnet/download/Conference Agenda.pdf">Agenda</a>,
<a href="http://www.ahu.edu.jo/petra2008/">Website</a> |
<a href="/aspnet">More Information</a>
</div>-->
