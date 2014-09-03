	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
		<head>
			<meta http-equiv="content-type" content="text/html;charset=utf-8" />
			<link rel="stylesheet" type="text/css" media="screen,projection" href="<? echo site_url('admin/system/css'); ?>" />
			<?
				foreach($js_list as $js_file)
				{
			?>
					<script src="<? echo base_url('js/'.$js_file); ?>" type="text/javascript"></script>
			<?
				}
			?>
			<title>
				<? echo $this->config->item('config_blog_title')." - Administration - ".$page_title; ?>
			</title>
			<? $this->modules->call_hook('admin_view_head'); ?>
		</head>
		<body>
			<div class="top_bar">
				<div class="top_bar_item">
					<? echo anchor('post/overview', '<< Return to blog'); ?>
				</div>
				<? $this->modules->call_hook('admin_view_top_bar'); ?>
			</div>
			<div class="container">
				<div class="nav">
					<? $this->view->show_simple('navigation')?>
				</div>
				<div class="content">
					<? $this->view->show_simple($view_name)?>
				</div>
			</div>
		</body>
	</html>