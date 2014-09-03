
<div id="maincontent_home">
	<div style="float:left; margin-right:15px;padding-top:10px;margin-left:15px;">
    <img src="images/logo_knockout.png" width="110" height="110" />
    </div>
    
    <div style="float:left; width:345px; padding-bottom:10px; padding-right:15px;">
            <div><img src="images/tagline_home.gif" width="300" height="26" />
            </div>
            Welcome to Knitty City!!   Join our happy and friendly community.  Learn all about our beautiful yarns.   Find information about our classes. Read our blog and even better, come visit us   and meet our group of happy enthusiasts!  You can be sure that we will keep you in stitches! 
            <span class="greycaplink">
                <a href="/knittyblog/home/aboutus"><span style="color:#FFF; letter-spacing:2px;">learn</span> about us<span class="greycaplikarrow">&raquo;</span> </a>
            </span>
    </div>
    
    <div class="link_recentpost">
            <div class="titlewrapper">
            
                      <div class="linkwhatsnew">
                            <a href="#"></a>
                      </div>
                          
            </div>
            <div class="addgreyline_below">
            </div>
        <?php foreach($homeViewModelContainer['post_list'] as $post){?>
            <div class="detailwrapper" >
                        
                      <div class="detail">
                            <?php if(isset($post['post_image']) && strlen($post['post_image'])>0) { ?>
                                <div class="thumb" style="background:none;text-align:center">
                            		<a href="/knittyblog/post/view/<?echo $post['post_id'];?>"><img width="60" src="<?php echo $post['post_image'];?>"></a>
                                </div>
                             <?php }else{ ?>
                                <div class="thumb">
                                    <a style="display:block;width:60px;height:60px" href="/knittyblog/post/view/<?echo $post['post_id'];?>"></a>
                                </div>
                            <?php }?>
                            
                            <div class="text">
                                    <div class="slug"> <?= $post['post_date_publish_formatted'];?> </div>
                                    <div class="title">
                                    
                                        <a href="/knittyblog/post/view/<?echo $post['post_id'];?>">
                                            <?php echo $post['post_title'];?>
                                        </a>
                                        <?  /*
                                            if($post['post_excerpt'] != ''){
                                                    echo substr($post['post_excerpt'],0,40)."..";
                                            }else{

                                                    echo "<pre>".substr($post['post_content'],0,40).".."."</pre>";
                                              }*/ ?>
                                    </div>
                            </div>
                      </div>
                
                                            
            </div>
         <?}?>
            
            
    </div>
    


    <div class="link_whatsnew" style="margin-right:0px">
            <div class="titlewrapper">
            
                      <div class="linkwhatsnew">
                            <a href="#"></a>
                      </div>
                          
            </div>
            <div class="addgreyline_below">
            </div>

        <?php foreach($homeViewModelContainer['product_list'] as $product){
               // echo var_dump($product);
            ?>
            <div class="detailwrapper" >
                
                      <div class="detail">
                            
                               
                                <? if(!isset($product['image'])  || $product['image']  == '' )
                               {?>
                                <div class="thumb">
                                    <a href="/store/index.php?route=product/product&product_id=<?=$product['product_id'];?>">
                                       <img width="60px" src ="/knittycity/store/image/cache/no_image-108x144.jpg">
                                    </a>
                                </div>
                                <?}else{?>
                          <div class="thumb" style="background:none;text-align:center">
                                <a href="/store/index.php?route=product/product&product_id=<?=$product['product_id'];?>">
                                   <img src ="/store/image/<?= $product['image'];?>">
                                </a>
                          </div>
                                <?}?>
                            
                            <div class="text">
                                    <div class="slug"><?= $product['manufacturer'];?></div>
                                    <div class="title"> 
                                        <a href="/store/index.php?route=product/product&product_id=<?=$product['product_id'];?>">
                                            <?=$product['name'];?>
                                        </a>
                                    </div>
                            </div>
                      </div>
                                            
            </div>
             <?}?>
           
            
    </div>
    


</div>