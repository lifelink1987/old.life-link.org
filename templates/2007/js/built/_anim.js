// JavaScript Document

YAHOO.namespace('ll.anim');

YAHOO.ll.anim.scrollIntoView = function(y) {
	// scroll up
	var currentHeight = YAHOO.util.Dom.getDocumentHeight();
	var scrollY = document.documentElement.scrollTop || document.body.scrollTop;
	var viewPortHeight = YAHOO.util.Dom.getViewportHeight();
	
	if ((scrollY + viewPortHeight == currentHeight) && (y > currentHeight - viewPortHeight)) return;
	var scrollUp = new YAHOO.util.Scroll(YAHOO.Andrei.Dom.getBody(), { scroll: { to: [0, y] } }, 2,
YAHOO.util.Easing.easeOut);
	scrollUp.animate();
};

YAHOO.ll.anim.flashInvalid = function(element) {
	var backAnim = true;
	var oldColor = YAHOO.util.Dom.getStyle(element, 'color');
	var anim = new YAHOO.util.ColorAnim(element, {
		color: {to: '#FF0000'}
	}, 0.5, YAHOO.util.Easing.easeOut);
	anim.onComplete.subscribe(function() {
		if (backAnim)
		{
			anim.attributes = {color: {to: oldColor}};
			anim.animate();
		}
		backAnim = !backAnim;
	});
	anim.animate();
	element = null;
}