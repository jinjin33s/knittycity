<? include "header.php" ?>

        <div id="container">
                         <div id="header">
                                <div class="div1">
                                            <img src="<?echo base_url('images/logo_small.png');?>" border="0">

                                </div>
                                <div class="admin_title">KNITTY CITY ADMIN  </div>
                                <div class="div2">
                                        
                                        <div class="top_bar_item" >
                                            <div>
                                                <a href="/knittyblog/index.php/system/logout">logout</a>

                                            </div>
                                            <div>
                                            <? echo anchor('post/overview', '&larr; return to BLOG'); ?>
                                            </div>
                                            <div>
                                            <? echo anchor('kclass', '&larr; return to CLASSES'); ?>
                                            </div>
                                            <div>
                                            <? echo anchor('kevent', '&larr; return to EVENTS'); ?>
                                            </div>
                                            <div>
                                            <? echo anchor('kprofile', '&larr; return to PROFILES'); ?>
                                            </div>
                                            <div>
                                            <? echo anchor('kcalendar', '&larr; return to CALENDAR'); ?>
                                            </div>
                                            
                                        </div>
                                        <? $this->modules->call_hook('admin_view_top_bar'); ?>
                                </div>
                         </div>
                        <div id="menu">
                            <? include "navigation.php" ?>
                        </div>
                         
                        <div id="content" >
                            <div class="box">
                                <div class="left"></div>
                                <div class="right"></div>
                                <div class="heading">
                                    <h1 class="viewname"><? echo $view_name;?></h1>
                                </div>
                                <div class="content">
                                    <?
                                        $this->view->show_simple($view_name);
                                    ?>
                                </div>
                            </div>
                        </div>
        </div>

<? include "footer.php" ?>
                   