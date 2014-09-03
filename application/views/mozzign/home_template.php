<?php $pageCode = "home"; ?>
<?php include "includes/header.php" ?>
<title>Knitty City Online</title>
            <div class="knitty_content">

                <? $this->view->show_simple('sidebar_home')?>

                <div id="banner_home" class="blog" style="position:relative;z-index:1;">
                    <div style="width:700px;height:385px;float:left;position:relative;z-index:1;">
                        <div id="banner_prototype">
                                <script type="text/javascript">
                                        var flashvars = {};
                                        var params={wmode:"transparent"};
                                        swfobject.embedSWF("<? echo shared_url('images/banner/banner_main_1.swf');?>", "banner_prototype", "700", "385", "10.0.0","expressInstall.swf",flashvars,params);
                                </script>
                        </div>
                    </div>
                </div>
                
                <? $this->view->show_simple($view_name)?>
                <? $this->view->show_simple('rightbar')?>

                    
            </div>


<?php include "includes/footer.php" ?>

