<section class="sidebar related">
	<h1>Related Pages</h1>
	<div>
		<ul>
			<li><a href="{$uri.care_for_myself}">Care for Myself</a></li>
			{get_actions var=actions}
			{foreach from=$actions item=action name=action}
				{if $action.actions_number > 100 and $action.actions_number < 200}
					<li>&middot; <a href="{$action.link}">{$action.actions_number_nice} {$action.action|escape}</a></li>
				{/if}
			{/foreach}
		</ul>
	</div>
</section>
