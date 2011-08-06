// JavaScript Document

$(function(){
	/* Enlarge News */
	$('#content .news ul li > a').colorbox($.extend({}, colorbox.config, colorbox.text, {
		rel:'news',
		current:'article {current} of {total}',
		href:function() {
			return $(this).closest('li').children('div.full').first();
		}
	}));
	
	/* Enlarge images within News links */
	$('#content .news img[longdesc]').colorbox($.extend({}, colorbox.config, colorbox.image, {
		rel:'news_photos',
		title:function() {
			return $(this).closest('li').children('div.title').first().html();
		},
		href:function() {
			return $(this).attr('longdesc');
		}
	}));
	
	/* Enlarge Action Photos */
	$('#content .action_photos img[longdesc]').colorbox($.extend({}, colorbox.config, colorbox.image, colorbox.slideshow, {
		href:function() {
			return $(this).attr('longdesc');
		},
		title:function() {
			return $(this).closest('li').children('div.title').first().html();
		}
	}));
	
	/* Build Slider */
	$('.slider').codaslider();
});
