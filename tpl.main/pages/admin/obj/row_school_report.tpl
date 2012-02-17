{css file="/css/source/report.css"}
<div class="row_school{if $school_approved eq ''} pending{/if}">
	<div class="line first school">
		<span>{$report_id}</span>
		<span title="{$report_description|escape}">{$report_description|truncate:45:'...'|escape}</span>
	</div>
	<div class="line city"><span>{$report_action_number}</span></div>
	<div class="line country"><span title="{$report_action}">{$report_action}</span></div>
	<div class="line approved"><span>{if $report_approved neq ''}{$report_approved|relativedate}{else}pending{/if}</span></div>
	<a href="{$report_link}" class="link"><span>Edit</span></a>
</div>