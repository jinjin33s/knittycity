<div class="maincontent_topmenu">
        <div class="title" style="width:330px;">
                <img src="<?php echo base_url(); ?>images/topmenutitle/title_gallery.png" width="288" height="52" />
        </div>

        <div class="gotonaviwrapper">
            <div class="gotonavi"><span id="backtolist"></span><a href="http://www.knittycity.com/knittyblog/gallery">back to list</a></div>
            <?php  if ($rows->prevId == "") { ?>
                <div class="gotonavi"><span id="previousslide"></span><a href="#">previous slide</a></div>
            <?php } else { ?>
                <div class="gotonavi"><span id="previousslide"></span><a href="http://www.knittycity.com/knittyblog/gallery/view/<?= $rows->prevId ?>">previous slide</a></div>
            <?php } ?>
            <?php  if ($rows->nextId == "") { ?>
                <div class="gotonavi"><span id="nextslide"></span><a href="#">next slide</a></div>
            <?php } else { ?>
                <div class="gotonavi"><span id="nextslide"></span><a href="http://www.knittycity.com/knittyblog/gallery/view/<?= $rows->nextId ?>">next slide</a></div>
            <?php } ?>
        </div>

    <div style="display:none">
        <?= var_dump($rows);?>
    </div>

        <?php //echo var_dump($rows);?>
        <div class="postlistWide">

                    <div class="gallery_content">
                        <?php

                        if($this->uri->segment(4))
                        {
                                $images = $rows->images;

                                foreach( $images as $r) {
                                    if($r->img_id == $this->uri->segment(4))
                                     {
                                        $found = $r;
                                        break;
                                      }
                                 }
                        }

                         if(isset($found)){
                         ?>

                            <img width="550px" src="<? echo base_url('uploads/'.$found->filename); ?>">
                            <div id="gallery_caption"> <? echo $found->caption; ?></div>

                         <?php }else{?>

                            <img  width="550px"  src="<? echo base_url('uploads/'.$rows->images[0]->filename); ?>">
                            <div id="gallery_caption"><? echo $rows->images[0]->caption; ?></div>


                          <?php } ?>
                    </div>



                    <div style="color:#EB6226;
                                margin-top:5px;
                                font-size: 25px;
                                font-weight: 100;
                                letter-spacing: 1px;
                                line-height: 1.1em;
                                margin-bottom: 10px;
                                text-transform: lowercase;">
                        "<? echo $rows->title; ?>"
                    </div>

                    <h3 style="font-weight: normal;font-size: 14px;line-height: 18px;width:500px;margin-left:auto;margin-right:auto;">
                            <? echo $rows->description; ?>
                    </h3>

                <?php
                        $images = $rows->images;
                        foreach( $images as $r) { ?>

                        <div class="gallery_small_list">
                            <a href="<? echo base_url()."gallery/view/".$rows->id."/".$r->img_id;?>">
                                <div><?php
                                        if(!empty($r->caption))
                                         {
                                            //echo $r->caption;
                                         }
                                       ?>
                                </div>
                                <div>
                                    <img width="50" src="<?=base_url("uploads/".$r->thumbnail)?>">
                                </div>
                            </a>
                        </div>
                <?php } ?>
        </div>
</div>
