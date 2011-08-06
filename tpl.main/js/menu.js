// JavaScript Document

$(function() {
	/**
	 * the menu
	 */
	var $menu = $('#ldd_menu');

	/**
	 * for each list element, we show the submenu when hovering and expand the
	 * span element (title) to 510px
	 */
	$menu.children('li').each(function() {
		var $this = $(this);
		var $span = $this.children('span');
		$span.data('width', $span.width());
		$span.data('outerWidth', $span.outerWidth());

		var $submenu = $this.children('.ldd_submenu');
		if ($submenu.length == 0)
			return;
		$submenu.data('width', $submenu.width());

		$this.bind('mouseenter', function() {
			$menu.find('.ldd_submenu').stop(true, true).hide();
			$submenu = $this.find('.ldd_submenu');
			$width = 420;
			if ($submenu.first().hasClass('ldd_submenu_columns2')) {
				$width -= 150;
			}
			if ($submenu.first().hasClass('ldd_submenu_columns1')) {
				$width -= 150 * 2;
			}
			if ($width < parseInt($span.data('width'))) {
				$width = parseInt($span.data('width'));
				$submenu.css('width', parseInt($span.data('outerWidth')));
			}
			$span.stop().animate( {
				'width': $width + 'px'
			}, 'fast', function() {
				$submenu.first().fadeIn(500);
			});
		}).bind('mouseleave', function() {
			$this.find('.ldd_submenu').stop(true, true).hide();
			$span.stop().animate( {
				'width': $span.data('width') + 'px'
			}, 'fast');
			$submenu.css('width', $submenu.data('width'));
		});
	});
});