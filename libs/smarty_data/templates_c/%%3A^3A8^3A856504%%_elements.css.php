<?php /* Smarty version 2.6.16, created on 2011-06-15 08:05:07
         compiled from /home/lifelink/life-link.org/templates/2007/css/built/_elements.css */ ?>
/* CSS Document */

#page-content hr,
#page-content .hr
{
	border: 0 #FFFFFF none;
	padding: 0;
	color: #FCC90D;
	background-color: #FCC90D;
	height: 1px;
	line-height: 1px;
	margin: 2px;
	_margin: 0;
	display: block;
	overflow: hidden;
}

#page-content p,
.panel .bd p
{
	margin-bottom: 0.5em;
	text-align: justify;
	display: block;
}

#page-content strong,
#page-content em
{
	color: #000000;
}

#page-content blockquote
{
	padding-left: 1em;
}

#page-content .indent
{
	margin-left: 2em;
}

#page-content .sectionlinks
{
	position: absolute;
	visibility: hidden;
}

#page-content .summary
{
/*	overflow: auto !important;
	overflow-y: auto !important;
*/	overflow: hidden;
	overflow-x: hidden !important;
	max-height: 90px;
	min-height: 90px;
	_height: 90px;
	padding: 2px;
	border-bottom: 1px solid #FCC90D;
}

#page-content .hidden
{
	display: none;
}

/* Headings */
#page-content h1,
#page-content .h1
{
	font-family: "Trebuchet MS", Helvetica, Tahoma, Geneva, sans-serif;
	font-size: 152%;
	font-weight: normal;
	text-transform: uppercase;
	color: #006A33;
	border-bottom: 1px #DDDDDD solid; 
}

#page-content h2,
#page-content .h2
{
	font-family: "Trebuchet MS", Helvetica, Tahoma, Geneva, sans-serif;
	font-size: 122%;
	font-weight: normal;
	color: #006A33;
}

#page-content h3,
#page-content .h3
{
	font-size: 107%;
	font-weight: bold;
}

#page-content h1
{
	margin-bottom: 0.5em;
}

#page-content h3,
#page-content h2
{
	margin-bottom: 1em;
}

#page-content h2 + h3
{
	margin-top: -1em;
}

/* Links */
#page-content a
{
	text-decoration: underline;
	color: #006A33;
/*	border-bottom: 1px solid #006A33;
	font-style: italic;*/
}

#page-content a:hover
{
/*	border-bottom: 1px solid #FC990D;
	text-decoration: underline;*/
	text-decoration: none;
}

#page-content a.doc
{
	padding-left: 20px;
	background: transparent url(/templates/2007/icons/page_white_word.gif) no-repeat;
}

#page-content a.pdf
{
	padding-left: 20px;
	background: transparent url(/templates/2007/icons/page_white_acrobat.gif) no-repeat;
}

#page-content a.jpg,
#page-content a.gif,
#page-content a.png
{
	padding-left: 20px;
	background: transparent url(/templates/2007/icons/page_white_picture.gif) no-repeat;
}

#page-content a.xls,
#page-content a.cvs
{
	padding-left: 20px;
	background: transparent url(/templates/2007/icons/page_white_excel.gif) no-repeat;
}

#page-content a.ppt,
#page-content a.pps
{
	padding-left: 20px;
	background: transparent url(/templates/2007/icons/page_white_powerpoint.gif) no-repeat;
}

#page-content a.zip,
#page-content a.rar,
#page-content a.ace
{
	padding-left: 20px;
	background: transparent url(/templates/2007/icons/page_white_compressed.gif) no-repeat;
}

#page-content a.mail
{
	padding-right: 20px;
	background: transparent url(/templates/2007/icons/email.gif) no-repeat 100% 0;
}

#sidebar a
{
	text-decoration: none;
	color: #006A33;
	border-bottom: 1px solid #006A33;
}

#sidebar a:hover
{
	border-bottom: 1px solid #FC990D;
}

/* Lists */
#page-content ul,
#page-content ol
{
	margin-bottom: 5px;
}

#page-content ul
{
	list-style: disc;
	list-style-position: inside;
}

#page-content ol
{
	list-style-position: inside;
	list-style-type: decimal;
}

#page-content li
{
	text-align: left;
}

#page-content dl dd
{
	padding-left: 1em;
	padding-bottom: 1em;
}

#page-content dl dt
{
	padding-bottom: 2px;
}

/* Tooltip */
.tt
{
	z-index: 600;
}

/* Panels */
div.mask
{
	background-color: #FFFFFF;
}

div.panel div.hd
{
	background-color: #006A33;
}

/* Wait */
#wait .bd
{
	text-align: center;
}

/* YUI Grid correction */
.yui-gb .yui-u, 
.yui-gc .yui-u, 
.yui-gd .yui-u{margin-left:1.8%;*margin-left:1.790%;} 

#page-content .yui-u {
	padding-bottom: 1px;
}

/* YUI Calendar */
#page-content .yui-calendar a
{
	text-decoration: none;
	color: #003DB8;
}

#page-content .yui-calendar a:hover
{
	color: #FFFFFF;
}

/* LLCLEAR */
#page-content span.llclear
{
	height: 0;
	line-height: 0;
}

#page-content span.llclear.h05
{
	height: 0.5em;
	line-height: 0.5em;
}

#page-content span.llclear.h10
{
	height: 1em;
	line-height: 1em;
}

#page-content span.llclear.h20
{
	height: 2em;
	line-height: 2em;
}

#page-content span.llclear.h30
{
	height: 3em;
	line-height: 3em;
}