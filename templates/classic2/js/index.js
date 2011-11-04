// JavaScript Document

YAHOO.namespace('ll.page.index');

YAHOO.ll.page.index.infoVisible = 1; // toggle variable for showing info or not
YAHOO.ll.page.index.infoToggleDisabled = 0; // toggle variable for temporarily disabling the Effect while the mouse is in the area
YAHOO.ll.page.index.infoFadeInEffect;
YAHOO.ll.page.index.infoFadeOutEffect;
YAHOO.ll.page.index.indexInfoOnMouseOver;
YAHOO.ll.page.index.indexInfoBehindOnMouseOver;
YAHOO.ll.page.index.indexInfoBehindOnMouseOut;
YAHOO.ll.page.index.timeout;
YAHOO.ll.page.index.startTimeout;

YAHOO.ll.page.index.startTimeout = function ()
{
	YAHOO.ll.page.index.timeout = window.setTimeout("YAHOO.ll.page.index.infoToggle();", 5 *1000);
}

YAHOO.ll.page.index.infoToggle = function ()
{
	with (YAHOO.ll.page.index)
	{
		if (infoToggleDisabled)
		{
			startTimeout();
			return;
		}
		if (infoVisible)
		{
			if (infoFadeInEffect.isAnimated())
			{
				infoFadeInEffect.stop();
			}
			infoFadeOutEffect.animate();
		} else {
			if (infoFadeOutEffect.isAnimated())
			{
				infoFadeOutEffect.stop();
			}
			infoFadeInEffect.animate();
		}
	}
}

YAHOO.ll.event.pageLoadIndividual.subscribe(function (type, args) {
	with (YAHOO.ll.page.index)
	{
		infoFadeInEffect = new YAHOO.util.Anim('indexInfo', {opacity: {to: 1.0}}, 2, YAHOO.util.Easing.easeBothStrong);
		infoFadeInEffect.onStart.subscribe(function() {
			window.clearTimeout(YAHOO.ll.page.index.timeout);
			YAHOO.util.Dom.setStyle('indexInfo', 'display', 'block');
			YAHOO.ll.page.index.infoVisible = 1;
		});
		infoFadeInEffect.onComplete.subscribe(function() {
			YAHOO.ll.page.index.startTimeout();
		});
		infoFadeOutEffect = new YAHOO.util.Anim('indexInfo', {opacity: {to: 0.0}}, 2, YAHOO.util.Easing.easeBothStrong);
		infoFadeOutEffect.onStart.subscribe(function() {
			window.clearTimeout(YAHOO.ll.page.index.timeout);
		});
		infoFadeOutEffect.onComplete.subscribe(function() {
			YAHOO.util.Dom.setStyle('indexInfo', 'display', 'none');
			YAHOO.ll.page.index.infoVisible = 0;
			YAHOO.ll.page.index.startTimeout();
		});
		/*
		indexInfoOnMouseOver = function() {
			with (YAHOO.ll.page.index)
			{
				if ((!infoVisible) || (infoFadeInEffect.isAnimated()))
				{
					infoFadeInEffect.stop();
				}
				infoFadeOutEffect.animate();
			}
		}*/
		
		indexOnMouseOver = function() {
			YAHOO.ll.page.index.infoToggleDisabled = 1;
		}
		
		indexOnMouseOut = function() {
			YAHOO.ll.page.index.infoToggleDisabled = 0;
		}
	}
	
	YAHOO.util.Event.addListener('indexInfo', 'mouseover', indexOnMouseOver, YAHOO.ll.page.index);
	YAHOO.util.Event.addListener('indexInfo', 'mouseout', indexOnMouseOut, YAHOO.ll.page.index);
	YAHOO.util.Event.addListener('indexInfoBehind', 'mouseover', indexOnMouseOver, YAHOO.ll.page.index);
	YAHOO.util.Event.addListener('indexInfoBehind', 'mouseout', indexOnMouseOut, YAHOO.ll.page.index);

	YAHOO.ll.page.index.startTimeout();
});

YAHOO.ll.event.pageUnloadIndividual.subscribe(function (type, args) {
	YAHOO.util.Event.removeListener('indexInfo', 'mouseover', indexOnMouseOver, YAHOO.ll.page.index);
	YAHOO.util.Event.removeListener('indexInfo', 'mouseout', indexOnMouseOut, YAHOO.ll.page.index);
	YAHOO.util.Event.removeListener('indexInfoBehind', 'mouseover', indexOnMouseOver, YAHOO.ll.page.index);
	YAHOO.util.Event.removeListener('indexInfoBehind', 'mouseout', indexOnMouseOut, YAHOO.ll.page.index);
	
	window.clearTimeout(YAHOO.ll.page.index.timeout);
});
