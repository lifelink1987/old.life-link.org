// JavaScript Document

$(function(){
	if (window.location.search) {
		window.location.hash = '#results';
	}
	
	$('select[name=type]').change(function() {
		$this = $(this);
		if ($this.val() == 'school') {
			$('#form-placeholder1').html('with Reports');
		} else if ($this.val() == 'report') {
			$('#form-placeholder1').html('&nbsp;');
		}
	});
	
	/* More Results */
	$('#more_results_more').live('click', function(){
		var search = window.location.search ? window.location.search : '?';
		var skip = 'ajax=true&skip=' + more_results_from;
		$('#more_results_loading').removeClass('secret');
		$('#more_results_heading').hide();
		
		$.get(window.location.pathname + search + ((window.location.search.length < 2) ? skip : '&' + skip), function(data) {
			$('#more_results_loading').addClass('secret');
			$('#more_results').append('<div id="more_results_' + more_results_from + '"></div>');
			var $container = $('#more_results_' + more_results_from);
			$container.append(data);
			if (more_results_from) {
				$('#more_results_heading').show();
			}

			$container.find('.img_center img').imgCenter();
			
			$container.find('a[title],div[title],span[title]').tipTip({maxWidth:'400px'});
			
			$container.find('.row_report img[longdesc]').colorbox($.extend({}, colorbox.config, colorbox.image, colorbox.slideshow, {
				href:function() {
					return $(this).prop('longdesc') || $(this).prop('longDesc');
				},
				title:function() {
					return $(this).closest('div.row_report').children('div.title').first().html();
				}
			}));
		});
		return false;
	});
});