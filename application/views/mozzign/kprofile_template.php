<?php $pageCode = "profile"; ?>
<?php include "includes/header.php" ?>

            <div class="knitty_content" style="height:2000px;">

                <? $this->view->show_simple('sidebar_profiles')?>
                <div class="banner" style="height:100px;margin-top:40px;width: 600px;">
                    <div style="float: left;">
                        <img src="<?php echo base_url(); ?>images/topmenutitle/title_profiles.png" />
                    </div>
                    <div style="color: #222;
                                float: left;
                                font-family: helvetica, arial, san-serif;
                                font-size: 9px;
                                font-style: normal;
                                letter-spacing: 1px;
                                line-height: 1.5em;
                                margin-bottom: 0px;
                                margin-left: 0px;
                                margin-top: -5px;
                                text-transform: uppercase;" >
                        Nothing sets our hearts aflutter like the passion of artists. This monthly series
                        profiles some of the interesting and unique people we meet who make our lives
                        more enjoyable by creating special things and sharing them.
                    </div>
                </div>
                <? $this->view->show_simple($view_name)?>

                    
            </div>


<?php include "includes/footer.php" ?>

