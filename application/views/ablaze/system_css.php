/********************************************
   AUTHOR:  			Erwin Aligam
   WEBSITE:   			http://www.styleshout.com/
	TEMPLATE NAME: 	ablaze
   TEMPLATE CODE: 	S-0009
   VERSION:          2.1
 *******************************************/

/********************************************
   HTML ELEMENTS
********************************************/

/* top elements */
* {
	padding: 0; margin: 0;
}
body {
	margin: 0; 	padding: 0;
	font: normal .70em/1.5em Tahoma, 'Trebuchet MS', sans-serif;
	color: #6A6A6A;
	text-align: center;
	background: #000;
}

/* links */
a {
	color: #F88F26;
	background-color: inherit;
	text-decoration: none
}
a:hover {
	color: #FFF;
	background-color: inherit;
}

/* headers */
h1, h2, h3 {
	font: bold 1.3em 'Trebuchet MS', Arial, Sans-serif;
	color: #A0080D;
}
h1 { font-size: 1.6em; }
h2 { font-size: 1.4em; text-transform:uppercase;}
h3 { font-size: 1.3em; }

#main h1 {
	font: normal 1.5em 'Trebuchet MS', Arial, Sans-serif;
	color: #DBD0A3;
}
#sidebar h1 {
	font: bold 1.4em 'Trebuchet MS', Arial, Sans-serif;
	background: #000 url('<? echo $this->view->img_base_url('arrow.gif'); ?>') no-repeat 10px .7em;
	padding: 7px 0 7px 35px;
	color: #A0080D;
}

p, h1, h2, h3 {
	margin: 0;
	padding: 10px 15px;
}

ul, ol {
	margin: 10px 30px;
	padding: 0 15px;
}
ul span, ol span {
	color: #CCC;
}

/* images */
img {
	border: 3px solid #444;
}
img.no-border {
	border: none;
}
img.float-right {
  margin: 5px 0px 5px 15px;
}
img.float-left {
  margin: 5px 15px 5px 0px;
}
a img {
  border: 3px solid #444;
}
a:hover img {
  border: 3px solid #CCC !important; /* IE fix*/
  border: 3px solid #444;
}
acronym {
  cursor: help;
  border-bottom: 1px solid #777;
}
blockquote {
	margin: 15px;
 	padding: 0 0 0 20px;
  	background: #111;
   font: bold 1.3em/1.5em 'Trebuchet MS', Sans-serif;
}

/* form elements */
form {
	margin: 15px;
	padding: 0;
	background: #000;
   border: 1px dashed #151515;
}
label {
	display:block;
	font-weight:bold;
	margin:5px 0;
}
input {
	padding: 2px;
	border: 1px solid #CCC;
	font: normal 1em Verdana, sans-serif;
	color:#000;
	background: #CCC;
}
textarea {
	width: 250px;
	padding:2px;
	border: 1px solid #CCC;
	font: normal 1em Verdana, sans-serif;
	height:100px;
	display:block;
	color:#000;
	background: #CCC;
}
input.button {
	margin: 0;
	font: bold 1em Tahoma, Sans-serif;
	border: 1px solid #CCC;
	padding: 2px 3px;
	color: #000;
	background: #CCC;
}

/* search form */
.searchform form{
	position: absolute;
	top: 10px; right: 10px;
	background-color: transparent;
	border: none;
	margin: 0; padding: 0;
}
.searchform input.textbox {
	margin: 0 3px; padding: 0 2px;
	width: 130px;
	background: #000;
	color: #FFF;
	height: 20px;
	border: 1px solid #7E050A;
	vertical-align: top;
}
.searchform input.button {
	font: bold 12px Arial, Sans-serif;
	background: #000;
	color: #fff;
	width: 70px;
	height: 22px;
	border: none;
	padding: 3px 5px;
	vertical-align: top;
}

/***********************
	  LAYOUT
************************/

#header-content, #footer-content, #content {
	width: 83%;
}

/* header */
#header {
	background: #444 url('<? echo $this->view->img_base_url('headerbg.jpg'); ?>') repeat-x 0 0;
	height: 120px;
	text-align: left;
}
#header-content {
	position: relative;
	margin: 0 auto; padding: 0;
}
#header-content #logo {
	position: absolute;
	font: bold 50px Verdana, 'Trebuchet Ms', Sans-serif;
	letter-spacing: -2px;
	color: #000;
	margin: 0; padding: 0;

	/* change the values of left and top to adjust the position of the logo */
	top: 5px; left: 20px;
}
#header-content #slogan {
	position: absolute;
	font: bold 12px 'Trebuchet Ms', Sans-serif;
	text-transform: none;
	color: #CCC;
	margin: 0; padding: 0;

	/* change the values of left and top to adjust the position of the slogan */
	top: 60px; left: 35px;
}

/* header menu */
#header-content ul {
	position: absolute;
	right: 20px; top: 75px;
	font: bolder 1.3em 'Trebuchet MS', sans-serif;
	color: #000;
	list-style: none;
	margin: 0; padding: 0;
}
#header-content li {
	display: inline;
}
#header-content li a {
	float: left;
	display: block;
	padding: 3px 12px;
	color: #000;
}
#header-content li a:hover {
	background: #000;
	color: #F88F26;
}
#header-content li a#current  {
	background: #000;
	color: #CCC;
}

/* content */
#content-wrap {
	clear: both;
	float: left;
	background: #000;
	width: 100%;
}
#content {
	text-align: left;
	padding: 0; margin: 0 auto;
}

/* sidebar */
#sidebar {
	float: right;
	width: 260px;
	margin: 10px 0; padding: 0;
}
#sidebar ul.sidemenu {
	list-style:none;
	margin: 0;
	padding: 5px 0 15px 0;
}
#sidebar ul.sidemenu li {
	padding: 0 10px;
}
#sidebar ul.sidemenu a {
	display: block;
	font-weight:bold;
	color: #6A6A6A;
	height: 1.5em;
	text-decoration: none;
	padding:.3em 0 .3em 15px;
	background: #000;
	border-bottom: 1px dashed #151515;
	line-height: 1.5em;
}
#sidebar ul.sidemenu a.top{
	border-top: 1px dashed #151515;
}
#sidebar ul.sidemenu a:hover {
	padding: .3em 0 .3em 10px;
	background: #000;
	border-left: 5px solid  #D30F16;
	color: #D30F16;
}
#sidebar .sidebox {
	background: #000;
	margin: 5px 15px 10px 15px;
}

#sidebar .sidebox .cloud {
	margin-left: 15px;
}

#sidebar .sidebox .cloud span.cloud-1
{
	font-size: 10px;
}
#sidebar .sidebox .cloud span.cloud-2
{
	font-size: 12px;
}
#sidebar .sidebox .cloud span.cloud-3
{
	font-size: 14px;
}
#sidebar .sidebox .cloud span.cloud-4
{
	font-size: 16px;
}
#sidebar .sidebox .cloud span.cloud-5
{
	font-size: 18px;
}
#sidebar .sidebox .cloud span.cloud-6
{
	font-size: 20px;
}
#sidebar .sidebox .cloud span.cloud-7
{
	font-size: 2px;
}
#sidebar .sidebox .cloud span.cloud-8
{
	font-size: 24px;
}
#sidebar .sidebox .cloud span.cloud-9
{
	font-size: 26px;
}
#sidebar .sidebox .cloud span.cloud-10
{
	font-size: 28px;
}

/* main */
#main {
	margin: 10px 0;
	padding: 0 270px 0 0;
}
#pagination {
	float: left;
	text-align: center;
	width: 100%;
	margin: 15px;
}

div.comment {
	border: 1px solid;
	width: 100%;
	float: left;
	margin: 15px;
}

table
{
	width: 100%;
}

table.form_error
{
	margin-left: 15px;
	color: red;
}

table.form_notice
{
	margin-left: 15px;
	color: green;
}

/* footer */
#footer {
	clear: both;
	margin: 0; padding: 0;
	border-top: 1px solid #68050A;
	font-size: 95%;
	text-align: left;
}
#footer h2, #footer p {
	padding-left: 0;
}
#footer-content {
	margin: 0 auto;
}
#footer-content a {
	text-decoration: none;
	color: #8A8A8A;
}
#footer-content a:hover {
	text-decoration: underline;
	color: #FFF;
}
#footer-content ul {
	list-style: none;
	margin: 0; padding: 0;
}
#footer-content .col {
	width: 32%;
	padding: 0 5px 30px 15px;
}
#footer-content .col2 {
	width: 30%;
	padding: 0 0 30px 0;
}

/* alignment classes */
.float-left  { float: left; }
.float-right { float: right; }
.align-left  {	text-align: left; }
.align-right {	text-align: right; }

/* additional classes */
.clear { clear: both; }
.comments {
	text-align: right;
	border: 1px dashed #151515;
	padding: 5px 10px;
	margin: 20px 15px 10px 15px;
}

/**
 * SyntaxHighlighter
 * http://alexgorbatchev.com/
 *
 * SyntaxHighlighter is donationware. If you are using it, please donate.
 * http://alexgorbatchev.com/wiki/SyntaxHighlighter:Donate
 *
 * @version
 * 2.0.296 (March 01 2009)
 *
 * @copyright
 * Copyright (C) 2004-2009 Alex Gorbatchev.
 *
 * @license
 * This file is part of SyntaxHighlighter.
 *
 * SyntaxHighlighter is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * SyntaxHighlighter is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with SyntaxHighlighter.  If not, see <http://www.gnu.org/licenses/>.
 */
/************************************
 * Default Syntax Highlighter theme.
 *
 * Interface elements.
 ************************************/

.syntaxhighlighter
{
	background-color: #E7E5DC !important;
}

/* Highlighed line number */
.syntaxhighlighter .line.highlighted .number
{
	background-color: #6CE26C !important;
	color: black !important;
}

/* Highlighed line */
.syntaxhighlighter .line.highlighted.alt1 .content,
.syntaxhighlighter .line.highlighted.alt2 .content
{
	background-color: #6CE26C !important;
}

/* Gutter line numbers */
.syntaxhighlighter .line .number
{
	color: #5C5C5C !important;
}

/* Add border to the lines */
.syntaxhighlighter .line .content
{
	border-left: 3px solid #6CE26C !important;
	color: #000 !important;
}

.syntaxhighlighter.printing .line .content
{
	border: 0 !important;
}

/* First line */
.syntaxhighlighter .line.alt1 .content
{
	background-color: #fff !important;
}

/* Second line */
.syntaxhighlighter .line.alt2 .content
{
	background-color: #F8F8F8 !important;
}

.syntaxhighlighter .line .content .block
{
	background: url('<? echo $this->view->img_base_url('fckeditor/wrapping.png'); ?>') 0 1.1em no-repeat !important;
}

.syntaxhighlighter .ruler
{
	color: silver !important;
	background-color: #F8F8F8 !important;
	border-left: 3px solid #6CE26C !important;
}

.syntaxhighlighter.nogutter .ruler
{
	border: 0 !important;
}

.syntaxhighlighter .toolbar
{
	background-color: #F8F8F8 !important;
	border: #E7E5DC solid 1px !important;
}

.syntaxhighlighter .toolbar a
{
	color: #a0a0a0 !important;
}

.syntaxhighlighter .toolbar a:hover
{
	color: red !important;
}

/************************************
 * Actual syntax highlighter colors.
 ************************************/
.syntaxhighlighter .plain,
.syntaxhighlighter .plain a
{
	color: #000 !important;
}

.syntaxhighlighter .comments,
.syntaxhighlighter .comments a
{
	color: #008200 !important;
}

.syntaxhighlighter .string,
.syntaxhighlighter .string a
{
	color: blue !important;
}

.syntaxhighlighter .keyword
{
	color: #069 !important;
	font-weight: bold !important;
}

.syntaxhighlighter .preprocessor
{
	color: gray !important;
}

.syntaxhighlighter .variable
{
	color: #a70 !important;
}

.syntaxhighlighter .value
{
	color: #090 !important;
}

.syntaxhighlighter .functions
{
	color: #ff1493 !important;
}

.syntaxhighlighter .constants
{
	color: #0066CC !important;
}

.syntaxhighlighter .script
{
	background-color: yellow !important;
}

.syntaxhighlighter .color1,
.syntaxhighlighter .color1 a
{
	color: #808080 !important;
}

.syntaxhighlighter .color2,
.syntaxhighlighter .color2 a
{
	color: #ff1493 !important;
}

.syntaxhighlighter .color3,
.syntaxhighlighter .color3 a
{
	color: red !important;
}


/**
 * SyntaxHighlighter
 * http://alexgorbatchev.com/
 *
 * SyntaxHighlighter is donationware. If you are using it, please donate.
 * http://alexgorbatchev.com/wiki/SyntaxHighlighter:Donate
 *
 * @version
 * 2.0.296 (March 01 2009)
 *
 * @copyright
 * Copyright (C) 2004-2009 Alex Gorbatchev.
 *
 * @license
 * This file is part of SyntaxHighlighter.
 *
 * SyntaxHighlighter is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * SyntaxHighlighter is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with SyntaxHighlighter.  If not, see <http://www.gnu.org/licenses/>.
 */
.syntaxhighlighter,
.syntaxhighlighter div,
.syntaxhighlighter code,
.syntaxhighlighter span
{
	margin: 0 !important;
	padding: 0 !important;
	border: 0 !important;
	outline: 0 !important;
	background: none !important;
	text-align: left !important;
	float: none !important;
	vertical-align: baseline !important;
	position: static !important;
	left: auto !important;
	top: auto !important;
	right: auto !important;
	bottom: auto !important;
	height: auto !important;
	width: auto !important;
	line-height: 1.1em !important;
	font-family: "Consolas", "Monaco", "Bitstream Vera Sans Mono", "Courier New", Courier, monospace !important;
	font-weight: normal !important;
	font-style: normal !important;
	font-size: 1em !important;
}

.syntaxhighlighter
{
	width: 99%; !important;
	margin: 1em 0 1em 0 !important;
	padding: 1px !important; /* adds a little border on top and bottom */
	position: relative !important;
}

.syntaxhighlighter .bold {
	font-weight: bold !important;
}

.syntaxhighlighter .italic {
	font-style: italic !important;
}

.syntaxhighlighter .line .number
{
	float: left !important;
	width: 3em !important;
	padding-right: .3em !important;
	text-align: right !important;
	display: block !important;
}

/* Disable numbers when no gutter option is set */
.syntaxhighlighter.nogutter .line .number
{
	display: none !important;
}

.syntaxhighlighter .line .content
{
	margin-left: 3.3em !important;
	padding-left: .5em !important;
	display: block !important;
}

.syntaxhighlighter .line .content .block
{
	display: block !important;
	padding-left: 1.5em !important;
	text-indent: -1.5em !important;
}

.syntaxhighlighter .line .content .spaces
{
	display: none !important;
}

/* Disable border and margin on the lines when no gutter option is set */
.syntaxhighlighter.nogutter .line .content
{
	margin-left: 0 !important;
	border-left: none !important;
}

.syntaxhighlighter .bar
{
}

.syntaxhighlighter.collapsed .bar
{

}

.syntaxhighlighter.nogutter .ruler
{
	margin-left: 0 !important;
	padding-left: 0 !important;
}

.syntaxhighlighter .ruler
{
	padding: 0 0 .5em .5em !important;
	margin-left: 3.3em !important;
	overflow: hidden !important;
}

/* Adjust some properties when collapsed */

.syntaxhighlighter.collapsed .lines,
.syntaxhighlighter.collapsed .ruler
{
	display: none !important;
}

/* Styles for the toolbar */

.syntaxhighlighter .toolbar
{
	position: absolute !important;
	right: 0px !important;
	top: 0px !important;
	font-size: 1px !important;
	padding: 8px 8px 8px 0 !important; /* in px because images don't scale with ems */
}

.syntaxhighlighter.collapsed .toolbar
{
	font-size: 80% !important;
	padding: .2em 0 .5em .5em !important;
	position: static !important;
}

.syntaxhighlighter .toolbar a.item,
.syntaxhighlighter .toolbar .item
{
	display: block !important;
	float: left !important;
	margin-left: 8px !important;
	background-repeat: no-repeat !important;
	overflow: hidden !important;
	text-indent: -5000px !important;
}

.syntaxhighlighter.collapsed .toolbar .item
{
	display: none !important;
}

.syntaxhighlighter.collapsed .toolbar .item.expandSource
{
	background-image: url(<? echo $this->view->img_base_url('fckeditor/magnifier.png'); ?>) !important;
	display: inline !important;
	text-indent: 0 !important;
	width: auto !important;
	float: none !important;
	height: 16px !important;
	padding-left: 20px !important;
}

.syntaxhighlighter .toolbar .item.viewSource
{
	background-image: url(<? echo $this->view->img_base_url('fckeditor/page_white_code.png'); ?>) !important;
}

.syntaxhighlighter .toolbar .item.printSource
{
	background-image: url(<? echo $this->view->img_base_url('fckeditor/printer.png'); ?>) !important;
}

.syntaxhighlighter .toolbar .item.copyToClipboard
{
	text-indent: 0 !important;
	background: none !important;
	overflow: visible !important;
}

.syntaxhighlighter .toolbar .item.about
{
	background-image: url(<? echo $this->view->img_base_url('fckeditor/help.png'); ?>) !important;
}

/**
 * Print view.
 * Colors are based on the default theme without background.
 */

.syntaxhighlighter.printing,
.syntaxhighlighter.printing .line.alt1 .content,
.syntaxhighlighter.printing .line.alt2 .content,
.syntaxhighlighter.printing .line.highlighted .number,
.syntaxhighlighter.printing .line.highlighted.alt1 .content,
.syntaxhighlighter.printing .line.highlighted.alt2 .content,
.syntaxhighlighter.printing .line .content .block
{
	background: none !important;
}

/* Gutter line numbers */
.syntaxhighlighter.printing .line .number
{
	color: #bbb !important;
}

/* Add border to the lines */
.syntaxhighlighter.printing .line .content
{
	color: #000 !important;
}

/* Toolbar when visible */
.syntaxhighlighter.printing .toolbar,
.syntaxhighlighter.printing .ruler
{
	display: none !important;
}

.syntaxhighlighter.printing a
{
	text-decoration: none !important;
}

.syntaxhighlighter.printing .plain,
.syntaxhighlighter.printing .plain a
{
	color: #000 !important;
}

.syntaxhighlighter.printing .comments,
.syntaxhighlighter.printing .comments a
{
	color: #008200 !important;
}

.syntaxhighlighter.printing .string,
.syntaxhighlighter.printing .string a
{
	color: blue !important;
}

.syntaxhighlighter.printing .keyword
{
	color: #069 !important;
	font-weight: bold !important;
}

.syntaxhighlighter.printing .preprocessor
{
	color: gray !important;
}

.syntaxhighlighter.printing .variable
{
	color: #a70 !important;
}

.syntaxhighlighter.printing .value
{
	color: #090 !important;
}

.syntaxhighlighter.printing .functions
{
	color: #ff1493 !important;
}

.syntaxhighlighter.printing .constants
{
	color: #0066CC !important;
}

.syntaxhighlighter.printing .script
{
	font-weight: bold !important;
}

.syntaxhighlighter.printing .color1,
.syntaxhighlighter.printing .color1 a
{
	color: #808080 !important;
}

.syntaxhighlighter.printing .color2,
.syntaxhighlighter.printing .color2 a
{
	color: #ff1493 !important;
}

.syntaxhighlighter.printing .color3,
.syntaxhighlighter.printing .color3 a
{
	color: red !important;
}