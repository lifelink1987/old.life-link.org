{css file="/css/source/report.css"}
<div class="row_school">
	<a href="{$school_link}" class="first school">
		<span>{$school_number}</span>
		<span{if strlen($school_name) > 45} title="{$school_name|escape}"{/if}>{$school_name|escape}</span>
	</a>
	<a href="{$school_city_link}" class="city"><span{if strlen($school_city) > 15} title="{$school_city}"{/if}>{$school_city|truncate:15:'...'}</span></a>
	{if $show_country}
	<a href="{$school_country_link}" class="country"><span{if strlen($school_country) > 20} title="{$school_country}"{/if}><img src="{$school_flag}" class="icon" title="{$school_country}" /> {$school_country|truncate:20:'...'}</span></a>
	{/if}
</div>