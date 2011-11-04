/*
 * LL template - 2007
 * Copyright(c) 2007, Andrei Neculau.
 */


YAHOO.namespace('ll.anim');YAHOO.ll.anim.scrollIntoView=function(y){var currentHeight=YAHOO.util.Dom.getDocumentHeight();var scrollY=document.documentElement.scrollTop||document.body.scrollTop;var viewPortHeight=YAHOO.util.Dom.getViewportHeight();if((scrollY+viewPortHeight==currentHeight)&&(y>currentHeight-viewPortHeight))return;var scrollUp=new YAHOO.util.Scroll(YAHOO.Andrei.Dom.getBody(),{scroll:{to:[0,y]}},2,YAHOO.util.Easing.easeOut);scrollUp.animate();};YAHOO.ll.anim.flashInvalid=function(element){var backAnim=true;var oldColor=YAHOO.util.Dom.getStyle(element,'color');var anim=new YAHOO.util.ColorAnim(element,{color:{to:'#FF0000'}},0.5,YAHOO.util.Easing.easeOut);anim.onComplete.subscribe(function(){if(backAnim)
{anim.attributes={color:{to:oldColor}};anim.animate();}
backAnim=!backAnim;});anim.animate();element=null;}

YAHOO.namespace('ll');YAHOO.namespace('ll.event');YAHOO.namespace('ll.debug');YAHOO.ll.debug.active=lldebug;YAHOO.ll.event.pageLoad=new YAHOO.util.CustomEvent('Page Content is ready for parsing');YAHOO.ll.event.pageLoadIndividual=new YAHOO.util.CustomEvent('Run tasks for the specific Page Content being loaded');YAHOO.ll.event.pageUnloadIndividual=new YAHOO.util.CustomEvent('Run tasks for the specific Page Content being unloaded');var pageRules={};var sidebarRules={};var pageIndividualRules={};var pageIndividualRulesDefault={};var genericBorder=null;YAHOO.ll.debug.eventTime=function(individual){if(individual)
{var Tstart=YAHOO.ll.debug.timeIndividual;YAHOO.ll.debug.timeIndividualStop=new Date().getTime();var Tstop=YAHOO.ll.debug.timeIndividualStop;var timeElement=YAHOO.util.Dom.get('debug-individual-time');}
else{var Tstart=YAHOO.ll.debug.time;YAHOO.ll.debug.timeStop=new Date().getTime();var Tstop=YAHOO.ll.debug.timeStop;var timeElement=YAHOO.util.Dom.get('debug-time');}
if(timeElement)
{timeElement.innerHTML=((Tstop-Tstart)/1000.0)+'s';timeElement=null;}};YAHOO.ll.event.pageLoad.subscribe(function(type,args){YAHOO.ll.event.pageUnloadIndividual.fire();YAHOO.ll.event.pageUnloadIndividual=new YAHOO.util.CustomEvent('Run tasks for the specific Page Content being unloaded');pageRules={};var scrollFunc=function(element){var firstItem=element.parentNode.id+'-item-1';var currentItem=element.parentNode.id+'-item-'+(parseInt(element.getAttribute('rel'),10)+1);var nextItem=element.parentNode.id+'-item-'+(parseInt(element.getAttribute('rel'),10)+2);currentItem=YAHOO.util.Dom.get(currentItem);YAHOO.util.Dom.setStyle(currentItem,'display','none');var sibling=YAHOO.Andrei.Dom.nextRealSibling(currentItem);if((sibling)&&(sibling.tagName.toUpperCase()=='DD'))
{YAHOO.util.Dom.setStyle(sibling,'display','none');}
currentItem=null;sibling=null
counter=parseInt(element.getAttribute('rel'),10)+1;if(!(nextItem=YAHOO.util.Dom.get(nextItem)))
{nextItem=YAHOO.util.Dom.get(firstItem);counter=0;}
YAHOO.util.Dom.setStyle(nextItem,'display','block');var sibling=YAHOO.Andrei.Dom.nextRealSibling(nextItem);if((sibling)&&(sibling.tagName.toUpperCase()=='DD'))
{YAHOO.util.Dom.setStyle(sibling,'display','block');}
element.setAttribute('rel',counter);nextItem=null;sibling=null;element=null;}
var Rules={'dl.scroll':function(element){var counter=0;for(var i=0;i<element.childNodes.length;i++)
{var scrollItem=element.childNodes[i];if((scrollItem.tagName)&&(scrollItem.tagName.toUpperCase()=='DT'))
{counter++;scrollItem.id=element.parentNode.id+'-item-'+counter;}}
var scrollItem=null;setInterval(scrollFunc,parseInt(element.getAttribute('rel')),element);element.setAttribute('rel',0);element=null;}};Object.extend(sidebarRules,Rules);});YAHOO.ll.event.pageLoadIndividual.subscribe(function(type,args){if(YAHOO.ll.debug.active)
{YAHOO.ll.debug.timeIndividual=new Date().getTime();}
pageIndividualRules={};onRenderEndedInterval=setInterval(onRenderEnded,1000);});YAHOO.ll.event.pageLoad.subscribe(function(type,args){var Rules0={'div > a':function(element){var relAttribute=element.getAttribute('rel');if(relAttribute)
{if(relAttribute.match('lightbox'))
{YAHOO.util.Event.addListener(element,'click',function(e){var element=YAHOO.util.Event.getTarget(e);myLightbox.start(element);YAHOO.util.Event.stopEvent(e);element=null;});}}
element=null;},'div.summary':function(element){if(element.scrollHeight>element.offsetHeight)
{element.title='This is an excerpt! DOUBLE-CLICK on the text TO READ IT ALL!';}
YAHOO.util.Event.addListener(element,'dblclick',function(e){var element=YAHOO.util.Event.getTarget(e);if(YAHOO.util.Dom.getStyle(element,'overflow')=='auto')
{YAHOO.util.Dom.setStyle(element,'overflow','hidden');element.title='This is an excerpt! DOUBLE-CLICK on the text TO READ IT ALL!';}
else{YAHOO.util.Dom.setStyle(element,'overflow','auto');element.title='Double-click again to show just the excerpt!';}
element=null;});},'div.toggler':function(element){YAHOO.util.Event.addListener(element.id+'-activator','click',function(e){var element=YAHOO.util.Event.getTarget(e);var childId=element.id.replace('-activator','');var onceId=element.id+'-once';if(YAHOO.util.Dom.hasClass(element,'Tshow'))
{YAHOO.util.Dom.removeClass(childId,'hidden');if(YAHOO.util.Dom.hasClass(element,'Toggle'))
{YAHOO.util.Dom.replaceClass(element,'Tshow','Thide');}}
if(YAHOO.util.Dom.hasClass(element,'Thide'))
{YAHOO.util.Dom.addClass(childId,'hidden');if(YAHOO.util.Dom.hasClass(element,'Toggle'))
{YAHOO.util.Dom.replaceClass(element,'Thide','Tshow');}}
if(YAHOO.util.Dom.hasClass(element,'Tonce'))
{var once=YAHOO.util.Dom.get(onceId);if(once)
{once.parentNode.removeChild(once);}
else{element.parentNode.removeChild(element);}
once=null;}
YAHOO.util.Event.stopEvent(e);element=null;});}};var Rules1={'div.sectionlinks':function(element){YAHOO.util.Dom.generateId(element);var newButton=document.createElement('BUTTON');newButton.setAttribute('type','button');newButton.innerHTML='Related';newButton.menuId=element.id;YAHOO.util.Dom.generateId(newButton);element.parentNode.insertBefore(newButton,element);YAHOO.util.Event.addListener(newButton,'click',function(e){var element=YAHOO.util.Event.getTarget(e);if(!element.menuRendered)
{element.menu=new YAHOO.widget.Menu(element.menuId,{zIndex:500,lazyLoad:true,hidedelay:250});element.menu.render();YAHOO.util.Dom.setX(element.menuId,YAHOO.util.Dom.getX(element)+element.offsetWidth-YAHOO.util.Dom.get(element.menuId).offsetWidth);YAHOO.util.Dom.setY(element.menuId,YAHOO.util.Dom.getY(element));element.menuRendered=true;}
element.menu.show();YAHOO.util.Event.stopEvent(e);element=null;});newButton=null;element=null;}};if(lltemplatelevel==0)
{genericBorder=RUZEE.ShadedBorder.create({corner:4,border:1});var RuleSB={'div.sb':function(element){YAHOO.util.Dom.setStyle(element,'padding','5px');genericBorder.render(element,true);}};}
else{genericBorder=RUZEE.ShadedBorder.create({corner:4,shadow:10,border:1});var RuleSB={'div.sb':function(element){YAHOO.util.Dom.setStyle(element,'padding','10px');genericBorder.render(element,true);}};}
Object.extend(pageIndividualRulesDefault,Rules0);Object.extend(pageIndividualRulesDefault,RuleSB);if(lltemplatelevel>0)
{Object.extend(pageIndividualRulesDefault,Rules1);}
var ua=navigator.userAgent.toLowerCase();var isIE=ua.indexOf("msie")>-1;var isIE7=ua.indexOf("msie 7")>-1;if((!isIE)||((isIE)&&(isIE7)))return;var RuleIEpng={'img.png':function(element){var oldHeight=element.offsetHeight;var oldWidth=element.offsetWidth;YAHOO.util.Dom.setStyle(element,'filter',"progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'"+element.src+"\', sizingMethod='scale')");YAHOO.util.Dom.setStyle(element,'height',oldHeight+'px');YAHOO.util.Dom.setStyle(element,'width',oldWidth+'px');element.src="<{$tpl.webpath}>/images/spacer.gif";}};Object.extend(pageIndividualRulesDefault,RuleIEpng);});

with(YAHOO.widget.MenuBarItem.prototype)
{SUBMENU_INDICATOR_IMAGE_PATH="menuarodwn8_hov_1.gif";SELECTED_SUBMENU_INDICATOR_IMAGE_PATH="menuarodwn8_nrm_1.gif";}
YAHOO.namespace('ll.menu');YAHOO.ll.event.pageLoad.subscribe(function(type,args){with(YAHOO.ll.menu)
{widget=new YAHOO.widget.MenuBar('menu',{autosubmenudisplay:true,showdelay:0,hidedelay:250,lazyLoad:(lltemplatelevel<1),zindex:50});widget.render();widget.show();}});

YAHOO.ll.getLinkElements=function(text)
{var temp=text.split('?');var temp2=new Array('','');if(temp[1])
{temp2=temp[1].split('#');if(temp2[0])
{temp2[0]='?'+temp2[0];}
else
{temp2[0]='';}
if(temp2[1])
{temp2[1]='#'+temp2[1];}
else
{temp2[1]='';}}
temp[0]=temp[0].replace(window.location.protocol+'//'+window.location.host,'');if(!(new RegExp('^/').test(temp[0])))
{temp[0]='/'+temp[0];}
return{protocol:window.location.protocol,host:window.location.host,pathname:temp[0],search:temp2[0],hash:temp2[1]};}
YAHOO.Andrei.field.parseSubDependencies=function(element,forceEnable){if(!element.subDependencies)return;var subs=element.subDependencies.split(', ');for(var i=0;i<subs.length;i++)
{var temp=subs[i].split(' ');var subElementId=temp[0];var subElementOptions=temp[1];var subElement=YAHOO.util.Dom.get(subElementId);var disable=!YAHOO.Andrei.field.dependenciesOK(subElement);if((disable)&&(!forceEnable))
{if(subElementOptions.indexOf('required')!=-1)
{YAHOO.util.Dom.removeClass(subElement,'required');}
subElement.disabled=true;}
else{subElement.disabled=false;if(subElementOptions.indexOf('required')!=-1)
{YAHOO.util.Dom.addClass(subElement,'required');}}}
subElement=null;subs=null;temp=null;element=null;}
YAHOO.ll.event.pageLoad.subscribe(function(type,args){var Rules={'ul#paging-header a, ul#paging-footer a':function(element){YAHOO.util.Event.addListener(element,'click',function(e){var element=YAHOO.util.Event.getTarget(e);YAHOO.ll.wait.widget.targetElement='results';YAHOO.ll.wait.widget.render();YAHOO.ll.wait.widget.show();var linkElements=YAHOO.ll.getLinkElements(element.getAttribute('href'));if(linkElements.search)
{linkElements.search+='&ajax=1';}
else
{linkElements.search='?ajax=1';}
var callback={success:function(o){var results;results=YAHOO.util.Dom.get('results');results.innerHTML=o.responseText;YAHOO.ll.event.pageLoadIndividual.fire();applyRules(pageIndividualRulesDefault,"#results ");applyRules(pageIndividualRules,"#results ");if(YAHOO.ll.debug.active)
{YAHOO.ll.debug.eventTime(true);}
pageIndividualRules={};YAHOO.ll.wait.widget.hide();var scrollUpMargin;if(YAHOO.util.Dom.getY('filters'))
{scrollUpMargin=Math.min(YAHOO.util.Dom.getY('filters'),YAHOO.util.Dom.getY('results'));}
else{scrollUpMargin=YAHOO.util.Dom.getY('results');}
YAHOO.ll.anim.scrollIntoView(scrollUpMargin);results=null;},failure:function(o){YAHOO.ll.wait.widget.hide();alert('It was not possible to load the requested page. Please try again!');}}
YAHOO.util.Connect.asyncRequest('GET',linkElements.pathname+linkElements.search,callback);YAHOO.util.Event.stopEvent(e);element=null;});},'form':function(element){element.requiredCheck=function(){var element=this;for(var i=0;i<element.elements.length;i++)
{var formElement=element.elements[i];if((YAHOO.util.Dom.hasClass(formElement,'required'))&&(!formElement.value))
{alert('Please fill in required fields!');setTimeout(function(){formElement.focus();formElement=null;},0);element=null;return false;}}
formElement=null;element=null;return true;};for(var i=0;i<element.elements.length;i++)
{var formElement=element.elements[i];var formElementRel=formElement.getAttribute('rel');if(YAHOO.util.Dom.hasClass(element,'major'))
{YAHOO.util.Event.addListener(formElement,'focus',function(e){var element=YAHOO.util.Event.getTarget(e);YAHOO.util.Dom.addClass(element,'focus');element=null;});YAHOO.util.Event.addListener(formElement,'blur',function(e){var element=YAHOO.util.Event.getTarget(e);YAHOO.util.Dom.removeClass(element,'focus');element=null;});}
if(formElementRel)
{var requiredElements=formElementRel.split(', ');for(var j=0;j<requiredElements.length;j++)
{var temp=requiredElements[j].split(' ');var requiredElementId=temp[0];var requiredElementOptions=null;if(temp.length==2)
{requiredElementOptions=temp[1];}
var requiredElement=YAHOO.util.Dom.get(requiredElementId);if(requiredElement.subDependencies)
{requiredElement.subDependencies+=', '+formElement.id+' '+requiredElementOptions;}
else{requiredElement.subDependencies=formElement.id+' '+requiredElementOptions;}
YAHOO.util.Event.addListener(requiredElement,'focus',function(e){var element=YAHOO.util.Event.getTarget(e);YAHOO.Andrei.field.parseSubDependencies(element,true);});YAHOO.util.Event.addListener(requiredElement,'blur',function(e){var element=YAHOO.util.Event.getTarget(e);YAHOO.Andrei.field.parseSubDependencies(element);});requiredElement=null;requiredElementId=null;requiredElementOptions=null;}
if(formElement.value=='')
{formElement.disabled=true;}
requiredElements=null;}
if(formElement.tagName.toUpperCase()=='SELECT')
{if(YAHOO.util.Dom.hasClass(formElement,'timespan'))
{YAHOO.util.Event.addListener(formElement,'change',formElement.form.timespanCheck,formElement.form,true);}
else if(YAHOO.util.Dom.hasClass(formElement,'list_city'))
{YAHOO.util.Event.addListener(element.id+'-list_country','change',function(e){var element=YAHOO.util.Event.getTarget(e);if((element.cityAJAX)&&(YAHOO.util.Connect.isCallInProgress(element.cityAJAX)))
{YAHOO.util.Connect.abort(element.cityAJAX);}
var cityElement=YAHOO.util.Dom.get(element.form.id+'-list_city');cityElement.options.length=0;if(element.value=='')
{cityElement.options[cityElement.options.length]=new Option('all of the cities','');cityElement.disabled=false;element=null;cityElement=null;return;}
cityElement.options[cityElement.options.length]=new Option('Loading','');cityElement.disabled=true;var callback={success:function(o){var cityElement=YAHOO.util.Dom.get(o.argument.cityElement);cityElement.disabled=false;var jsonResult=o.responseText.parseJSON().output.results;cityElement.options.length=0;cityElement.options[cityElement.options.length]=new Option('all of the cities','');for(var i=0;i<jsonResult.length;i++)
{cityElement.options[cityElement.options.length]=new Option(jsonResult[i].name,jsonResult[i].name);}
cityElement=null;},failure:function(o){var cityElement=YAHOO.util.Dom.get(o.argument.cityElement);var countryElement=YAHOO.util.Dom.get(o.argument.countryElement);cityElement.options.length=0;cityElement.options[cityElement.options.length]=new Option('Error. Re-Loading','');countryElement.cityAJAX=YAHOO.util.Connect.asyncRequest('GET','./autocomplete.php?function=cities_bycountry&country='+countryElement.value,callback);cityElement=null;countryElement=null;},argument:{'countryElement':element.id,'cityElement':element.form.id+'-list_city'}};element.cityAJAX=YAHOO.util.Connect.asyncRequest('GET','./autocomplete.php?function=cities_bycountry&country='+element.value,callback);element=null;cityElement=null;});}}
if(formElement.tagName.toUpperCase()=='TEXTAREA')
{YAHOO.util.Event.addListener(formElement,'blur',function(e){var element=YAHOO.util.Event.getTarget(e);element.value=element.value.triminside();element.value=element.value.trim();element=null;});if(YAHOO.util.Dom.hasClass(formElement,'limitation'))
{YAHOO.util.Event.addListener(formElement,'keypress',function(e){var element=YAHOO.util.Event.getTarget(e);if(element.value.length>=500)
{element.helpShow(e);}
element=null;});YAHOO.util.Event.addListener(formElement,'keyup',function(e){var element=YAHOO.util.Event.getTarget(e);var infoElement=YAHOO.util.Dom.get(element.id+'-limitation');if(infoElement)
{infoElement.innerHTML=500-element.value.length;infoElement=null;}
element=null;});YAHOO.util.Event.addListener(formElement,'blur',function(e){var element=YAHOO.util.Event.getTarget(e);if(element.value.length>=500)
{element.value=element.value.substr(0,500);alert('We only kept the first 500 characters of your text!');}
var infoElement=YAHOO.util.Dom.get(element.id+'-limitation');if(infoElement)
{infoElement.innerHTML=500-element.value.length;infoElement=null;}
element=null;});}}
if(formElement.tagName.toUpperCase()=='INPUT')
{var formElementType=formElement.getAttribute('type');if(formElementType=='text')
{YAHOO.util.Event.addListener(formElement,'blur',function(e){var element=YAHOO.util.Event.getTarget(e);element.value=element.value.triminside();element.value=element.value.trim();element=null;});if(YAHOO.util.Dom.hasClass(formElement,'calendar'))
{YAHOO.Andrei.field.regexp(formElement,YAHOO.Andrei.regexpChar.date);var calendarContainer=document.createElement('DIV');calendarContainer.id=formElement.id+'-calcontainer';calendarContainer.hoveredCalendar=false;YAHOO.util.Dom.get('results').appendChild(calendarContainer);YAHOO.util.Dom.setStyle(calendarContainer,'position','absolute');YAHOO.util.Dom.setX(calendarContainer,YAHOO.util.Dom.getX(formElement));YAHOO.util.Dom.setY(calendarContainer,YAHOO.util.Dom.getY(formElement)+formElement.offsetHeight);YAHOO.util.Dom.setStyle(calendarContainer,'display','none');formElement.widget=new YAHOO.widget.Calendar(formElement.id+'-calendar',calendarContainer.id,{DATE_FIELD_DELIMITER:'-',MDY_DAY_POSITION:3,MDY_MONTH_POSITION:2,MDY_YEAR_POSITION:1,START_WEEKDAY:1});YAHOO.util.Event.addListener(formElement,"focus",formElement.widget.show,formElement.widget,true);YAHOO.util.Event.addListener(formElement,"blur",function(e){var element=YAHOO.util.Event.getTarget(e);if((!YAHOO.Andrei.regexp.date.test(element.value))&&(element.value!=''))
{YAHOO.Andrei.field.invalid(element,e);}
else{if(YAHOO.util.Dom.getStyle(element.widget.oDomContainer,'display')=='none')return;setTimeout(function(){element.widget.hide();element=null;},100);}},formElement.widget,true);formElement.widget.selectEvent.subscribe(function(type,args,obj){var dates=args[0];var date=dates[0];var year=date[0],month=date[1],day=date[2];if(month<10)
{month='0'+month;}
if(day<10)
{day='0'+day;}
obj.value=year+'-'+month+'-'+day;obj.widget.hide();},formElement,true);formElement.widget.render();calendarContainer=null;}
else if(YAHOO.util.Dom.hasClass(formElement,'letters'))
{YAHOO.Andrei.field.regexp(formElement,YAHOO.Andrei.regexpChar.letters);}
else if(YAHOO.util.Dom.hasClass(formElement,'captcha'))
{YAHOO.Andrei.field.regexp(formElement,YAHOO.Andrei.regexpChar.letters);var newButton=document.createElement('BUTTON');newButton.setAttribute('type','button');newButton.innerHTML="Unreadable letters? Refresh signature!";newButton.captchaId=formElement.id;newButton.captchaSrc='<{$tpl.links.captcha}>';YAHOO.util.Event.addListener(newButton,'click',function(e){var element=YAHOO.util.Event.getTarget(e);YAHOO.util.Dom.get(element.captchaId).value='';var temp=new Date();YAHOO.util.Dom.get(element.captchaId+'-image').src=element.captchaSrc+'?'+temp.getYear()+temp.getMonth()+temp.getDate()+temp.getHours()+temp.getMinutes()+temp.getSeconds();});var captchaImage=YAHOO.util.Dom.get(formElement.id+'-image');captchaImage.parentNode.insertBefore(newButton,captchaImage);captchaImage.parentNode.insertBefore(captchaImage,newButton);newButton=null;captchaImage=null;}
else if(YAHOO.util.Dom.hasClass(formElement,'city'))
{var formElementAC=YAHOO.util.Dom.get(formElement.id+'-autocomplete');YAHOO.util.Dom.setX(formElementAC,YAHOO.util.Dom.getX(formElement));YAHOO.util.Dom.setY(formElementAC,YAHOO.util.Dom.getY(formElement)+formElement.offsetHeight);YAHOO.util.Dom.setStyle(formElementAC,'width',formElement.offsetWidth+'px');formElement.dataSource=new YAHOO.widget.DS_XHR('./autocomplete.php',['output.results','name']);formElement.widget=new YAHOO.widget.AutoComplete(formElement.id,formElementAC.id,formElement.dataSource,{queryDelay:1,minQueryLength:0,maxResultsDisplayed:100,animVert:false,animHoriz:false,autoHighlight:false});formElement.widget.formatResult=function(aResultItem,sQuery){return aResultItem[0];}
formElement.dataSource.scriptQueryParam='city';formElement.dataSource.scriptQueryAppend='function=cities_bycountry&country='+YAHOO.util.Dom.get(element.id+'-country').value;YAHOO.util.Event.addListener(element.id+'-country','change',function(e){var element=YAHOO.util.Event.getTarget(e);var formElement=YAHOO.util.Dom.get(element.form.id+'-city');formElement.dataSource.scriptQueryAppend='function=cities_bycountry&country='+element.value;element=null;formElement=null;});formElementAC=null;}
else if(YAHOO.util.Dom.hasClass(formElement,'membername'))
{var formElementAC=YAHOO.util.Dom.get(formElement.id+'-autocomplete');YAHOO.util.Dom.setX(formElementAC,YAHOO.util.Dom.getX(formElement));YAHOO.util.Dom.setY(formElementAC,YAHOO.util.Dom.getY(formElement)+formElement.offsetHeight);YAHOO.util.Dom.setStyle(formElementAC,'width',formElement.offsetWidth+'px');formElement.dataSource=new YAHOO.widget.DS_XHR('./autocomplete.php',['output.results','name','city','countryname','schoolnumber']);formElement.widget=new YAHOO.widget.AutoComplete(formElement.id,formElementAC.id,formElement.dataSource,{queryDelay:1,minQueryLength:3,maxResultsDisplayed:100,animVert:false,animHoriz:false,autoHighlight:false});formElement.widget.formatResult=function(aResultItem,sQuery){return'['+aResultItem[3]+'] <b>'+aResultItem[0]+'</b> ('+aResultItem[2]+', '+aResultItem[1]+')';}
formElement.dataSource.scriptQueryParam='namelike';formElement.dataSource.scriptQueryAppend='function=members_byname';if(formElementAC.getAttribute('rel'))
{formElementAC.itemSelectRedirect=function(type,args){var redirection=args[0]._oContainer.getAttribute('rel')+args[2][3];args[0]._oTextbox.disabled=true;location=redirection;}
formElement.widget.itemSelectEvent.subscribe(formElementAC.itemSelectRedirect);}
formElementAC=null;}
else if(YAHOO.util.Dom.hasClass(formElement,'numbers'))
{YAHOO.Andrei.field.regexp(formElement,YAHOO.Andrei.regexpChar.numbers);}
else if(YAHOO.util.Dom.hasClass(formElement,'number-range'))
{YAHOO.Andrei.field.regexp(formElement,YAHOO.Andrei.regexpChar.numberRange);YAHOO.util.Event.addListener(formElement,'blur',function(e){var element=YAHOO.util.Event.getTarget(e);var regexp=/^\d{1,2}(?:\-\d{1,2})?$/;if((!regexp.test(element.value))&&(element.value!=''))
{YAHOO.Andrei.field.invalid(element,e);}});}
else if(YAHOO.util.Dom.hasClass(formElement,'zipcode'))
{YAHOO.Andrei.field.regexp(formElement,YAHOO.Andrei.regexpChar.zipcode);}
else if((YAHOO.util.Dom.hasClass(formElement,'name'))||(YAHOO.util.Dom.hasClass(formElement,'names')))
{if(YAHOO.util.Dom.hasClass(formElement,'name'))
{YAHOO.Andrei.field.regexp(formElement,YAHOO.Andrei.regexpChar.name);}
else{YAHOO.Andrei.field.regexp(formElement,YAHOO.Andrei.regexpChar.names);}
YAHOO.util.Event.addListener(formElement,'blur',function(e){var element=YAHOO.util.Event.getTarget(e);element.value=element.value.capitalize();if((!YAHOO.Andrei.regexp.name.test(element.value))&&(element.value!=''))
{YAHOO.Andrei.field.invalid(element,e);}});}
else if((YAHOO.util.Dom.hasClass(formElement,'email'))||(YAHOO.util.Dom.hasClass(formElement,'emails')))
{if(YAHOO.util.Dom.hasClass(formElement,'email'))
{YAHOO.Andrei.field.regexp(formElement,YAHOO.Andrei.regexpChar.email);}
else{YAHOO.Andrei.field.regexp(formElement,YAHOO.Andrei.regexpChar.emails);}
YAHOO.util.Event.addListener(formElement,'blur',function(e){var element=YAHOO.util.Event.getTarget(e);element.value=element.value.toLowerCase();if((!YAHOO.Andrei.regexp.email.test(element.value))&&(element.value!=''))
{YAHOO.Andrei.field.invalid(element,e);}});}
else if(YAHOO.util.Dom.hasClass(formElement,'website'))
{YAHOO.Andrei.field.regexp(formElement,YAHOO.Andrei.regexpChar.website);YAHOO.util.Event.addListener(formElement,'blur',function(e){var element=YAHOO.util.Event.getTarget(e);element.value=element.value.toLowerCase();if((!YAHOO.Andrei.regexp.website.test(element.value))&&(element.value!=''))
{YAHOO.Andrei.field.invalid(element,e);}});}
else if(YAHOO.util.Dom.hasClass(formElement,'zipcode'))
{YAHOO.util.Event.addListener(formElement,'blur',function(e){var element=YAHOO.util.Event.getTarget(e);element.value=element.value.toUpperCase();element=null;});}
else if((YAHOO.util.Dom.hasClass(formElement,'phone'))||(YAHOO.util.Dom.hasClass(formElement,'phones')))
{if(YAHOO.util.Dom.hasClass(formElement,'phone'))
{YAHOO.Andrei.field.regexp(formElement,YAHOO.Andrei.regexpChar.phone);}
else{YAHOO.Andrei.field.regexp(formElement,YAHOO.Andrei.regexpChar.phones);}
YAHOO.util.Event.addListener(formElement,'blur',function(e){var element=YAHOO.util.Event.getTarget(e);if((!YAHOO.Andrei.regexp.phone.test(element.value))&&(element.value!=''))
{YAHOO.Andrei.field.invalid(element,e);}});}}
else if(formElementType=='file')
{if(YAHOO.util.Dom.hasClass(formElement,'jpeg'))
{YAHOO.util.Event.addListener(formElement,'change',function(e){var element=YAHOO.util.Event.getTarget(e);if((!YAHOO.Andrei.regexp.jpeg.test(element.value))&&(element.value!=''))
{alert("Your file doesn't look to be a JPEG image file.");element.value='';}});}}}
var help=YAHOO.util.Dom.get(formElement.id+'-help');if(help)
{formElement.help=new YAHOO.widget.Overlay(help.id,{context:[formElement,'bl','tl'],width:formElement.offsetWidth+'px',effect:{effect:YAHOO.widget.ContainerEffect.FADE,duration:0.5},zIndex:1000,visible:false});formElement.help.render();YAHOO.util.Dom.setStyle(formElement.help.element,'visibility','hidden');YAHOO.util.Dom.setStyle(formElement.help.element,'display','block');var functionShow=function(e){var delay=1000;var element=YAHOO.util.Event.getTarget(e);if(element.helpTimeout)
{clearTimeout(element.helpTimeout);}
if(e.type=='keypress')
{delay=0;}
element.helpTimeout=setTimeout(function(){element.help.align('bl','tl');element.help.show();element.helpTimeout=setTimeout(function(){element.help.hide();element=null;},10000);},delay);};var functionHide=function(e){var element=YAHOO.util.Event.getTarget(e);if(element.helpTimeout)
{clearTimeout(element.helpTimeout);}
element.help.hide();element=null;};if(YAHOO.util.Dom.hasClass(formElement,'ondemandhelp'))
{formElement.helpShow=functionShow;}
else{YAHOO.util.Event.addListener(formElement,'focus',functionShow);YAHOO.util.Event.addListener(formElement,'click',functionShow);YAHOO.util.Event.addListener(formElement,'keypress',functionShow);}
YAHOO.util.Event.addListener(formElement,'blur',functionHide);YAHOO.util.Event.addListener(formElement,'mouseout',functionHide);}
help=null;}},'form button[type=submit]':function(element){var form=YAHOO.util.Dom.get(element.form.id);if(YAHOO.util.Dom.get(form.id+'-ajax'))return;YAHOO.util.Event.addListener(form,'submit',function(e){var element=YAHOO.util.Event.getTarget(e);if(!element.requiredCheck())
{YAHOO.util.Event.stopEvent(e);return false;}
if(!YAHOO.util.Dom.hasClass(element.id+'-submit','ajax'))return true;YAHOO.ll.wait.widget.targetElement='results';YAHOO.ll.wait.widget.render();YAHOO.ll.wait.widget.show();var callback={success:function(o){var results=YAHOO.util.Dom.get('results');results.innerHTML=o.responseText;YAHOO.ll.event.pageLoadIndividual.fire();applyRules(pageIndividualRulesDefault,"#results ");applyRules(pageIndividualRules,"#results ");if(YAHOO.ll.debug.active)
{YAHOO.ll.debug.eventTime(true);}
pageIndividualRules={};YAHOO.ll.wait.widget.hide();var scrollUpMargin;if(YAHOO.util.Dom.getY('filters'))
{scrollUpMargin=Math.min(YAHOO.util.Dom.getY('filters'),YAHOO.util.Dom.getY('results'));}
else{scrollUpMargin=YAHOO.util.Dom.getY('results');}
var scrollUp=new YAHOO.util.Scroll(YAHOO.Andrei.Dom.getBody(),{scroll:{to:[0,scrollUpMargin]}},1,YAHOO.util.Easing.easeOut);scrollUp.animate();results=null;scrollUp=null;},failure:function(o){alert('It was not possible to send/receive the requested information. Please try again!');YAHOO.ll.wait.widget.hide();}}
callback.upload=callback.success;YAHOO.util.Connect.setForm(element,YAHOO.util.Dom.hasClass(element,'upload'));YAHOO.util.Connect.asyncRequest(element.getAttribute('method').toUpperCase(),element.getAttribute('action'),callback);YAHOO.util.Event.preventDefault(e);element=null;});if(!YAHOO.util.Dom.hasClass(element,'ajax'))return;var ajaxField=document.createElement('INPUT');ajaxField.setAttribute('type','hidden');ajaxField.setAttribute('name','ajax');ajaxField.setAttribute('value','1');ajaxField.id=form.id+'-ajax';form.appendChild(ajaxField);form=null;ajaxField=null;}};Object.extend(pageIndividualRulesDefault,Rules);});

YAHOO.namespace('ll.wait');YAHOO.ll.event.pageLoad.subscribe(function(type,args){YAHOO.ll.wait.widget=new YAHOO.widget.Panel('wait',{width:'350px',fixedcenter:true,underlay:'shadow',draggable:false,close:false,modal:true,zIndex:1000});YAHOO.ll.wait.widget.setBody('<{$tpl.images.loading}>');YAHOO.ll.wait.widget.showMaskEvent.subscribe(fixMask,YAHOO.ll.wait.widget,true);YAHOO.ll.wait.widget.hideEvent.subscribe(fixHide,YAHOO.ll.wait.widget,true);});

var fx=new Object();fx.Base=function(){};fx.Base.prototype={setOptions:function(options){this.options={duration:500,onComplete:'',transition:fx.sinoidal}
Object.extend(this.options,options||{});},step:function(){var time=(new Date).getTime();if(time>=this.options.duration+this.startTime){this.now=this.to;clearInterval(this.timer);this.timer=null;if(this.options.onComplete)setTimeout(this.options.onComplete.bind(this),10);}
else{var Tpos=(time-this.startTime)/(this.options.duration);this.now=this.options.transition(Tpos)*(this.to-this.from)+this.from;}
this.increase();},custom:function(from,to){if(this.timer!=null)return;this.from=from;this.to=to;this.startTime=(new Date).getTime();this.timer=setInterval(this.step.bind(this),13);},hide:function(){this.now=0;this.increase();},clearTimer:function(){clearInterval(this.timer);this.timer=null;}}
fx.Layout=Class.create();fx.Layout.prototype=Object.extend(new fx.Base(),{initialize:function(el,options){this.el=$(el);this.el.style.overflow="hidden";this.iniWidth=this.el.offsetWidth;this.iniHeight=this.el.offsetHeight;this.setOptions(options);}});fx.Height=Class.create();Object.extend(Object.extend(fx.Height.prototype,fx.Layout.prototype),{increase:function(){this.el.style.height=this.now+"px";},toggle:function(){if(this.el.offsetHeight>0)this.custom(this.el.offsetHeight,0);else this.custom(0,this.el.scrollHeight);}});fx.Width=Class.create();Object.extend(Object.extend(fx.Width.prototype,fx.Layout.prototype),{increase:function(){this.el.style.width=this.now+"px";},toggle:function(){if(this.el.offsetWidth>0)this.custom(this.el.offsetWidth,0);else this.custom(0,this.iniWidth);}});fx.Opacity=Class.create();fx.Opacity.prototype=Object.extend(new fx.Base(),{initialize:function(el,options){this.el=$(el);this.now=1;this.increase();this.setOptions(options);},increase:function(){if(this.now==1&&(/Firefox/.test(navigator.userAgent)))this.now=0.9999;this.setOpacity(this.now);},setOpacity:function(opacity){if(opacity==0&&this.el.style.visibility!="hidden")this.el.style.visibility="hidden";else if(this.el.style.visibility!="visible")this.el.style.visibility="visible";if(window.ActiveXObject)this.el.style.filter="alpha(opacity="+opacity*100+")";this.el.style.opacity=opacity;},toggle:function(){if(this.now>0)this.custom(1,0);else this.custom(0,1);}});fx.sinoidal=function(pos){return((-Math.cos(pos*Math.PI)/2)+0.5);}
fx.linear=function(pos){return pos;}
fx.cubic=function(pos){return Math.pow(pos,3);}
fx.circ=function(pos){return Math.sqrt(pos);}

var fileLoadingImage="<{$lightbox_loading}>";var fileBottomNavCloseImage="<{$lightbox_close}>";var resizeSpeed=6;var borderSize=10;var imageArray=new Array;var activeImage;if(resizeSpeed>10){resizeSpeed=10;}
if(resizeSpeed<1){resizeSpeed=1;}
resizeDuration=(11-resizeSpeed)*100;Object.extend(Element,{hide:function(){for(var i=0;i<arguments.length;i++){var element=$(arguments[i]);element.style.display='none';}},show:function(){for(var i=0;i<arguments.length;i++){var element=$(arguments[i]);element.style.display='';}},getWidth:function(element){element=$(element);return element.offsetWidth;},setWidth:function(element,w){element=$(element);element.style.width=w+"px";},getHeight:function(element){element=$(element);return element.offsetHeight;},setHeight:function(element,h){element=$(element);element.style.height=h+"px";},setTop:function(element,t){element=$(element);element.style.top=t+"px";},setSrc:function(element,src){element=$(element);element.src=src;},setInnerHTML:function(element,content){element=$(element);element.innerHTML=content;}});Array.prototype.removeDuplicates=function(){for(i=1;i<this.length;i++){if(this[i][0]==this[i-1][0]){this.splice(i,1);}}}
Array.prototype.empty=function(){for(i=0;i<=this.length;i++){this.shift();}}
var Lightbox=Class.create();Lightbox.prototype={initialize:function(){var objBody=document.getElementsByTagName("body").item(0);var objOverlay=document.createElement("div");objOverlay.setAttribute('id','overlay');YAHOO.util.Event.addListener(objOverlay,'click',function(e){myLightbox.end();YAHOO.util.Event.stopEvent(e);});objBody.appendChild(objOverlay);var objLightbox=document.createElement("div");objLightbox.setAttribute('id','lightbox');objLightbox.style.display='none';objBody.appendChild(objLightbox);var objOuterImageContainer=document.createElement("div");objOuterImageContainer.setAttribute('id','outerImageContainer');objLightbox.appendChild(objOuterImageContainer);var objImageContainer=document.createElement("div");objImageContainer.setAttribute('id','imageContainer');objOuterImageContainer.appendChild(objImageContainer);var objLightboxImage=document.createElement("img");objLightboxImage.setAttribute('id','lightboxImage');objImageContainer.appendChild(objLightboxImage);var objHoverNav=document.createElement("div");objHoverNav.setAttribute('id','hoverNav');objImageContainer.appendChild(objHoverNav);var objPrevLink=document.createElement("a");objPrevLink.setAttribute('id','prevLink');objPrevLink.setAttribute('href','#');objHoverNav.appendChild(objPrevLink);YAHOO.util.Event.addListener('prevLink','click',function(e){myLightbox.changeImage(activeImage-1);YAHOO.util.Event.stopEvent(e);});var objNextLink=document.createElement("a");objNextLink.setAttribute('id','nextLink');objNextLink.setAttribute('href','#');objHoverNav.appendChild(objNextLink);YAHOO.util.Event.addListener('nextLink','click',function(e){myLightbox.changeImage(activeImage+1);YAHOO.util.Event.stopEvent(e);});var objLoading=document.createElement("div");objLoading.setAttribute('id','loading');objImageContainer.appendChild(objLoading);var objLoadingLink=document.createElement("a");objLoadingLink.setAttribute('id','loadingLink');objLoadingLink.setAttribute('href','#');YAHOO.util.Event.addListener(objLoadingLink,'click',function(e){myLightbox.end();YAHOO.util.Event.stopEvent(e);});objLoading.appendChild(objLoadingLink);var objLoadingImage=document.createElement("img");objLoadingImage.setAttribute('src',fileLoadingImage);objLoadingLink.appendChild(objLoadingImage);var objImageDataContainer=document.createElement("div");objImageDataContainer.setAttribute('id','imageDataContainer');objImageDataContainer.className='clearfix';objLightbox.appendChild(objImageDataContainer);var objImageData=document.createElement("div");objImageData.setAttribute('id','imageData');objImageDataContainer.appendChild(objImageData);var objImageDetails=document.createElement("div");objImageDetails.setAttribute('id','imageDetails');objImageData.appendChild(objImageDetails);var objCaption=document.createElement("span");objCaption.setAttribute('id','caption');objImageDetails.appendChild(objCaption);var objNumberDisplay=document.createElement("span");objNumberDisplay.setAttribute('id','numberDisplay');objImageDetails.appendChild(objNumberDisplay);var objBottomNav=document.createElement("div");objBottomNav.setAttribute('id','bottomNav');objImageData.appendChild(objBottomNav);var objBottomNavCloseLink=document.createElement("a");objBottomNavCloseLink.setAttribute('id','bottomNavClose');objBottomNavCloseLink.setAttribute('href','#');YAHOO.util.Event.addListener(objBottomNavCloseLink,'click',function(e){myLightbox.end();YAHOO.util.Event.stopEvent(e);});objBottomNav.appendChild(objBottomNavCloseLink);var objBottomNavCloseImage=document.createElement("img");objBottomNavCloseImage.setAttribute('src',fileBottomNavCloseImage);objBottomNavCloseLink.appendChild(objBottomNavCloseImage);overlayEffect=new fx.Opacity(objOverlay,{duration:300});overlayEffect.hide();imageEffect=new fx.Opacity(objLightboxImage,{duration:350,onComplete:function(){imageDetailsEffect.custom(0,1);}});imageEffect.hide();imageDetailsEffect=new fx.Opacity('imageDataContainer',{duration:400,onComplete:function(){navEffect.custom(0,1);}});imageDetailsEffect.hide();navEffect=new fx.Opacity('hoverNav',{duration:100});navEffect.hide();},start:function(imageLink){hideSelectBoxes();if(imageLink.tagName.toUpperCase()=='IMG')
{imageLink=imageLink.parentNode;}
var arrayPageSize=getPageSize();Element.setHeight('overlay',arrayPageSize[1]);overlayEffect.custom(0,0.8);imageArray=[];imageNum=0;var anchors=YAHOO.util.Dom.getElementsBy(function(){return true;},'A',imageLink.parentNode);if((imageLink.getAttribute('rel')=='lightbox')){imageArray.push(new Array(imageLink.getAttribute('href'),imageLink.getAttribute('title')));}else{for(var i=0;i<anchors.length;i++){var anchor=anchors[i];if(anchor.getAttribute('href')&&(anchor.getAttribute('rel')==imageLink.getAttribute('rel'))){imageArray.push(new Array(anchor.getAttribute('href'),anchor.getAttribute('title')));}}
imageArray.removeDuplicates();while(imageArray[imageNum][0]!=imageLink.getAttribute('href')){imageNum++;}}
var arrayPageSize=getPageSize();var arrayPageScroll=getPageScroll();var lightboxTop=arrayPageScroll[1]+(arrayPageSize[3]/15);Element.setTop('lightbox',lightboxTop);Element.show('lightbox');this.changeImage(imageNum);},changeImage:function(imageNum){activeImage=imageNum;Element.show('loading');imageDetailsEffect.hide();imageEffect.hide();navEffect.hide();Element.hide('prevLink');Element.hide('nextLink');Element.hide('numberDisplay');imgPreloader=new Image();imgPreloader.onload=function(){Element.setSrc('lightboxImage',imageArray[activeImage][0]);myLightbox.resizeImageContainer(imgPreloader.width,imgPreloader.height);};imgPreloader.src=imageArray[activeImage][0];},resizeImageContainer:function(imgWidth,imgHeight){this.wCur=Element.getWidth('outerImageContainer');this.hCur=Element.getHeight('outerImageContainer');wDiff=(this.wCur-borderSize*2)-imgWidth;hDiff=(this.hCur-borderSize*2)-imgHeight;reHeight=new fx.Height('outerImageContainer',{duration:resizeDuration});reHeight.custom(Element.getHeight('outerImageContainer'),imgHeight+(borderSize*2));reWidth=new fx.Width('outerImageContainer',{duration:resizeDuration,onComplete:function(){imageEffect.custom(0,1);}});reWidth.custom(Element.getWidth('outerImageContainer'),imgWidth+(borderSize*2));if((hDiff==0)&&(wDiff==0)){if(navigator.appVersion.indexOf("MSIE")!=-1){pause(250);}else{pause(100);}}
Element.setHeight('prevLink',imgHeight);Element.setHeight('nextLink',imgHeight);Element.setWidth('imageDataContainer',imgWidth+(borderSize*2));Element.setWidth('hoverNav',imgWidth+(borderSize*2));this.showImage();},showImage:function(){Element.hide('loading');myLightbox.updateDetails();this.preloadNeighborImages();},updateDetails:function(){Element.show('caption');Element.setInnerHTML('caption',imageArray[activeImage][1]);if(imageArray.length>1){Element.show('numberDisplay');Element.setInnerHTML('numberDisplay',"Image "+eval(activeImage+1)+" of "+imageArray.length);}
myLightbox.updateNav();},updateNav:function(){if(activeImage!=0){Element.show('prevLink');}
if(activeImage!=(imageArray.length-1)){Element.show('nextLink');}
this.enableKeyboardNav();},enableKeyboardNav:function(){YAHOO.util.Event.addListener(document,'keydown',this.keyboardAction);},disableKeyboardNav:function(){YAHOO.util.Event.removeListener(document,'keydown',this.keyboardAction);},keyboardAction:function(e){if(e==null){keycode=event.keyCode;}else{keycode=e.which;}
key=String.fromCharCode(keycode).toLowerCase();if((key=='x')||(key=='o')||(key=='c')){myLightbox.end();}else if(key=='p'){if(activeImage!=0){myLightbox.disableKeyboardNav();myLightbox.changeImage(activeImage-1);}}else if(key=='n'){if(activeImage!=(imageArray.length-1)){myLightbox.disableKeyboardNav();myLightbox.changeImage(activeImage+1);}}},preloadNeighborImages:function(){if((imageArray.length-1)>activeImage){preloadNextImage=new Image();preloadNextImage.src=imageArray[activeImage+1][0];}
if(activeImage>0){preloadPrevImage=new Image();preloadPrevImage.src=imageArray[activeImage-1][0];}},end:function(){this.disableKeyboardNav();Element.hide('lightbox');imageEffect.toggle();overlayEffect.custom(0.8,0);showSelectBoxes();}}
function getPageScroll(){var yScroll;if(self.pageYOffset){yScroll=self.pageYOffset;}else if(document.documentElement&&document.documentElement.scrollTop){yScroll=document.documentElement.scrollTop;}else if(document.body){yScroll=document.body.scrollTop;}
arrayPageScroll=new Array('',yScroll)
return arrayPageScroll;}
function getPageSize(){var xScroll,yScroll;if(window.innerHeight&&window.scrollMaxY){xScroll=document.body.scrollWidth;yScroll=window.innerHeight+window.scrollMaxY;}else if(document.body.scrollHeight>document.body.offsetHeight){xScroll=document.body.scrollWidth;yScroll=document.body.scrollHeight;}else{xScroll=document.body.offsetWidth;yScroll=document.body.offsetHeight;}
var windowWidth,windowHeight;if(self.innerHeight){windowWidth=self.innerWidth;windowHeight=self.innerHeight;}else if(document.documentElement&&document.documentElement.clientHeight){windowWidth=document.documentElement.clientWidth;windowHeight=document.documentElement.clientHeight;}else if(document.body){windowWidth=document.body.clientWidth;windowHeight=document.body.clientHeight;}
if(yScroll<windowHeight){pageHeight=windowHeight;}else{pageHeight=yScroll;}
if(xScroll<windowWidth){pageWidth=windowWidth;}else{pageWidth=xScroll;}
arrayPageSize=new Array(pageWidth,pageHeight,windowWidth,windowHeight)
return arrayPageSize;}
function getKey(e){if(e==null){keycode=event.keyCode;}else{keycode=e.which;}
key=String.fromCharCode(keycode).toLowerCase();if(key=='x'){}}
function listenKey(){YAHOO.util.Event.addListener(document,'keypress',getKey);}
function showSelectBoxes(){selects=document.getElementsByTagName("select");for(i=0;i!=selects.length;i++){selects[i].style.visibility="visible";}}
function hideSelectBoxes(){selects=document.getElementsByTagName("select");for(i=0;i!=selects.length;i++){selects[i].style.visibility="hidden";}}
function pause(numberMillis){var now=new Date();var exitTime=now.getTime()+numberMillis;while(true){now=new Date();if(now.getTime()>exitTime)
return;}}
function initLightbox(){myLightbox=new Lightbox();}

var RUZEE=window.RUZEE||{};RUZEE.ShadedBorder={create:function(opts){var isie=/msie/i.test(navigator.userAgent)&&!window.opera;function sty(el,h){for(k in h){if(/ie_/.test(k)){if(isie)el.style[k.substr(3)]=h[k];}else el.style[k]=h[k];}}
function crdiv(h){var el=document.createElement("div");el.className="sb-gen";sty(el,h);return el;}
function op(v){v=v<0?0:v;v=v>0.99999?0.99999:v;if(isie){return" filter:alpha(opacity="+(v*100)+");";}else{return" opacity:"+v+';';}}
var sr=opts.shadow||0;var r=opts.corner||0;var bor=0;var bow=opts.border||0;var shadow=sr!=0;var lw=r>sr?r:sr;var rw=lw;var th=lw;var bh=lw;if(bow>0){bor=r;r=r-bow;}
var cx=r!=0&&shadow?Math.round(lw/3):0;var cy=cx;var cs=Math.round(cx/2);var iclass=r>0?"sb-inner":"sb-shadow";var sclass="sb-shadow";var bclass="sb-border";var edges=opts.edges||"trlb";if(!/t/i.test(edges))th=0;if(!/b/i.test(edges))bh=0;if(!/l/i.test(edges))lw=0;if(!/r/i.test(edges))rw=0;var p={position:"absolute",left:"0",top:"0",width:lw+"px",height:th+"px",ie_fontSize:"1px",overflow:"hidden"};var tl=crdiv(p);delete p.left;p.right="0";p.width=rw+"px";var tr=crdiv(p);delete p.top;p.bottom="0";p.height=bh+"px";var br=crdiv(p);delete p.right;p.left="0";p.width=lw+"px";var bl=crdiv(p);var tw=crdiv({position:"absolute",width:"100%",height:th+"px",ie_fontSize:"1px",top:"0",left:"0",overflow:"hidden"});var t=crdiv({position:"relative",height:th+"px",ie_fontSize:"1px",marginLeft:lw+"px",marginRight:rw+"px",overflow:"hidden"});tw.appendChild(t);var bw=crdiv({position:"absolute",left:"0",bottom:"0",width:"100%",height:bh+"px",ie_fontSize:"1px",overflow:"hidden"});var b=crdiv({position:"relative",height:bh+"px",ie_fontSize:"1px",marginLeft:lw+"px",marginRight:rw+"px",overflow:"hidden"});bw.appendChild(b);var mw=crdiv({position:"absolute",top:(-bh)+"px",left:"0",width:"100%",height:"100%",overflow:"hidden",ie_fontSize:"1px"});function corner(el,t,l){var w=l?lw:rw;var h=t?th:bh;var s=t?cs:-cs;var dsb=[];var dsi=[];var dss=[];var xp=0;var xd=1;if(l){xp=w-1;xd=-1;}
for(var x=0;x<w;++x){var yp=0;var yd=1;if(t){yp=h-1;yd=-1;}
for(var y=0;y<h;++y){var div='<div style="position:absolute; top:'+yp+'px; left:'+xp+'px; '+'width:1px; height:1px; overflow:hidden;';var xc=x-cx;var yc=y-cy-s;var d=Math.sqrt(xc*xc+yc*yc);var doShadow=false;if(r>0){if(xc<0&&yc<bor&&yc>=r||yc<0&&xc<bor&&xc>=r){dsb.push(div+'" class="'+bclass+'"></div>');}else
if(d<bor&&d>=r-1&&xc>=0&&yc>=0){var dd=div;if(d>=bor-1){dd+=op(bor-d);doShadow=true;}
dsb.push(dd+'" class="'+bclass+'"></div>');}
var dd=div+' z-index:2;';if(xc<0&&yc<r||yc<0&&xc<r){dsi.push(dd+'" class="'+iclass+'"></div>');}else
if(d<r&&xc>=0&&yc>=0){if(d>=r-1){dd+=op(r-d);doShadow=true;}
dsi.push(dd+'" class="'+iclass+'"></div>');}else doShadow=true;}else doShadow=true;if(sr>0&&doShadow){d=Math.sqrt(x*x+y*y);if(d<sr){dss.push(div+' z-index:0; '+op(1-(d/sr))+'" class="'+sclass+'"></div>');}}
yp+=yd;}
xp+=xd;}
el.innerHTML=dss.concat(dsb.concat(dsi)).join('');}
function mid(mw){var ds=[];ds.push('<div style="position:relative; top:'+(th+bh)+'px;'+' height:10000px; margin-left:'+(lw-r-cx)+'px;'+' margin-right:'+(rw-r-cx)+'px; overflow:hidden;"'+' class="'+iclass+'"></div>');var dd='<div style="position:absolute; width:1px;'+' top:'+(th+bh)+'px; height:10000px;';for(var x=0;x<lw-r-cx;++x){ds.push(dd+' left:'+x+'px;'+op((x+1.0)/lw)+'" class="'+sclass+'"></div>');}
for(var x=0;x<rw-r-cx;++x){ds.push(dd+' right:'+x+'px;'+op((x+1.0)/rw)+'" class="'+sclass+'"></div>');}
if(bow>0){var su=' width:'+bow+'px;'+'" class="'+bclass+'"></div>';ds.push(dd+' left:'+(lw-bor-cx)+'px;'+su);ds.push(dd+' right:'+(rw-bor-cx)+'px;'+su);}
mw.innerHTML=ds.join('');}
function tb(el,t){var ds=[];var h=t?th:bh;var dd='<div style="height:1px; overflow:hidden; position:absolute;'+' width:100%; left:0px; ';var s=t?cs:-cs;for(var y=0;y<h-s-cy-r;++y){ds.push(dd+(t?'top:':'bottom:')+y+'px;'+op((y+1)*1.0/h)+'" class="'+sclass+'"></div>');}
if(y>=bow){ds.push(dd+(t?'top:':'bottom:')+(y-bow)+'px;'+' height:'+bow+'px;" class="'+bclass+'"></div>');}
ds.push(dd+(t?'top:':'bottom:')+y+'px;'+' height:'+(r+cy+s)+'px;" class="'+iclass+'"></div>');el.innerHTML=ds.join('');}
corner(tl,true,true);corner(tr,true,false);corner(bl,false,true);corner(br,false,false);mid(mw);tb(t,true);tb(b,false);return{render:function(el,skipChange){if(typeof el=='string')el=document.getElementById(el);if(el.length!=undefined){for(var i=0;i<el.length;++i)this.render(el[i]);return;}
var node=el.firstChild;if(!skipChange)
{while(node){var nextNode=node.nextSibling;if(node.nodeType==1&&node.className=='sb-gen')
el.removeChild(node);node=nextNode;}}
var iel=el.firstChild;var twc=tw.cloneNode(true);var mwc=mw.cloneNode(true);var bwc=bw.cloneNode(true);el.insertBefore(tl.cloneNode(true),iel);el.insertBefore(tr.cloneNode(true),iel);el.insertBefore(bl.cloneNode(true),iel);el.insertBefore(br.cloneNode(true),iel);el.insertBefore(twc,iel);el.insertBefore(mwc,iel);el.insertBefore(bwc,iel);if(isie){function resize(){twc.style.width=bwc.style.width=mwc.style.width=el.offsetWidth+"px";mwc.style.height=el.offsetHeight+"px";}
el.onresize=resize;resize();}}};}}

YAHOO.ll.page=YAHOO.util.Dom.get('page-content');YAHOO.ll.sidebar=YAHOO.util.Dom.get('sidebar-content');var myLightbox={};var previousHeight=0;var onRenderEndedInterval;function onRenderEnded()
{var currentHeight=YAHOO.util.Dom.getDocumentHeight();if(previousHeight==currentHeight)
{if(currentHeight>2500)
{YAHOO.util.Dom.setStyle(YAHOO.util.Dom.get('page-footer'),'backgroundImage','none');}
else{YAHOO.util.Dom.setStyle(YAHOO.util.Dom.get('page-footer'),'backgroundImage','');}
clearInterval(onRenderEndedInterval);}
else{previousHeight=currentHeight;}}
YAHOO.util.Event.onDOMReady(function(e){if(YAHOO.ll.debug.active)
{YAHOO.ll.debug.time=new Date().getTime();}
YAHOO.ll.event.pageLoad.fire();applyRules(pageRules);applyRules(sidebarRules,'#sidebar-content ');YAHOO.ll.event.pageLoadIndividual.fire();applyRules(pageIndividualRulesDefault);applyRules(pageIndividualRules);if(YAHOO.ll.debug.active)
{YAHOO.ll.debug.eventTime(true);}
pageIndividualRules={};myLightbox=new Lightbox();var related=YAHOO.util.Dom.get('related');if(related)
{var sidebar=YAHOO.util.Dom.get('sidebar-content');var relatedTitle=document.createElement('H2');relatedTitle.innerHTML='Related';related.insertBefore(relatedTitle,related.firstChild);sidebar.insertBefore(related,sidebar.firstChild);YAHOO.util.Dom.addClass(related,'block');sidebar=null;relatedTitle=null;}
related=null;YAHOO.util.Dom.setStyle('custom-doc','visibility','visible');if(YAHOO.ll.debug.active)
{YAHOO.ll.debug.eventTime();}});function applyRules(rules,prefix){if(!prefix)
{prefix="#page-content ";}
for(var selector in rules)
{var selectors=selector.split(', ');for(var i=0;i<selectors.length;i++){selectors[i]=prefix+selectors[i];}
new_selector=selectors.join(', ');list=Ext.DomQuery.select(new_selector);if(!list){continue;}
for(var i=0;element=list[i];i++){rules[selector](element);}
list=null;element=null;}}
