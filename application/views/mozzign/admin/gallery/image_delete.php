<?php include "gallery_tabs.php";?>
                <h1>Delete Image</h1>
		<p>Delete?</p>
		<p><a href="<?php echo site_url("admin_gallery/gallery/do_remove/".$info[0]->img_id)?>">Yes</a> | <a href="javascript:history.go(-1)">No</a></p>
		<p><img src="<?php echo base_url();?>uploads/<?php echo $info[0]->filename?>" /></p>
