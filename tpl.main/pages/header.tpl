<!DOCTYPE HTML>
<html lang="en" xlm:lang="en" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<title>
	{$title}
	</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="chrome=1">
	<link rel="icon" href="{$host}/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="{$host}/favicon.ico" type="image/x-icon">
	<link href="{$fb_rss}" rel="alternate" type="application/rss+xml" title="Life-Link Friendship-Schools" />
	<!-- Fix Internet Explorer -->
	<!--[if lt IE 7]>
		<script src="http://shared.life-link.org/ie7/IE7.js">var IE7_PNG_SUFFIX = ".png";</script>
	<![endif]-->
	<!--[if lt IE 8]>
		<script src="http://shared.life-link.org/ie7/IE8.js"></script>
	<![endif]-->
	<!--[if lt IE 9]>
		<script src="http://shared.life-link.org/ie7/IE9.js"></script>
	<![endif]-->
	<script type="text/javascript">
		host = "{$host}";
		api_uri = "{$uri.api}";
		tpl_uri = "{$tpl_uri}";
		country_uri = "{$uri.country}";
		school_uri = "{$uri.school}";
		action_uri = "{$uri.action}";
		contactable_uri = "{$uri.contactable}";
		speed_up = "{$speed_up}";
	</script>
	<!-- HEAD JS files -->
	{foreach from=$js.head item=js_item}
	<script type="text/javascript" src="{$js_item}"></script>
	{/foreach}
	<!-- CSS files -->
	{foreach from=$css item=css_item}
	<link rel="stylesheet" href="{$css_item}" type="text/css" media="screen">
	{/foreach}
</head>

<body class="{$browser.name} {$browser.name}_{$browser.major}">
<!-- BODY JS files -->
{foreach from=$js.pre_body item=js_item}
<script type="text/javascript" src="{$js_item}"></script>
{/foreach}
<div id="contact"></div>
<div id="overlay"></div>
<div id="page">
	<!-- Header -->
	<header id="header" class="full">
		<div class="half_title">
			Life-Link
		</div>
		<div class="half_title">
			Friendship-Schools
		</div>
		<div class="byline first">
			<span><img src="{$tpl_uri}/img/layout/leaf_dark.png"></span>
		</div>
	</header>
	<!-- Menu -->
	<nav id="nav" class="full">
		{include file="menu.tpl"}
	</nav>
	<!-- Content -->
	<article id="content" class="column width3 first">