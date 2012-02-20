{nocache}
{css file="/pages/obj/link.css"}
{/nocache}

<div class="link">
	<div class="title"><a href="{$link_link}" title="{$link_description}">{$link_title|truncate:100:'...'}</a></div>
	<div class="date">{if $link_tags.date}{$link_tags.date.title|relativedate}{else}{$link_datetime|relativedate}{/if}</div>
	<div class="type">{$link_tags.type.title}</div>
</div>
