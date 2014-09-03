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
			<link rel="stylesheet" type="text/css" media="screen,projection" href="<? echo shared_url('css/moz.css');?>"/>

                        <link rel="stylesheet" type="text/css" media="screen,projection" href="<? echo shared_url('css/moz_wrapper.css');?>"/>

                        <link rel="stylesheet" type="text/css" media="screen,projection" href="<? echo shared_url('css/moz_header.css');?>"/>
                         
                        <link rel="stylesheet" type="text/css" media="screen,projection" href="<? echo shared_url('css/moz_footer.css');?>"/>

                        <link rel="stylesheet" type="text/css" media="screen,projection" href="<? echo shared_url('css/common.css');?>"/>

                         <link rel="stylesheet" type="text/css" media="screen,projection" href="<? echo base_url('application/views/mozzign/style/moz_blog.css');?>"/>

  			<link rel="alternate" type="application/rss+xml" title="Post overview" href="<? echo site_url('post/rss');?>" />

                        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
                        
                        <script type="text/javascript" src="<? echo shared_url('js/swfobject/swfobject.js');?>"></script>
                        
                        <script type="text/javascript" src="<? echo base_url('js/shCore.js');?>"></script>

                        <script type="text/javascript" src="<? echo base_url('js/shBrushPhp.js');?>"></script>

                        <script type="text/javascript" src="<? echo base_url('js/shBrushJScript.js');?>"></script>

                        <script type="text/javascript" src="<? echo base_url('js/shBrushSql.js');?>"></script>

                        <title>
                            Knitty City Online <?// echo $page_title; ?>
			</title>
		</head>
		<body>
			<div class="knitty_container">
				<div class="knitty_wrapper">
					<div class="knitty_header">
                                            
                                            <a href="<? echo base_url() . 'home' ?>" ><div id="knitty_logo"></div></a>
                                            <div id="knitty_navContainer">
                                                <div id="knitty_nav_top">
                                                    <div id="knitty_slogan"><img src="<?echo base_url("images/slogan.png") ?>" border="0"></div>
                                                    <ul class="knitty_topRightNav sangreycap" style="position:relative;z-index:10;margin-top:0px;font-size: 12px;" >
                                                                <li style="color:#f26701; letter-spacing: 2px">/</li>
                                                                <li><a href="/knittyblog/storeinfo" target="_self">store info</a></li>
                                                                <li style="color: #f26701; letter-spacing: 2px">/</li>
                                                                <li><a href="/store/index.php?route=product/product&path=78&product_id=105">gift card</a></li>
                                                                <li style="color:#f26701; letter-spacing: 2px">/</li>
                                                                <li><a href="/knittyblog/freestuff" target="_self">free stuff</a></li>
                                                                <li style="color:#f26701; letter-spacing: 2px">/</li>
                                                                <li ><a href="/knittyblog/community" target="_self">community</a></li>
                                                                <li style="color:#f26701; letter-spacing: 2px">/</li>
                                                                <li><a href="/knittyblog/kprofile" target="_self">profiles</a></li>
                                                                <li style="color:#f26701; letter-spacing: 2px">/</li>
                                                                <li><a href="/knittyblog/gallery" target="_self">photo gallery</a></li>
                                                                <li style="color:#f26701; letter-spacing: 2px">/</li>
                                                                <li><a href="/knittyblog/kcalendar" target="_self">calendar</a></li>
                                                                <li style="color:#f26701; letter-spacing: 2px">/</li>
                                                                
                                                     </ul>
                                                </div>
                                                
                                                <div id="knitty_nav">

                                                        <ul class="knitty_topNav" >
                                                                <li class="about<?php if(isset($pageCode) && $pageCode == "aboutus")echo ' selected';?>"><a href="<? echo base_url() . 'home/aboutus' ?>">about</a></li>
                                                                <li class="blog<?php if(isset($pageCode) && $pageCode == "blog")echo ' selected';?>"><a href="<? echo base_url() . 'post' ?>" >blog</a></li>
                                                                <li class="classes<?php if(isset($pageCode) && $pageCode == "class")echo ' selected';?>"><a href="<? echo base_url() . 'kclass' ?>">classes</a></li>
                                                                <li class="events<?php if(isset($pageCode) && $pageCode == "event")echo ' selected';?>"><a href="<? echo base_url() . 'kevent' ?>">events</a></li>
                                                                <li class="shopping<?php if(isset($pageCode) && $pageCode == "shop")echo ' selected';?>"><a href="/knittystore/">shopping</a></li>
                                                        </ul>
                                                </div>
                                            </div>
                                            
                    
                                        </div>


                                            
