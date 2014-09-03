	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

		<head>
			<meta http-equiv="content-type" content="text/html;charset=utf-8" />
			<meta http-equiv="Expires" content="Mon, 06 Jan 1990 00:00:01 GMT" />
			<meta http-equiv="pragma" content="no-cache" />
			<meta name="revisit-after" content="1 day" />
			<meta name="robots" content="INDEX,FOLLOW" />
			<?
				if($this->config->item('config_owner_name') != '')
				{
			?>
					<meta name="author" content="<? echo $this->config->item('config_owner_name'); ?>" />
			<?
				}
				if($this->config->item('config_meta_description') != '')
				{
			?>
					<meta name="description" content="<? echo $this->config->item('config_meta_description'); ?>" />
			<?
				}
				if($this->config->item('config_meta_keywords') != '')
				{
			?>
					<meta name="keywords" content="<? echo $this->config->item('config_meta_keywords'); ?>" />
			<?
				}
			?>
			<link rel="alternate" type="application/rss+xml" title="Post overview" href="<? echo site_url('post/rss');?>" />
			<link rel="stylesheet" href="<? echo site_url('system/css'); ?>" type="text/css" />
  			<script type="text/javascript" src="<? echo base_url('js/shCore.js');?>"></script>
  			<script type="text/javascript" src="<? echo base_url('js/shBrushPhp.js');?>"></script>
  			<script type="text/javascript" src="<? echo base_url('js/shBrushJScript.js');?>"></script>
  			<script type="text/javascript" src="<? echo base_url('js/shBrushSql.js');?>"></script>
			<title><? echo $this->config->item('config_blog_title')." - ".$page_title; ?></title>
		</head>

		<body>
			<!-- header starts here -->
			<div id="header">
				<div id="header-content">

					<h1 id="logo"><? echo $this->config->item('config_blog_title'); ?></h1>
					<h2 id="slogan"><? echo $this->config->item('config_blog_sub_title'); ?></h2>

					<?
						if($this->config->item('config_navigation_show_search') == 1)
						{
					?>
							<div class="searchform">
								<?
									echo form_open('search/perform');
								?>
								<p>
									<?
										$data = array(
										              'name'        => 'search_term',
										              'id'          => 'search_term',
										              'size'        => '25',
										              'maxlength'	=> '100',
										              'class'		=> 'textbox'
										            );

										echo form_input($data)."&nbsp;".form_submit('submit', 'Search', "class='button'");
									?>
								</p>
								<? echo form_close(); ?>
							</div>
					<?
						}
					?>

					<!-- Menu Tabs -->
					<ul>
						<li><? echo anchor(base_url(), 'Home'); ?></li>
						<li><? echo anchor('system/contact', 'Contact'); ?></li>
					</ul>

				</div>
			</div>
			<!-- content-wrap starts here -->
			<div id="content-wrap">
				<div id="content">

					<? $this->view->show_simple('sidebar')?>

					<div id="main">
						<? $this->view->show_simple($view_name)?>
					</div>

				<!-- content-wrap ends here -->
				</div>
			</div>
			<!-- footer starts here -->
			<div id="footer">
				<div id="footer-content">

					<div class="col float-left">
						<p>
							&copy; copyright 2009 <strong><? echo anchor('http://www.davidbehler.de', 'David Behler'); ?></strong><br />
							Running on DBlog v<? echo $this->config->item('dblog_version'); ?> - Powered by <strong><? echo anchor('http://www.codeigniter.com', 'CodeIgniter', array('target' => '_blank')); ?></strong><br/>
							Design by: <strong><? echo anchor('http://www.styleshout.com', 'styleshout'); ?></strong> &nbsp; &nbsp;
							Valid <a href="http://jigsaw.w3.org/css-validator/check/referer"><strong>CSS</strong></a> |
							<a href="http://validator.w3.org/check/referer"><strong>XHTML</strong></a> <br/>
						</p>

						<ul>
							<li><? echo anchor(base_url(), 'Home'); ?></li>
							<li>
								<?
									switch($this->uri->segment(1))
									{
										case 'post':
											echo anchor('post/rss', 'RSS Feed');
											break;
										case 'category':
											echo anchor('category/rss/'.$this->uri->segment(3), 'RSS Feed');
											break;
										case 'tag':
											echo anchor('tag/rss/'.$this->uri->segment(3), 'RSS Feed');
											break;
										default:
											echo anchor('post/rss', 'RSS Feed');
											break;
									}
								?>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<?
				if($this->config->item('config_google_tracker_id') != '')
				{
					$this->view->show_simple('google_tracker');
				}
			?>
		    <script type="text/javascript">
		        SyntaxHighlighter.all();
		    </script>
		</body>
	</html>