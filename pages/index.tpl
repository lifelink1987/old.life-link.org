<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Life-Link Friendship-Schools</title>
<style type="text/css">
	body
	{
		padding: 0;
		margin: 0;
	}
</style>
</head>
<body bgcolor="#FFFFFF">
<script text="text/javascript">
	var ua = navigator.userAgent.toLowerCase();
	var isSafari = (/webkit|khtml/).test(ua);
	var isOpera = ua.indexOf("opera") > -1;
	var isIE = !isOpera && ua.indexOf("msie") > -1;
	var isMac = (ua.indexOf("macintosh") != -1 || ua.indexOf("mac os x") != -1 || ua.indexOf("mac_ppc") != -1 || ua.indexOf("mac_powerpc") != -1);
	if (isSafari){
		document.write('<div style="border: 1px solid #FF0000; background-color: #FFAAAA; color: #000000; padding: 5px">You are using Safari&reg; as a browser. Due to some technical issues, the advanced features of this website are not available on your browser.<br>Although regular browsing (reading) is not an issue, <b>you are still highly advised to switch to <a href="http://www.getfirefox.com/">Firefox&reg;</a> in order to browse this website</b>.</div>');
	}
	if (isIE && isMac){
		document.write('<div style="border: 1px solid #FF0000; background-color: #FFAAAA; color: #000000; padding: 5px">You are using Internet Explorer&reg; as a browser. Due to some technical issues, our website may not be available on your browser.<br><b>You are advised to switch to <a href="http://www.getfirefox.com/">Firefox&reg;</a> in order to browse this website</b>.</div>');
	}
</script>
<!--url's used in the movie-->
<!--text used in the movie-->
<!-- saved from url=(0013)about:internet -->
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="100%" height="500" id="intro" align="middle">
	<param name="allowScriptAccess" value="sameDomain" />
	<param name="movie" value="templates/intro_2007_old.swf" />
	<param name="loop" value="false" />
	<param name="quality" value="best" />
	<param name="scale" value="showall" />
	<param name="salign" value="lt" />
	<param name="wmode" value="transparent" />
	<param name="bgcolor" value="#000000" />
	<embed src="templates/intro_2007_old.swf" loop="false" quality="best" scale="showall" salign="lt" wmode="transparent" bgcolor="#000000" width="100%" height="500" name="intro" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>
<script type="text/javascript">
	document.write('<table align="right"><tr><td><form method="post" action="home.php"><input type="hidden" name="llschoolnumber" value="0"><button type="submit">Go to HOME PAGE</button></form></td></tr><tr><td><form method="post" action="home.php">I am from Life-Link school no. <input type="text" size="3" maxlength="3" name="llschoolnumber" value="<{if $smarty.session.llschoolnumber}><{$smarty.session.llschoolnumber}><{/if}>" autocomplete="off">. <button type="submit">Go to MY SCHOOL\'S PAGE</button></form></td></tr></table>');
</script>
<noscript>
	<div style="border: 1px solid #FF0000; background-color: #FFAAAA; color: #000000; padding: 5px">
		Your browsers seems to have no JavaScript support. Therefore the advanced features of this website are not available on your browser.<br>
		Although regular browsing (reading) is not an issue, <b>you are still highly advised to switch to <a href="http://www.getfirefox.com/">Firefox&reg;</a> in order to browse this website</b>.
	</div>
	<table align="right"><tr>
		<td>
			<form method="post" action="home.php">
				<input type="hidden" name="lltemplatelevel" value="-1">
				<input type="hidden" name="llschoolnumber" value="0">
				<button type="submit">Go to HOME PAGE</button>
			</form>
		</td>
	</tr><tr>
		<td>
			<form method="post" action="home.php">
				<input type="hidden" name="lltemplatelevel" value="-1">
				I'm from Life-Link school no.
				<input type="text" size="3" maxlength="3" name="llschoolnumber" value="<{if $smarty.session.llschoolnumber}><{$smarty.session.llschoolnumber}><{/if}>" autocomplete="off">.
				<button type="submit">Go to MY SCHOOL'S PAGE</button>
			</form>
		</td>
	</tr></table>
</noscript>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
<script type="text/javascript">
	_uacct = "UA-1944438-1";
	urchinTracker();
</script>
</body>
</html>