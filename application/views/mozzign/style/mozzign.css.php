body, div, img, p, img, a
{
	border: none;
	margin: 0px;
	padding: 0px;
}

body
{
	background-color: #d5d6d7;
	font-family: 'Lucida Grande', Verdana, Arial, Sans-Serif;
	font-size: 12px;
}
a, a:visited, a:active
{
	color: #FF7038;
	text-decoration: none;
}
a:hover
{
	color: #FF431E;
	text-decoration: underline;
}
a.post_title
{
	color: #000000;
	text-decoration: none;
}
a.maintitle
{
	color: #FFFFFF;
	text-decoration: none;
}
a.footer
{
	color: #000000;
	text-decoration: none;
}
a.post_title:hover
{
	color: #FF431E;
	text-decoration: none;
}
.left
{
	text-align: left;
}
div.container
{
	width: 980px;
	margin-left: auto;
	margin-right: auto;
	margin-top: 50px;
}
	div.container div.wrapper
	{
		float: left;
		width: 100%;
		background-color: #FFFFFF;
		border: 1px solid;
	}
	div.container div.wrapper div.header
	{
		margin-top: 5px;
		margin-left: 5px;
		margin-right: 5px;
		width: 970px;
		min-height: 100px;
		background: #FFFFFF url('<? echo $this->view->img_base_url('header.png'); ?>');
		float: left;
	}
		div.container div.wrapper div.header h1
		{
			text-align: center;
			font-weight: bold;
			font-size: 30px;
			color: #FFFFFF;
			margin: 2px;
			margin-top: 20px;
		}
		div.container div.wrapper div.header h2
		{
			text-align: center;
			font-style:italic;
			color: #FFFFFF;
			margin: 2px;
			font-weight: normal;
			font-size: 20px;
		}
	div.container div.wrapper div.content
	{
		margin-top: 15px;
		margin-left: 5px;
		margin-right: 5px;
		width: 970px;
		float: left;
	}
		div.container div.wrapper div.content div.postlist
		{
			width: 660px;
			float: left;
			margin-left: 20px;
		}
			div.container div.wrapper div.content div.postlist div.post
			{
				float: left;
				width: 660px;
				margin-bottom: 10px;
			}
				div.container div.wrapper div.content div.postlist div.post p
				{
					margin-bottom: 12px;
				}
			div.container div.wrapper div.content div.postlist div.post h1
			{
				font-size: 22px;
				margin: 2px;
			}
			div.container div.wrapper div.content div.postlist div.post h2
			{
				font-size: 14px;
				margin: 2px;
				font-weight: normal;
			}
			div.container div.wrapper div.content div.postlist div.post div.excerpt
			{
				margin: 2px;
				margin-top: 10px;
			}
				div.container div.wrapper div.content div.postlist div.post div.excerpt div.code
				{
					margin: 2px;
					border: 1px solid #FF7038;
					width: 600px;
					padding: 1px;
				}
			div.container div.wrapper div.content div.postlist div.post div.info
			{
				margin: 2px;
				text-align: center;
				margin-bottom: 0px;
			}
			div.container div.wrapper div.content div.postlist div.post div.tags
			{
				margin: 2px;
				text-align: center;
				margin-top: 10px;
				width: 100%;
			}
			div.container div.wrapper div.content div.postlist div.pagination
			{
				margin: 2px;
				margin-top: 10px;
				margin-bottom: 10px;
				text-align: center;
				float: left;
				width: 660px;
			}
		div.container div.wrapper div.content div.sidebar
		{
			float: left;
			width: 290px;
		}
			div.container div.wrapper div.content div.sidebar div.navigation
			{
				width: 265px;
				float: left;
				margin-right: 5px;
				margin-left: 20px;
				margin-top: 15px;
			}
				div.container div.wrapper div.content div.sidebar div.navigation ul, li
				{
					border: none;
					margin: 0px;
					padding: 0px;
				}
				div.container div.wrapper div.content div.sidebar div.navigation div.nav_title_item
				{
					font-weight: bold;
					float: left;
					width: 260px;
					margin-top: 5px;
				}
				div.container div.wrapper div.content div.sidebar div.navigation div.nav_item
				{
					float: left;
					margin-left: 15px;
					margin-top: 5px;
					width: 260px;
					font-size: 11px;
				}
			div.container div.wrapper div.content div.sidebar div.cloud
			{
				width: 265px;
				float: left;
				margin-right: 5px;
				margin-left: 20px;
				margin-top: 25px;
			}
				div.container div.wrapper div.content div.sidebar div.cloud span.cloud-1
				{
					font-size: 10px;
				}
				div.container div.wrapper div.content div.sidebar div.cloud span.cloud-2
				{
					font-size: 12px;
				}
				div.container div.wrapper div.content div.sidebar div.cloud span.cloud-3
				{
					font-size: 14px;
				}
				div.container div.wrapper div.content div.sidebar div.cloud span.cloud-4
				{
					font-size: 16px;
				}
				div.container div.wrapper div.content div.sidebar div.cloud span.cloud-5
				{
					font-size: 18px;
				}
				div.container div.wrapper div.content div.sidebar div.cloud span.cloud-6
				{
					font-size: 20px;
				}
				div.container div.wrapper div.content div.sidebar div.cloud span.cloud-7
				{
					font-size: 2px;
				}
				div.container div.wrapper div.content div.sidebar div.cloud span.cloud-8
				{
					font-size: 24px;
				}
				div.container div.wrapper div.content div.sidebar div.cloud span.cloud-9
				{
					font-size: 26px;
				}
				div.container div.wrapper div.content div.sidebar div.cloud span.cloud-10
				{
					font-size: 28px;
				}
			div.container div.wrapper div.content div.sidebar span.title
			{
				font-weight: bold;
			}
			div.container div.wrapper div.content div.sidebar div.search
			{
				width: 265px;
				float: left;
				margin-right: 5px;
				margin-left: 20px;
			}
				div.container div.wrapper div.content div.sidebar div.search input
				{
					font: 0.9em 'Lucida Grande', Verdana, Arial, Sans-Serif;
					border: 1px solid;
				}
			div.container div.wrapper div.content div.sidebar div.bottom
			{
				width: 265px;
				float: left;
				text-align: right;
				font-size: 10px;
				margin-right: 20px;
				margin-left: 5px;
				margin-top: 30px;
			}
		div.container div.wrapper div.content div.contact
		{
			width: 660px;
			margin-top: 20px;
			margin-left: 20px;
			float: left;
		}
			div.container div.wrapper div.content div.contact h1
			{
				font-size: 22px;
				margin: 2px;
			}
			div.container div.wrapper div.content div.contact table.contact_form
			{
				width: 490px;
				margin: 2px;
			}
				div.container div.wrapper div.content div.contact table.contact_form tbody tr td
				{
					padding: 2px;
				}
				div.container div.wrapper div.content div.contact table.contact_form tbody tr td.left
				{
					margin: 2px;
					width: 150px;
				}
					div.container div.wrapper div.content div.contact table.contact_form tbody tr td.right
					{
						margin: 2px;
						text-align: right;
					}
				div.container div.wrapper div.content div.contact table.contact_form tbody tr td.right input, textarea
				{
					font: 0.9em 'Lucida Grande', Verdana, Arial, Sans-Serif;
					border: 1px solid;
				}
			div.container div.wrapper div.content div.contact table.form_error
			{
				width: 490px;
				margin: 2px;
				color: red;
			}
			div.container div.wrapper div.content div.contact table.form_notice
			{
				width: 490px;
				margin: 2px;
				color: green;
			}
		div.container div.wrapper div.content div.post_view
		{
			width: 660px;
			margin-top: 20px;
			margin-left: 20px;
			float: left;
		}
			div.container div.wrapper div.content div.post_view table
			{
				width: 100%;
			}
			div.container div.wrapper div.content div.post_view h1
			{
				font-size: 22px;
				margin: 2px;
			}
			div.container div.wrapper div.content div.post_view h2
			{
				font-size: 18px;
				margin: 2px;
				margin-top: 5px;
			}
			div.container div.wrapper div.content div.post_view h3
			{
				font-size: 14px;
				margin: 2px;
				font-weight: normal;
			}
			div.container div.wrapper div.content div.post_view div.post_content
			{
				margin: 2px;
				margin-top: 10px;
				margin-bottom: 10px;
			}
				div.container div.wrapper div.content div.post_view div.post_content p
				{
					margin-bottom: 12px;
				}
			div.container div.wrapper div.content div.post_view div.tags
			{
				margin: 2px;
				margin-top: 15px;
				margin-bottom: 15px;
			}
			div.container div.wrapper div.content div.post_view div.pagination
			{
				margin: 2px;
				margin-top: 10px;
				margin-bottom: 10px;
				text-align: center;
				float: left;
				width: 660px;
			}
				div.container div.wrapper div.content div.post_view div.pagination span.current_page
				{
					font-weight: bold;
				}
			div.container div.wrapper div.content div.post_view div.comment
			{
				border: 1px solid #d5d6d7;
				margin-top: 5px;
				padding: 5px;
				float: left;
				width: 660px;
				overflow: auto;
			}
				div.container div.wrapper div.content div.post_view div.comment span.user
				{
					font-weight: bold;
				}
				div.container div.wrapper div.content div.post_view div.comment p.comment_content
				{
					margin-top: 5px;
				}
			div.container div.wrapper div.content div.post_view table.comment_form
			{
				width: 490px;
				margin: 2px;
			}
				div.container div.wrapper div.content div.post_view table.comment_form tbody tr td
				{
					padding: 2px;
				}
				div.container div.wrapper div.content div.post_view table.comment_form tbody tr td.left
				{
					margin: 2px;
				}
					div.container div.wrapper div.content div.post_view table.comment_form tbody tr td.right
					{
						margin: 2px;
						text-align: right;
					}
				div.container div.wrapper div.content div.post_view table.comment_form tbody tr td.right input, textarea
				{
					font: 0.9em 'Lucida Grande', Verdana, Arial, Sans-Serif;
					border: 1px solid;
				}
			div.container div.wrapper div.content div.post_view table.comment_form_error
			{
				width: 490px;
				margin: 2px;
			}
				div.container div.wrapper div.content div.post_view table.comment_form_error tbody tr td
				{
					padding: 2px;
					color: red;
				}
		div.container div.wrapper div.content div.page_view
		{
			width: 660px;
			float: left;
			margin-left: 20px;
		}
			div.container div.wrapper div.content div.page_view h1
			{
				font-size: 22px;
				margin: 2px;
			}
			div.container div.wrapper div.content div.page_view div.page_content
			{
				margin: 2px;
				margin-top: 10px;
				margin-bottom: 10px;
			}
	div.container div.wrapper div.footer
	{
		margin-top: 15px;
		margin-left: 5px;
		margin-right: 5px;
		margin-bottom: 5px;
		width: 970px;
		float: left;
		background: #FFFFFF url('<? echo $this->view->img_base_url('footer.png'); ?>');
		min-height: 50px;
	}
		div.container div.wrapper div.footer p
		{
			margin-top: 15px;
			text-align: center;
			font-size: 10px;
		}

div.container_system
{
	width: 370px;
	margin-left: auto;
	margin-right: auto;
	margin-top: 50px;
}

	div.container_system div.wrapper
	{
		float: left;
		width: 100%;
		background-color: #FFFFFF;
		border: 1px solid;
	}
		div.container_system div.wrapper div.content
		{
			margin: 5px;
			width: 360px;
			float: left;
		}
			div.container_system div.wrapper div.content table.form
			{
				width: 350px;
				margin: 5px;
			}
				div.container_system div.wrapper div.content table.form tbody tr td
				{
					padding: 2px;
					margin: 2px;
				}
				div.container_system div.wrapper div.content table.form tbody tr td.right
				{
					text-align: right;
				}
				div.container_system div.wrapper div.content table.form tbody tr td.center
				{
					text-align: center;
				}
					div.container_system div.wrapper div.content table.form tbody tr td input, textarea
					{
						font: 0.9em 'Lucida Grande', Verdana, Arial, Sans-Serif;
						border: 1px solid;
					}
			div.container_system div.wrapper div.content table.form_error
			{
				width: 350px;
				margin: 2px;
			}
				div.container_system div.wrapper div.content table.form_error tbody tr td
				{
					padding: 2px;
					color: red;
				}
			div.container_system div.wrapper div.content table.form_notice
			{
				width: 350px;
				margin: 2px;
			}
				div.container_system div.wrapper div.content table.form_notice tbody tr td
				{
					padding: 2px;
					color: green;
				}
div.top_bar
{
	width: 100%
	float: left;
	background-color: #FFFFFF;
	padding: 5px;
	border-bottom: 1px solid;
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
	width: 100% !important;
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