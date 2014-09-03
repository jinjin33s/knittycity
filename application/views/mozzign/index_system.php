	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
		<head>
			<meta http-equiv="content-type" content="text/html;charset=utf-8" />
			<link rel="stylesheet" type="text/css" media="screen,projection" href="<? echo site_url('system/css'); ?>" />
			<title>
				<? echo $this->config->item('config_blog_title')." - ".$page_title; ?>
			</title>
		</head>
		<body>
			<div class="top_bar">
				<? echo anchor('post/overview', '<< Return to blog'); ?>
			</div>
			<div class="container_system">
				<div class="wrapper">
					<div class="content">
						<? $this->view->show_simple($view_name)?>
					</div>
				</div>
			</div>
		</body>
	</html>