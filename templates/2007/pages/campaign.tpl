<div class="yui-ge">
	<div class="yui-u first">
		<div class="h2" title="<{$campaign.title|escape}> Campaign"><{$campaign.title|truncate:60}> <strong>Campaign</strong></div>
		<{if $campaign.subtitle}>
			<span class="lltextsmall"><{$campaign.subtitle}></span>
		<{else}>
			&nbsp;
		<{/if}>
		<div class="hr"></div>
	</div>
	<div class="yui-u">
		<strong><{$campaign.startdate|date_format:$tpl.date_format}></strong>
		<{if $campaign.startdate != $campaign.enddate}>
			<br>Until <{$campaign.enddate|date_format:$tpl.date_format}>
		<{/if}>
	</div>
</div>

<div class="yui-ge">
	<div class="yui-u first">
		<div class="lljustify llpaddingl"><{$campaign.description}></div>
		<span class="llclear h10"></span>
		<dl class="llpaddingl">
			<{foreach from=$campaign.links item=link}>
				<{if $link.post_type eq 'post'}>
					<dt><a href="<{$link.guid}>"><{$link.post_title}></a></dt>
					<dd class="lltextsmall"><{$link.post_content}></dd>
				<{else}>
					<dt><a href="<{$link.guid}>" class="<{$link.post_extension}>"><{$link.post_title}></a></dt>
				<{/if}>
			<{/foreach}>
			<{if $campaign.survey_slug}>
				<dt><a href="<{$tpl.links.surveys_get}><{$campaign.survey_slug}>">Survey</a></dt>
			<{/if}>
			<{if $campaign.gallery_slug}>
				<dt><a href="<{$tpl.links.gallery_get}><{$campaign.gallery_slug}>" class="jpg">This campaign has Photos! Check them out!</a></dt>
			<{/if}>
			<{if $campaign.actions}>
			<dt>
				<span class="llclear h10"></span>
				Related Guideline Action(s):<br>
				<{foreach from=$campaign.actions item=action}>
					<div class="llfloatr">
						<{include file="pages/sectionlinks.action.tpl"}>
					</div>
					<{$action.actionnumber}> <span class="h2"><{$action.name}></span>
					<span class="llclear"></span>
				<{/foreach}>
			</dt>
			<{/if}>
			<dt><small>campaign no. <strong><{$campaign.id}></strong></small></dt>
		</dl>
	</div>
	<div class="yui-u">
		<{if $campaign.logo}>
			<a href="<{$tpl.links.campaign_get_lphoto}><{$campaign.id}>" rel="lightbox" class="llbordernone"><img style="border: 1px <{$tpl.basics.lightgrey}> solid" src="<{$tpl.links.campaign_get_lthumbnail}><{$campaign.id}>"></a>
		<{/if}>
	</div>
</div>