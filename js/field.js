// JavaScript Document

YAHOO.namespace('Andrei');
YAHOO.namespace('Andrei.regexp');
YAHOO.namespace('Andrei.regexpChar');
YAHOO.namespace('Andrei.field');
YAHOO.namespace('Andrei.Dom');

YAHOO.Andrei.Dom.getBody = function() {
	var mode = document.compatMode; // Standards or Quirks mode? (or null)
	var bodyEl = document.body; // Safari and IE/OP/Gecko quirks mode
	if (mode && mode.indexOf('CSS') != -1) {
		bodyEl = document.documentElement; // IE/OP/Gecko standards mode
	}
	return bodyEl;
}

YAHOO.Andrei.regexp.email = /^[\w|\.|\-|_]+@[\w|\.|\-|_]+\.[\w|\.|\-|_]{2,}(?:,(?: )?[\w|\.|\-|_]+@[\w|\.|\-|_]+\.[\w|\.|\-|_]{2,})*$/;
YAHOO.Andrei.regexp.phone = /^(?:\+|00)(?:[\d]+[ \(\)\-\.])*[\d]+(?:,(?: )?(?:\+|00)(?:[\d]+[ \(\)\-\.])*[\d]+)*$/;
YAHOO.Andrei.regexp.website = /^(?:(?:http(s)?:\/\/)|(www\.))((?:(?:(?:\w|\-|\_)+\.)+)(?:[a-z]{2,5}))((?:\/(?:(?:(?:(?:\w|\-|\_)+\.)*(?:\w|\-|\_)+\/?)*))*)(\?(?:\S*))?$/i;
YAHOO.Andrei.regexp.name = /^(?:(?:[\.a-zA-Z\u00C0-\u024f]{2,}[ \-])?)*[\.a-zA-Z\u00C0-\u024f]{2,}(?:,(?: )?(?:(?:[\.a-zA-Z\u00C0-\u024f]{2,}[ \-])?)*[\.a-zA-Z\u00C0-\u024f]{2,})*$/;
YAHOO.Andrei.regexp.date = /[0-9]{4}\-[0-9]{2}\-[0-9]{2}/;
YAHOO.Andrei.regexp.jpeg = /\.jp(?:e)?g$/i;

YAHOO.Andrei.regexpChar.email = /[-_\.@0-9a-zA-Z]/;
YAHOO.Andrei.regexpChar.emails = /[-_\.\,@ 0-9a-zA-Z]/;
YAHOO.Andrei.regexpChar.website = /[-_\/\.\?\&\=\:\%0-9a-zA-Z]/;
YAHOO.Andrei.regexpChar.phone = /[+\(\)\- \d]/;
YAHOO.Andrei.regexpChar.phones = /[+\,\(\)\- \d]/;
YAHOO.Andrei.regexpChar.letters = /[a-zA-Z]/;
YAHOO.Andrei.regexpChar.numbers = /\d/;
YAHOO.Andrei.regexpChar.numberRange = /[-\d]/;
YAHOO.Andrei.regexpChar.zipcode = /[- \da-zA-Z]/;
YAHOO.Andrei.regexpChar.date = /[-0-9]/;
YAHOO.Andrei.regexpChar.name = /[-\. a-zA-Z\u00C0-\u024f]/; // latin suppliment + latin-a + latin-b
YAHOO.Andrei.regexpChar.names = /[-,\. a-zA-Z\u00C0-\u024f]/;

YAHOO.Andrei.field.regexp = function(element, regexpChar) {
	YAHOO.util.Event.addListener(element, 'keypress', function(e) {
		var keyCode = YAHOO.util.Event.getCharCode(e);
		var keyChar = String.fromCharCode(keyCode);
		if ((!regexpChar.test(keyChar)) && (!YAHOO.Andrei.field.allowedSpecialKey(keyCode)) && (!e.ctrlKey))
		{
			YAHOO.util.Event.preventDefault(e);
		}
	});
};

YAHOO.Andrei.field.invalid = function(element, e) {
	YAHOO.ll.anim.flashInvalid(element);
	if (confirm('Your information does NOT fulfill the current field requirements.\nDo you wish to correct it?'))
	{
		YAHOO.util.Event.stopEvent(e);
		setTimeout(function() {element.focus(); element = null;}, 0);
	}
	else {
		element.value = '';
		YAHOO.Andrei.field.parseSubDependencies(element);
	}
}

YAHOO.Andrei.field.parseSubDependencies = function(element, forceEnable) {}

YAHOO.Andrei.field.timespan = function(ids) {
	var between_month = YAHOO.util.Dom.get(ids[0]);
	var between_year = YAHOO.util.Dom.get(ids[1]);
	var between_and_month = YAHOO.util.Dom.get(ids[2]);
	var between_and_year = YAHOO.util.Dom.get(ids[3]);
	for (var i=0; i<between_and_year.options.length; i++)
	{
		if (i < between_year.selectedIndex)
		{
			between_and_year.options[i].disabled = true;
		}
		else {
			between_and_year.options[i].disabled = false;
		}
	}
	if (between_and_year.selectedIndex < between_year.selectedIndex)
	{
		between_and_year.selectedIndex = between_year.selectedIndex;
	}
	if (between_year.value == between_and_year.value)
	{
		for (var i=0; i<between_and_month.options.length; i++)
		{
			if (i < between_month.selectedIndex)
			{
				between_and_month.options[i].disabled = true;
			}
			else {
				between_and_month.options[i].disabled = false;
			}
		}
		if (between_and_month.selectedIndex < between_month.selectedIndex)
		{
			between_and_month.selectedIndex = between_month.selectedIndex;
		}
	}
	else {
		for (var i=0; i<between_and_month.options.length; i++)
		{
			between_and_month.options[i].disabled = false;
		}
	}
	between_month = null;
	between_year = null;
	between_and_month = null;
	between_and_year = null;
}

YAHOO.Andrei.field.allowedSpecialKey = function(keyCode) {
	return (
		(keyCode == YAHOO.Andrei.field.keyCodes.BACKSPACE) ||
		(keyCode == YAHOO.Andrei.field.keyCodes.TAB) ||
		(keyCode == YAHOO.Andrei.field.keyCodes.ENTER)
	);
};

YAHOO.Andrei.field.keyCodes = {
     BACKSPACE: 8,
	 TAB: 9,
	 ENTER: 13,
	 SHIFT: 16,
     CTRL: 17,
	 ALT: 18,
	 PAUSE: 19,
	 CAPS: 20,
     ESC: 27,
	 PAGEUP: 33,
	 PAGEDN: 34,
	 END: 35,
     HOME: 36,
	 LEFT: 37,
	 UP: 38,
	 RIGHT: 39,
     DOWN: 40,
	 INSERT: 45,
	 DELETE: 46,      
     n0: 48,
	 n1: 49,
	 n2: 50,
	 n3: 51,
	 n4: 52,
     n5: 53,
	 n6: 54,
	 n7: 55,
	 n8: 56,
	 n9: 57,
     A:65, B:66, C:67, D:68, E:68, F:70, G:71, H:72, I:73, J:74, K:75,
     L:76, M:77, N:78, O:79, P:80, Q:81, R:82, S:83, T:84, U:85, V:86,
     W:87, X:88, Y:89, Z:90,
     WINLEFT: 91,
	 WINRIGHT: 92,
	 SELECT: 93,
	 NUM0: 96,
     NUM1: 97,
	 NUM2: 98,
	 NUM3: 99,
	 NUM4: 100,
     NUM5: 101,
	 NUM6: 102,
	 NUM7: 103,
	 NUM8: 104,
     NUM9: 105,
	 MULTIPLY: 106,
	 ADD: 107,
	 SUBTRACT: 109,
     DECIMAL: 110,
	 DIVIDE: 111,
	 F1: 112,
	 F2: 113,
     F3: 114,
	 F4: 115,
	 F5: 116,
	 F6: 117,
     F7: 118,
	 F8: 119,
	 F9: 120,
	 F10: 121,
     F11: 122,
	 F12: 123,
	 NUMLOCK: 144,
	 SCROLLLOCK: 145,
     SEMICOLON: 186,
	 EQUAL: 187,
	 COMMA: 188,
	 DASH: 189,
     PERIOD: 190,
	 FORWARDSLASH: 191,
	 GRAVEACCENT: 192,
     OPENBRACKET: 219,
	 BACKSLASH: 220,
	 CLOSEBRACKET: 221,
     QUOTE: 222
};

YAHOO.Andrei.field.dependenciesOK = function(element) {
	var elementRel = element.getAttribute('rel');
	var requiredElements = elementRel.split(', ');
	for (var i = 0; i<requiredElements.length; i++)
	{
		var requiredElementId = requiredElements[i].split(' ')[0];
		var requiredElement = YAHOO.util.Dom.get(requiredElementId);
		if (!requiredElement.value)
		{
			requiredElement = null;
			element = null;
			return false;
		}
	}
	requiredElement = null;
	element = null;
	return true;
};

/*
	http://developer.mozilla.org/en/docs/Whitespace_in_the_DOM
*/

YAHOO.Andrei.Dom._is_all_ws = function( nod )
{
  // Use ECMA-262 Edition 3 String and RegExp features
  return !(/[^\t\n\r ]/.test(nod.data));
}


YAHOO.Andrei.Dom._is_ignorable = function( nod )
{
  return ( nod.nodeType == 8) || // A comment node
         ( (nod.nodeType == 3) && YAHOO.Andrei.Dom._is_all_ws(nod) ); // a text node, all ws
}

YAHOO.Andrei.Dom.nextRealSibling = function( sib )
{
  while ((sib = sib.nextSibling)) {
    if (!YAHOO.Andrei.Dom._is_ignorable(sib)) return sib;
  }
  return null;
}

YAHOO.Andrei.Dom.previousRealSibling = function( sib )
{
  while ((sib = sib.previousSibling)) {
    if (!YAHOO.Andrei.Dom._is_ignorable(sib)) return sib;
  }
  return null;
}

//-------------------------------------------------------
/**
 * function onmousewheel,
 *	onmousewheel(element:Object [, callback:Function]):Void
 * @param	Object		window, document or DOM.element to use with callback
 * @param	Function	callback function with element scope (.call(...)) and delta wheel value as single parameter
 * @return	Void
 */
function onmousewheel(element, callback) {
		
	// @author	Andrea Giammarchi		[http://www.devpro.it/]
	// @license	MIT 				[http://www.opensource.org/licenses/mit-license.php]
	// @credits	Adomas Paltanavicius 		[http://adomas.org/javascript-mouse-wheel/]
	
	function __onwheel(event) {
		var	delta = 0;
		var realDelta = 0;
		if(event.wheelDelta) {
			delta = event.wheelDelta / 120;
			realDelta = event.wheelDelta;
			if(window.opera)
				delta = -delta;
		}
		else if(event.detail) {
			delta = -event.detail / 3;
			realDelta = -event.detail;
		}
		if((delta) && (callback))
			callback.call(element, delta, realDelta);
		YAHOO.util.Event.preventDefault(event);
	};
	
	if(element.addEventListener && !window.opera)
		element.addEventListener("DOMMouseScroll", __onwheel, false);
	else
		element.onmousewheel = (function(base){return function(evt){
			if(!evt) evt = window.event;
			if(base) base.call(element, evt);
			return __onwheel(evt);
		}})(element.onmousewheel);
};

function onmousewheeldefault(delta, realDelta)
{
	var bodyEl = YAHOO.Andrei.Dom.getBody();
	bodyEl.scrollTop -= realDelta;
	bodyEl = null;
}

/**************************************
» Jonas Raoni Soares Silva
» http://www.joninhas.ath.cx
**************************************/

String.prototype.capitalize = function(){ //v1.0
    return this.replace(/\w+/g, function(a){
        return a.charAt(0).toUpperCase() + a.substr(1).toLowerCase();
    });
};

String.prototype.trim = function(){
	return this.replace(/^\s*(.*?)\s*$/, '$1');
}

String.prototype.triminside = function(){
	return this.replace(/(\s){2,}/, '$1');
}