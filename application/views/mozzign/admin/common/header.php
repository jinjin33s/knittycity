	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
		<head>
			<meta http-equiv="content-type" content="text/html;charset=utf-8" />
			
			<link rel="stylesheet" type="text/css" media="screen,projection" href="<? echo base_url('application/views/mozzign/admin/stylesheet/stylesheet.css'); ?>" />

                        
                         <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
                        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
                        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
                        
                        
                        <script type="text/javascript" src="<? echo base_url('application/views/mozzign/admin/javascript/jquery/superfish/js/superfish.js');?>"></script>
                        <script type="text/javascript" src="<? echo base_url('application/views/mozzign/admin/javascript/jquery/tab.js');?>"></script>


			<title>
				<? echo $this->config->item('config_blog_title')." - Administration - ".$page_title; ?>
			</title>
			<? $this->modules->call_hook('admin_view_head'); ?>
		</head>
		<body>
                    
                        