<div class="line first secondary feedback">
	<span>{if $report_feedback}Reply{else}&nbsp;{/if}</span>
	<span{if strlen($report_feedback) > 45} title="{$report_feedback|escape}"{/if}>{if $report_feedback}{$report_feedback|escape}{else}&nbsp;{/if}</span>
</div>
<div class="line secondary feedback_date">
	<span>{$report_feedback_date|relativedate}</span>
</div>