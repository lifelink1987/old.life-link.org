// JavaScript Document

YAHOO.namespace('ll.event');

YAHOO.ll.event.pageLoad = new YAHOO.util.CustomEvent('Page Content is ready for parsing');
YAHOO.ll.event.pageLoadIndividual = new YAHOO.util.CustomEvent('Run tasks for the specific Page Content being loaded');
YAHOO.ll.event.pageUnloadIndividual = new YAHOO.util.CustomEvent('Run tasks for the specific Page Content being unloaded');

YAHOO.ll.event.pageLoad.subscribe(function (type, args) {
	Nifty('div.llround', '');
	Nifty('div.llroundt', 'top');
	Nifty('div.llroundb', 'bottom');
	Nifty('div.llroundl', 'left');
	Nifty('div.llroundr', 'right');
});

YAHOO.ll.event.pageLoad.subscribe(function (type, args) {
	var Rules = {
		// link management
		'#pageContent a': function(element) {
			if (element.title)
			{
				element.title = element.title+'<br>';
			}
			var listLink = (element.parentNode.tagName == 'LI');
			var exceptionListLink = listLink && (!YAHOO.util.Dom.hasClass(element.parentNode.parentNode, 'llbulletpagenext'));
			exceptionListLink = exceptionListLink && (!YAHOO.util.Dom.hasClass(element.parentNode, 'yuimenuitem'));
			exceptionListLink = exceptionListLink && (!YAHOO.util.Dom.hasClass(element.parentNode.parentNode, 'llheaderh'));
			exceptionListLink = exceptionListLink && (!YAHOO.util.Dom.hasClass(element.parentNode.parentNode, 'llfooterh'));
			exceptionListLink = exceptionListLink && (!YAHOO.util.Dom.hasClass(element.parentNode.parentNode, 'llheaderv'));
			exceptionListLink = exceptionListLink && (!YAHOO.util.Dom.hasClass(element.parentNode.parentNode, 'llfooterv'));
			exceptionListLink = exceptionListLink && (!YAHOO.util.Dom.hasClass(element.parentNode.parentNode, 'llheaderhsub'));
			exceptionListLink = exceptionListLink && (!YAHOO.util.Dom.hasClass(element.parentNode.parentNode, 'llfooterhsub'));
			if ((!YAHOO.util.Dom.hasClass(element, 'llbutton')) && (!listLink || exceptionListLink) && (!element.getAttribute('name')))
			{
				var icon = element.getAttribute('icon');
				var icon2;
				if ((icon == 'doc') || (icon == 'word') || ((/\.doc$/.test(element.getAttribute('href'))) && (!icon)))
				{
					icon2 = '<img src="/templates/classic2/icons/page_white_word.gif" align="absmiddle" style="margin: 0; margin-right: 3px">';
					element.title += "Word Document.<br>";
					element.setAttribute('target', '_blank');
				}
				else if ((icon == 'xls') || (icon == 'excel') || ((/\.xls$/.test(element.getAttribute('href'))) && (!icon)))
				{
					icon2 = '<img src="/templates/classic2/icons/page_white_excel.gif" align="absmiddle" style="margin: 0; margin-right: 3px">';
					element.title += "Excel Document.<br>";
					element.setAttribute('target', '_blank');
				}
				else if ((icon == 'ppt') || (icon == 'pps') || (icon == 'powerpoint') || ((/\.ppt$/.test(element.getAttribute('href'))) && (!icon)))
				{
					icon2 = '<img src="/templates/classic2/icons/page_white_powerpoint.gif" align="absmiddle" style="margin: 0; margin-right: 3px">';
					element.title += "Powerpoint Presentation.<br>";
					element.setAttribute('target', '_blank');
				}
				else if (icon == 'file')
				{
					icon2 = '<img src="/templates/classic2/icons/page_white_go.gif" align="absmiddle" style="margin: 0; margin-right: 3px">';
					element.setAttribute('target', '_blank');
				}
				else if ((icon == 'pdf') || (icon == 'acrobat') || ((/\.pdf$/.test(element.getAttribute('href'))) && (!icon)))
				{
					icon2 = '<img src="/templates/classic2/icons/page_white_acrobat.gif" align="absmiddle" style="margin: 0; margin-right: 3px">';
					element.title += "PDF Document.<br>";
					element.setAttribute('target', '_blank');
				}
				else if ((icon == 'mail') || ((/^mailto/.test(element.getAttribute('href'))) && (!icon)))
				{
					icon2 = '<img src="/templates/classic2/icons/email.gif" align="absmiddle" style="margin: 0; margin-right: 3px">';
					if (/^mailto/.test(element.getAttribute('href')))
					{
						element.title += "Send an E-mail.<br>";
					}
					else
					{
						element.title += "Send an message.<br>";
					}
				}
				else if ((icon != 'none') && (!icon2))
				{
					icon2 = '<img src="/templates/classic2/icons/page_next.gif" align="absmiddle" style="margin: 0; margin-right: 3px">';
				}
				if (icon != 'none')
				{
					element.innerHTML = icon2 + element.innerHTML;
				}
				if ((icon == 'external') || ((element.getAttribute('target')) && (icon != 'none')))
				{
					icon2 = '&nbsp;<img src="/templates/classic2/icons/external.gif" align="bottom" style="margin: 0; margin-right: 3px">';
					element.title += "This link opens in a new tab/window.<br>";
					element.innerHTML = element.innerHTML + icon2;
				}
				else if (icon == 'magnify')
				{
					icon2 = '&nbsp;<img src="/templates/classic2/icons/external.gif" align="bottom" style="margin: 0; margin-right: 3px">';
					element.title += "Magnify image.<br>";
					element.innerHTML = element.innerHTML + icon2;
				}
			}
			if (element.getAttribute('title'))
			{
				new YAHOO.widget.Tooltip('tooltip', {context: element, showdelay: 500});
			}
		},
		
		// button-like links
		'#pageContent a.llbutton': function(element) {
			var newElement = document.createElement('BUTTON');
			if (element.getAttribute('target'))
			{
				newElement.onclick = function(e) {
					window.open(this.getAttribute('href'), this.getAttribute('target'));
					YAHOO.util.Event.stopEvent(e);
				}
				newElement.setAttribute('target', element.getAttribute('target'));
				newElement.setAttribute('title', element.getAttribute('title'));
				new YAHOO.widget.Tooltip('tooltip', {context: newElement, showdelay: 500});
			}
			else {
				newElement.onclick = function(e) {
					YAHOO.ll.ajax.requestPageContent(this.getAttribute('href'), true);
					YAHOO.util.Event.stopEvent(e);
				}
			}
			newElement.innerHTML = element.innerHTML;
			newElement.disabled = element.getAttribute('disabled');
			newElement.setAttribute('href', element.getAttribute('href'));
			newElement.className = element.className;
			YAHOO.util.Dom.removeClass(newElement, 'llbutton');
			element.parentNode.replaceChild(newElement, element);
			//element.innerHTML = '<table cellspacing="0" cellpadding="0"><tr><td><img src="/templates/classic2/buttons/bar1_left.gif"></td><td class="link"><a href="' + element.getAttribute('href') + '">' + element.innerHTML + '</a></td><td><img src="/templates/classic2/buttons/bar1_right.gif"></td></tr></table>';
		},
		
		'.sectionlinks': function(element) {
			YAHOO.util.Dom.generateId(element);
			var newButton = document.createElement('BUTTON');
			newButton.innerHTML = '&raquo;';
			YAHOO.util.Dom.generateId(newButton);
			var newMenuWidget = new YAHOO.widget.Menu(element.id, {
				zIndex: 500,
				context: [newButton.id, 'tl', 'tr']
			});
			newButton.menu = newMenuWidget;
			element.parentNode.insertBefore(newButton, element);
			newMenuWidget.render();
			YAHOO.util.Event.addListener(newButton, 'click', function(e) {
				var element = YAHOO.util.Event.getTarget(e);
				var menu = element.menu;
				if (menu.cfg.getProperty('visible'))
				{
					menu.hide();
				}
				else
				{
					menu.align('tl', 'tr');
					menu.show();
				}
			});
		}
	};
	EventSelectors.start(Rules);
});

YAHOO.ll.event.pageLoad.subscribe(function (type, args) {
	YAHOO.ll.event.pageLoadIndividual.fire();
	YAHOO.util.Dom.setStyle('pageContent', 'visibility', 'visible');
	YAHOO.ll.panel.wait.widget.hide();
});