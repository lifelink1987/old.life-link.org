// JavaScript Document

YAHOO.namespace('ll');
YAHOO.namespace('ll.event');
YAHOO.namespace('ll.debug');
YAHOO.ll.debug.active = lldebug;

YAHOO.ll.event.pageLoad = new YAHOO.util.CustomEvent('Page Content is ready for parsing');
YAHOO.ll.event.pageLoadIndividual = new YAHOO.util.CustomEvent('Run tasks for the specific Page Content being loaded');
YAHOO.ll.event.pageUnloadIndividual = new YAHOO.util.CustomEvent('Run tasks for the specific Page Content being unloaded');

var pageRules = {};
var sidebarRules = {};
var pageIndividualRules = {};
var pageIndividualRulesDefault = {};
var genericBorder = null;

YAHOO.ll.debug.eventTime = function(individual) {
	if (individual)
	{
		var Tstart = YAHOO.ll.debug.timeIndividual;
		YAHOO.ll.debug.timeIndividualStop = new Date().getTime();
		var Tstop = YAHOO.ll.debug.timeIndividualStop;
		var timeElement = YAHOO.util.Dom.get('debug-individual-time');
	}
	else {
		var Tstart = YAHOO.ll.debug.time;
		YAHOO.ll.debug.timeStop = new Date().getTime();
		var Tstop = YAHOO.ll.debug.timeStop;
		var timeElement = YAHOO.util.Dom.get('debug-time');
	}
	if (timeElement)
	{
		timeElement.innerHTML = ((Tstop - Tstart) / 1000.0) + 's';
		timeElement = null;
	}
};

YAHOO.ll.event.pageLoad.subscribe(function (type, args) {
	YAHOO.ll.event.pageUnloadIndividual.fire();
	YAHOO.ll.event.pageUnloadIndividual = new YAHOO.util.CustomEvent('Run tasks for the specific Page Content being unloaded');
	pageRules = {};
	
	var scrollFunc = function(element) {
		var firstItem = element.parentNode.id + '-item-1';
		var currentItem = element.parentNode.id + '-item-' + (parseInt(element.getAttribute('rel'), 10)+1);
		var nextItem = element.parentNode.id + '-item-' + (parseInt(element.getAttribute('rel'), 10)+2);
		
		currentItem = YAHOO.util.Dom.get(currentItem);
		YAHOO.util.Dom.setStyle(currentItem, 'display', 'none');
		var sibling = YAHOO.Andrei.Dom.nextRealSibling(currentItem);
		if ((sibling) && (sibling.tagName.toUpperCase() == 'DD'))
		{
			YAHOO.util.Dom.setStyle(sibling, 'display', 'none');
		}
		currentItem = null;
		sibling = null
		counter = parseInt(element.getAttribute('rel'), 10)+1;
		if (!(nextItem = YAHOO.util.Dom.get(nextItem)))
		{
			nextItem = YAHOO.util.Dom.get(firstItem);
			counter = 0;
		}
		YAHOO.util.Dom.setStyle(nextItem, 'display', 'block');
		var sibling = YAHOO.Andrei.Dom.nextRealSibling(nextItem);
		if ((sibling) && (sibling.tagName.toUpperCase() == 'DD'))
		{
			YAHOO.util.Dom.setStyle(sibling, 'display', 'block');
		}
		element.setAttribute('rel', counter);
		nextItem = null;
		sibling = null;
		element = null;
	}
	
	var Rules = {
		'dl.scroll': function(element) {
			var counter = 0;
			for (var i=0; i<element.childNodes.length; i++)
			{
				var scrollItem = element.childNodes[i];
				if ((scrollItem.tagName) && (scrollItem.tagName.toUpperCase() == 'DT'))
				{
					counter++;
					scrollItem.id = element.parentNode.id + '-item-' + counter;
				}
			}
			var scrollItem = null;
			setInterval(scrollFunc, parseInt(element.getAttribute('rel')), element);
			element.setAttribute('rel', 0);
			element = null;
		}
	};
	Object.extend(sidebarRules, Rules);
});

YAHOO.ll.event.pageLoadIndividual.subscribe(function (type, args) {
	if (YAHOO.ll.debug.active)
	{
		YAHOO.ll.debug.timeIndividual = new Date().getTime();
	}
	pageIndividualRules = {};
	onRenderEndedInterval = setInterval(onRenderEnded, 1000);
});

YAHOO.ll.event.pageLoad.subscribe(function (type, args) {
	var Rules0 = {
		// lightbox
		'div > a': function(element) {
			var relAttribute = element.getAttribute('rel');
			if (relAttribute)
			{
				if (relAttribute.match('lightbox'))
				{
					YAHOO.util.Event.addListener(element, 'click', function(e) {
						var element = YAHOO.util.Event.getTarget(e);
						myLightbox.start(element);
						YAHOO.util.Event.stopEvent(e);
						element = null;
					});
				}
			}
			element = null;
		},
		
		// summary
		'div.summary': function(element) {
			if (element.scrollHeight > element.offsetHeight)
			{
				element.title = 'This is an excerpt! DOUBLE-CLICK on the text TO READ IT ALL!';
			}
			YAHOO.util.Event.addListener(element, 'dblclick', function(e) {
				var element = YAHOO.util.Event.getTarget(e);
				if (YAHOO.util.Dom.getStyle(element, 'overflow') == 'auto')
				{
					YAHOO.util.Dom.setStyle(element, 'overflow', 'hidden');
					element.title = 'This is an excerpt! DOUBLE-CLICK on the text TO READ IT ALL!';
				}
				else {
					YAHOO.util.Dom.setStyle(element, 'overflow', 'auto');
					element.title = 'Double-click again to show just the excerpt!';
				}
				element = null;
			});
		},
		
		//toggle elements
		'div.toggler': function(element) {
			YAHOO.util.Event.addListener(element.id+'-activator', 'click', function(e) {
				var element = YAHOO.util.Event.getTarget(e);
				var childId = element.id.replace('-activator', '');
				var onceId = element.id + '-once';
				if (YAHOO.util.Dom.hasClass(element, 'Tshow'))
				{
					YAHOO.util.Dom.removeClass(childId, 'hidden');
					if (YAHOO.util.Dom.hasClass(element, 'Toggle'))
					{
						YAHOO.util.Dom.replaceClass(element, 'Tshow', 'Thide');
					}
				}
				if (YAHOO.util.Dom.hasClass(element, 'Thide'))
				{
					YAHOO.util.Dom.addClass(childId, 'hidden');
					if (YAHOO.util.Dom.hasClass(element, 'Toggle'))
					{
						YAHOO.util.Dom.replaceClass(element, 'Thide', 'Tshow');
					}
				}
				if (YAHOO.util.Dom.hasClass(element, 'Tonce'))
				{
					var once = YAHOO.util.Dom.get(onceId);
					if (once)
					{
						once.parentNode.removeChild(once);
					}
					else {
						element.parentNode.removeChild(element);
					}
					once = null;
				}
				YAHOO.util.Event.stopEvent(e);
				element = null;
			});
		}
	};
	
	var Rules1 = {
		// section links
		'div.sectionlinks': function(element) {
			YAHOO.util.Dom.generateId(element);
			var newButton = document.createElement('BUTTON');
			newButton.setAttribute('type', 'button');
			newButton.innerHTML = 'Related';
			newButton.menuId = element.id;
			YAHOO.util.Dom.generateId(newButton);
			element.parentNode.insertBefore(newButton, element);
			YAHOO.util.Event.addListener(newButton, 'click', function(e) {
				var element = YAHOO.util.Event.getTarget(e);
				if (!element.menuRendered)
				{
					element.menu = new YAHOO.widget.Menu(element.menuId, {
						zIndex: 500,
						lazyLoad: true,
						hidedelay: 250
					});
					element.menu.render();
					YAHOO.util.Dom.setX(element.menuId, YAHOO.util.Dom.getX(element) + element.offsetWidth - YAHOO.util.Dom.get(element.menuId).offsetWidth);
					YAHOO.util.Dom.setY(element.menuId, YAHOO.util.Dom.getY(element));
					element.menuRendered = true;
				}
				element.menu.show();
				YAHOO.util.Event.stopEvent(e);
				element = null;
			});
			newButton = null;
			element = null;
		}
	};
	
	// SHADED BORDERS
	if (lltemplatelevel == 0)
	{
		genericBorder = RUZEE.ShadedBorder.create({ corner:4, border:1 });
		var RuleSB = {
			// shaded borders
			'div.sb': function(element) {
				YAHOO.util.Dom.setStyle(element, 'padding', '5px');
				genericBorder.render(element, true);
			}
		};
	}
	else {
		genericBorder = RUZEE.ShadedBorder.create({ corner:4, shadow:10, border:1 });
		var RuleSB = {
			// shaded borders
			'div.sb': function(element) {
				YAHOO.util.Dom.setStyle(element, 'padding', '10px');
				genericBorder.render(element, true);
			}
		};
	}

	Object.extend(pageIndividualRulesDefault, Rules0);
	Object.extend(pageIndividualRulesDefault, RuleSB);
	if (lltemplatelevel > 0)
	{
		Object.extend(pageIndividualRulesDefault, Rules1);
	}
	
	// IMG PNG for IE
	var ua = navigator.userAgent.toLowerCase();
	var isIE = ua.indexOf("msie") > -1;
	var isIE7 = ua.indexOf("msie 7") > -1;

	if ((!isIE) || ((isIE) && (isIE7))) return;
	var RuleIEpng = {
		// PNG fix
		'img.png': function(element) {
			var oldHeight = element.offsetHeight;
			var oldWidth = element.offsetWidth;
			YAHOO.util.Dom.setStyle(element, 'filter', "progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'" + element.src + "\', sizingMethod='scale')");
			YAHOO.util.Dom.setStyle(element, 'height', oldHeight + 'px');
			YAHOO.util.Dom.setStyle(element, 'width', oldWidth + 'px');
			element.src = "/templates/2007//images/spacer.gif";
		}
	};
	Object.extend(pageIndividualRulesDefault, RuleIEpng);
});