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
				<? //echo $this->config->item('config_blog_title')." - Administration - ".$page_title; ?>
			</title>
			<? $this->modules->call_hook('admin_view_head'); ?>
		</head>
		<body>
			<div class="top_bar">
				<div class="top_bar_item" >
                                    <div style="float:left;margin-left:-14px">
                                        <img src="<?echo base_url('images/logo_small.png');?>" border="0">
                                    </div>
                                    <div style="float:left;margin-left:-14px;font-size:11px; font-weight:800; font-style:italic;">
                                    <? echo anchor('post/overview', '&larr; return to BLOG'); ?>
                                    </div>
                                    <div style="float:left;margin-left:12px;font-size:11px; font-weight:800; font-style:italic;">
                                    <? echo anchor('kclass', '&larr; return to CLASSES'); ?>
                                    </div>
                                    <div style="float:left;margin-left:12px;font-size:11px; font-weight:800; font-style:italic;">
                                    <? echo anchor('kevent', '&larr; return to EVENTS'); ?>
                                    </div>
                                    <div style="float:left;margin-left:12px;font-size:11px; font-weight:800; font-style:italic;">
                                    <? echo anchor('kprofile', '&larr; return to PROFILES'); ?>
                                    </div>
                                    <div style="float:left;margin-left:12px;font-size:11px; font-weight:800; font-style:italic;">
                                    <? echo anchor('kcalendar', '&larr; return to CALENDAR'); ?>
                                    </div>
                                    <div style="float:left;margin-left:12px;font-size:11px; font-weight:800; font-style:italic;">
                                    <? echo anchor('subscriber', '&larr; return to CALENDAR'); ?>
                                    </div>
				</div>
				<? $this->modules->call_hook('admin_view_top_bar'); ?>
			</div>
			<div class="container" style="margin-top:0px;">
				<div class="nav">
					<? $this->view->show_simple('navigation')?>
				</div>
				<div class="content">
					<? $this->view->show_simple($view_name)?>
				</div>
			</div>
		</body>
	</html>