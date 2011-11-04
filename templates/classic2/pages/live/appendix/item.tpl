<div class="llfloatl lltextr h3 llpaddingr" style="width: 200px">
	<{$post.post_date_gmt|date_format:$tpl.date_format}>
	<hr width="150">
</div>
<div class="llmarginl">
	<{if $attachments}>
		<{foreach from=$attachments item=attachment name=attachment}>
			<a href="<{$attachment.guid}>" target="_blank" class="h3"><{$attachment.post_title}></a><br>
		<{/foreach}>
	<{/if}>
	<a href="<{$post.guid}>" target="_blank" title="Live! Post"><{$post.post_title}></a>
</div>
<span class="llclear" style="height: 2em"></span>