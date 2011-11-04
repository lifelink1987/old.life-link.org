// JavaScript Document

YAHOO.namespace('ll.ajax');
YAHOO.namespace('ll.ajax.history');

YAHOO.ll.ajax.history.loadedJS = new Array();

var browserHistoryClass = Class.create();
browserHistoryClass.prototype = {	
	initialize : function() {		
		//in the constructor below, the 1st argument must match the literal string of the vaiable; 
		//2nd argument should be left blank   
		browserHistory = new historyStack("browserHistory", "");				
		browserHistory.onBrowserAddressChanged = function(){	
			var initialPageContent = YAHOO.util.Dom.get('initialPageContent');
			if (initialPageContent)
			{
				initialPageContent.parentNode.removeChild(initialPageContent);
			}
			YAHOO.ll.ajax.requestPageContent(decodeURIComponent(this.current), true);			
		};
	}
}
/*
YAHOO.util.Event.addListener(window, 'load', function() {
	new browserHistoryClass();
});*/

YAHOO.ll.ajax.getPageContentBodyClass = function(location)
{
	var high_page = location;
	var low_page = location;
	high_page = high_page.replace(/([\D\S]+)\.php(?:.*)/, "$1");
	high_page = high_page.replace('/', '_');
	high_page = high_page.replace(/^(?:_)+(.*)/, "$1");
	if (low_page.match('sub='))
	{
		low_page = '_'+low_page.replace(/(?:.*)sub\=([^&]*)(?:.*)/, "$1");
	}
	else
	{
		low_page = '';
	}
	return high_page+low_page;
}

YAHOO.ll.ajax.getLinkElements = function(text)
{
	var temp = text.split('?');
	var temp2 = new Array('', '');
	if (temp[1])
	{
		temp2 = temp[1].split('#');
		if (temp2[0])
		{
			temp2[0] = '?'+temp2[0];
		}
		else
		{
			temp2[0] = '';
		}
		if (temp2[1])
		{
			temp2[1] = '#'+temp2[1];
		}
		else
		{
			temp2[1] = '';
		}
	}
	temp[0] = temp[0].replace(window.location.protocol+'//'+window.location.host, '');
	if ( !(new RegExp('^/').test(temp[0])) )
	{
		temp[0] = '/' + temp[0];
	}
	return {protocol: window.location.protocol, host: window.location.host, pathname: temp[0], search: temp2[0], hash: temp2[1]};
}

YAHOO.ll.ajax.parseLinks = function() {
	var Rules = {
		'a': function(element) {
			var target = element.getAttribute('target');
			var href = element.getAttribute('href');
			var anchor = new RegExp('^#').test(href);
			var file = new RegExp('(?:jpg|gif|jpeg|bmp|png)$').test(href);
			if ((href) && (!anchor) && (!target) && (!file) && (!element['parsedAlreadyAJAX']))
			{
				element.onclick = function (e) {
					if (!e) {
						e = window.event;
					}
					YAHOO.ll.ajax.requestPageContent(this.getAttribute('href'), true);
					YAHOO.util.Event.stopEvent(e);
				}
				if ((element.parentNode.tagName == 'LI') && (YAHOO.util.Dom.hasClass(element.parentNode, 'yuimenuitem')))
				{
					YAHOO.util.Event.purgeElement(element.parentNode, false, 'click');
					element.parentNode.setAttribute('href', element.getAttribute('href'));
					YAHOO.util.Event.addListener(element.parentNode, 'click', element.onclick);
				}
			}
			element.parsedAlreadyAJAX = true;
		}
	}
	EventSelectors.start(Rules);
}

YAHOO.ll.ajax.requestPageContent = function(href, failureNotification) {
	YAHOO.util.Dom.setStyle('pageContent', 'visibility', 'hidden');
	YAHOO.ll.panel.wait.widget.show();
	var linkElements = YAHOO.ll.ajax.getLinkElements(href);
	var hasAjax = new RegExp('ajax\=1').test(linkElements.search);
	linkElements.searchAjax = linkElements.search;
	if (!hasAjax)
	{
		if (linkElements.search)
		{
			linkElements.searchAjax += '&ajax=1';
		}
		else
		{
			linkElements.searchAjax = '?ajax=1';
		}
	}
	if (failureNotification)
	{
		var callbackFailure = YAHOO.ll.ajax.callbackFailureNotification
	}
	else
	{
		var callbackFailure = YAHOO.ll.ajax.callbackFailure
	}
	var callback = {
		success: YAHOO.ll.ajax.callbackSuccess,
		failure: callbackFailure,
		timeout: 15000,
		argument: {linkElements: linkElements}
	}
	YAHOO.util.Connect.asyncRequest('GET', linkElements.pathname+linkElements.searchAjax, callback);
}

YAHOO.ll.ajax.callbackUpload = function(o) {
	YAHOO.ll.ajax.callbackSuccess(o);
}

YAHOO.ll.ajax.callbackSuccess = function(o) {
	YAHOO.ll.event.pageLoadIndividual.unsubscribeAll();
	YAHOO.ll.event.pageLoadIndividual.subscribe(function() {
		YAHOO.ll.panel.wait.widget.setHeader(YAHOO.ll.panel.wait.onLoading);
	});
	YAHOO.ll.event.pageUnloadIndividual.fire();
	YAHOO.ll.event.pageUnloadIndividual.unsubscribeAll();
	YAHOO.ll.panel.page.widget.setBody(o.responseText);
	
	var Rules = {
		'#pageContent a[name]': function(element) {
			if (!element.getAttribute('name'))
			{
				return;
			}
			var newElement = document.createElement('SPAN');
			newElement.id = element.getAttribute('name').replace('#', '');
			element.parentNode.insertBefore(newElement, element);
			element.parentNode.removeChild(element);
		}
	}
	EventSelectors.start(Rules);
	if (o.argument.linkElements.hash)
	{
		var anchor = o.argument.linkElements.hash;
		anchor = anchor.replace('#', '');
		if (anchor)
		{
			anchor = YAHOO.util.Dom.get(anchor);
			if (anchor && anchor.scrollIntoView)
			{
				anchor.scrollIntoView();
			}
		}
	}
	else
	{
		var pageContainer = YAHOO.util.Dom.get('pageContainer');
		pageContainer.scrollTop = 0;
	}
	var currentLocation = o.argument.linkElements.pathname+o.argument.linkElements.search;
	var newClass = YAHOO.ll.ajax.getPageContentBodyClass(currentLocation);
	if ((o.argument['method']) && (o.argument.method != 'GET'))
	{
		var randomId = document.createElement('div');
		YAHOO.util.Dom.generateId(randomId);
		currentLocation = o.argument.linkElements.pathname+'?'+randomId.id;
		randomId = null;
	}
	browserHistory.put(currentLocation);
	YAHOO.util.Dom.get('pageContentBody').className = newClass;
	var scriptElements = YAHOO.util.Dom.getElementsBy(function(element) {
		return (element.getAttribute('type') == 'text/javascript');
	}, 'DIV', 'pageContent');
	if (scriptElements.length)
	{
		for (var i = 0; i < scriptElements.length; i++)
		{
			var scriptElement = scriptElements[i];
			var newScript = document.createElement('SCRIPT');
			newScript.setAttribute('src', scriptElement.getAttribute('src'));
			newScript.setAttribute('type', scriptElement.getAttribute('type'));
			YAHOO.util.Dom.generateId(newScript);
			YAHOO.ll.ajax.history.loadedJS[YAHOO.ll.ajax.history.loadedJS.length] = newScript.id;
			newScript.data = scriptElement.data;
			if (Andrei.Browser.isMSIE())
			{
				newScript.onreadystatechange = function ()
				{
					if (newScript.readyState == 'loaded')
					{
						YAHOO.ll.event.pageLoad.fire();
						newScript.onreadystatechange = null;
					}
				}
			}
			else
			{
				newScript.onload = function() {YAHOO.ll.event.pageLoad.fire();}
			}
			scriptElement.parentNode.removeChild(scriptElement);
			var head = document.getElementsByTagName("head")[0];
			head.appendChild(newScript);
			YAHOO.ll.event.pageUnloadIndividual.subscribe(function (type, args) {
				for (var i = 0; i < YAHOO.ll.ajax.history.loadedJS.length; i++)
				{
					var scriptElement = YAHOO.util.Dom.get(YAHOO.ll.ajax.history.loadedJS[i]);
					scriptElement.parentNode.removeChild(scriptElement);
				}
			});
			//var pageContentBody = YAHOO.util.Dom.get('pageContentBody');
			//pageContentBody.appendChild(newScript);
		}
	}
	else
	{
		YAHOO.ll.event.pageLoad.fire();
	}
} 

YAHOO.ll.ajax.callbackFailure = function(o) {
	YAHOO.util.Dom.setStyle('pageContent', 'visibility', 'visible');
	YAHOO.ll.panel.wait.widget.hide();
}

YAHOO.ll.ajax.callbackFailureNotification = function(o) {
	YAHOO.ll.ajax.callbackFailure(o);
	with (o.argument.linkElements)
	{
		var link = protocol+'//'+host+pathname+search;
	}
	with (YAHOO.ll.dialog.info.widget)
	{
		setBody('There was an error getting the content of the page!<br><b>Please try again</b><br><br>'+link+'<br>'+o.status+' : '+o.statusText);
		render();
		show();
	}
}

YAHOO.util.Event.addListener(window, 'load', function(e) {
	YAHOO.ll.ajax.parseLinks();
});

YAHOO.ll.event.pageLoad.subscribe(function (type, args) {
	YAHOO.ll.ajax.parseLinks();
});

/* History Management */
YAHOO.namespace('ll.ajax.history');

YAHOO.ll.ajax.history.list = new Array();
YAHOO.ll.ajax.history.current = -1;

YAHOO.ll.ajax.history.attrFilter = function(element) {
	var tagNames = new Array('SELECT', 'INPUT', 'TEXTAREA');
	for (var i = 0; i < tagNames.length; i++)
	{
		if (element.tagName = tagNames[i])
		{
			return true;
		}
	}
	return false;
}

YAHOO.ll.ajax.history.summarizeObject = function(element, attributes) {
	var object = {};
	for (var i in attributes)
	{
		eval('object.'+attributes[i]) = eval('element.'+attributes[i]);
	}
	return object;
}

YAHOO.ll.ajax.history.updateHistory = function() {
	var length = YAHOO.ll.ajax.history.list.length;
	var result = {};
	result.location = {pathname: window.location.pathname, search: window.location.search, hash: window.location.hash};
	var elements = YAHOO.util.Dom.getElementsBy(YAHOO.ll.ajax.history.attrFilter, null, 'pageContent');
	for (var i in elements)
	{
		var element = {};
		if (elements[i].tagName == 'SELECT')
		{
			elementAttr = new Array('disabled', 'type');
			element = YAHOO.ll.ajax.history.summarizeObject(elements[i], elementAttr);
			elementAttr = new Array('text', 'value', 'selected');
			element.options = new Array();
			for (var j in elements[i].options)
			{
				element.options[element.options.length] = YAHOO.ll.ajax.history.summarizeObject(elements[i].options[j], elementAttr);
			}
			eval('results.'+elements[i].id) = element;
		}
		else if (elements[i].tagName == 'INPUT')
		{
			elementAttr = new Array('value');
			element = YAHOO.ll.ajax.history.summarizeObject(elements[i], elementAttr);
			eval('results.'+elements[i].id) = element;
		}
		else if (elements[i].tagName == 'TEXTAREA')
		{
			elementAttr = new Array('innerHtml');
			element = YAHOO.ll.ajax.history.summarizeObject(elements[i], elementAttr);
			eval('results.'+elements[i].id) = element;
		}
	}
}