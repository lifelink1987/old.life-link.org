// JavaScript Document

$(function(){
	if (window.location.search) {
		window.location.hash = '#results';
	}
	
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
			$('#more_results_from').html(more_results_from);
			if (more_results_from) {
				$('#more_results_heading').show();
			}
			
			$container.find('a[title],div[title],span[title]').tipTip({maxWidth:'400px'});
		});
		return false;
	});
});