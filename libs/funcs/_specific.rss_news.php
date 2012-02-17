<?php

function walk_twitter_rss(&$item) {
	$item['title'] = utf8_encode($item['title']);
	$item['title'] = preg_replace('/lifelink: /u', '', $item['title']);
	preg_match('/(http:\/\/bit\.ly\S+)$/u', $item['title'], $link);
	if (! count($link)) {
		preg_match('/(http:\/\/fb\.me\S+)$/u', $item['title'], $link);
	}
	$item['link'] = array_pop($link);
	$item['title'] = preg_replace('/(http:\/\/bit\.ly\S+)$/u', '', $item['title']);
	$item['title'] = preg_replace('/(http:\/\/fb\.me\S+)$/u', '', $item['title']);
	
	/*$item['title_link'] = $item['title'];
	$item['title_link'] = preg_replace('/(https?:\/\/\S+)/u', '</a><a href="\1">\1</a><a href="'.$item['link'].'">', $item['title_link']);
	$item['title_link'] = preg_replace('/www\.(\S+)/u', '</a><a href="http://www.\1">\1</a><a href="'.$item['link'].'">', $item['title_link']);
	$item['title_link'] = '<a href="'.$item['link'].'">' . $item['title_link'] . '</a>';*/
	
	//$item['title'] = preg_replace('/(https?:\/\/\S+)/u', '<a href="\1">\1</a>', $item['title']);
	//$item['title'] = preg_replace('/www\.(\S+)/u', '<a href="http://www.\1">\1</a>', $item['title']);
}

function walk_facebook_rss(&$item) {
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
	
	//$item['title'] = preg_replace('/(https?:\/\/\S+)/u', '<a href="\1">\1</a>', $item['title']);
	//$item['title'] = preg_replace('/www\.(\S+)/u', '<a href="http://www.\1">\1</a>', $item['title']);
	
	$item['link'] = preg_replace('/&comments$/u', '', $item['link']);
}

function get_rss_news() {
	/*$twitter_rss = @fetch_rss(LL_TWITTER_RSS);
	$twitter_rss_items = $twitter_rss->items;
	$twitter_rss_items = @array_slice($twitter_rss_items, 0, 3);
	@array_walk($twitter_rss_items, 'walk_twitter_rss');*/
	
	$facebook_rss = @fetch_rss(LL_FACEBOOK_RSS);
	$facebook_rss_items = $facebook_rss->items;
	$facebook_rss_items_filtered = array();
	//Ignore those tagged with #fb; Those are only for the Facebook community
	for ($i = 0; $i < count($facebook_rss_items); $i++) {
		if (strpos($facebook_rss_items[$i]['title'], '#fb') === FALSE) {
			$facebook_rss_items_filtered[] = $facebook_rss_items[$i];
		}
	}
	$facebook_rss_items = @array_slice($facebook_rss_items_filtered, 0, 3);
	@array_walk($facebook_rss_items, 'walk_facebook_rss');
	
	$facebook_notes_rss = @fetch_rss(LL_FACEBOOK_NOTES_RSS);
	$facebook_notes_rss_items = $facebook_notes_rss->items;
	$facebook_notes_rss_items = @array_slice($facebook_notes_rss_items, 0, 3);
	
	for ($i = 0; $i < count($facebook_rss_items); $i++) {
		/*Notes do not have title
		if ($facebook_rss_items[$i]['title'] == ' ')
			$facebook_rss_items[$i]['title'] = $twitter_rss_items[$i]['title'];*/
		
		//Extract image from description as logo
		preg_match('/([^"]+)_s\.jpg/', $facebook_rss_items[$i]['description'], $img);
		$img = @array_pop($img);
		$facebook_rss_items[$i]['img'] = $img ? $img . '_s.jpg' : '';
		$facebook_rss_items[$i]['img_big'] = $img ? $img . '_n.jpg' : '';
		
		//Fill with full note title and description
		$note = FALSE;
		for ($j = 0; $j < count($facebook_notes_rss_items); $j++) {
			if ($facebook_notes_rss_items[$j]['link'] == $facebook_rss_items[$i]['link']) {
				$facebook_rss_items[$i]['description'] = mb_convert_encoding($facebook_notes_rss_items[$j]['description'], 'UTF-8');
				$facebook_rss_items[$i]['title'] = $facebook_notes_rss_items[$j]['title'];
				$facebook_rss_items[$i]['guid'] = $facebook_notes_rss_items[$j]['guid'];
				$facebook_rss_items[$i]['pubdate'] = $facebook_notes_rss_items[$j]['pubdate'];
				$note = TRUE;
				break;
			}
		}
		if (! $note) {
			$facebook_rss_items[$i]['description'] = '';
		}
		
		$facebook_rss_items[$i]['title'] = strip_tags($facebook_rss_items[$i]['title']);
	}
	
	return $facebook_rss_items;
}
