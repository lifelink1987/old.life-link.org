<a href="{$report_link}" class="first report">
	<span>{$report_id}</span>
	<span{if strlen($report_description) > 45} title="{$report_description|escape}"{/if}>{$report_description|escape}</span>
</a>