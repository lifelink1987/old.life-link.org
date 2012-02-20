{nocache}
{css file="/pages/obj/event.css"}
{/nocache}

<div class="event">
	<div class="title"><a href="{$event_link}">{$event_name|truncate:100:'...'}</a></div>
	<div class="type">{$event_type}</div>
	<div class="country_year">{if $event_country}<img src="{$event_flag}" class="icon" title="{$event_country}" /> {/if}{$event_year_start}{if $event_year_start neq $event_year_end}-{$event_year_end}{/if}</div>
</div>