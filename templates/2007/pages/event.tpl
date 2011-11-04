<blockquote>
	<dl>
		<dt>
			<div class="h2">
				<{if $event.link}>
					<a href="<{$event.link}>" title="click for more information">
				<{/if}>
				<{$event.title}>
				<{if $event.link}>
					</a>
				<{/if}>
			</div>
		</dt>
		<dd>
			<div>
				<div class="lltextsmall">
					<strong><{$event.typetitle}> &middot; <{$event.startdate|date_format:$tpl.date_format}></strong>
					<{if $event.startdate != $event.enddate}>
						- <{$event.enddate|date_format:$tpl.date_format}>
					<{/if}>
				</div>
				<{if !$event.link}>
					<{$event.description}>
					<{if $event.actions}>
						<div>
							Related Guideline Actions:<br>
							<{foreach from=$event.actions item=action}>
								<div class="llfloatr">
									<{include file="pages/sectionlinks.action.tpl"}>
								</div>
								<{$action.actionnumber}> <a href="<{$tpl.links.action}><{$action.actionnumber_raw}>"><{$action.name}></a>
								<span class="llclear"></span>
							<{/foreach}>
						</div>
					<{/if}>
				<{/if}>
			</div>
		</dd>
	<dl>
</blockquote>