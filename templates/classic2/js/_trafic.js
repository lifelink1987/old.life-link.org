// JavaScript Document

YAHOO.namespace('ll.trafic');

YAHOO.ll.trafic.show = function()
{
	var $A=window;
	var $B=$A.location;
	if($B.protocol=='file:')return;
	var $C=navigator;
	var $D=$C.userAgent;
	var $E=document;
	var $F=$A.screen;
	var $G=$H=0;
	var $I = function ($J){return escape($J)}
	var $K = function ($L){
		for(var $M=0;$M<$L.length/2;$M++)
			if($D.indexOf($L[$M*2+1])>=0)return $L[$M*2];
		return 0
	}
	var $N=$C.mimeTypes;
	var $O=$N["application/x-shockwave-flash"];
	var $P=0;
	var $R;
	if($N&&$O?$O.enabledPlugin:0)
	{
		var $Q=$C.plugins["Shockwave Flash"].description.split(' ');
		for(var $M=0;$M<$Q.length;++$M)
			if(!isNaN(parseInt($Q[$M]))){
				$P=$Q[$M];
				break;
			}
	}
	else if($A.ActiveXObject){
		for(var $M=8;$M>2;$M--){
			try{
				if(eval("new ActiveXObject('ShockwaveFlash.ShockwaveFlash."+$M+"');"))
					{$P=$M;break}
				}
			catch($R){}
		}
	}
	var $S;
	try{$S=top.document.referrer;$T=""}
	catch(e){$S="";$T=$E.referrer}
	var $U=['google','q|as_*q|prev',10,'yahoo','p|va',11,'msn','q',12,'trafic','q',33,'altavista','q',13,'aol','query',14,'home','q',21,'ask','q',31,'mamma','query',20,'netscape','query',15,'alltheweb','q',32,'search.com','q',17,'lycos','query',26,'overture','Keywords',27,'looksmart','key',16,'about','terms',37,'hotbot','query',29,'teoma','q',39];
	var $V="";
	for(var $M=0;$M<$U.length/3;$M++){
		if($S.indexOf("."+$U[$M*3]+".")>-1){
			var $W=$U[$M*3+1];
			(new RegExp("[?&]("+$W+")=([^&]*)")).exec($S);
			if("prev"==RegExp.$1)
				(new RegExp("[?&]("+$W+")=([^&]*)")).exec(unescape(RegExp.$2));
			if(RegExp.$2!=""&&RegExp.$2.indexOf("cache:")==-1)$V=$U[$M*3+2]+"*"+RegExp.$2;
			break
		}
	}
	var $X=0;
	try{for(var $M in top.opener)$X++}
	catch(e){$X=1}
	if($X>1)
		try{$X=top.opener.document.URL}
		catch(e){$X=1}
		var $Y=[51,'Firefox/1',28,'Opera',17,'MSIE 5.5',18,'MSIE 5',16,'MSIE 6',52,'MSIE 7',19,'MSIE 4',20,'MSIE 3',21,'MSIE',29,'Konqueror',22,'Netscape6',50,'Netscape/7',24,'Mozilla/4',25,'Mozilla/3',26,'Mozilla/2',27,'Mozilla'];$Z=[46,'Windows ME',46,'Win 9x',9,'Windows 98',9,'Win98',12,'Windows NT 5.1',53,'Windows NT 5.2',12,'Windows XP',11,'Windows NT 5',11,'Windows 2000',10,'WinNT',10,'Windows NT',8,'Win95',8,'Windows 95',13,'Linux',13,'UNIX',13,'SunOS',13,'IRIX',13,'HP-UX',13,'FreeBSD',14,'Mac_PowerPC',14,'Macintosh',7,'Win16'];
		if(typeof(t_sp)=="undefined"){var t_sp=0;var t_iw=88;var t_ih=31}
		$E.write((t_sp==0?'<a href="http://www.trafic.ro/?rid='+t_rid+'" target=_blank>':'')+'<img src="http://log.trafic.ro/cgi-bin/pl.dll?'+'rid='+t_rid+'&rn=8mriSl'+'&c='+$F.colorDepth+'&w='+$F.width+'&j='+($C.javaEnabled()?1:0)+'&f='+$P+'&b='+$K($Y)+'&os='+$K($Z)+'&d='+$I($E.URL)+'&r='+$I($S)+'&p='+$T+'&o='+$I(($X==$S?'r':$X))+'&se='+$V+'&s='+t_sp+'"'+' width='+t_iw+' height='+t_ih+(t_sp==0?' border=0 alt="Trafic.ro - clasamente si statistici pentru site-urile romanesti"></a>':'>'))
}