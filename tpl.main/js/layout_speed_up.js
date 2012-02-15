// JavaScript Document

if ((!speed_up && !cookie.read('speed_up')) || speed_up == 'check') {
	startRenderingDate = new Date();
	startRenderingTime = startRenderingDate.getTime() / 1000;
	RenderingTime = 0;
	$(window).load(function() {
		measure_rendering_time();
	});
} else {
	if (speed_up == 'yes' || cookie.read('speed_up') == 'yes') {
		speed_up_rendering_time();
	}
	cookie.del('speed_up');
}

function measure_rendering_time() {
	endRenderingDate = new Date();
	endRenderingTime = endRenderingDate.getTime() / 1000;
	RenderingTime = endRenderingTime - startRenderingTime;
	if (window.console) {
		console.log('Rendering Time: ' + (RenderingTime));
	}
	if (RenderingTime > 5) {
		speed_up_rendering_time();
		cookie.set('speed_up', 'yes');
	} else {
		cookie.set('speed_up', 'no');
	}
}

function speed_up_rendering_time() {
	$('head').append('<link>');
	css = $('head').children(':last');
	css.attr({
		rel:  'stylesheet',
		type: 'text/css',
		href: tpl_uri + '/css/static/speed_up.css'
	});
}