<div class="date">{$report_date}</div>
{if $report_front_thumb neq ''}
<div class="logo img_center" title="{$report_action} in {$school_city}, {$school_country}">
	<img src="{$report_front_thumb}" longdesc="{$report_front}" rel="action_photos_{$report_id}" />
</div>
<div class="secret images">
	{foreach from=$report_media item=media name=media}
	{if $smarty.foreach.media.index > 0}
	<img src="{$tpl_uri}/img/layout/blank.gif" longdesc="{$media.uri}" rel="action_photos_{$report_id}" class="hidden" />
	{/if}
	{/foreach}
</div>
<div class="secret title">
	<a href="{$report_link}">Read about</a> <em>how on</em> {$report_date|relativedate}, {$school_name} <em>in</em> {$school_city}, {$school_country} <img src="{$school_flag}" class="icon" /><br />
	<em>engaged in</em> {$report_action}
</div>
{else}
<div class="logo">
	&bull;
</div>
{/if}