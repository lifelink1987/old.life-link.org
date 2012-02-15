<div class="line first secondary numbers">
	<span>{if $report_students or $report_teachers or $report_parents}Engage{else}&nbsp;{/if}</span>
	<span>for {$report_days} day{if $report_days > 1}s{/if} {if $report_students or $report_teachers or $report_parents}&middot;{/if}{if $report_students} {$report_students} students{if $report_students_age} aged {$report_students_age}{/if} &middot;{/if}{if $report_teachers} {$report_teachers} teachers &middot;{/if}{if $report_parents} {$report_parents} parents &middot;{/if}</span>
</div>
{if $report_contact}
	<a class="secondary contact" href="mailto:{$report_contact_email}">
		<span>{$report_contact}</span>
	</a>
{else}
	<div class="line secondary contact">
		<span>&nbsp;</span>
	</div>
{/if}