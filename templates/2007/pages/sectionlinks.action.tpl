<{if !$nosectionlinks}>
	<{if $smarty.session.lltemplatelevel > 0}>
		<div class="yuimenu sectionlinks">
			<div class="bd">
				<ul>
					<li class="yuimenuitem"><a href="<{$tpl.links.action}><{$action.actionnumber_raw}>">Action <{$action.actionnumber}></a></li>
					<li class="yuimenuitem"><a href="<{$tpl.links.members_get}>list&amp;list_sr=r&amp;guideline=on&amp;guideline_action=<{$action.actionnumber_raw}>">Action <{$action.actionnumber}> : Reports</a></li>
					<li class="yuimenuitem"><a href="<{$tpl.links.members_get}>list&amp;list_sr=s&amp;guideline=on&amp;guideline_action=<{$action.actionnumber_raw}>">Action <{$action.actionnumber}> : Reporting Schools</a></li>
					<li class="yuimenuitem"><a href="<{$tpl.links.action}><{$action.chapter.actionnumber_raw}>"><{$action.chapter.name}></a></li>
					<li class="yuimenuitem"><a href="<{$tpl.links.members_get}>list&amp;list_sr=r&amp;guideline=on&amp;guideline_action=<{$action.chapter.actionnumber_raw}>"><{$action.chapter.name}> : Reports</a></li>
					<li class="yuimenuitem"><a href="<{$tpl.links.members_get}>list&amp;list_sr=s&amp;guideline=on&amp;guideline_action=<{$action.chapter.actionnumber_raw}>"><{$action.chapter.name}> : Reporting Schools</a></li>
				</ul>
			</div>
		</div>
	<{else}>
		<a href="<{$tpl.links.action}><{$action.actionnumber_raw}>">Details</a>
	<{/if}>
<{/if}>