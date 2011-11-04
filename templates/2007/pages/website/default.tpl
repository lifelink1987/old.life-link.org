<div id="related">
  <{include file="official:`$tpl.current`related.tpl"}>
</div>
<{include file="official:`$tpl.current`website.tpl"}>
<span class="llclear" style="height: 2em"></span>


<div class="h2"><strong>Current Website Version</strong>:</div>
<div class="yui-g">
	<div class="yui-u first">
		<dl>
			<dt>Backbone</dt>
			<dd><{$tpl.website.version.major}>.<{$tpl.website.version.minor}> - Updated on <{$tpl.website.version.date|date_format:$tpl.date_format}></dd>
		</dl>
	</div>
	<div class="yui-u">
		<dl>
			<dt>Interface</dt>
			<dd><{$tpl.version.major}>.<{$tpl.version.minor}> - Updated on <{$tpl.version.date|date_format:$tpl.date_format}></dd>
		</dl>
	</div>
</div>
		
<div class="hr"></div>
<div class="yui-g">
	<div class="yui-u first">
		<h2>This site has been <strong>optimized for</strong>:</h2>
		<dl>
			<dt><a href="http://www.mozilla.com/en-US/firefox/" rel="nofollow"><{$tpl.images.bfirefox}></a> (Mozilla Corporation)</dt>
			<dd>tested on Windows version 2.0.0.1</dd>
			
			<dt><a href="http://www.opera.com/" rel="nofollow"><{$tpl.images.bopera}></a> (Opera Software)</dt>
			<dd>tested on Windows version 9.1</dd>
			
			<dt><a href="http://www.microsoft.com/windows/ie/" rel="nofollow"><{$tpl.images.bie}></a> (Microsoft Corporation)</dt>
			<dd>tested on Windows version 6.0 SP2 & 7.0</d>
			
			<dt><strong>1024x768 px</strong> resolution</dt>
			<dd>800x600 px resolution (minimum)</dd>
		</dl>
	</div>
	<div class="yui-u first">
		<h2>and has been built with/on:</h2>
		<dl>
			<dt><a href="http://www.apache.org" rel="nofollow"><{$tpl.images.bapache}></a> Apache HTTP Server 2</dt>
			<dt><a href="http://www.php.net" rel="nofollow"><{$tpl.images.bphp}></a> Hypertext Preprocessor 5</dt>
			<dt><a href="http://www.mysql.com" rel="nofollow"><{$tpl.images.bmysql}></a> MySQL Database 5</dt>
			<dt><a href="http://www.unicode.org" rel="nofollow"><{$tpl.images.butf8}></a> International UTF8 support</dt>
		</dl>
		
		<div class="hr"></div>

		<h2>and uses these <strong>technologies/frameworks</strong>:</h2>
		<dl>
			<dt><{$tpl.images.bhtml}></dt>
			<dd>Hyper Text Markup Language</dd>
			
			<dt><{$tpl.images.bcss}></dt>
			<dd>Cascading Style Sheets</dd>
			
			<dt><strong>DOM</strong></dt>
			<dd>Document Object Model</dd>
			
			<dt><strong>JS &amp; Web 2.0</strong></dt>
			<dd>
				Dynamic Hyper Text Markup Language<br>
				Java Script &amp; Web 2.0 elements
			</dd>
		</dl>		
	</div>
</div>