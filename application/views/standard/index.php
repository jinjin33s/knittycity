	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
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
			<link rel="stylesheet" type="text/css" media="screen,projection" href="<? echo site_url('system/css'); ?>" />
  			<link rel="alternate" type="application/rss+xml" title="Post overview" href="<? echo site_url('post/rss');?>" />
  			<script type="text/javascript" src="<? echo base_url('js/shCore.js');?>"></script>
  			<script type="text/javascript" src="<? echo base_url('js/shBrushPhp.js');?>"></script>
  			<script type="text/javascript" src="<? echo base_url('js/shBrushJScript.js');?>"></script>
  			<script type="text/javascript" src="<? echo base_url('js/shBrushSql.js');?>"></script>
			<title>
				<? echo $this->config->item('config_blog_title')." - ".$page_title; ?>
			</title>
		</head>
		<body>
			<div class="container">
				<div class="wrapper">
					<div class="header">
						<h1>
							<? echo anchor(base_url(), $this->config->item('config_blog_title'), array('class' => 'maintitle')); ?>
						</h1>
						<h2>
							<? echo $this->config->item('config_blog_sub_title'); ?>
						</h2>
					</div>
					<div class="content">
						<? $this->view->show_simple($view_name)?>
						<? $this->view->show_simple('sidebar')?>
					</div>
					<div class="footer">
						<p>
							Running on DBlog v<? echo $this->config->item('dblog_version'); ?> - Powered by <? echo anchor('http://www.codeigniter.com', 'CodeIgniter', array('class' => 'footer', 'target' => '_blank')); ?><br/>
							&copy; 2009 - David Behler
						</p>
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