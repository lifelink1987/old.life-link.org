<div class="yui-gf">
	<div class="yui-u first lltextr">
		<strong><{$post.post_date_gmt|date_format:$tpl.date_format}></strong>
	</div>
	<div class="yui-u">
		<{foreach from=$post.attachments item=attachment name=attachment}>
			<a href="<{$attachment.guid}>" class="<{$attachment.post_extension}>"><{$attachment.post_title}></a><br>
		<{/foreach}>
	</div>
</div>