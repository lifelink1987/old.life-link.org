<!-- Sidebar -->
{js file="/sidebar.js" merge=true}

<aside id="sidebar" class="column width1">
        {block name="sidebar_spotlight" nocache}
	{get_spotlight_events var="spotlight_events"}
	{if $spotlight_events}
	<section>
		<h1>Important Events</h1>
		<div>
			<ul>
			{foreach from=$spotlight_events item=event}
				<li><a href="{$uri.event}{$event.events_id}">{$event.event_nice}</a></li>
			{/foreach}
			</ul>
		</div>
	</section>
	{/if}
	{get_spotlight_days var="spotlight_days"}
	{if $spotlight_days}
	<section>
		<h1>Important Days</h1>
		<div>
			<ul>
			{foreach from=$spotlight_days item=day}
				<li><a href="{if $day.url}{$day.url}{else}{$uri.wikipedia}{$day.day}{/if}">{$months[$day.month]} {$day.month_day}<br />{$day.day}</a></li>
			{/foreach}
			</ul>
		</div>
	</section>
	{/if}
	{/block}
	<section>
		<h1><em>Your</em> school, country<br/><em>or our</em> Life-Link actions</h1>
		<div>
			<form id="type_to_search">
				<input type="text" name="school" placeholder="School Number or Name" autocomplete="off">
				<input type="text" name="country" placeholder="Country" autocomplete="off">
				<input type="text" name="action" placeholder="Care Action Number or Name" autocomplete="off">
			</form>
			<div id="advanced_search">
				or go to the <a href="{$uri.friendship_schools_search}">Advanced Search</a>
			</div>
		</div>
	</section>
	<section>
		<h1><em>the</em> World Reacts</h1>
		<div>
			{block name="sidebar_random_reaction" nocache}
			{get_random_reaction var=random_reaction}
			<b>{if $random_reaction.country}<img src="{$uri.icon_flag_16}{$random_reaction.iso2}" class="icon" title="{$random_reaction.country_short}"/> {/if}{if $random_reaction.year}({$random_reaction.year}) {/if}{$random_reaction.who}</b><br />
			{$random_reaction.reaction|truncate:250:'...'|escape|autolink}
			<a href="{$uri.reactions}#{$random_reaction.country_short}">Read more</a>
			{/block}
		</div>
	</section>
	<section class="facebook">
		<div>
			<fb:like-box class="likebox" href="http://www.facebook.com/lifelinkorg1987" width="220" height="280" connections="6" header="false" stream="false"></fb:like-box>
			<!--<fb:activity class="activity" site="life-link.org" app_id="236062617449" width="195" height="200" header="false" font="tahoma" recommendations="false"></fb:activity>-->
		</div>
	</section>
	<section class="twitter">
		<div>
			<a class="twitter-timeline" href="https://twitter.com/lifelink1987" data-widget-id="252065955272855552">Tweets by @lifelink1987</a>
			<script src="//platform.twitter.com/widgets.js" id="twitter-wjs"></script>
		</div>
	</section>
</aside>
