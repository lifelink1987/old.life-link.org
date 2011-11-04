// JavaScript Document

YAHOO.namespace('ll.dialog.summary');

YAHOO.util.Event.addListener(window, 'load', function(e) {
	YAHOO.ll.dialog.summary.widget = new YAHOO.widget.Dialog('summary', {
		underlay: 'shadow',
		close: true,
		fixedcenter: true,
		draggable: false,
		visible: false,
		modal: true,
		zIndex: 1000
	});
	YAHOO.ll.dialog.summary.widget.render();
	
	YAHOO.ll.dialog.summary.tooltip = 'This is a summary. Double click to view full text!';
	
	YAHOO.ll.dialog.summary.listeners = new YAHOO.util.KeyListener(document, {
		keys: 27
	}, {
		fn: function() {this.cancel();},
		scope: YAHOO.ll.dialog.summary.widget,
		correctScope:true
	});
	
	YAHOO.ll.dialog.summary.widget.cfg.queueProperty('keylisteners', YAHOO.ll.dialog.summary.listeners);
	
	YAHOO.ll.dialog.summary.widget.cfg.queueProperty('buttons', [ {
		text: 'Close',
		handler: function() {this.cancel();}
	} ]);
});

YAHOO.ll.event.pageLoad.subscribe(function() {
	var Rules = {
		'#pageContent .summary': function(element) {
			YAHOO.util.Event.addListener(element, 'mouseover', function(e) {
				var element = YAHOO.util.Event.getTarget(e);
				if (element['parsedAlready'])
				{
					return;
				}
				element.title = YAHOO.ll.dialog.summary.tooltip;
				if (element.scrollHeight <= element.offsetHeight)
				{
					YAHOO.util.Dom.setStyle(element, 'cursor', 'default');
					element.title = '';
				} else {
					YAHOO.util.Event.addListener(element, 'dblclick', function(e) {
						var element = YAHOO.util.Event.getTarget(e);
						new YAHOO.widget.Tooltip('tooltip', {context: element});
						YAHOO.ll.dialog.summary.widget.setBody(element.innerHTML);
						with (YAHOO.ll.dialog.summary.widget)
						{
							cfg.setProperty('xy', YAHOO.ll.panel.page.widget.cfg.getProperty('xy'));
							cfg.setProperty('width', YAHOO.ll.panel.page.widget.cfg.getProperty('width'));
							cfg.setProperty('height', YAHOO.ll.panel.page.widget.cfg.getProperty('height'));
							show();
						}
						YAHOO.util.Event.stopEvent(e);
					});
				}
				element.parsedAlready = true;
			});
		}
	}
	EventSelectors.start(Rules);
});