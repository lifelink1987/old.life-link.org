<{if $pages > 1}>
<ul class="llheaderh">
	<li class="lltitle llpaddingr">Page <{$page}> out of <{$pages}></li>
	<{if $page > 1}>
		<li><a href="<{page link=$page_link number=$page-1}>">Previous</a></li>
	<{/if}>
	<{if $page < $pages}>
		<li><a href="<{page link=$page_link number=$page+1}>">Next</a></li>
	<{/if}>
	<span class="llclear"></span>
	<ul class="llheaderhsub">
	<{if $pages <= 15}>
		<{foreach from=$pages_array item=page_array_item}>
		<{if $page_array_item != $page}>
			<li><a href="<{page link=$page_link number=$page_array_item}>"><{$page_array_item}></a></li>
		<{else}>
			<li class="current"><a><{$page_array_item}></a></li>
		<{/if}>
		<{/foreach}>
	<{else}>
		<{if $page <= 5}>
			<{math equation="max(3,x)" x=$page+2 assign=max_page}>
			<{math equation="x" x=$pages-2 assign=min_page}>
		<{/if}>
		<{if $page > $pages-5}>
			<{math equation="3" assign=max_page}>
			<{math equation="min(x,y)" x=$page-2 y=$pages-2 assign=min_page}>
		<{/if}>
		<{if $page <= 5 or $page > $pages-5}>
			<{foreach from=$pages_array item=page_array_item}>
				<{if $page_array_item <= $max_page or $page_array_item >= $min_page}>
					<{if $page_array_item != $page}>
					<li><a href="<{page link=$page_link number=$page_array_item}>"><{$page_array_item}></a></li>
					<{else}>
					<li class="current"><a><{$page_array_item}></a></li>
					<{/if}>
				<{/if}>
				<{if $page_array_item == $max_page and $max_page != $min_page}>
				<li>...</li>
				<{/if}>
			<{/foreach}>
		<{else}>
			<{foreach from=$pages_array item=page_array_item}>
				<{if $page_array_item <= 3 or $page_array_item >= $pages-2}>
				<li><a href="<{page link=$page_link number=$page_array_item}>"><{$page_array_item}></a></li>
				<{/if}>
				<{if $page_array_item <= $page+2 and $page_array_item >= $page-2}>
					<{if $page_array_item != $page}>
					<li><a href="<{page link=$page_link number=$page_array_item}>"><{$page_array_item}></a></li>
					<{else}>
					<li class="current"><a><{$page_array_item}></a></li>
					<{/if}>
				<{/if}>
				<{if ($page_array_item == $page-3 and $page_array_item != 3) or ($page_array_item == $page+3 and $page_array_item != $pages-2)}>
				<li>...</li>
				<{/if}>
			<{/foreach}>
		<{/if}>
	<{/if}>
	</ul>
</ul>
<span class="llclear"></span>
<{/if}>