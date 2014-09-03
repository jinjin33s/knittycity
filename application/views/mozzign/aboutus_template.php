<?php $pageCode = "aboutus"; ?>
<?php include "includes/header.php" ?>

            <div class="knitty_content">

                <? $this->view->show_simple('sidebar_home')?>

                <div id="banner_about" class="banner"></div>

                
                <? $this->view->show_simple($view_name)?>

                <? $this->view->show_simple('rightbar')?>

                    
            </div>


<?php include "includes/footer.php" ?>

