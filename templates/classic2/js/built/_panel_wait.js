// JavaScript Document

YAHOO.namespace('ll.panel.wait');

YAHOO.ll.panel.wait.onLoading = 'The page is being loaded. Please stand by...';
YAHOO.ll.panel.wait.onSending = 'Sending information. Please stand by...';

YAHOO.util.Event.onAvailable('wait', function() {
	var oldWait = YAHOO.util.Dom.get('wait');
	oldWait.parentNode.removeChild(oldWait);
	
	YAHOO.ll.panel.wait.widget = new YAHOO.widget.Panel('wait', {
		width: '350px', 
		fixedcenter: true, 
		underlay: 'shadow', 
		close: false, 
		draggable: false, 
		modal: true,
		zIndex: 1000
	});
	YAHOO.ll.panel.wait.widget.setBody('<img src="/templates/classic2/images/leaf.gif"><br>Life-Link Friendship-Schools<br><img src="/templates/classic2/images/loading.gif">');
	YAHOO.ll.panel.wait.widget.setHeader(YAHOO.ll.panel.wait.onLoading);
	YAHOO.ll.panel.wait.widget.render(document.body);
	YAHOO.ll.panel.wait.widget.show();
});

YAHOO.util.Event.addListener(window, 'beforeunload', function(e) {
	YAHOO.ll.panel.wait.widget.show();
});

/*YAHOO.util.Event.addListener(window, 'unload', function(e) {
	YAHOO.ll.panel.wait.widget.show();
});*/