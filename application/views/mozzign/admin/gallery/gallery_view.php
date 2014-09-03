<?php
    include "gallery_tabs.php";
?>

                <h1>Gallery</h1>
		
                <p><img src="<?php echo base_url();?>/images/icon_add.png" alt="Add new" /><a href="<?=site_url("admin_gallery/gallery/add")?>">Add new album</a></p>

		<table cellpadding="4" cellspacing="1" border="0" bgcolor="#cccccc" width="100%">
			<tr>
				<td bgcolor="#cccccc"><strong>Albums</strong></td>
                                <td bgcolor="#cccccc"><strong>Date</strong></td>
				<td bgcolor="#cccccc" colspan="5"><strong>Image</strong></td>
			</tr>
		<?php if(isset($rows)) {
			foreach($rows as $r) { ?>
			<tr onmouseover="this.bgColor='#dddddd'" onmouseout ="this.bgColor='#ffffff'" bgcolor="#ffffff">
				<td><?php echo $r->title; ?></td>
                                <td width="100"><?php echo $r->date; ?></td>
                                <td class="gallerypic" bgcolor="#ffffff" width="70"><a href="<?php echo base_url();?>uploads/<?php echo $r->thumbnail;?>"><img src="<?php echo base_url();?>uploads/<?php echo $r->thumbnail;?>" /></a></td>
                                <td width="150"><img src="<?php echo base_url();?>/images/icon_images.png" alt="Manage images" /> <a href="<?=site_url("admin_gallery/gallery/images/".$r->id)?>">Manage Images</a></td>
				<td width="100"><img src="<?php echo base_url();?>/images/icon_view.png" alt="View" /> <a href="<?=site_url("admin_gallery/gallery/view/".$r->id)?>">View</a></td>
				<td width="100"><img src="<?php echo base_url();?>/images/icon_update.png" alt="Edit" /> <a href="<?=site_url("admin_gallery/gallery/update/".$r->id)?>">Edit</a></td>
				<td width="100"><img src="<?php echo base_url();?>/images/icon_delete.png" alt="Delete" /><a href="<?=site_url("admin_gallery/gallery/delete/".$r->id)?>">Delete</a></td>
			</tr>
		<?php } } ?>
                        <?php if(isset($rows1)) {
                            foreach($rows1 as $r1) { ?>
                        <tr>
                        <td><?php echo $r1->caption; ?></td>
                        </tr>
                        <?php } } ?>
		</table>

