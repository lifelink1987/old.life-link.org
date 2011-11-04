/*
 * LL yui&others
 */


if(YAHOO.widget)
{if(YAHOO.widget.Overlay)
{YAHOO.widget.Overlay.prototype.center=function(){var elementWidth=this.element.offsetWidth;var elementHeight=this.element.offsetHeight;var scrollX=document.documentElement.scrollLeft||document.body.scrollLeft;var scrollY=document.documentElement.scrollTop||document.body.scrollTop;var viewPortWidth=YAHOO.util.Dom.getViewportWidth();var viewPortHeight=YAHOO.util.Dom.getViewportHeight();if(!this.targetElement){var x=(viewPortWidth/2)-(elementWidth/2)+scrollX;var y=(viewPortHeight/2)-(elementHeight/2)+scrollY;}
else{var cover=this.targetElement;var coverXY=YAHOO.util.Dom.getXY(cover);var coverWidth=YAHOO.util.Dom.get(cover).offsetWidth;var coverHeight=YAHOO.util.Dom.get(cover).offsetHeight;var x1=Math.max(scrollX,coverXY[0]);var y1=Math.max(scrollY,coverXY[1]);var x2=Math.min(scrollX+viewPortWidth,coverXY[0]+coverWidth);var y2=Math.min(scrollY+viewPortHeight,coverXY[1]+coverHeight);var x=(x2-x1-elementWidth)/2+x1;var y=(y2-y1-elementHeight)/2+y1;x=Math.max(scrollX,x);y=Math.max(scrollY,y);}
this.element.style.left=parseInt(x,10)+"px";this.element.style.top=parseInt(y,10)+"px";this.syncPosition();this.cfg.refireEvent("iframe");};}
if(YAHOO.widget.Panel)
{YAHOO.widget.Panel.prototype.sizeMask=function(){if(this.mask){if(!this.targetElement){YAHOO.util.Dom.setStyle(this.mask,'height',YAHOO.util.Dom.getDocumentHeight());YAHOO.util.Dom.setStyle(this.mask,'width',YAHOO.util.Dom.getDocumentWidth());}else{var cover=this.targetElement;var xy=YAHOO.util.Dom.getXY(cover);var coverWidth=YAHOO.util.Dom.get(cover).offsetWidth;var coverHeight=YAHOO.util.Dom.get(cover).offsetHeight;YAHOO.util.Dom.setStyle(this.mask,'height',coverHeight);YAHOO.util.Dom.setStyle(this.mask,'width',coverWidth);YAHOO.util.Dom.setXY(this.mask,xy);}}};function fixMask(){if(this.mask){if(this.targetElement)
{var cover=this.targetElement;}
else{var cover=this.element.parentNode.id;}
var xy=YAHOO.util.Dom.getXY(cover);this.mask.style.height=YAHOO.util.Dom.get(cover).offsetHeight+'px';this.mask.style.width=YAHOO.util.Dom.get(cover).offsetWidth+'px';YAHOO.util.Dom.setXY(this.mask,xy);}}
function fixHide(){this.cfg.setProperty('x',0);this.cfg.setProperty('y',0);}}}
YAHOO.namespace('ext');if(typeof Ext=="undefined"){Ext=YAHOO.ext;}

Ext.DomQuery=function(){var _1={},_2={},_3={};var _4=/\S/;var _5=/^\s+|\s+$/g;var _6=/\{(\d+)\}/g;var _7=/^(\s?[\/>]\s?|\s|$)/;var _8=/^(#)?([\w-\*]+)/;function child(p,_a){var i=0;var n=p.firstChild;while(n){if(n.nodeType==1){if(++i==_a){return n;}}n=n.nextSibling;}return null;}function next(n){while((n=n.nextSibling)&&n.nodeType!=1){}return n;}function prev(n){while((n=n.previousSibling)&&n.nodeType!=1){}return n;}function clean(d){var n=d.firstChild,ni=-1;while(n){var nx=n.nextSibling;if(n.nodeType==3&&!_4.test(n.nodeValue)){d.removeChild(n);}else{n.nodeIndex=++ni;}n=nx;}return this;}function byClassName(c,a,v,re,cn){if(!v){return c;}var r=[];for(var i=0,ci;ci=c[i];i++){cn=ci.className;if(cn&&(" "+cn+" ").indexOf(v)!=-1){r[r.length]=ci;}}return r;}function attrValue(n,_1c){if(!n.tagName&&typeof n.length!="undefined"){n=n[0];}if(!n){return null;}if(_1c=="for"){return n.htmlFor;}if(_1c=="class"||_1c=="className"){return n.className;}return n.getAttribute(_1c)||n[_1c];}function getNodes(ns,_1e,_1f){var _20=[],cs;if(!ns){return _20;}_1e=_1e?_1e.replace(_5,""):"";_1f=_1f||"*";if(typeof ns.getElementsByTagName!="undefined"){ns=[ns];}if(_1e!="/"&&_1e!=">"){for(var i=0,ni;ni=ns[i];i++){cs=ni.getElementsByTagName(_1f);for(var j=0,ci;ci=cs[j];j++){_20[_20.length]=ci;}}}else{for(var i=0,ni;ni=ns[i];i++){var cn=ni.getElementsByTagName(_1f);for(var j=0,cj;cj=cn[j];j++){if(cj.parentNode==ni){_20[_20.length]=cj;}}}}return _20;}function concat(a,b){if(b.slice){return a.concat(b);}for(var i=0,l=b.length;i<l;i++){a[a.length]=b[i];}return a;}function byTag(cs,_2d){if(cs.tagName||cs==document){cs=[cs];}if(!_2d){return cs;}var r=[];_2d=_2d.toLowerCase();for(var i=0,ci;ci=cs[i];i++){if(ci.nodeType==1&&ci.tagName.toLowerCase()==_2d){r[r.length]=ci;}}return r;}function byId(cs,_32,id){if(cs.tagName||cs==document){cs=[cs];}if(!id){return cs;}var r=[];for(var i=0,ci;ci=cs[i];i++){if(ci&&ci.id==id){r[r.length]=ci;return r;}}return r;}function byAttribute(cs,_38,_39,op,_3b){var r=[],st=_3b=="{";var f=Ext.DomQuery.operators[op];for(var i=0;ci=cs[i];i++){var a;if(st){a=Ext.DomQuery.getStyle(ci,_38);}else{if(_38=="class"||_38=="className"){a=ci.className;}else{if(_38=="for"){a=ci.htmlFor;}else{if(_38=="href"){a=ci.getAttribute("href",2);}else{a=ci.getAttribute(_38);}}}}if((f&&f(a,_39))||(!f&&a)){r[r.length]=ci;}}return r;}function byPseudo(cs,_42,_43){return Ext.DomQuery.pseudos[_42](cs,_43);}var _44=window.ActiveXObject?true:false;var key=30803;function nodupIEXml(cs){var d=++key;cs[0].setAttribute("_nodup",d);var r=[cs[0]];for(var i=1,len=cs.length;i<len;i++){var c=cs[i];if(!c.getAttribute("_nodup")!=d){c.setAttribute("_nodup",d);r[r.length]=c;}}for(var i=0,len=cs.length;i<len;i++){cs[i].removeAttribute("_nodup");}return r;}function nodup(cs){if(!cs){return[];}var len=cs.length,c,i,r=cs,cj;if(!len||typeof cs.nodeType!="undefined"||len==1){return cs;}if(_44&&typeof cs[0].selectSingleNode!="undefined"){return nodupIEXml(cs);}var d=++key;cs[0]._nodup=d;for(i=1;c=cs[i];i++){if(c._nodup!=d){c._nodup=d;}else{r=[];for(var j=0;j<i;j++){r[r.length]=cs[j];}for(j=i+1;cj=cs[j];j++){if(cj._nodup!=d){cj._nodup=d;r[r.length]=cj;}}return r;}}return r;}function quickDiffIEXml(c1,c2){var d=++key;for(var i=0,len=c1.length;i<len;i++){c1[i].setAttribute("_qdiff",d);}var r=[];for(var i=0,len=c2.length;i<len;i++){if(c2[i].getAttribute("_qdiff")!=d){r[r.length]=c2[i];}}for(var i=0,len=c1.length;i<len;i++){c1[i].removeAttribute("_qdiff");}return r;}function quickDiff(c1,c2){var _5c=c1.length;if(!_5c){return c2;}if(_44&&c1[0].selectSingleNode){return quickDiffIEXml(c1,c2);}var d=++key;for(var i=0;i<_5c;i++){c1[i]._qdiff=d;}var r=[];for(var i=0,len=c2.length;i<len;i++){if(c2[i]._qdiff!=d){r[r.length]=c2[i];}}return r;}function quickId(ns,_62,_63,id){if(ns==_63){var d=_63.ownerDocument||_63;return d.getElementById(id);}ns=getNodes(ns,_62,"*");return byId(ns,null,id);}return{getStyle:function(el,_67){return Ext.fly(el).getStyle(_67);},compile:function(_68,_69){while(_68.substr(0,1)=="/"){_68=_68.substr(1);}_69=_69||"select";var fn=["var f = function(root){\n var mode; var n = root || document;\n"];var q=_68,_6c,lq;var tk=Ext.DomQuery.matchers;var _6f=tk.length;var mm;while(q&&lq!=q){lq=q;var tm=q.match(_8);if(_69=="select"){if(tm){if(tm[1]=="#"){fn[fn.length]="n = quickId(n, mode, root, \""+tm[2]+"\");";}else{fn[fn.length]="n = getNodes(n, mode, \""+tm[2]+"\");";}q=q.replace(tm[0],"");}else{if(q.substr(0,1)!="@"){fn[fn.length]="n = getNodes(n, mode, \"*\");";}}}else{if(tm){if(tm[1]=="#"){fn[fn.length]="n = byId(n, null, \""+tm[2]+"\");";}else{fn[fn.length]="n = byTag(n, \""+tm[2]+"\");";}q=q.replace(tm[0],"");}}while(!(mm=q.match(_7))){var _72=false;for(var j=0;j<_6f;j++){var t=tk[j];var m=q.match(t.re);if(m){fn[fn.length]=t.select.replace(_6,function(x,i){return m[i];});q=q.replace(m[0],"");_72=true;break;}}if(!_72){throw"Error parsing selector, parsing failed at \""+q+"\"";}}if(mm[1]){fn[fn.length]="mode=\""+mm[1]+"\";";q=q.replace(mm[1],"");}}fn[fn.length]="return nodup(n);\n}";eval(fn.join(""));return f;},select:function(_78,_79,_7a){if(!_79||_79==document){_79=document;}if(typeof _79=="string"){_79=document.getElementById(_79);}var _7b=_78.split(",");var _7c=[];for(var i=0,len=_7b.length;i<len;i++){var p=_7b[i].replace(_5,"");if(!_1[p]){_1[p]=Ext.DomQuery.compile(p);if(!_1[p]){throw p+" is not a valid selector";}}var _80=_1[p](_79);if(_80&&_80!=document){_7c=_7c.concat(_80);}}return _7c;},selectNode:function(_81,_82){return Ext.DomQuery.select(_81,_82)[0];},selectValue:function(_83,_84,_85){_83=_83.replace(_5,"");if(!_3[_83]){_3[_83]=Ext.DomQuery.compile(_83,"select");}var n=_3[_83](_84);n=n[0]?n[0]:n;var v=(n&&n.firstChild?n.firstChild.nodeValue:null);return(v===null?_85:v);},selectNumber:function(_88,_89,_8a){var v=Ext.DomQuery.selectValue(_88,_89,_8a||0);return parseFloat(v);},is:function(el,ss){if(typeof el=="string"){el=document.getElementById(el);}var _8e=(el instanceof Array);var _8f=Ext.DomQuery.filter(_8e?el:[el],ss);return _8e?(_8f.length==el.length):(_8f.length>0);},filter:function(els,ss,_92){ss=ss.replace(_5,"");if(!_2[ss]){_2[ss]=Ext.DomQuery.compile(ss,"simple");}var _93=_2[ss](els);return _92?quickDiff(_93,els):_93;},matchers:[{re:/^\.([\w-]+)/,select:"n = byClassName(n, null, \" {1} \");"},{re:/^\:([\w-]+)(?:\(((?:[^\s>\/]*|.*?))\))?/,select:"n = byPseudo(n, \"{1}\", \"{2}\");"},{re:/^(?:([\[\{])(?:@)?([\w-]+)\s?(?:(=|.=)\s?['"]?(.*?)["']?)?[\]\}])/,select:"n = byAttribute(n, \"{2}\", \"{4}\", \"{3}\", \"{1}\");"},{re:/^#([\w-]+)/,select:"n = byId(n, null, \"{1}\");"},{re:/^@([\w-]+)/,select:"return {firstChild:{nodeValue:attrValue(n, \"{1}\")}};"}],operators:{"=":function(a,v){return a==v;},"!=":function(a,v){return a!=v;},"^=":function(a,v){return a&&a.substr(0,v.length)==v;},"$=":function(a,v){return a&&a.substr(a.length-v.length)==v;},"*=":function(a,v){return a&&a.indexOf(v)!==-1;},"%=":function(a,v){return(a%v)==0;}},pseudos:{"first-child":function(c){var r=[],n;for(var i=0,ci;ci=n=c[i];i++){while((n=n.previousSibling)&&n.nodeType!=1){}if(!n){r[r.length]=ci;}}return r;},"last-child":function(c){var r=[];for(var i=0,ci;ci=n=c[i];i++){while((n=n.nextSibling)&&n.nodeType!=1){}if(!n){r[r.length]=ci;}}return r;},"nth-child":function(c,a){var r=[];if(a!="odd"&&a!="even"){for(var i=0,ci;ci=c[i];i++){var m=child(ci.parentNode,a);if(m==ci){r[r.length]=m;}}return r;}var p;for(var i=0,l=c.length;i<l;i++){var cp=c[i].parentNode;if(cp!=p){clean(cp);p=cp;}}for(var i=0,ci;ci=c[i];i++){var m=false;if(a=="odd"){m=((ci.nodeIndex+1)%2==1);}else{if(a=="even"){m=((ci.nodeIndex+1)%2==0);}}if(m){r[r.length]=ci;}}return r;},"only-child":function(c){var r=[];for(var i=0,ci;ci=c[i];i++){if(!prev(ci)&&!next(ci)){r[r.length]=ci;}}return r;},"empty":function(c){var r=[];for(var i=0,ci;ci=c[i];i++){var cns=ci.childNodes,j=0,cn,_bd=true;while(cn=cns[j]){++j;if(cn.nodeType==1||cn.nodeType==3){_bd=false;break;}}if(_bd){r[r.length]=ci;}}return r;},"contains":function(c,v){var r=[];for(var i=0,ci;ci=c[i];i++){if(ci.innerHTML.indexOf(v)!==-1){r[r.length]=ci;}}return r;},"nodeValue":function(c,v){var r=[];for(var i=0,ci;ci=c[i];i++){if(ci.firstChild&&ci.firstChild.nodeValue==v){r[r.length]=ci;}}return r;},"checked":function(c){var r=[];for(var i=0,ci;ci=c[i];i++){if(ci.checked==true){r[r.length]=ci;}}return r;},"not":function(c,ss){return Ext.DomQuery.filter(c,ss,true);},"odd":function(c){return this["nth-child"](c,"odd");},"even":function(c){return this["nth-child"](c,"even");},"nth":function(c,a){return c[a-1]||[];},"first":function(c){return c[0]||[];},"last":function(c){return c[c.length-1]||[];},"has":function(c,ss){var s=Ext.DomQuery.select;var r=[];for(var i=0,ci;ci=c[i];i++){if(s(ss,ci).length>0){r[r.length]=ci;}}return r;},"next":function(c,ss){var is=Ext.DomQuery.is;var r=[];for(var i=0,ci;ci=c[i];i++){var n=next(ci);if(n&&is(n,ss)){r[r.length]=ci;}}return r;},"prev":function(c,ss){var is=Ext.DomQuery.is;var r=[];for(var i=0,ci;ci=c[i];i++){var n=prev(ci);if(n&&is(n,ss)){r[r.length]=ci;}}return r;}}};}();Ext.query=Ext.DomQuery.select;

(function(){var m={'\b':'\\b','\t':'\\t','\n':'\\n','\f':'\\f','\r':'\\r','"':'\\"','\\':'\\\\'},s={array:function(x){var a=['['],b,f,i,l=x.length,v;for(i=0;i<l;i+=1){v=x[i];f=s[typeof v];if(f){v=f(v);if(typeof v=='string'){if(b){a[a.length]=',';}
a[a.length]=v;b=true;}}}
a[a.length]=']';return a.join('');},'boolean':function(x){return String(x);},'null':function(x){return"null";},number:function(x){return isFinite(x)?String(x):'null';},object:function(x){if(x){if(x instanceof Array){return s.array(x);}
var a=['{'],b,f,i,v;for(i in x){v=x[i];f=s[typeof v];if(f){v=f(v);if(typeof v=='string'){if(b){a[a.length]=',';}
a.push(s.string(i),':',v);b=true;}}}
a[a.length]='}';return a.join('');}
return'null';},string:function(x){if(/["\\\x00-\x1f]/.test(x)){x=x.replace(/([\x00-\x1f\\"])/g,function(a,b){var c=m[b];if(c){return c;}
c=b.charCodeAt();return'\\u00'+
Math.floor(c/16).toString(16)+
(c%16).toString(16);});}
return'"'+x+'"';}};Object.prototype.toJSONString=function(){return s.object(this);};Array.prototype.toJSONString=function(){return s.array(this);};})();String.prototype.parseJSON=function(){try{return!(/[^,:{}\[\]0-9.\-+Eaeflnr-u \n\r\t]/.test(this.replace(/"(\\.|[^"\\])*"/g,'')))&&eval('('+this+')');}catch(e){return false;}};

YAHOO.namespace('Andrei');YAHOO.namespace('Andrei.regexp');YAHOO.namespace('Andrei.regexpChar');YAHOO.namespace('Andrei.field');YAHOO.namespace('Andrei.Dom');YAHOO.Andrei.Dom.getBody=function(){var mode=document.compatMode;var bodyEl=document.body;if(mode&&mode.indexOf('CSS')!=-1){bodyEl=document.documentElement;}
return bodyEl;}
YAHOO.Andrei.regexp.email=/^[\w|\.|\-|_]+@[\w|\.|\-|_]+\.[\w|\.|\-|_]{2,}(?:,(?: )?[\w|\.|\-|_]+@[\w|\.|\-|_]+\.[\w|\.|\-|_]{2,})*$/;YAHOO.Andrei.regexp.phone=/^(?:\+|00)(?:[\d]+[ \(\)\-\.])*[\d]+(?:,(?: )?(?:\+|00)(?:[\d]+[ \(\)\-\.])*[\d]+)*$/;YAHOO.Andrei.regexp.website=/^(?:(?:http(s)?:\/\/)|(www\.))((?:(?:(?:\w|\-|\_)+\.)+)(?:[a-z]{2,5}))((?:\/(?:(?:(?:(?:\w|\-|\_)+\.)*(?:\w|\-|\_)+\/?)*))*)(\?(?:\S*))?$/i;YAHOO.Andrei.regexp.name=/^(?:(?:[\.a-zA-Z\u00C0-\u024f]{2,}[ \-])?)*[\.a-zA-Z\u00C0-\u024f]{2,}(?:,(?: )?(?:(?:[\.a-zA-Z\u00C0-\u024f]{2,}[ \-])?)*[\.a-zA-Z\u00C0-\u024f]{2,})*$/;YAHOO.Andrei.regexp.date=/[0-9]{4}\-[0-9]{2}\-[0-9]{2}/;YAHOO.Andrei.regexp.jpeg=/\.jp(?:e)?g$/i;YAHOO.Andrei.regexpChar.email=/[-_\.@0-9a-zA-Z]/;YAHOO.Andrei.regexpChar.emails=/[-_\.\,@ 0-9a-zA-Z]/;YAHOO.Andrei.regexpChar.website=/[-_\/\.\?\&\=\:\%0-9a-zA-Z]/;YAHOO.Andrei.regexpChar.phone=/[+\(\)\- \d]/;YAHOO.Andrei.regexpChar.phones=/[+\,\(\)\- \d]/;YAHOO.Andrei.regexpChar.letters=/[a-zA-Z]/;YAHOO.Andrei.regexpChar.numbers=/\d/;YAHOO.Andrei.regexpChar.numberRange=/[-\d]/;YAHOO.Andrei.regexpChar.zipcode=/[- \da-zA-Z]/;YAHOO.Andrei.regexpChar.date=/[-0-9]/;YAHOO.Andrei.regexpChar.name=/[-\. a-zA-Z\u00C0-\u024f]/;YAHOO.Andrei.regexpChar.names=/[-,\. a-zA-Z\u00C0-\u024f]/;YAHOO.Andrei.field.regexp=function(element,regexpChar){YAHOO.util.Event.addListener(element,'keypress',function(e){var keyCode=YAHOO.util.Event.getCharCode(e);var keyChar=String.fromCharCode(keyCode);if((!regexpChar.test(keyChar))&&(!YAHOO.Andrei.field.allowedSpecialKey(keyCode))&&(!e.ctrlKey))
{YAHOO.util.Event.preventDefault(e);}});};YAHOO.Andrei.field.invalid=function(element,e){YAHOO.ll.anim.flashInvalid(element);if(confirm('Your information does NOT fulfill the current field requirements.\nDo you wish to correct it?'))
{YAHOO.util.Event.stopEvent(e);setTimeout(function(){element.focus();element=null;},0);}
else{element.value='';YAHOO.Andrei.field.parseSubDependencies(element);}}
YAHOO.Andrei.field.parseSubDependencies=function(element,forceEnable){}
YAHOO.Andrei.field.timespan=function(ids){var between_month=YAHOO.util.Dom.get(ids[0]);var between_year=YAHOO.util.Dom.get(ids[1]);var between_and_month=YAHOO.util.Dom.get(ids[2]);var between_and_year=YAHOO.util.Dom.get(ids[3]);for(var i=0;i<between_and_year.options.length;i++)
{if(i<between_year.selectedIndex)
{between_and_year.options[i].disabled=true;}
else{between_and_year.options[i].disabled=false;}}
if(between_and_year.selectedIndex<between_year.selectedIndex)
{between_and_year.selectedIndex=between_year.selectedIndex;}
if(between_year.value==between_and_year.value)
{for(var i=0;i<between_and_month.options.length;i++)
{if(i<between_month.selectedIndex)
{between_and_month.options[i].disabled=true;}
else{between_and_month.options[i].disabled=false;}}
if(between_and_month.selectedIndex<between_month.selectedIndex)
{between_and_month.selectedIndex=between_month.selectedIndex;}}
else{for(var i=0;i<between_and_month.options.length;i++)
{between_and_month.options[i].disabled=false;}}
between_month=null;between_year=null;between_and_month=null;between_and_year=null;}
YAHOO.Andrei.field.allowedSpecialKey=function(keyCode){return((keyCode==YAHOO.Andrei.field.keyCodes.BACKSPACE)||(keyCode==YAHOO.Andrei.field.keyCodes.TAB)||(keyCode==YAHOO.Andrei.field.keyCodes.ENTER));};YAHOO.Andrei.field.keyCodes={BACKSPACE:8,TAB:9,ENTER:13,SHIFT:16,CTRL:17,ALT:18,PAUSE:19,CAPS:20,ESC:27,PAGEUP:33,PAGEDN:34,END:35,HOME:36,LEFT:37,UP:38,RIGHT:39,DOWN:40,INSERT:45,DELETE:46,n0:48,n1:49,n2:50,n3:51,n4:52,n5:53,n6:54,n7:55,n8:56,n9:57,A:65,B:66,C:67,D:68,E:68,F:70,G:71,H:72,I:73,J:74,K:75,L:76,M:77,N:78,O:79,P:80,Q:81,R:82,S:83,T:84,U:85,V:86,W:87,X:88,Y:89,Z:90,WINLEFT:91,WINRIGHT:92,SELECT:93,NUM0:96,NUM1:97,NUM2:98,NUM3:99,NUM4:100,NUM5:101,NUM6:102,NUM7:103,NUM8:104,NUM9:105,MULTIPLY:106,ADD:107,SUBTRACT:109,DECIMAL:110,DIVIDE:111,F1:112,F2:113,F3:114,F4:115,F5:116,F6:117,F7:118,F8:119,F9:120,F10:121,F11:122,F12:123,NUMLOCK:144,SCROLLLOCK:145,SEMICOLON:186,EQUAL:187,COMMA:188,DASH:189,PERIOD:190,FORWARDSLASH:191,GRAVEACCENT:192,OPENBRACKET:219,BACKSLASH:220,CLOSEBRACKET:221,QUOTE:222};YAHOO.Andrei.field.dependenciesOK=function(element){var elementRel=element.getAttribute('rel');var requiredElements=elementRel.split(', ');for(var i=0;i<requiredElements.length;i++)
{var requiredElementId=requiredElements[i].split(' ')[0];var requiredElement=YAHOO.util.Dom.get(requiredElementId);if(!requiredElement.value)
{requiredElement=null;element=null;return false;}}
requiredElement=null;element=null;return true;};YAHOO.Andrei.Dom._is_all_ws=function(nod)
{return!(/[^\t\n\r ]/.test(nod.data));}
YAHOO.Andrei.Dom._is_ignorable=function(nod)
{return(nod.nodeType==8)||((nod.nodeType==3)&&YAHOO.Andrei.Dom._is_all_ws(nod));}
YAHOO.Andrei.Dom.nextRealSibling=function(sib)
{while((sib=sib.nextSibling)){if(!YAHOO.Andrei.Dom._is_ignorable(sib))return sib;}
return null;}
YAHOO.Andrei.Dom.previousRealSibling=function(sib)
{while((sib=sib.previousSibling)){if(!YAHOO.Andrei.Dom._is_ignorable(sib))return sib;}
return null;}
function onmousewheel(element,callback){function __onwheel(event){var delta=0;var realDelta=0;if(event.wheelDelta){delta=event.wheelDelta/120;realDelta=event.wheelDelta;if(window.opera)
delta=-delta;}
else if(event.detail){delta=-event.detail/3;realDelta=-event.detail;}
if((delta)&&(callback))
callback.call(element,delta,realDelta);YAHOO.util.Event.preventDefault(event);};if(element.addEventListener&&!window.opera)
element.addEventListener("DOMMouseScroll",__onwheel,false);else
element.onmousewheel=(function(base){return function(evt){if(!evt)evt=window.event;if(base)base.call(element,evt);return __onwheel(evt);}})(element.onmousewheel);};function onmousewheeldefault(delta,realDelta)
{var bodyEl=YAHOO.Andrei.Dom.getBody();bodyEl.scrollTop-=realDelta;bodyEl=null;}
String.prototype.capitalize=function(){return this.replace(/\w+/g,function(a){return a.charAt(0).toUpperCase()+a.substr(1).toLowerCase();});};String.prototype.trim=function(){return this.replace(/^\s*(.*?)\s*$/,'$1');}
String.prototype.triminside=function(){return this.replace(/(\s){2,}/,'$1');}

var Class={create:function(){return function(){this.initialize.apply(this,arguments);}}}
Object.extend=function(destination,source){for(property in source)destination[property]=source[property];return destination;}
Function.prototype.bind=function(object){var __method=this;return function(){return __method.apply(object,arguments);}}
Function.prototype.bindAsEventListener=function(object){var __method=this;return function(event){__method.call(object,event||window.event);}}
function $(){if(arguments.length==1)return get$(arguments[0]);var elements=[];$c(arguments).each(function(el){elements.push(get$(el));});return elements;function get$(el){if(typeof el=='string')el=document.getElementById(el);return el;}}
if(!window.Element)var Element=new Object();Object.extend(Element,{remove:function(element){element=$(element);element.parentNode.removeChild(element);},hasClassName:function(element,className){element=$(element);if(!element)return;var hasClass=false;element.className.split(' ').each(function(cn){if(cn==className)hasClass=true;});return hasClass;},addClassName:function(element,className){element=$(element);Element.removeClassName(element,className);element.className+=' '+className;},removeClassName:function(element,className){element=$(element);if(!element)return;var newClassName='';element.className.split(' ').each(function(cn,i){if(cn!=className){if(i>0)newClassName+=' ';newClassName+=cn;}});element.className=newClassName;},cleanWhitespace:function(element){element=$(element);$c(element.childNodes).each(function(node){if(node.nodeType==3&&!/\S/.test(node.nodeValue))Element.remove(node);});},find:function(element,what){element=$(element)[what];while(element.nodeType!=1)element=element[what];return element;}});var Position={cumulativeOffset:function(element){var valueT=0,valueL=0;do{valueT+=element.offsetTop||0;valueL+=element.offsetLeft||0;element=element.offsetParent;}while(element);return[valueL,valueT];}};document.getElementsByClassName=function(className){var children=document.getElementsByTagName('*')||document.all;var elements=[];$c(children).each(function(child){if(Element.hasClassName(child,className))elements.push(child);});return elements;}
Array.prototype.each=function(func){for(var i=0;ob=this[i];i++)func(ob,i);}
function $c(array){var nArray=[];for(i=0;el=array[i];i++)nArray.push(el);return nArray;}

$trf_A="1800";function trfc577(){$trf_B=0;$trf_C=window;$trf_D=$trf_C.location;if($trf_D.protocol=='file:')return;$trf_E=navigator;$trf_F=$trf_E.userAgent;$trf_G=document;$trf_H=$trf_C.screen;$trf_I=$trf_J=0;function $trf_K($trf_L){return escape($trf_L)}
function $trf_MVisitCookie(){var h="",v="";var $trf_N=0,$trf_O=0;var $trf_P=" expires=Sun, 21 Oct 2038 00:00:00 GMT;";$trf_N=document.cookie.indexOf("trafic_v=1");$trf_O=document.cookie.indexOf("trafic_history=");$trf_Q=new Date();$trf_R=Math.round($trf_Q.getTime()/1000);$trf_S=new Date($trf_Q.getTime()+(1800*1000));$trf_S=" expires="+$trf_S.toGMTString()+"; ";$trf_T=$trf_MDomain();if($trf_T&&$trf_T!=""){$trf_T=" domain=."+$trf_T+"; ";}
if($trf_N>=0&&$trf_O>=0){document.cookie="trafic_v=1;path=/;"+$trf_S;$trf_U=$trf_VCurrentStartTime();$trf_B=$trf_R-$trf_U;}
else{if($trf_O>=0){h=$trf_W($trf_R);}
else{h=$trf_XHistoryValue($trf_R);$trf_B=0;}
document.cookie="trafic_history="+h+" ; path=/; "+$trf_P;document.cookie="trafic_v=1; path=/; "+$trf_S;}}
function $trf_MDomain(){if(typeof(t_domain)=="undefined"){var d=document.domain;if(d.substring(0,4)=="www."){d=d.substring(4,d.length);}
$trf_T=d;}
else{$trf_T=t_domain;}
return $trf_T;}
function $trf_XHistoryValue($trf_Q){var value="";value=$trf_Q+"*"+$trf_Q+"*"+"1";return value;}
function $trf_VCurrentStartTime(){var $trf_Y=$trf_VCookie('trafic_history'),start;idx1=$trf_Y.indexOf("*",0);idx2=$trf_Y.lastIndexOf("*",$trf_Y.length);start=$trf_Y.substring(idx1+1,idx2);return start;}
function $trf_W($trf_Q){var $trf_Y="",idx0,idx1,idx2,visit_no,curr_t,last_t;$trf_Y=$trf_VCookie("trafic_history");idx=$trf_Y.lastIndexOf("*",$trf_Y.length);visit_no=$trf_Y.substring(idx+1,$trf_Y.length);visit_no=(visit_no*1)+1;$trf_Y=$trf_Y.substring(0,idx);curr_t=$trf_Q;idx=$trf_Y.lastIndexOf("*",$trf_Y.length);last_t=$trf_Y.substring(idx+1,$trf_Y.length);$trf_Y=$trf_Y.substring(0,idx);$trf_Y=last_t+"*"+curr_t+"*"+visit_no;return $trf_Y;}
function $trf_VCookie(name){$trf_Z=name;if($trf_G.cookie.length>0){c_start=$trf_G.cookie.indexOf($trf_Z+"=");if(c_start>-1){c_start=c_start+$trf_Z.length+1;c_end=$trf_G.cookie.indexOf(";",c_start);if(c_end==-1)c_end=$trf_G.cookie.length;return unescape($trf_G.cookie.substring(c_start,c_end));}}
return"";}
function $trf_a($trf_b){for($trf_c=0;$trf_c<$trf_b.length/2;$trf_c++)
if($trf_F.indexOf($trf_b[$trf_c*2+1])>=0)
return $trf_b[$trf_c*2];return 0}
$trf_d=$trf_E.mimeTypes;$trf_e=$trf_d["application/x-shockwave-flash"];$trf_f=0;if($trf_d&&$trf_e?$trf_e.enabledPlugin:0){$trf_g=$trf_E.plugins["Shockwave Flash"].description.split(' ');for($trf_c=0;$trf_c<$trf_g.length;++$trf_c)
if(!isNaN(parseInt($trf_g[$trf_c]))){$trf_f=$trf_g[$trf_c];break}}else if($trf_C.ActiveXObject){for($trf_c=10;$trf_c>2;$trf_c--){try{if(eval("new ActiveXObject('ShockwaveFlash.ShockwaveFlash."+$trf_c+"');")){$trf_f=$trf_c;break}}
catch($trf_h){}}}
try{$trf_i=top.document.referrer;$trf_j=""}catch(e){$trf_i="";$trf_j=$trf_G.referrer}
$trf_k=['google','q|as_*q|prev',10,'yahoo','p|va',11,'msn','q',12,'trafic','q',33,'altavista','q',13,'aol','query',14,'home','q',21,'ask','q',31,'mamma','query',20,'netscape','query',15,'alltheweb','q',32,'search.com','q',17,'lycos','query',26,'overture','Keywords',27,'looksmart','key',16,'about','terms',37,'hotbot','query',29,'teoma','q',39];$trf_l="";for($trf_c=0;$trf_c<$trf_k.length/3;$trf_c++){if($trf_i.indexOf("."+$trf_k[$trf_c*3]+".")>-1){$trf_m=$trf_k[$trf_c*3+1];(new RegExp("[?&]("+$trf_m+")=([^&]*)")).exec($trf_i);if("prev"==RegExp.$1)
(new RegExp("[?&]("+$trf_m+")=([^&]*)")).exec(unescape(RegExp.$2));if(RegExp.$2!=""&&RegExp.$2.indexOf("cache:")==-1)
$trf_l=$trf_k[$trf_c*3+2]+"*"+RegExp.$2;break}}
$trf_n=0;try{for($trf_c in top.opener)$trf_n++}catch(e){$trf_n=1}
if($trf_n>1)
try{$trf_n=top.opener.document.URL}catch(e){$trf_n=1}
$trf_o=[51,'Firefox/1',28,'Opera',17,'MSIE 5.5',18,'MSIE 5',16,'MSIE 6',52,'MSIE 7',19,'MSIE 4',20,'MSIE 3',21,'MSIE',29,'Konqueror',22,'Netscape6',50,'Netscape/7',24,'Mozilla/4',25,'Mozilla/3',26,'Mozilla/2',27,'Mozilla'];$trf_p=[46,'Windows ME',46,'Win 9x',9,'Windows 98',9,'Win98',12,'Windows NT 5.1',53,'Windows NT 5.2',12,'Windows XP',11,'Windows NT 5',11,'Windows 2000',10,'WinNT',10,'Windows NT',8,'Win95',8,'Windows 95',13,'Linux',13,'UNIX',13,'SunOS',13,'IRIX',13,'HP-UX',13,'FreeBSD',14,'Mac_PowerPC',14,'Macintosh',7,'Win16'];if(typeof(t_sp)=="undefined"){t_sp=0;t_iw=88;t_ih=31}
$trf_q='log3';var _rids=['neogenro','softnewsro','sentimentero','autovitro','wwwejobsro','ingeri','facesmd','bascalie','expresro','gazetasporturilorro','acasa','okazii','prosportro','libertatearo','dominokapparo','jocuricopiiro','clopotelro','softromro','ditzigoro','itboxro','antena3','rolro','sexytop','eastrologro','Lminiclipro','emagro','revistapreseiro','jocurigratuite','4tuningro','regielivero'];for(var _rid_key in _rids){if(t_rid==_rids[_rid_key]){$trf_q='log';}}
$trf_MVisitCookie();$trf_r=$trf_VCookie("trafic_history").split("*");$trf_G.write((t_sp==0?'<a href="http://www.trafic.ro/?rid='+t_rid+'" target=_blank>':'')
+'<img src="http://'+$trf_q+'.trafic.ro/cgi-bin/pl.dll?'
+'rid='+t_rid
+'&rn=MJFUcP'
+'&c='+$trf_H.colorDepth
+'&w='+$trf_H.width
+'&j='+($trf_E.javaEnabled()?1:0)
+'&f='+$trf_f
+'&b='+$trf_a($trf_o)
+'&os='+$trf_a($trf_p)
+'&d='+$trf_K($trf_G.URL)
+'&r='+$trf_K($trf_i)
+'&p='+$trf_j
+'&o='+$trf_K(($trf_n==$trf_i?'r':$trf_n))
+'&se='+$trf_l
+'&lst='+$trf_r[0]
+'&cst='+$trf_r[1]
+'&vn='+$trf_r[2]
+'&vl='+$trf_B
+'&s='+t_sp+'"'
+' width='+t_iw+' height='+t_ih
+(t_sp==0?' border=0 alt="Trafic.ro - clasamente si statistici pentru site-urile romanesti"></a>':'>'))}
