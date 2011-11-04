<{include file="pages/paging.header.tpl"}>
<{foreach from=$campaigns item=campaign name=campaign}>
<{include file="pages/campaign.tpl"}>
<{if !$smarty.foreach.campaign.last}><span class="llclear h30"></span><{/if}>
<{/foreach}>
<{include file="pages/paging.footer.tpl"}>