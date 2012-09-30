<div class="date">{$report_date}</div>
{if $report_front.uri_thumb neq ''}
<div class="logo img_center" title="{$report_action} in {$school_city}, {$school_country}">
	<img src="{$report_front.uri_thumb}" longdesc="{$report_front.uri}" rel="report_{$report_id}" />
</div>
<div class="secret images">
	{foreach from=$report_media item=media name=media}
	{if $smarty.foreach.media.index > 0}
	<img src="{$tpl_uri}/img/layout/blank.gif" longdesc="{$media.uri}" rel="report_{$report_id}" class="hidden" />
	{/if}
	{/foreach}
</div>
<div class="secret title">
	<a href="{$report_link}">Read about</a> {$school.school} <em>in</em> {$school.city}, <a href="{$uri.country}{$school.country}">{$school.country}</a> <img src="{$school_flag}" class="icon" /><br />
	<em>engaging in</em> {$report_action} <em>on</em> {$report_date|relativedate}
</div>
{else}
<div class="logo">
	{$report_action}
</div>
{/if}