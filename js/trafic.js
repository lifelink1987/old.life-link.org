$trf_A = "1800";
function trfc577(){
$trf_B = 0;
$trf_C=window;
$trf_D=$trf_C.location;
if($trf_D.protocol=='file:')return;
$trf_E=navigator;
$trf_F=$trf_E.userAgent;
$trf_G=document;
$trf_H=$trf_C.screen;
$trf_I=$trf_J=0;
function $trf_K($trf_L){
	return escape($trf_L)
}



function $trf_MVisitCookie() {
	var h="",v="";
	var $trf_N=0, $trf_O = 0;
	var $trf_P = " expires=Sun, 21 Oct 2038 00:00:00 GMT;";
	$trf_N = document.cookie.indexOf("trafic_v=1");
	$trf_O = document.cookie.indexOf("trafic_history=");
	$trf_Q = new Date();
	$trf_R=Math.round($trf_Q.getTime()/1000);
	$trf_S=new Date($trf_Q.getTime()+(1800*1000));
	$trf_S=" expires="+$trf_S.toGMTString()+"; ";
	$trf_T = $trf_MDomain();
	if($trf_T && $trf_T!=""){ $trf_T = " domain=."+$trf_T+"; ";}
	if ($trf_N >=0 && $trf_O >=0)	{
	
		document.cookie = "trafic_v=1;path=/;"+$trf_S;
		$trf_U = $trf_VCurrentStartTime();
	
		$trf_B = $trf_R - $trf_U;
	}
	else {
		if($trf_O >=0){
			h = $trf_W($trf_R);
		}
		else {
			h = $trf_XHistoryValue($trf_R);
			$trf_B = 0;
		}
		document.cookie = "trafic_history="+h+" ; path=/; "+$trf_P;
		document.cookie = "trafic_v=1; path=/; "+$trf_S;
	}
}
	
	
function $trf_MDomain() {
 if (typeof(t_domain)=="undefined") {
	 var d=document.domain;
	 if (d.substring(0,4)=="www.") {
		 d=d.substring(4,d.length);
	 }
	 $trf_T=d;
 }
 else{

	$trf_T = t_domain;
 }
 return $trf_T;
}


function $trf_XHistoryValue($trf_Q){
	var value="";
	value = $trf_Q+"*"+$trf_Q+"*"+"1";
	return value;
}

function $trf_VCurrentStartTime(){
	var $trf_Y = $trf_VCookie('trafic_history'),start;
	idx1 = $trf_Y.indexOf("*",0);
	idx2 = $trf_Y.lastIndexOf("*",$trf_Y.length);
	start = $trf_Y.substring(idx1+1,idx2);

	return start;
}
function $trf_W($trf_Q){
	var $trf_Y="",idx0,idx1,idx2,visit_no,curr_t,last_t;

	$trf_Y = $trf_VCookie("trafic_history");
	idx = $trf_Y.lastIndexOf("*",$trf_Y.length);
	visit_no = $trf_Y.substring(idx+1,$trf_Y.length);
	visit_no = (visit_no*1) + 1;
	$trf_Y = $trf_Y.substring(0,idx);
 	curr_t = $trf_Q;
	idx = $trf_Y.lastIndexOf("*",$trf_Y.length);
	last_t = $trf_Y.substring(idx+1,$trf_Y.length);
	$trf_Y = $trf_Y.substring(0,idx);
	$trf_Y = last_t+"*"+curr_t+"*"+visit_no;
	return $trf_Y;
}
	function $trf_VCookie(name)	{
		$trf_Z = name;
		if ($trf_G.cookie.length>0)  {
			c_start=$trf_G.cookie.indexOf($trf_Z + "=");
			if (c_start > -1){ 
				c_start=c_start + $trf_Z.length+1 ;
			    c_end=$trf_G.cookie.indexOf(";",c_start);
			    if (c_end==-1) c_end=$trf_G.cookie.length;
				return unescape($trf_G.cookie.substring(c_start,c_end));
    			} 
  		}
		return "";
	}

function $trf_a($trf_b){
	for($trf_c=0;$trf_c<$trf_b.length/2;$trf_c++)
		if($trf_F.indexOf($trf_b[$trf_c*2+1])>=0)
			return $trf_b[$trf_c*2];
	return 0
}
$trf_d=$trf_E.mimeTypes;
$trf_e=$trf_d["application/x-shockwave-flash"];
$trf_f=0;
if($trf_d&&$trf_e
	?$trf_e.enabledPlugin
	:0){
	$trf_g=$trf_E.plugins["Shockwave Flash"].description.split(' ');
	for($trf_c=0;$trf_c<$trf_g.length;++$trf_c)
		if(!isNaN(parseInt($trf_g[$trf_c]))){
			$trf_f=$trf_g[$trf_c];
			break
		}
}else if($trf_C.ActiveXObject){
	for($trf_c=10;$trf_c>2;$trf_c--){
		try{
			if(eval("new ActiveXObject('ShockwaveFlash.ShockwaveFlash."+$trf_c+"');")){
				$trf_f=$trf_c;
				break
			}
		}
		catch($trf_h){}
	}
}
try{
	$trf_i=top.document.referrer;
	$trf_j=""
}catch(e){
	$trf_i="";
	$trf_j=$trf_G.referrer
}
$trf_k=[
	'google','q|as_*q|prev',10,
	'yahoo','p|va',11,
	'msn','q',12,
	'trafic','q',33,
	'altavista','q',13,
	'aol','query',14,
	'home','q',21,
	'ask','q',31,
	'mamma','query',20,
	'netscape','query',15,
	'alltheweb','q',32,
	'search.com','q',17,
	'lycos','query',26,
	'overture','Keywords',27,
	'looksmart','key',16,
	'about','terms',37,
	'hotbot','query',29,
	'teoma','q',39
];
$trf_l="";
for($trf_c=0;$trf_c<$trf_k.length/3;$trf_c++){
	if($trf_i.indexOf("."+$trf_k[$trf_c*3]+".")>-1){
		$trf_m=$trf_k[$trf_c*3+1];
		(new RegExp("[?&]("+$trf_m+")=([^&]*)")).exec($trf_i);
		if("prev"==RegExp.$1)
			(new RegExp("[?&]("+$trf_m+")=([^&]*)")).exec(unescape(RegExp.$2));
		if(RegExp.$2!=""&&RegExp.$2.indexOf("cache:")==-1)
			$trf_l=$trf_k[$trf_c*3+2]+"*"+RegExp.$2;
		break
	}
}
$trf_n=0;
try{
	for($trf_c in top.opener)$trf_n++
}catch(e){
	$trf_n=1
}
if($trf_n>1)
	try{
		$trf_n=top.opener.document.URL
	}catch(e){
		$trf_n=1
	}
$trf_o=[
	51,'Firefox/1',
	28,'Opera',
	17,'MSIE 5.5',
	18,'MSIE 5',
	16,'MSIE 6',
	52,'MSIE 7',
	19,'MSIE 4',
	20,'MSIE 3',
	21,'MSIE',
	29,'Konqueror',
	22,'Netscape6',
	50,'Netscape/7',
	24,'Mozilla/4',
	25,'Mozilla/3',
	26,'Mozilla/2',
	27,'Mozilla'
];
$trf_p=[
	46,'Windows ME',
	46,'Win 9x',
	9,'Windows 98',
	9,'Win98',
	12,'Windows NT 5.1',
	53,'Windows NT 5.2',
	12,'Windows XP',
	11,'Windows NT 5',
	11,'Windows 2000',
	10,'WinNT',
	10,'Windows NT',
	8,'Win95',
	8,'Windows 95',
	13,'Linux',
	13,'UNIX',
	13,'SunOS',
	13,'IRIX',
	13,'HP-UX',
	13,'FreeBSD',
	14,'Mac_PowerPC',
	14,'Macintosh',
	7,'Win16'
];
if(typeof(t_sp)=="undefined"){
	t_sp=0;
	t_iw=88;
	t_ih=31
}



$trf_q ='log3';
var _rids = ['neogenro','softnewsro','sentimentero','autovitro','wwwejobsro','ingeri','facesmd','bascalie','expresro','gazetasporturilorro','acasa','okazii','prosportro','libertatearo','dominokapparo','jocuricopiiro','clopotelro','softromro','ditzigoro','itboxro','antena3','rolro','sexytop','eastrologro','Lminiclipro','emagro','revistapreseiro','jocurigratuite','4tuningro','regielivero'];
for (var _rid_key in _rids) {
    if (t_rid == _rids[_rid_key]) {
        $trf_q = 'log';
    }
}


$trf_MVisitCookie();
$trf_r = $trf_VCookie("trafic_history").split("*");



$trf_G.write(
	(t_sp==0?'<a href="http://www.trafic.ro/?rid='+t_rid+'" target=_blank>':'')
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
	+'&lst=' + $trf_r[0]
	+'&cst=' + $trf_r[1]
	+'&vn=' + $trf_r[2]
	+'&vl=' + $trf_B
	+'&s='+t_sp+'"'
	+' width='+t_iw+' height='+t_ih
	+(t_sp==0?' border=0 alt="Trafic.ro - clasamente si statistici pentru site-urile romanesti"></a>':'>')
)}