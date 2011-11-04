// JavaScript Document

YAHOO.namespace('ll.dialog.info');

YAHOO.util.Event.addListener(window, 'load', function(e) {
	YAHOO.ll.dialog.info.widget = new YAHOO.widget.Dialog('info', {
		width: '400px',
		fixedcenter: true,
		underlay: 'shadow', 
		close: true, 
		draggable: false,
		visible: false,
		modal: true,
		zIndex: 1000
	});
	
	YAHOO.ll.dialog.info.listeners = new YAHOO.util.KeyListener(document, {
		keys: 27
	}, {
		fn: function() {this.cancel();},
		scope: YAHOO.ll.dialog.info.widget,
		correctScope:true
	});
	
	YAHOO.ll.dialog.info.widget.cfg.queueProperty('keylisteners', YAHOO.ll.dialog.info.listeners);
	
	YAHOO.ll.dialog.info.widget.cfg.queueProperty('buttons', [ {
		text: 'OK',
		handler: function() {this.cancel();}
	} ]);
});
