<div class="yui-ge">
	<div class="yui-u first">
		<div class="h2" title="<{$conference.title|escape}>"><{$conference.title|truncate:60}></div>
		<{if $conference.major_title}>
			<span class="lltextsmall"><{$conference.major_title}></span>
		<{else}>
			&nbsp;
		<{/if}>
		<div class="hr"></div>
	</div>
	<div class="yui-u">
		<strong><{$conference.startdate|date_format:$tpl.date_format}></strong>
		<{if $conference.startdate != $conference.enddate}>
			<br>Until <{$conference.enddate|date_format:$tpl.date_format}>
		<{/if}>
	</div>
</div>

<div class="yui-ge">
	<div class="yui-u first">
		<div class="lljustify llpaddingl"><{$conference.description}></div>
		<span class="llclear h10"></span>
		<dl class="llpaddingl">
			<{foreach from=$conference.links item=link}>
				<{if $link.post_type eq 'post'}>
					<dt><a href="<{$link.guid}>"><{$link.post_title}></a></dt>
					<dd class="lltextsmall"><{$link.post_content}></dd>
				<{else}>
					<dt><a href="<{$link.guid}>" class="<{$link.post_extension}>"><{$link.post_title}></a></dt>
				<{/if}>
			<{/foreach}>
			<{if $conference.survey_slug}>
				<dt><a href="<{$tpl.links.surveys_get}><{$conference.survey_slug}>">Survey</a></dt>
			<{/if}>
			<{if $conference.gallery_slug}>
				<dt><a href="<{$tpl.links.gallery_get}><{$conference.gallery_slug}>" class="jpg">This conference has Photos! Check them out!</a></dt>
			<{/if}>
			<{if $conference.actions}>
			<dt>
				<span class="llclear h10"></span>
				Related Guideline Action(s):<br>
				<{foreach from=$conference.actions item=action}>
					<div class="llfloatr">
						<{include file="pages/sectionlinks.action.tpl"}>
					</div>
					<{$action.actionnumber}> <span class="h2"><{$action.name}></span>
					<span class="llclear"></span>
				<{/foreach}>
			</dt>
			<{/if}>
			<dt><small>conference no. <strong><{$conference.id}></strong></small></dt>
		</dl>
	</div>
	<div class="yui-u lltextc">
		<strong><{$conference.countryname|upper}></strong>
		<{if $conference.logo}>
			<span class="llclear h10"></span>
			<div>
				<a href="<{$tpl.links.conference_get_lphoto}><{$conference.id}>" rel="lightbox" class="llbordernone"><img style="border: 1px <{$tpl.basics.lightgrey}> solid" src="<{$tpl.links.conference_get_lthumbnail}><{$conference.id}>"></a>
			</div>
		<{/if}>
	</div>
</div>
