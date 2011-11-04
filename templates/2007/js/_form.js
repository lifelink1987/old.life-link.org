// JavaScript Document

YAHOO.ll.getLinkElements = function(text)
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

YAHOO.Andrei.field.parseSubDependencies = function(element, forceEnable) {
	if (!element.subDependencies) return;
	var subs = element.subDependencies.split(', ');
	for (var i=0; i<subs.length; i++)
	{
		var temp = subs[i].split(' ');
		var subElementId = temp[0];
		var subElementOptions = temp[1];
		var subElement = YAHOO.util.Dom.get(subElementId);

		var disable = !YAHOO.Andrei.field.dependenciesOK(subElement);
		if ((disable) && (!forceEnable))
		{
			if (subElementOptions.indexOf('required') != -1)
			{
				YAHOO.util.Dom.removeClass(subElement, 'required');
			}
			subElement.disabled = true;
		}
		else {
			subElement.disabled = false;
			if (subElementOptions.indexOf('required') != -1)
			{
				YAHOO.util.Dom.addClass(subElement, 'required');
			}
		}
	}
	subElement = null;
	subs = null;
	temp = null;
	element = null;
}

YAHOO.ll.event.pageLoad.subscribe(function (type, args) {
	var Rules = {
		// ajax paging
		'ul#paging-header a, ul#paging-footer a': function(element) {
			YAHOO.util.Event.addListener(element, 'click', function (e) {
				var element = YAHOO.util.Event.getTarget(e);
				YAHOO.ll.wait.widget.targetElement = 'results';
				YAHOO.ll.wait.widget.render();
				YAHOO.ll.wait.widget.show();
				var linkElements = YAHOO.ll.getLinkElements(element.getAttribute('href'));
				if (linkElements.search)
				{
					linkElements.search += '&ajax=1';
				}
				else
				{
					linkElements.search = '?ajax=1';
				}
				var callback = {
					success: function(o) {
						var results;
						results = YAHOO.util.Dom.get('results');
						results.innerHTML = o.responseText;
						YAHOO.ll.event.pageLoadIndividual.fire();
						applyRules(pageIndividualRulesDefault, "#results ");
						applyRules(pageIndividualRules, "#results ");
						if (YAHOO.ll.debug.active)
						{
							YAHOO.ll.debug.eventTime(true);
						}

						pageIndividualRules = {};
						YAHOO.ll.wait.widget.hide();
						
						var scrollUpMargin;
						if (YAHOO.util.Dom.getY('filters'))
						{
							scrollUpMargin = Math.min(YAHOO.util.Dom.getY('filters'), YAHOO.util.Dom.getY('results'));
						}
						else {
							scrollUpMargin = YAHOO.util.Dom.getY('results');
						}
						YAHOO.ll.anim.scrollIntoView(scrollUpMargin);
						results = null;
					},
					failure: function(o) {
						YAHOO.ll.wait.widget.hide();
						alert('It was not possible to load the requested page. Please try again!');
					}
				}
				YAHOO.util.Connect.asyncRequest('GET', linkElements.pathname+linkElements.search, callback);
				YAHOO.util.Event.stopEvent(e);
				element = null;
			});
		},
		
		// give IDs to fields, ajax validation, tooltip creation
		'form': function(element) {
			element.requiredCheck = function() {
				var element = this;
				for (var i=0; i<element.elements.length; i++)
				{
					var formElement = element.elements[i];
					if ((YAHOO.util.Dom.hasClass(formElement, 'required')) && (!formElement.value))
					{
						alert('Please fill in required fields!');
						setTimeout(function() {formElement.focus(); formElement = null;}, 0);
						element = null;
						return false;
					}
				}
				formElement = null;
				element = null;
				return true;
			};
			for (var i=0; i<element.elements.length; i++)
			{
				var formElement = element.elements[i];
				var formElementRel = formElement.getAttribute('rel');
				
				if (YAHOO.util.Dom.hasClass(element, 'major'))
				{
					YAHOO.util.Event.addListener(formElement, 'focus', function(e) {
						var element = YAHOO.util.Event.getTarget(e);
						YAHOO.util.Dom.addClass(element, 'focus');
						element = null;
					});
					YAHOO.util.Event.addListener(formElement, 'blur', function(e) {
						var element = YAHOO.util.Event.getTarget(e);
						YAHOO.util.Dom.removeClass(element, 'focus');
						element = null;
					});
				}

				// check element's required fields
				if (formElementRel)
				{
					var requiredElements = formElementRel.split(', ');
					for (var j = 0; j<requiredElements.length; j++)
					{
						var temp = requiredElements[j].split(' ');
						var requiredElementId = temp[0];
						var requiredElementOptions = null;
						if (temp.length == 2)
						{
							requiredElementOptions = temp[1];
						}
						var requiredElement = YAHOO.util.Dom.get(requiredElementId);
						if (requiredElement.subDependencies)
						{
							requiredElement.subDependencies += ', ' + formElement.id + ' ' + requiredElementOptions;
						}
						else {
							requiredElement.subDependencies = formElement.id + ' ' + requiredElementOptions;
						}
						YAHOO.util.Event.addListener(requiredElement, 'focus', function(e) {
							var element = YAHOO.util.Event.getTarget(e);
							YAHOO.Andrei.field.parseSubDependencies(element, true);
						});
						YAHOO.util.Event.addListener(requiredElement, 'blur', function(e) {
							var element = YAHOO.util.Event.getTarget(e);
							YAHOO.Andrei.field.parseSubDependencies(element);
						});
						requiredElement = null;
						requiredElementId = null;
						requiredElementOptions = null;
					}
					if (formElement.value == '')
					{
						formElement.disabled = true;
					}
					requiredElements = null;
				}
				
				// javascript validation
				if (formElement.tagName.toUpperCase() == 'SELECT')
				{
					if (YAHOO.util.Dom.hasClass(formElement, 'timespan'))
					{
						YAHOO.util.Event.addListener(formElement, 'change', formElement.form.timespanCheck, formElement.form, true);
					}
					else if (YAHOO.util.Dom.hasClass(formElement, 'list_city'))
					{
						YAHOO.util.Event.addListener(element.id+'-list_country', 'change', function(e) {
							var element = YAHOO.util.Event.getTarget(e);

							if ((element.cityAJAX) && (YAHOO.util.Connect.isCallInProgress(element.cityAJAX)))
							{
								YAHOO.util.Connect.abort(element.cityAJAX);
							}
							
							var cityElement = YAHOO.util.Dom.get(element.form.id+'-list_city');
							cityElement.options.length = 0;
							
							if (element.value == '')
							{
								cityElement.options[cityElement.options.length] = new Option('all of the cities', '');
								cityElement.disabled = false;
								element = null;
								cityElement = null;
								return;
							}
							cityElement.options[cityElement.options.length] = new Option('Loading', '');
							cityElement.disabled = true;

							var callback = {
								success: function(o) {
									var cityElement = YAHOO.util.Dom.get(o.argument.cityElement);
									cityElement.disabled = false;
									var jsonResult = o.responseText.parseJSON().output.results;
									cityElement.options.length = 0;
									cityElement.options[cityElement.options.length] = new Option('all of the cities', '');
									for (var i=0; i<jsonResult.length; i++)
									{
										cityElement.options[cityElement.options.length] = new Option(jsonResult[i].name, jsonResult[i].name);
									}
									cityElement = null;
								},
								failure: function(o) {
									var cityElement = YAHOO.util.Dom.get(o.argument.cityElement);
									var countryElement = YAHOO.util.Dom.get(o.argument.countryElement);
									cityElement.options.length = 0;
									cityElement.options[cityElement.options.length] = new Option('Error. Re-Loading', '');
									countryElement.cityAJAX = YAHOO.util.Connect.asyncRequest('GET', './autocomplete.php?function=cities_bycountry&country='+countryElement.value, callback);
									cityElement = null;
									countryElement = null;
								},
								argument: {'countryElement': element.id, 'cityElement': element.form.id+'-list_city'}
							};
							element.cityAJAX = YAHOO.util.Connect.asyncRequest('GET', './autocomplete.php?function=cities_bycountry&country='+element.value, callback);
							element = null;
							cityElement = null;
						});
					}
				}
				
				if (formElement.tagName.toUpperCase() == 'TEXTAREA')
				{
					YAHOO.util.Event.addListener(formElement, 'blur', function(e) {
						var element = YAHOO.util.Event.getTarget(e);
						element.value = element.value.triminside();
						element.value = element.value.trim();
						element = null;
					});
					if (YAHOO.util.Dom.hasClass(formElement, 'limitation'))
					{
						YAHOO.util.Event.addListener(formElement, 'keypress', function(e) {
							var element = YAHOO.util.Event.getTarget(e);
							if (element.value.length >= 500)
							{
								element.helpShow(e);
							}
							element = null;
						});
						YAHOO.util.Event.addListener(formElement, 'keyup', function(e) {
							var element = YAHOO.util.Event.getTarget(e);
							var infoElement = YAHOO.util.Dom.get(element.id + '-limitation');
							if (infoElement)
							{
								infoElement.innerHTML = 500-element.value.length;
								infoElement = null;
							}
							element = null;
						});
						YAHOO.util.Event.addListener(formElement, 'blur', function(e) {
							var element = YAHOO.util.Event.getTarget(e);
							if (element.value.length >= 500)
							{
								element.value = element.value.substr(0, 500);
								alert('We only kept the first 500 characters of your text!');
							}
							var infoElement = YAHOO.util.Dom.get(element.id + '-limitation');
							if (infoElement)
							{
								infoElement.innerHTML = 500-element.value.length;
								infoElement = null;
							}
							element = null;
						});
					}
				}
				
				if (formElement.tagName.toUpperCase() == 'INPUT')
				{
					var formElementType = formElement.getAttribute('type');
					if (formElementType == 'text')
					{
						YAHOO.util.Event.addListener(formElement, 'blur', function(e) {
							var element = YAHOO.util.Event.getTarget(e);
							element.value = element.value.triminside();
							element.value = element.value.trim();
							element = null;
						});
						if (YAHOO.util.Dom.hasClass(formElement, 'calendar'))
						{
							YAHOO.Andrei.field.regexp(formElement, YAHOO.Andrei.regexpChar.date);
							
							var calendarContainer = document.createElement('DIV');
							calendarContainer.id = formElement.id + '-calcontainer';
							calendarContainer.hoveredCalendar = false;
							YAHOO.util.Dom.get('results').appendChild(calendarContainer);
							YAHOO.util.Dom.setStyle(calendarContainer, 'position', 'absolute');
							YAHOO.util.Dom.setX(calendarContainer, YAHOO.util.Dom.getX(formElement));
							YAHOO.util.Dom.setY(calendarContainer, YAHOO.util.Dom.getY(formElement) + formElement.offsetHeight);
							YAHOO.util.Dom.setStyle(calendarContainer, 'display', 'none');
							
							formElement.widget = new YAHOO.widget.Calendar(formElement.id + '-calendar', calendarContainer.id, {
								DATE_FIELD_DELIMITER: '-',
								MDY_DAY_POSITION: 3,
								MDY_MONTH_POSITION: 2,
								MDY_YEAR_POSITION: 1,
								START_WEEKDAY: 1
							});
							YAHOO.util.Event.addListener(formElement, "focus", formElement.widget.show, formElement.widget, true);
							YAHOO.util.Event.addListener(formElement, "blur", function(e) {
								var element = YAHOO.util.Event.getTarget(e);
								if ((!YAHOO.Andrei.regexp.date.test(element.value)) && (element.value != ''))
								{
									YAHOO.Andrei.field.invalid(element, e);
								}
								else {
/*									var dates = element.value.split('-');
									dates = new Array(parseInt(dates[0], 10), parseInt(dates[1], 10), parseInt(dates[2], 10));
									element.widget.select(dates);
*/
/*									if (YAHOO.util.Dom.get(element.id+'-calcontainer').hoveredCalendar) return;
*/									if (YAHOO.util.Dom.getStyle(element.widget.oDomContainer, 'display') == 'none') return;
									setTimeout(function() {element.widget.hide(); element = null;}, 100);
								}
							}, formElement.widget, true);
							
/*							formElement.widget.renderEvent.subscribe(function(type,args,obj) {
								YAHOO.util.Event.addListener(obj.id, 'mouseover', function(e) {
									var element = YAHOO.util.Event.getTarget(e);
									element.hoveredCalendar = true;
									element = null;
								});
								YAHOO.util.Event.addListener(obj.id, 'mouseout', function(e) {
									var element = YAHOO.util.Event.getTarget(e);
									setTimeout(function() {element.hoveredCalendar = false; element = null;}, 2000);
								});
							}, formElement.widget.oDomContainer, true);
*/							
							formElement.widget.selectEvent.subscribe(function(type,args,obj) {
								var dates = args[0];
								var date = dates[0];
								var year = date[0], month = date[1], day = date[2];
								if (month < 10)
								{
									month = '0' + month;
								}
								if (day < 10)
								{
									day = '0' + day;
								}
								obj.value = year + '-' + month + '-' + day;
								obj.widget.hide();
							}, formElement, true);
							formElement.widget.render();
							calendarContainer = null;
						}
						else if (YAHOO.util.Dom.hasClass(formElement, 'letters'))
						{
							YAHOO.Andrei.field.regexp(formElement, YAHOO.Andrei.regexpChar.letters);
						}
						else if (YAHOO.util.Dom.hasClass(formElement, 'captcha'))
						{
							YAHOO.Andrei.field.regexp(formElement, YAHOO.Andrei.regexpChar.letters);
							var newButton = document.createElement('BUTTON');
							newButton.setAttribute('type', 'button');
							newButton.innerHTML = "Unreadable letters? Refresh signature!";
							newButton.captchaId = formElement.id;
							newButton.captchaSrc = '<{$tpl.links.captcha}>';
							YAHOO.util.Event.addListener(newButton, 'click', function(e) {
								var element = YAHOO.util.Event.getTarget(e);
								YAHOO.util.Dom.get(element.captchaId).value = '';
								var temp = new Date();
								YAHOO.util.Dom.get(element.captchaId + '-image').src = element.captchaSrc + '?' + temp.getYear() + temp.getMonth() + temp.getDate() + temp.getHours() + temp.getMinutes() + temp.getSeconds();
							});
							var captchaImage = YAHOO.util.Dom.get(formElement.id + '-image');
							captchaImage.parentNode.insertBefore(newButton, captchaImage);
							captchaImage.parentNode.insertBefore(captchaImage, newButton);
							newButton = null;
							captchaImage = null;
						}
						else if (YAHOO.util.Dom.hasClass(formElement, 'city'))
						{
							var formElementAC = YAHOO.util.Dom.get(formElement.id + '-autocomplete');
							YAHOO.util.Dom.setX(formElementAC, YAHOO.util.Dom.getX(formElement));
							YAHOO.util.Dom.setY(formElementAC, YAHOO.util.Dom.getY(formElement) + formElement.offsetHeight);
							YAHOO.util.Dom.setStyle(formElementAC, 'width', formElement.offsetWidth + 'px');
							formElement.dataSource = new YAHOO.widget.DS_XHR('./autocomplete.php', ['output.results', 'name']);
							formElement.widget = new YAHOO.widget.AutoComplete(formElement.id, formElementAC.id, formElement.dataSource, {
								queryDelay: 1,
								minQueryLength: 0,
								maxResultsDisplayed: 100,
								animVert: false,
								animHoriz: false,
								autoHighlight: false
							});
							formElement.widget.formatResult = function(aResultItem, sQuery) {
								return aResultItem[0];
							}
							formElement.dataSource.scriptQueryParam = 'city';
							formElement.dataSource.scriptQueryAppend  = 'function=cities_bycountry&country=' + YAHOO.util.Dom.get(element.id + '-country').value;
							YAHOO.util.Event.addListener(element.id + '-country', 'change', function(e) {
								var element = YAHOO.util.Event.getTarget(e);
								var formElement = YAHOO.util.Dom.get(element.form.id + '-city');
								formElement.dataSource.scriptQueryAppend  = 'function=cities_bycountry&country=' + element.value;
								element = null;
								formElement = null;
							});
							formElementAC = null;
						}
						else if (YAHOO.util.Dom.hasClass(formElement, 'membername'))
						{
							var formElementAC = YAHOO.util.Dom.get(formElement.id + '-autocomplete');
							YAHOO.util.Dom.setX(formElementAC, YAHOO.util.Dom.getX(formElement));
							YAHOO.util.Dom.setY(formElementAC, YAHOO.util.Dom.getY(formElement) + formElement.offsetHeight);
							YAHOO.util.Dom.setStyle(formElementAC, 'width', formElement.offsetWidth + 'px');
							formElement.dataSource = new YAHOO.widget.DS_XHR('./autocomplete.php', ['output.results', 'name', 'city', 'countryname', 'schoolnumber']);
							formElement.widget = new YAHOO.widget.AutoComplete(formElement.id, formElementAC.id, formElement.dataSource, {
								queryDelay: 1,
								minQueryLength: 3,
								maxResultsDisplayed: 100,
								animVert: false,
								animHoriz: false,
								autoHighlight: false
							});
							formElement.widget.formatResult = function(aResultItem, sQuery) {
								return '[' + aResultItem[3] + '] <b>' + aResultItem[0] + '</b> (' + aResultItem[2] + ', ' + aResultItem[1] + ')';
							}
							formElement.dataSource.scriptQueryParam = 'namelike';
							formElement.dataSource.scriptQueryAppend  = 'function=members_byname';
							if (formElementAC.getAttribute('rel'))
							{
								formElementAC.itemSelectRedirect = function(type, args) {
									var redirection = args[0]._oContainer.getAttribute('rel') + args[2][3];
									args[0]._oTextbox.disabled = true;
									location = redirection;
								}
								formElement.widget.itemSelectEvent.subscribe(formElementAC.itemSelectRedirect);
							}
							formElementAC = null;
						}
						else if (YAHOO.util.Dom.hasClass(formElement, 'numbers'))
						{
							YAHOO.Andrei.field.regexp(formElement, YAHOO.Andrei.regexpChar.numbers);
						}
						else if (YAHOO.util.Dom.hasClass(formElement, 'number-range'))
						{
							YAHOO.Andrei.field.regexp(formElement, YAHOO.Andrei.regexpChar.numberRange);
							YAHOO.util.Event.addListener(formElement, 'blur', function(e) {
								var element = YAHOO.util.Event.getTarget(e);
								var regexp = /^\d{1,2}(?:\-\d{1,2})?$/;
								if ((!regexp.test(element.value)) && (element.value != ''))
								{
									YAHOO.Andrei.field.invalid(element, e);
								}
							});
						}
						else if (YAHOO.util.Dom.hasClass(formElement, 'zipcode'))
						{
							YAHOO.Andrei.field.regexp(formElement, YAHOO.Andrei.regexpChar.zipcode);
						}
						else if ((YAHOO.util.Dom.hasClass(formElement, 'name')) || (YAHOO.util.Dom.hasClass(formElement, 'names')))
						{
							if (YAHOO.util.Dom.hasClass(formElement, 'name'))
							{
								YAHOO.Andrei.field.regexp(formElement, YAHOO.Andrei.regexpChar.name);
							}
							else {
								YAHOO.Andrei.field.regexp(formElement, YAHOO.Andrei.regexpChar.names);
							}
							YAHOO.util.Event.addListener(formElement, 'blur', function(e) {
								var element = YAHOO.util.Event.getTarget(e);
								element.value = element.value.capitalize();
								if ((!YAHOO.Andrei.regexp.name.test(element.value)) && (element.value != ''))
								{
									YAHOO.Andrei.field.invalid(element, e);
								}
							});
						}
						else if ((YAHOO.util.Dom.hasClass(formElement, 'email')) || (YAHOO.util.Dom.hasClass(formElement, 'emails')))
						{
							if (YAHOO.util.Dom.hasClass(formElement, 'email'))
							{
								YAHOO.Andrei.field.regexp(formElement, YAHOO.Andrei.regexpChar.email);
							}
							else {
								YAHOO.Andrei.field.regexp(formElement, YAHOO.Andrei.regexpChar.emails);
							}
							YAHOO.util.Event.addListener(formElement, 'blur', function(e) {
								var element = YAHOO.util.Event.getTarget(e);
								element.value = element.value.toLowerCase();
								if ((!YAHOO.Andrei.regexp.email.test(element.value)) && (element.value != ''))
								{
									YAHOO.Andrei.field.invalid(element, e);
								}
							});
						}
						else if (YAHOO.util.Dom.hasClass(formElement, 'website'))
						{
							YAHOO.Andrei.field.regexp(formElement, YAHOO.Andrei.regexpChar.website);
							YAHOO.util.Event.addListener(formElement, 'blur', function(e) {
								var element = YAHOO.util.Event.getTarget(e);
								element.value = element.value.toLowerCase();
								if ((!YAHOO.Andrei.regexp.website.test(element.value)) && (element.value != ''))
								{
									YAHOO.Andrei.field.invalid(element, e);
								}
							});
						}
						else if (YAHOO.util.Dom.hasClass(formElement, 'zipcode'))
						{
							YAHOO.util.Event.addListener(formElement, 'blur', function(e) {
								var element = YAHOO.util.Event.getTarget(e);
								element.value = element.value.toUpperCase();
								element = null;
							});
						}
						else if ((YAHOO.util.Dom.hasClass(formElement, 'phone')) || (YAHOO.util.Dom.hasClass(formElement, 'phones')))
						{
							if (YAHOO.util.Dom.hasClass(formElement, 'phone'))
							{
								YAHOO.Andrei.field.regexp(formElement, YAHOO.Andrei.regexpChar.phone);
							}
							else {
								YAHOO.Andrei.field.regexp(formElement, YAHOO.Andrei.regexpChar.phones);
							}
							YAHOO.util.Event.addListener(formElement, 'blur', function(e) {
								var element = YAHOO.util.Event.getTarget(e);
								if ((!YAHOO.Andrei.regexp.phone.test(element.value)) && (element.value != ''))
								{
									YAHOO.Andrei.field.invalid(element, e);
								}
							});
						}
					}
					else if (formElementType == 'file')
					{
						if (YAHOO.util.Dom.hasClass(formElement, 'jpeg'))
						{
							YAHOO.util.Event.addListener(formElement, 'change', function(e) {
								var element = YAHOO.util.Event.getTarget(e);
								if ((!YAHOO.Andrei.regexp.jpeg.test(element.value)) && (element.value != ''))
								{
									alert("Your file doesn't look to be a JPEG image file.");
									element.value = '';
								}
							});
						}
					}
				}
				
				// tooltip
				var help = YAHOO.util.Dom.get(formElement.id+'-help');
				if (help)
				{
					formElement.help = new YAHOO.widget.Overlay(help.id, {
						context: [formElement, 'bl', 'tl'],
						width: formElement.offsetWidth+'px',
						effect: {effect:YAHOO.widget.ContainerEffect.FADE, duration:0.5},
						zIndex: 1000,
						visible: false
					});
					formElement.help.render();
					YAHOO.util.Dom.setStyle(formElement.help.element, 'visibility', 'hidden');
					YAHOO.util.Dom.setStyle(formElement.help.element, 'display', 'block');
					var functionShow = function(e) {
						var delay = 1000;
						var element = YAHOO.util.Event.getTarget(e);
						if (element.helpTimeout)
						{
							clearTimeout(element.helpTimeout);
						}
						if (e.type == 'keypress')
						{
							delay = 0;
						}
						element.helpTimeout = setTimeout(function() {
							element.help.align('bl', 'tl');
							element.help.show();
							element.helpTimeout = setTimeout(function() {
								element.help.hide();
								element = null;
							}, 10000);
						}, delay);
					};
					var functionHide = function(e) {
						var element = YAHOO.util.Event.getTarget(e);
						if (element.helpTimeout)
						{
							clearTimeout(element.helpTimeout);
						}
						element.help.hide();
						element = null;
					};
					if (YAHOO.util.Dom.hasClass(formElement, 'ondemandhelp'))
					{
						formElement.helpShow = functionShow;
					}
					else {
						YAHOO.util.Event.addListener(formElement, 'focus', functionShow);
						YAHOO.util.Event.addListener(formElement, 'click', functionShow);
						YAHOO.util.Event.addListener(formElement, 'keypress', functionShow);
					}
					YAHOO.util.Event.addListener(formElement, 'blur', functionHide);
					YAHOO.util.Event.addListener(formElement, 'mouseout', functionHide);
				}
				help = null;
			}
		},
		
/*		// ajax file upload
		'div#form-upload-container': function(element) {
			var container = document.createElement('DIV');
			element.parentNode.replaceChild(container, element);
			
			var uploadButton = document.createElement('BUTTON');
			uploadButton.innerHTML = 'Add';
			uploadButton.id = 'form-upload-button';
			uploadButton.setAttribute('tabindex', 59);
			container.appendChild(uploadButton);
			
			var uploadForm = document.createElement('FORM');
			uploadForm.id = 'form-upload';
			uploadForm.setAttribute('method', 'post');
			uploadForm.setAttribute('enctype', 'multipart/form-data');
			uploadForm.setAttribute('action', '<{$tpl.links.upload}>');
			if (YAHOO.util.Dom.get('form-upload-counter'))
			{
				uploadForm.counter = YAHOO.util.Dom.get('form-upload-counter').value;
			}
			YAHOO.util.Dom.get('page-content').appendChild(uploadForm);
			
			var uploadUnique = document.createElement('INPUT');
			uploadUnique.setAttribute('type', 'hidden');
			uploadUnique.setAttribute('name', 'unique');
			uploadUnique.setAttribute('value', YAHOO.util.Dom.get('form-upload-unique').value);
			uploadForm.appendChild(uploadUnique);
			
			if (YAHOO.util.Dom.get('form-upload-type'))
			{
				var uploadType = document.createElement('INPUT');
				uploadType.setAttribute('type', 'hidden');
				uploadType.setAttribute('name', 'type');
				uploadType.setAttribute('value', YAHOO.util.Dom.get('form-upload-type').value);
				uploadForm.appendChild(uploadType);
				YAHOO.util.Dom.get('form-upload-type').parentNode.removeChild(YAHOO.util.Dom.get('form-upload-type'));
			}
			
			var uploadInput = document.createElement('INPUT');
			uploadInput.id = 'form-upload-file';
			uploadInput.setAttribute('type', 'file');
			uploadInput.setAttribute('name', 'document');
			YAHOO.util.Dom.setStyle(uploadInput, 'zIndex', '2');
			YAHOO.util.Dom.setStyle(uploadInput, 'opacity', '0');
			YAHOO.util.Dom.setStyle(uploadInput, 'position', 'absolute');
			uploadForm.appendChild(uploadInput);
			YAHOO.util.Event.addListener(uploadInput, 'change', function(e) {
				var element = YAHOO.util.Event.getTarget(e);
				if (!element.value) return;
				if (!YAHOO.util.Dom.get('form-upload-unique').form.requiredCheck())
				{
					YAHOO.util.Event.stopEvent(e);
					return;
				}
				if (YAHOO.util.Dom.get('form-upload-button').counter == element.form.counter)
				{
					alert('You have reached the maximum number of files to be uploaded!');
					YAHOO.util.Event.stopEvent(e);
					return;
				}
				YAHOO.util.Dom.get('form-upload-button').counter++;
				YAHOO.ll.wait.widget.targetElement = 'results';
				YAHOO.ll.wait.widget.render();
				YAHOO.ll.wait.widget.show();
				var callback = {
					upload: function(o) {
						YAHOO.ll.wait.widget.hide();
						var jsonResult = o.responseText.parseJSON();
						if (jsonResult.message)
						{
							alert(jsonResult.message);
						}
						else {
							var container = document.createElement('DIV');
							var results = YAHOO.util.Dom.get('form-upload-results');
							
							if (results.hasChildNodes())
							{
								results.insertBefore(container, results.firstChild);
							}
							else
							{
								results.appendChild(container);
							}
							
							var deleteButton = document.createElement('BUTTON');
							deleteButton.innerHTML = 'Delete';
							deleteButton.setAttribute('tabindex', 59 + YAHOO.util.Dom.get('form-upload-button').counter);
							YAHOO.util.Event.addListener(deleteButton, 'click', function(e) {
								var element = YAHOO.util.Event.getTarget(e);
								YAHOO.util.Dom.get('form-upload-button').counter--;
								YAHOO.util.Connect.asyncRequest('GET', '<{$tpl.links.upload}>?delete=1&name=' + jsonResult.html.name + '&unique=' + jsonResult.html.unique, null);
								element.parentNode.parentNode.removeChild(element.parentNode);
								element = null;
							});
							container.appendChild(deleteButton);
							var text = document.createTextNode(' ' + jsonResult.html.name);
							container.appendChild(text);
							container = null;
							results = null;
							deleteButton = null;
							text = null;
						}
					}
				}
				YAHOO.util.Connect.setForm(element.form, true);
				YAHOO.util.Connect.asyncRequest(element.form.getAttribute('method').toUpperCase(), element.form.getAttribute('action'), callback);
				element.value = '';
				element = null;
			});
			
			var uploadResults = document.createElement('BLOCKQUOTE');
			uploadResults.id = 'form-upload-results';
			container.appendChild(uploadResults);
			
			var uploadResultsMessage = document.createElement('DIV');
			uploadResultsMessage.id = 'form-upload-results-message';
			uploadResults.appendChild(uploadResultsMessage);
			
			YAHOO.util.Dom.setX(uploadInput, YAHOO.util.Dom.getX(uploadButton) - uploadInput.offsetWidth + uploadButton.offsetWidth);
			YAHOO.util.Dom.setY(uploadInput, YAHOO.util.Dom.getY(uploadButton));
			YAHOO.util.Dom.setStyle(uploadInput, 'clip', 'rect(auto, auto, auto, ' + (uploadInput.offsetWidth - uploadButton.offsetWidth) + 'px)');
			
			container = null;
			uploadButton = null;
			uploadForm = null;
			uploadUnique = null;
			uploadType = null;
			uploadInput = null;
			uploadResults = null;
			uploadResultsMessage = null;
		},
*/		
		// ajax form submition
		'form button[type=submit]': function(element) {
			var form = YAHOO.util.Dom.get(element.form.id);
			if (YAHOO.util.Dom.get(form.id + '-ajax')) return;
			YAHOO.util.Event.addListener(form, 'submit', function(e) {
				var element = YAHOO.util.Event.getTarget(e);
				if (!element.requiredCheck())
				{
					YAHOO.util.Event.stopEvent(e);
					return false;
				}
				if (!YAHOO.util.Dom.hasClass(element.id + '-submit', 'ajax')) return true;
				YAHOO.ll.wait.widget.targetElement = 'results';
				YAHOO.ll.wait.widget.render();
				YAHOO.ll.wait.widget.show();
				var callback = {
					success: function(o) {
						var results = YAHOO.util.Dom.get('results');
						//alert('bhtml' + YAHOO.util.Dom.getDocumentHeight());
						results.innerHTML = o.responseText;
						//alert('ahtml' + YAHOO.util.Dom.getDocumentHeight());
						YAHOO.ll.event.pageLoadIndividual.fire();
						applyRules(pageIndividualRulesDefault, "#results ");
						applyRules(pageIndividualRules, "#results ");
						if (YAHOO.ll.debug.active)
						{
							YAHOO.ll.debug.eventTime(true);
						}

						pageIndividualRules = {};
						YAHOO.ll.wait.widget.hide();
						
						// scroll up
						var scrollUpMargin;
						if (YAHOO.util.Dom.getY('filters'))
						{
							scrollUpMargin = Math.min(YAHOO.util.Dom.getY('filters'), YAHOO.util.Dom.getY('results'));
						}
						else {
							scrollUpMargin = YAHOO.util.Dom.getY('results');
						}
						var scrollUp = new YAHOO.util.Scroll(YAHOO.Andrei.Dom.getBody(), { scroll: { to: [0, scrollUpMargin] } }, 1,
YAHOO.util.Easing.easeOut);
						scrollUp.animate();
						results = null;
						scrollUp = null;
					},
					failure: function(o) {
						alert('It was not possible to send/receive the requested information. Please try again!');
						YAHOO.ll.wait.widget.hide();
					}
				}
				callback.upload = callback.success;
				YAHOO.util.Connect.setForm(element, YAHOO.util.Dom.hasClass(element, 'upload'));
				YAHOO.util.Connect.asyncRequest(element.getAttribute('method').toUpperCase(), element.getAttribute('action'), callback);
				YAHOO.util.Event.preventDefault(e);
				element = null;
			});
			if (!YAHOO.util.Dom.hasClass(element, 'ajax')) return;
			var ajaxField = document.createElement('INPUT');
			ajaxField.setAttribute('type', 'hidden');
			ajaxField.setAttribute('name', 'ajax');
			ajaxField.setAttribute('value', '1');
			ajaxField.id = form.id + '-ajax';
			form.appendChild(ajaxField);
			form = null;
			ajaxField = null;
		}
	};
	Object.extend(pageIndividualRulesDefault, Rules);
});