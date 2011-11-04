<span class="llclear h30"></span>
<div class="h1"><strong>Website Overview/Sitemap</strong></div>
<span class="llclear h05"></span>
<div class="yui-gb">
<{foreach from=$menu item=cat_content key=cat_title name=category}>
	<div class="yui-u<{if $smarty.foreach.category.first}> first<{/if}>">
		<h3><strong><{$cat_title}></strong></h3>
		<!--Submenu-->
		<dl>
		<{foreach from=$cat_content item=menu_item name=menu}>
			<dt>
			<{if $menu_item[2]}>
				<{$menu_item[0]}>
				<dl class="llpaddingl">
				<{foreach from=$menu_item[2] item=menu_subitem key=menu_subitem_title name=submenu}>
					<dt><a href="<{$menu_subitem[0]}>" title="<{$menu_subitem[1]}>"><{$menu_subitem_title}></a></dt>
				<{/foreach}>
				</dl>
			<{else}>
				<a href="<{$menu_item[1]}>" title="<{$menu_item[3]}>"><{$menu_item[0]}></a>
			<{/if}>
			</dt>
		<{/foreach}>
		</dl>
		<!--Submenu End-->
	</div>
<{/foreach}>
</div>