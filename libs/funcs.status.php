<?php
require_once('libs/magpierss/rss_fetch.inc');

function walk_twitter_rss(&$item){
	$item['title'] = utf8_encode($item['title']);
	$item['title'] = preg_replace('/lifelink: /u', '', $item['title']);
	preg_match('/(http:\/\/bit\.ly\S+)$/u', $item['title'], $link);
	if (!count($link)) {
		preg_match('/(http:\/\/fb\.me\S+)$/u', $item['title'], $link);
	}
	$item['link'] = array_pop($link);
	$item['title'] = preg_replace('/(http:\/\/bit\.ly\S+)$/u', '', $item['title']);
	$item['title'] = preg_replace('/(http:\/\/fb\.me\S+)$/u', '', $item['title']);
	
	/*$item['title_link'] = $item['title'];
	$item['title_link'] = preg_replace('/(https?:\/\/\S+)/u', '</a><a href="\1">\1</a><a href="'.$item['link'].'">', $item['title_link']);
	$item['title_link'] = preg_replace('/www\.(\S+)/u', '</a><a href="http://www.\1">\1</a><a href="'.$item['link'].'">', $item['title_link']);
	$item['title_link'] = '<a href="'.$item['link'].'">' . $item['title_link'] . '</a>';*/
	
	$item['title'] = preg_replace('/(https?:\/\/\S+)/u', '<a href="\1">\1</a>', $item['title']);
	$item['title'] = preg_replace('/www\.(\S+)/u', '<a href="http://www.\1">\1</a>', $item['title']);
}

function walk_facebook_rss(&$item){
	$item['title'] = utf8_encode($item['title']);
	//$item['title'] = preg_replace('/lifelink: /u', '', $item['title']);
	//preg_match('/(http:\/\/bit\.ly\S+)$/u', $item['title'], $link);
	//$item['link'] = array_pop($link);
	//$item['title'] = preg_replace('/(http:\/\/bit\.ly\S+)$/u', '', $item['title']);
	//$item['title'] = preg_replace('/(http:\/\/fb\.me\S+)$/u', '', $item['title']);
	
	/*$item['title_link'] = $item['title'];
	$item['title_link'] = preg_replace('/(https?:\/\/\S+)/u', '</a><a href="\1">\1</a><a href="'.$item['link'].'">', $item['title_link']);
	$item['title_link'] = preg_replace('/www\.(\S+)/u', '</a><a href="http://www.\1">\1</a><a href="'.$item['link'].'">', $item['title_link']);
	$item['title_link'] = '<a href="'.$item['link'].'">' . $item['title_link'] . '</a>';*/
	
	$item['title'] = preg_replace('/(https?:\/\/\S+)/u', '<a href="\1">\1</a>', $item['title']);
	$item['title'] = preg_replace('/www\.(\S+)/u', '<a href="http://www.\1">\1</a>', $item['title']);
}

$twitter_rss = @fetch_rss(LL_TWITTER_RSS);
$twitter_rss_items = $twitter_rss->items;
$twitter_rss_items = @array_slice($twitter_rss_items, 0, 5);
$items = array();
foreach ($twitter_rss_items as $item) {
	if (stristr($item['title'], '#fb') === false) {
	$items[] = $item;
	}
}
@array_walk($items, 'walk_twitter_rss');
$twitter_rss_items = @array_slice($items, 0, 3);

$facebook_rss = @fetch_rss(LL_FACEBOOK_RSS);
$facebook_rss_items = $facebook_rss->items;
$facebook_rss_items = @array_slice($facebook_rss_items, 0, 5);
$items = array();
foreach ($facebook_rss_items as $item) {
	if (stristr($item['title'], '#fb') === false) {
	$items[] = $item;
	}
}
@array_walk($items, 'walk_facebook_rss');
$facebook_rss_items = @array_slice($items, 0, 3);

for($i=0;$i<count($twitter_rss_items);$i++){
	if ($facebook_rss_items[$i]['title'] != ' ')
		$twitter_rss_items[$i]['title'] = $facebook_rss_items[$i]['title'];
}

@$smarty->assign_by_ref('twitter_rss', $twitter_rss_items);

$timetest['start_magpie'] = array(gmdate('H:i:s'), memory_get_usage(true));

?>