<{include file="pages/paging.header.tpl"}>
<{foreach from=$conferences item=conference name=conference}>
<{include file="pages/conference.tpl"}>
<{if !$smarty.foreach.conference.last}><span class="llclear h30"></span><{/if}>
<{/foreach}>
<{include file="pages/paging.footer.tpl"}>