// JavaScript Document

YAHOO.namespace('ll.wait');

YAHOO.ll.event.pageLoad.subscribe(function (type, args) {
	YAHOO.ll.wait.widget = new YAHOO.widget.Panel('wait', {
		width: '350px',
		fixedcenter: true,
		underlay: 'shadow',
		draggable: false,
		close: false,
		modal: true,
		zIndex: 1000
	});
	YAHOO.ll.wait.widget.setBody('<{$tpl.images.loading}>');
	YAHOO.ll.wait.widget.showMaskEvent.subscribe(fixMask, YAHOO.ll.wait.widget, true);
	YAHOO.ll.wait.widget.hideEvent.subscribe(fixHide, YAHOO.ll.wait.widget, true);
});