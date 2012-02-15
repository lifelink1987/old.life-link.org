<section class="sidebar related">
	<h1>Related Pages</h1>
	<div>
		<ul>
			<li><a href="{$uri.care_for_nature}">Care for Nature</a></li>
			{get_actions var=actions}
			{foreach from=$actions item=action name=action}
				{if $action.actions_number > 300 and $action.actions_number < 400}
					<li>&middot; <a href="{$action.link}">{$action.actions_number_nice} {$action.action|escape}</a></li>
				{/if}
			{/foreach}
		</ul>
	</div>
</section>
