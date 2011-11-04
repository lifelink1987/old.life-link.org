<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Life-Link Friendship-Schools</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<{cache}>
		<!--CSS files-->
		<{foreach from=$tpl.css_files item=css_item}>
			<link rel="stylesheet" href="<{$css_item}>" type="text/css">
		<{/foreach}>
		<!--CSS files end-->
		<{if $smarty.session.lltemplatelevel > -1}>
			<script type="text/javascript">
				lltemplatelevel = <{$smarty.session.lltemplatelevel}>;
				lldebug = <{$tpl.debugjs}>;
			</script>
			<!--JS files-->
			<{foreach from=$tpl.js_files.head item=js_item}>
				<script type="text/javascript" src="<{$js_item}>"></script>
			<{/foreach}>
			<!--JS files end-->
		<{else}>
			<style type="text/css">
				body #custom-doc
				{
					visibility: visible;
				}
				#page-content form .fieldHelp
				{
					position: inherit;
					display: inherit;
					margin-top: 2px;
					width: 99%;
				}
				#page-content form .fieldHelp .bd
				{
					border-top: 1px <{$tpl.basics.waterorange}> solid;
					border-bottom: 0;
					outline: 0;
				}
				#page-content .summary
				{
					overflow: auto !important;
					overflow-y: auto !important;
				}
				.sb
				{
					border: 1px solid <{$tpl.basics.lightorange}>;
					padding: 5px;
					margin: 2px;
					background-color: <{$tpl.basics.white}>;
				}
			</style>
		<{/if}>
	</head>
	<body>
		<!--Body JS files-->
		<{if $smarty.session.lltemplatelevel > -1}>
			<{foreach from=$tpl.js_files.body item=js_item}>
				<script type="text/javascript" src="<{$js_item}>"></script>
			<{/foreach}>
		<{/if}>
		<!--Body JS files end-->
		
		<div id="custom-doc">
			<div id="page">
				<div id="page-header">
					<div id="page-header-menu">
					
						<{if $smarty.session.lltemplatelevel > -1}>
						<!--Menu-->
						<div id="menu" class="yuimenubar">
							<div class="bd">
								<ul class="first-of-type">
									<li class="yuimenubaritem first"><a href="<{$tpl.links.home}>" title="Home Page">home</a></li>
									<{foreach from=$menu item=cat_content key=cat_title name=category}>
										<li class="yuimenubaritem"><{$cat_title}>
											<!--Submenu-->
											<div class="yuimenu" id="menu<{$smarty.foreach.category.iteration}>">
												<div class="bd">
													<ul>
														<{foreach from=$cat_content item=menu_item name=menu}>
															<li class="yuimenuitem">
															<{if $menu_item[2]}>
																<{$menu_item[0]}>
																<div class="yuimenu" id="menu<{$smarty.foreach.category.iteration}>_submenu<{$smarty.foreach.menu.iteration}>">
																	<div class="bd">
																		<ul>
																		<{foreach from=$menu_item[2] item=menu_subitem key=menu_subitem_title name=submenu}>
																			<li class="yuimenuitem"><a href="<{$menu_subitem[0]}>" title="<{$menu_subitem[1]}>"><{$menu_subitem_title}></a></li>
																		<{/foreach}>
																		</ul>
																	</div>
																</div>
															<{else}>
																<a href="<{$menu_item[1]}>" title="<{$menu_item[3]}>"><{$menu_item[0]}></a>
															<{/if}>
															</li>
														<{/foreach}>
													</ul>
												</div>
											</div>
											<!--Submenu End-->
										</li>
									<{/foreach}>
								</ul>
							</div>
						</div>
						<!--Menu End-->
						<{/if}>
						
					</div>
				</div>
				<div id="page-content">
