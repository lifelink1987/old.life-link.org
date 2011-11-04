// JavaScript Document

with (YAHOO.widget.MenuModuleItem.prototype)
{
	SUBMENU_INDICATOR_IMAGE_PATH = SELECTED_SUBMENU_INDICATOR_IMAGE_PATH; //make it white;
}

YAHOO.namespace('ll.panel.page');
YAHOO.namespace('ll.panel.footer');

YAHOO.ll.body = YAHOO.util.Dom.get('bodyContent');

YAHOO.util.Event.addListener(window, 'load', function(e) {

	/*var temp = new YAHOO.widget.LogReader();
	temp.show();*/

	YAHOO.ll.panel.page.widget = new YAHOO.widget.Panel('pageContainer', {
		width: '770px',
		height: YAHOO.util.Dom.getViewportHeight()-100-50+'px',
		x: Math.round((YAHOO.util.Dom.getViewportWidth()-770)/2),
		y: 100+50,
		underlay: 'none',
		close: false,
		draggable: false,
		constraintoviewport: true,
		modal: false
	});
	YAHOO.ll.panel.page.widget.render(YAHOO.ll.body);
	YAHOO.ll.panel.page.widget.show();
	
	YAHOO.util.Event.addListener(window, 'resize', function(e) {
		if (Andrei.Browser.isMSIE())
		{
			return;
		}
		with (YAHOO.ll.panel.page.widget)
		{
			cfg.setProperty('x', Math.round((YAHOO.util.Dom.getViewportWidth()-770)/2));
			cfg.setProperty('height', YAHOO.util.Dom.getViewportHeight()-100-50-5+'px');
		}
	});

	YAHOO.util.Dom.setStyle('bodyContent', 'visibility', 'visible');
	
	var initialPageContent = YAHOO.util.Dom.get('initialPageContent');
	if (initialPageContent)
	{
		var pageContent = YAHOO.util.Dom.get('pageContent');
		pageContent.appendChild(initialPageContent);
		var newClass = YAHOO.ll.ajax.getPageContentBodyClass(window.location.pathname+window.location.search);
		YAHOO.util.Dom.addClass('pageContentBody', newClass);		
		YAHOO.ll.event.pageLoad.fire();
		YAHOO.util.Dom.setStyle('initialPageContent', 'display', 'block');
	}
	new browserHistoryClass();
});

var pageRules = {};
var pageInitFunction;
var suggestPause = 2000;