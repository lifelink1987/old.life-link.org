// JavaScript Document

YAHOO.ll.page = YAHOO.util.Dom.get('page-content');
YAHOO.ll.sidebar = YAHOO.util.Dom.get('sidebar-content');

var myLightbox = {};

var previousHeight = 0;
var onRenderEndedInterval;
function onRenderEnded()
{
	var currentHeight = YAHOO.util.Dom.getDocumentHeight();
	if (previousHeight == currentHeight)
	{
		if (currentHeight > 2500)
		{
			YAHOO.util.Dom.setStyle(YAHOO.util.Dom.get('page-footer'), 'backgroundImage', 'none');
		}
		else {
			YAHOO.util.Dom.setStyle(YAHOO.util.Dom.get('page-footer'), 'backgroundImage', '');
		}
		clearInterval(onRenderEndedInterval);
	}
	else {
		previousHeight = currentHeight;
	}
}

YAHOO.util.Event.onDOMReady(function(e) {
	if (YAHOO.ll.debug.active)
	{
		YAHOO.ll.debug.time = new Date().getTime();
	}
												
	YAHOO.ll.event.pageLoad.fire();
	applyRules(pageRules);
	applyRules(sidebarRules, '#sidebar-content ');

	YAHOO.ll.event.pageLoadIndividual.fire();
	applyRules(pageIndividualRulesDefault);
	applyRules(pageIndividualRules);
	if (YAHOO.ll.debug.active)
	{
		YAHOO.ll.debug.eventTime(true);
	}

	pageIndividualRules = {};
	myLightbox = new Lightbox();
	
	var related = YAHOO.util.Dom.get('related');
	if (related)
	{
		var sidebar = YAHOO.util.Dom.get('sidebar-content');
		var relatedTitle = document.createElement('H2');
		relatedTitle.innerHTML = 'Related';
		related.insertBefore(relatedTitle, related.firstChild);
		sidebar.insertBefore(related, sidebar.firstChild);
		YAHOO.util.Dom.addClass(related, 'block');
		sidebar = null;
		relatedTitle = null;
	}
	related = null;
	
	YAHOO.util.Dom.setStyle('custom-doc', 'visibility', 'visible');
	if (YAHOO.ll.debug.active)
	{
		YAHOO.ll.debug.eventTime();
	}
});

function applyRules(rules, prefix) {
	if (!prefix)
	{
		prefix = "#page-content ";
	}
	for (var selector in rules)
	{
		var selectors = selector.split(', ');
		for (var i=0; i<selectors.length; i++) {
			selectors[i] = prefix+selectors[i];
		}
		new_selector = selectors.join(', ');
		
		list = Ext.DomQuery.select(new_selector);
		if (!list) {
			continue;
		}
	
		for (var i=0; element=list[i]; i++) {
			rules[selector](element);
		}
		list = null;
		element = null;
	}
}