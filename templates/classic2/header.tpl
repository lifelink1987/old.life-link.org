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
		<{if $smarty.session.ll_jsenabled == 1}>
			<!--JS files-->
			<{foreach from=$tpl.js_files.head item=js_item}>
				<script type="text/javascript" src="<{$js_item}>"></script>
			<{/foreach}>
			<!--JS files end-->
		<{/if}>
	</head>
	<body>
		<div id="wait"></div>
		<!--Body JS files-->
		<{if $smarty.session.ll_jsenabled == 1}>
			<{foreach from=$tpl.js_files.body item=js_item}>
				<script type="text/javascript" src="<{$js_item}>"></script>
			<{/foreach}>
		<{/if}>
		<!--Body JS files end-->
		
		<div id="bodyContent">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" id="headerContainer">
				<tr>
					<td id="headerLeft">&nbsp;</td>
					<td id="headerCenter">
						<div id="banner">
							<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="<{$tpl.basics.banner_width}>" height="<{$tpl.basics.header_height}>" id="SWFbanner" align="middle">
								<param name="allowScriptAccess" value="sameDomain" />
								<param name="movie" value="<{banner}>" />
								<param name="loop" value="false" />
								<param name="menu" value="false" />
								<param name="quality" value="best" />
								<param name="wmode" value="transparent" />
								<param name="bgcolor" value="#ffffff" />
								<embed src="<{banner}>" loop="false" menu="false" quality="best" wmode="transparent" bgcolor="#ffffff" width="<{$tpl.basics.banner_width}>" height="<{$tpl.basics.header_height}>" name="SWFbanner" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
							</object>
						</div>
						
						<!--Menu-->
						<div id="mainmenu" class="yuimenubar">
							<div class="bd">
								<ul class="first-of-type">
									<li class="yuimenubaritem first-of-type"><a href="<{$tpl.links.home}>" title="Home Page">Life-Link Programme</a></li>
									<{foreach from=$menu item=cat_content key=cat_title name=category}>
										<li class="yuimenubaritem"><{$cat_title}>
											<!--Submenu-->
											<div class="yuimenu" id="menu<{$smarty.foreach.category.iteration}>">
												<div class="bd">
													<ul>
														<{foreach from=$cat_content item=menu_item name=menu}>
															<li class="yuimenuitem"><a href="<{$menu_item[1]}>" title="<{$menu_item[3]}>"><{$menu_item[0]}></a>
															<{if $menu_item[2]}>
																<div class="yuimenu" id="menu<{$smarty.foreach.category.iteration}>_submenu<{$smarty.foreach.menu.iteration}>">
																	<div class="bd">
																		<ul>
																		<{foreach from=$menu_item[2] item=menu_subitem key=menu_subitem_title name=submenu}>
																			<li class="yuimenuitem"><a href="<{$menu_subitem[0]}>" title="<{$menu_subitem[1]}>"><{$menu_subitem_title}></a></li>
																		<{/foreach}>
																		</ul>
																	</div>
																</div>
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
					</td>
					<td id="headerRight">&nbsp;</td>
				</tr>
			</table>
			
			<div id="pageContainer">
				<div class="bd" id="pageContent">
				</div>
			</div>
			
			<div id="footerContainer">
				<div class="bd">
				</div>
			</div>
		</div>
		
		<!--Summary-->
		<div id="summary">
			<div class="hd">Full text</div>
			<div class="bd"></div>
		</div>
		<!--Summary End-->
		
		<!--Info-->
		<div id="info">
			<div class="hd">Information</div>
			<div class="bd"></div>
		</div>
		<!--Info End-->
		
		
	
		<div id="initialPageContent">
	