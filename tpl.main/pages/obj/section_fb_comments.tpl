{* facebook comments *}
<section>
	<h1>Comments</h1>
	{include file="/obj/byline.tpl"}
	<fb:comments xid='www.life-link.org_{$fb_comments_id}' numposts='5' width='590' simple='1' publish_feed='1' reverse='' css='' send_notification_uid='{$fb_uid}' title='{$title}' href='{$fb_comments_url}'></fb:comments>
</section>
