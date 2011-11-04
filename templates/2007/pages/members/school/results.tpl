<{if $result_message}>
	<h3><{$result_message}></h3>
<{/if}>
<{assign var="page_link" value="`$page_link`#results"}>
<{include file="pages/paging.header.tpl"}>
<{foreach from=$reports item=report name=report}>
	<{include file="pages/report.tpl"}>
	<{if !$smarty.foreach.report.last}><span class="llclear h30"></span><{/if}>
<{/foreach}>
<{include file="pages/paging.footer.tpl"}>