{* report *}

{css file="/pages/obj/report.css"}
<div class="row_school{if $school_approved eq ''} pending{/if}">
	<div class="line first school">
		<span>{$school_number}</span>
		<span{if strlen($school_name) > 45} title="{$school_name|escape}"{/if}>{$school_name|escape}</span>
	</div>
	<div class="line city"><span{if strlen($school_city) > 15} title="{$school_city}"{/if}>{$school_city|truncate:15:'...'}</span></div>
	<div class="line country"><span{if strlen($school_country) > 20} title="{$school_country}"{/if}><img src="{$school_flag}" class="icon" title="{$school_country}" /> {$school_country|truncate:20:'...'}</span></div>
	<div class="line approved"><span>{if $school_approved neq ''}{$school_approved|relativedate}{else}pending{/if}</span></div>
	<a href="{$school_link}" class="link"><span>Edit</span></a>
</div>