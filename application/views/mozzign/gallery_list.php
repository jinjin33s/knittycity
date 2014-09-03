<div class="maincontent_topmenu" style="width: 700px;" >
    <div class="title" style="width:300px;">
          <img src="<?php echo base_url(); ?>images/topmenutitle/title_gallery.png" width="288" height="52" />
    </div>
    <div class="subtitle" style="width: 700px;margin-bottom: 0px;">
        Nothing says “community” like pictures and we love them - especially when we see projects made by our customers.  So, send ‘em on in!  Please don’t forget to add your name and the date, as well as any other info you’d like us to know.  Send all pictures to<span style=" font-weight: bold"> Pearl@knittycity.com</span>
    </div>
    
    <div class="postlistWide">
        <?  if(!isset($rows)){?>
			<h3>No Gallery</h3>
	<?  } else {
                           if(count($error_list) > 0 OR count($notice_list) > 0){ ?>

                                            <table cellpadding="0" cellspacing="0" class="form_info">
                                                    <tbody>
                                                            <?
                                                                    foreach($error_list as $error)
                                                                    {
                                                            ?>
                                                                            <tr>
                                                                                    <td class="error">
                                                                                            <? echo $error; ?>
                                                                                    </td>
                                                                            </tr>
                                                            <?
                                                                    }
                                                            ?>
                                                            <?
                                                                    foreach($notice_list as $notice)
                                                                    {
                                                            ?>
                                                                            <tr>
                                                                                    <td class="notice">
                                                                                            <? echo $notice; ?>
                                                                                    </td>
                                                                            </tr>
                                                            <?
                                                                    }
                                                            ?>
                                                    </tbody>
                                            </table>

                            <? }?>
                        <div class="pagination" style="float:right; margin-right: 16px;">
				<? echo $this->pagination->create_links($pagination_info['page'], $pagination_info['page_count'], 'gallery/overview/');?>
			</div>
                                    <?php if(isset($rows)) {?>
                                        <div style="margin-top:20px">
                                    <?php                                            
                                            foreach($rows as $r) {
                                                if(isset($r->thumbnail)){
                                                ?>

                                                        <div class="gallery_list">
                                                            <a href="<?=site_url("gallery/view/".$r->id);?>">
                                                            <div class="gallery_date"><?php echo date("D, M.j, Y", strtotime($r->date)); ?></div>
                                                            <div class="gallery_thumbnail">
                                                                <img src="<?=base_url("uploads/".$r->thumbnail)?>">
                                                            </div>
                                                            <div><?php echo $r->title; ?></div>
                                                            </a>
                                                        </div>
                                           
                                                <?php }} ?>
                                         </div>
                                    <?php }  ?>

	<? } ?>
    </div>
</div>