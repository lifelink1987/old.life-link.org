<br><br>
<h1>Action Report</h1>

<blockquote>
	<h2><strong>{$report.actions[0].actionnumber}</strong> <a href="{$tpl.links.action}{$report.actions[0].actionnumber_raw}">{$report.actions[0].name}</a></h2>
	{if $smarty.now|date_format:"%Y-%m-%d" < $report.perfdate}to be {/if}performed on {$report.perfdate|date_format:$tpl.date_format}{if $report.perfdays}, and lasted for {$report.perfdays} days{/if}
	
	<br><br>
	<strong>involving</strong>
	{$report.students} students{if $report.age} aged {$report.age}{/if}
	{if $report.teachers}, {$report.teachers} teachers{/if}
	{if $report.parents}, {$report.parents} parents{/if}
	
	<br><br>
	<strong>Summary of activities</strong>:
	<blockquote>{$report.description}</blockquote>
</blockquote>