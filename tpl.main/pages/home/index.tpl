{include file="/obj/js_codaslider.tpl"}
<section class="basic">
	<div class="slider">
		<ul class="navigation">
			{foreach from=$highlights item=highlight name=highlights}
			<li><a href="#highlight_{$smarty.foreach.highlights.index}" title="{$highlight.highlight}">&bull;</a></li>
			{/foreach}
		</ul>
		<div class="scroll">
			<div class="scrollContainer">
				{foreach from=$highlights item=highlight name=highlights}
				<div class="panel" id="highlight_{$smarty.foreach.highlights.index}">
					<h1>
						{$highlight.highlight}
					</h1>
					<div class="byline">
						<span>&bull;</span>
					</div>
					{$highlight.content}
				</div>
				{/foreach}
			</div>
		</div>
	</div>
</section>
<section class="basic colgroup inline">
	<h1><em>the</em> Latest</h1>
	{include file="/obj/byline.tpl"}
	<div class="column width50 first news">
		<h2><em>in</em> Words</h2>
		<ul class="links">
			{foreach from=$rss_news item=rss_news_item name=rss_news}
			<li>
				<span class="date">{$rss_news_item.pubdate|relativedate}</span>
				<a href="{$rss_news_item.link}"{if strlen($rss_news_item.title)>100} title="{$rss_news_item.title}"{/if} id="news_{$smarty.foreach.rss_news.index}">
					{if $rss_news_item.img}
					<div class="logo img_center" title="Click this image to enlarge it or click the text on the right to read the article">
						<img src="{$rss_news_item.img}" longdesc="{$rss_news_item.img_big}" id="news_{$smarty.foreach.rss_news.index}_photo" />
					</div>
					{else}
					<div class="logo">
						&bull;
					</div>
					{/if}
					{$rss_news_item.title|truncate:100:'...'}
				</a>
				<div class="secret title">
					{$rss_news_item.title}<br />
					<a href="#" onclick="javascript:$('#news_{$smarty.foreach.rss_news.index}').click(); return false;">Read Article</a>
				</div>
				<div class="secret full">
					<h1>
						{$rss_news_item.title}
					</h1>
					{if $rss_news_item.img}
						<a href="#" onclick="javascript:$('#news_{$smarty.foreach.rss_news.index}_photo').click(); return false;" title="Click to enlarge"><img src="{$rss_news_item.img_big}" /></a>
					{/if}
					{$rss_news_item.description}
				</div>
			</li>
			{/foreach}
		</ul>
	</div>
	<div class="column width50 action_photos">
		<h2><em>in</em> Action Photos</h2>
		<ul class="links">
			{foreach from=$latest_reports item=report name=latest_reports}
			<li>
				<span class="flag"><img src="{$uri.icon_flag_16}{$report.iso2}" class="icon" /></span>
				<span class="date">{$report.datetime_registration|relativedate}</span>
				<a href="{$report.link}">
					<div class="logo img_center" title="{$report.actions_full.0.action} in {$report.city}, {$report.country}">
						<img src="{$report.media_front.uri_thumb}" longdesc="{$report.media_front.uri}" rel="action_photos_{$report.actions_number}" />
					</div>
				</a>
				<div class="secret images">
					{foreach from=$report.media item=media name=media}
					{if $smarty.foreach.media.index > 0}
					<img src="{$tpl_uri}/img/layout/blank.gif" longdesc="{$media.uri}" rel="action_photos_{$report.actions_number}" class="hidden" />
					{/if}
					{/foreach}
				</div>
				<div class="secret title">
					{$report.date|relativedate} &mdash; <a href="{$report.actions_full.0.link}">{$report.actions_full.0.actions_number_nice} - {$report.actions_full.0.action}</a><br />
					<a href="{$uri.school}{$report.member_schools_number}">{$report.school}</a>, {$report.city}, <a href="{$uri.country}{$report.country}">{$report.country}</a> <img src="{$uri.icon_flag_16}{$report.iso2}" class="icon" />
				</div>
			</li>
			{/foreach}
		</ul>
	</div>
</section>
<section class="basic colgroup">
	<h1><em>your</em> Next Step</h1>
	{include file="/obj/byline.tpl"}
	<div class="column width1 first explore">
		<h2>Explore</h2>
		<div>
			<div class="headingbox">
				<h1>What is Life-Link</h1>
				<div>
					<a href="{$uri.what_is_lifelink}">
						<div><img src="{$tpl_uri}/img/layout/leaf.png" width="64"></div>
						Get an overview of what Life-Link Friendship-Schools stands for.
					</a>
				</div>
			</div>
			<div class="headingbox">
				<h1>Proposed Care Actions</h1>
				<div>
					<a href="{$uri.actions}">
						<div><img src="{$uri.icon_quartz}clipboard_2.png"></div>
						We suggest {variable name="actions_counter"} Care Actions to be carried at schools world-wide.
					</a>
				</div>
			</div>
			<div class="headingbox">
				<h1>Schools &amp; Actions</h1>
				<div>
					<a href="{$uri.friendship_schools}">
						<div><img src="{$uri.icon_quartz}clipboard_3.png"></div>
						More than {variable name="schools_counter"} schools world-wide are performing Care Actions.
					</a>
				</div>
			</div>
			{if $geoip_record->country_code3}
			<div class="headingbox">
				<h1>Life-Link in {$geoip_record->country_name}</h1>
				<div>
					<a href="{$uri.country}{$geoip_record->country_name|escape:'url'}">
						<div class="img_center flag_48"><img src="{$uri.icon_flag_48}{$geoip_record->country_code}"></div>
						<b>{variable name="schools_counter_`$geoip_record->country_code3`"}</b> out of {variable name="schools_counter"} Schools<br />
						<b>{variable name="reports_counter_`$geoip_record->country_code3`"}</b> out of {variable name="reports_counter"} Reports<br />
						<b>{variable name="actions_counter_`$geoip_record->country_code3`"}</b> out of {variable name="actions_counter"} Care Actions
					</a>
				</div>
			</div>
			{/if}
		</div>
	</div>
	<div class="column width1 engage">
		<h2>Engage</h2>
		<div>
			<div class="headingbox">
				<h1>Enroll your School</h1>
				<div>
					<a href="{$uri.report}">
						<div><img src="{$uri.icon_quartz}book.png"></div>
						Report your first Life-Link action and join hands with other schools.
					</a>
				</div>
			</div>
			<div class="headingbox">
				<h1>Engage Schools near You</h1>
				<div>
					<a href="{$uri.engage_schools}">
						<div><img src="{$uri.icon_quartz}books.png"></div>
						Spread the word to other schools in your city or country.
					</a>
				</div>
			</div>
			<div class="headingbox">
				<h1>Engage your Community</h1>
				<div>
					<a href="{$uri.engage_community}">
						<div><img src="{$uri.icon_quartz}comment.png"></div>
						Talk and write to parents, teachers and officials about Life-Link and its benefits.
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="column width1 support">
		<h2>Support</h2>
		<div>
			<div class="headingbox">
				<h1>Contact a Newspaper</h1>
				<div>
					<a href="{$uri.contact_newspaper}">
						<div><img src="{$uri.icon_quartz}news.png"></div>
						Write a story on how you benefit from the Life-Link programme.
					</a>
				</div>
			</div>
			<div class="headingbox">
				<h1>Show the Leaf</h1>
				<div>
					<a href="{$uri.logo}">
						<div><img src="{$tpl_uri}/img/layout/leaf.png" width="64"></div>
						Use the Life-Link rose leaf whenever and wherever you speak of our actions.
					</a>
				</div>
			</div>
			<!--<div class="headingbox">
				<h1>Contact Us</h1>
				<div>
					<a href="#">
						<div><img src="{$uri.icon_quartz}book_address.png"></div>
						Drop us a line or report a new performed action.
					</a>
				</div>
			</div>-->
			<div class="headingbox">
				<h1>Donate</h1>
				<div>
					<a href="{$uri.donate}">
						<div><img src="{$uri.icon_quartz}star.png"></div>
						Support the Life-Link office financially.
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
