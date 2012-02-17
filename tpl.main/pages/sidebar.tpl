<!-- Sidebar -->
{js file="/sidebar.js"}
<aside id="sidebar" class="column width1">
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
	<section>
		<h1>Type <em>to</em> Search</h1>
		<div>
			<form id="type_to_search">
				<input type="text" name="country" placeholder="Country" autocomplete="off">
				<input type="text" name="school" placeholder="School Number or Name" autocomplete="off">
				<input type="text" name="action" placeholder="Care Action Number or Name" autocomplete="off">
			</form>
		</div>
	</section>
	<section>
		<h1><em>the</em> World Reacts</h1>
		<div>
			{get_random_reaction var=random_reaction}
			<b>{if $random_reaction.country}<img src="{$uri.icon_flag_16}{$random_reaction.iso2}" class="icon" title="{$random_reaction.country_short}"/> {/if}{if $random_reaction.year}({$random_reaction.year}) {/if}{$random_reaction.who}</b><br />
			{$random_reaction.reaction|truncate:250:'...'|escape|autolink}
			<a href="{$uri.reactions}#{$random_reaction.country_short}">Read more</a>
		</div>
	</section>
	<section>
		<h1>Suggestion Box</h1>
		<div>
			If you have ideas for improving this website, please speak your mind on <a href="{$uri.suggestions}">suggestions.life-link.org</a>
		</div>
	</section>
	<section>
		<h1>NOTICE!</h1>
		<div>
			This website is a testing version. Error or blank pages may show up. If you see fit, please <a href="mailto:webmaster@life-link.org">email the webmaster</a>.
		</div>
	</section>
	<section class="facebook">
		<div>
			<fb:like-box href="http://www.facebook.com/lifelinkorg" width="220" connections="0" header="false" stream="false"></fb:like-box>
		</div>
	</section>
</aside>
