<?php $pageCode = "blog"; ?>
<?php include "includes/header.php" ?>

            <div class="knitty_content">

                <? $this->view->show_simple('sidebar_blog')?>
                <div id="banner_blog" class="banner"></div>
                <? $this->view->show_simple($view_name)?>
                <? $this->view->show_simple('rightbar')?>

                    
            </div>


<?php include "includes/footer.php" ?>

