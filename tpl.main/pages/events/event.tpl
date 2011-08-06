<section class="colgroup inline">
	<h1>{$event.event}{if $event.type neq 'conference_major'} {$event.type_nice}{/if} {$event.year_start}{if $event.year_start neq $event.year_end}-{$event.year_end}{/if}</h1>
	{include file="/obj/byline.tpl"}
	<h3 class="center">{if $event.type neq 'conference_major'}{$event.event_cont}{else}{$event.event_nice}{/if}</h3>
	<div class="column width75 first center">
		<div class="white_box logo">
		</div>
	</div>
	<div class="column width25 statistics">
		<h3>From</h3>{$event.date_start|relativedate}<br />
		<h3>Until</h3>{$event.date_end|relativedate}<br />
		{if $event.country}<h3><a href="{$uri.country}{$event.country_short}"><img src="{$uri.icon_flag_16}{$event.iso2}" class="icon" /> {$event.country_short}</a></h3>as Host<br />{/if}
		{if $event.slug_gallery}<h3><a href="{$uri.media}{$event.slug_gallery}">Media Gallery</a></h3>{/if}
	</div>
</section>
<section>
	<p>
		{$event.description|nl2br|autolink}
	</p>
</section>
{if $event.files}
<section>
	<h1>Attachments</h1>
	{include file="/obj/byline.tpl"}
	{foreach from=$event.files item=file}
		<h2><a href="{$file.link}">{$file.name}</a></h2>
	{/foreach}
</section>
{/if}
{if $event.actions}
<section>
	<h1>Care Actions</h1>
	{include file="/obj/byline.tpl"}
	<h3 class="center">related <em>to</em> this event</h3>
	{foreach from=$event.actions_full item=action}
		<h2><a href="{$action.link}">{$action.actions_number}</a><a href="{$action.link}">{$action.action}</a></h2>
		<ul>{$action.description_theory|escape|nl2li|autolink}</ul>
	{/foreach}
</section>
{/if}
{if $schools}
<section>
	<h1>Schools</h1>
	{include file="/obj/byline.tpl"}
	<h3 class="center">taking part <em>in</em> this event</h3>
	{foreach from=$schools item=school name=school}
		{include
			file="/obj/school_city.tpl" show_country=true}
	{/foreach}
</section>
{/if}
{include file="/obj/section_fb_comments.tpl" fb_comments_id="event_`$event.events_id`" fb_comments_url="`$uri.event``$event.event_id`"}