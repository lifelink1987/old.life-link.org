// JavaScript Document

$(function(){
	$('#content .row_report img[longdesc]').colorbox($.extend({}, colorbox.config, colorbox.image, colorbox.slideshow, {
		href:function() {
			return $(this).attr('longdesc');
		},
		title:function() {
			return $(this).closest('div.row_report').children('div.title').first().html();
		}
	}));
});