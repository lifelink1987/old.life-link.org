// JavaScript Document

YAHOO.namespace('ll.menu.main');

YAHOO.util.Event.addListener(window, 'load', function(e) {
	with (YAHOO.ll.menu.main)
	{
		widget = new YAHOO.widget.MenuBar('mainmenu', {
			autosubmenudisplay: true,
			showdelay: 250,
			hidedelay: 250
		});
		widget.render();
		function onMainMenuKeyDown(p_oEvent) {
			if(p_oEvent.keyCode == 27) {
				YAHOO.util.Event.stopPropagation(p_oEvent);
			}
		}
		YAHOO.util.Event.addListener(widget.element, "keydown", onMainMenuKeyDown);
		widget.show();
	}
	var Rules = {
		'#mainmenu a': function(element) {
			if (element.getAttribute('title'))
			{
				new YAHOO.widget.Tooltip('tooltip', {context: element, showdelay: 500});
			}
		}
	}
	EventSelectors.start(Rules);
});
