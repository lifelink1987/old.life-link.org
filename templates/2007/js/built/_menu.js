// JavaScript Document

with (YAHOO.widget.MenuBarItem.prototype)
{
	//switch black and white
	SUBMENU_INDICATOR_IMAGE_PATH = "menuarodwn8_hov_1.gif";
	SELECTED_SUBMENU_INDICATOR_IMAGE_PATH = "menuarodwn8_nrm_1.gif";
}

YAHOO.namespace('ll.menu');

YAHOO.ll.event.pageLoad.subscribe(function (type, args) {
	with (YAHOO.ll.menu)
	{
		widget = new YAHOO.widget.MenuBar('menu', {
			autosubmenudisplay: true,
			showdelay: 0,
			hidedelay: 250,
			lazyLoad: (lltemplatelevel < 1),
			zindex: 50
		});
		widget.render();
		widget.show();
	}
});