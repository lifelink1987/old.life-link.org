// JavaScript Document

YAHOO.ll.event.pageLoad.subscribe(function (type, args) {
	var Rules = {
		// input fields management; forms
		'#pageContent input[type=checkbox]': function(element) {
			YAHOO.util.Dom.addClass(element, 'checkbox');
		},
		'#pageContent input[type=radio]': function(element) {
			YAHOO.util.Dom.addClass(element, 'radio');
			YAHOO.util.Event.addListener(element, 'focus', function(e) {
				var element = YAHOO.util.Event.getTarget(e);
				var parentFormElement = element;
				while ((parentFormElement.tagName == 'FORM') || (parentFormElement.tagName == 'FIELDSET'))
				{
					parentFormElement.setAttribute('radio_' + element.getAttribute('name'), element.id);
				}
			});
		},
		'#pageContent form select, #pageContent form input[type=radio], #pageContent form input[type=submit], #pageContent form button, #pageContent form input[type=checkbox], #pageContent form input[type=text], #pageContent form input[type=file], #pageContent form textarea': function(element) {
			if (element.getAttribute('for'))
			{
				YAHOO.util.Event.addListener(element, 'focus', function(e) {
					var element = YAHOO.util.Event.getTarget(e);
					var forElement;
					while (element.getAttribute('for'))
					{
						forElement = YAHOO.util.Dom.get(element.getAttribute('for'));
						forElement.checked = true;
						element = forElement;
					}
				});
			}
		},
		'#pageContent select, #pageContent input[type=text], #pageContent input[type=file], #pageContent textarea': function(element) {
			YAHOO.util.Event.addListener(element, 'focus', function(e) {
				var element = YAHOO.util.Event.getTarget(e);
				YAHOO.util.Dom.addClass(element, 'focus');
			});
			YAHOO.util.Event.addListener(element, 'blur', function(e) {
				var element = YAHOO.util.Event.getTarget(e);
				YAHOO.util.Dom.removeClass(element, 'focus');
			});
		},
		'#pageContent select.compulsory, #pageContent input.compulsory[type=text], #pageContent textarea.compulsory': function(element) {
			var compulsoryImg = document.createElement('SPAN');
			YAHOO.util.Dom.generateId(compulsoryImg);
			element.compulsoryId = compulsoryImg.id;
			compulsoryImg.innerHTML = '<img src="/templates/classic2/icons/stop.gif" align="absmiddle" style="margin: 0; margin-right: 3px">';
			YAHOO.util.Dom.setStyle(compulsoryImg, 'position', 'absolute');
			YAHOO.util.Dom.setStyle(compulsoryImg, 'padding-top', '0.1em');
			element.parentNode.insertBefore(compulsoryImg, element);
			YAHOO.util.Event.addListener(element, 'change', function(e) {
				var element = YAHOO.util.Event.getTarget(e);
				var compulsoryImg = YAHOO.util.Dom.get(element.compulsoryId);
				YAHOO.util.Dom.setStyle(compulsoryImg, 'visibility', 'visible');
				if (element.value == '')
				{
					compulsoryImg.innerHTML = '<img src="/templates/classic2/icons/stop.gif" align="absmiddle" style="margin: 0; margin-right: 3px">';
				}
				else
				{
					compulsoryImg.innerHTML = '<img src="/templates/classic2/icons/accept.gif" align="absmiddle" style="margin: 0; margin-right: 3px">';
				}
			});
		},
		'#pageContent select, #pageContent input, #pageContent label, #pageContent textarea, #pageContent button': function(element) {
			if (!element.getAttribute('id'))
			{
				element.setAttribute('id', element.getAttribute('name'));
			}
		},
		
		// form submition
		'#pageContent form button[type=submit], #pageContent form input[type=submit]': function(element) {
			/*var styleOpera;
			var parentE = element.parentNode;
			var new_element = document.createElement('A');
			new_element.className = "LL_button";
			new_element.href = "#";
			if (Andrei.Browser.isOPERA())
			{
				styleOpera = ' style="display: inline"';
			}
			new_element.innerHTML = '<table cellspacing="0" cellpadding="0"' + styleOpera + '><tr><td><img src="/templates/classic2/buttons/bar1_left.gif"></td><td class="link"><a href="#" onclick="javascript:$(\'' + element.form.id + '\').submit(); return false;">' + element.value + '</a></td><td><img src="/templates/classic2/buttons/bar1_right.gif"></td></tr></table>';
			parentE.replaceChild(new_element, element);*/
			var form = YAHOO.util.Dom.get(element.form.id);
			YAHOO.util.Event.addListener(form, 'submit', function(e) {
				YAHOO.ll.panel.wait.widget.setHeader(YAHOO.ll.panel.wait.onSending);
				YAHOO.ll.panel.wait.widget.show();
				var element = YAHOO.util.Event.getTarget(e);
				YAHOO.util.Connect.setForm(element, YAHOO.util.Dom.hasClass(element, 'upload'));
				var linkElements = element.getAttribute('action');
				if (element.getAttribute('method').toUpperCase() == 'GET')
				{
					var anchor;
					if (element.getAttribute('anchor'))
					{
						anchor = '#'+element.getAttribute('anchor');
					}
					linkElements += '?'+YAHOO.util.Connect._sFormData+anchor;
				}
				linkElements = YAHOO.ll.ajax.getLinkElements(linkElements);
				var callback = {
					success: YAHOO.ll.ajax.callbackSuccess,
					upload: YAHOO.ll.ajax.callbackUpload,
					failure: YAHOO.ll.ajax.callbackFailureNotification,
					argument: {linkElements: linkElements, method: element.getAttribute('method').toUpperCase()}
				}
				if (!YAHOO.util.Dom.hasClass(element, 'upload'))
				{
					callback.timeout = 30000;
				}
				var ajaxField = document.createElement('INPUT');
				ajaxField.setAttribute('type', 'hidden');
				ajaxField.setAttribute('name', 'ajax');
				ajaxField.setAttribute('value', '1');
				element.appendChild(ajaxField);
				YAHOO.util.Connect.setForm(element, YAHOO.util.Dom.hasClass(element, 'upload'));
				YAHOO.util.Connect.asyncRequest(element.getAttribute('method').toUpperCase(), element.getAttribute('action'), callback);
				YAHOO.util.Event.preventDefault(e); 
			});
		}
	};
	EventSelectors.start(Rules);
});