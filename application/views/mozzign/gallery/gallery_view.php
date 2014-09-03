		<h1>Gallery</h1>
		<p><img src="<?php echo base_url();?>/images/icon_add.png" alt="Add new" /><a href="<?=site_url("gallery/gallery/add")?>">Add new</a></p>
		<table cellpadding="4" cellspacing="1" border="0" bgcolor="#cccccc" width="100%">
			<tr>
				<td bgcolor="#cccccc"><strong>Categories</strong></td>
				<td bgcolor="#cccccc" colspan="5"><strong>Order ID</strong></td>
			</tr>
		<?php if(isset($rows)) {
			foreach($rows as $r) { ?>
			<tr onmouseover="this.bgColor='#dddddd'" onmouseout ="this.bgColor='#ffffff'" bgcolor="#ffffff">
				<td><?php echo $r->B.title; ?></td>
				<td width="70"><?php echo $r->B.order_id; ?></td>
				<td width="150"><img src="<?php echo base_url();?>/images/icon_images.png" alt="Manage images" /> <a href="<?=site_url("gallery/gallery/images/".$r->B.id)?>">Manage Images</a></td>
				<td width="100"><img src="<?php echo base_url();?>/images/icon_view.png" alt="View" /> <a href="<?=site_url("gallery/gallery/view/".$r->B.id)?>">View</a></td>
				<td width="100"><img src="<?php echo base_url();?>/images/icon_update.png" alt="Edit" /> <a href="<?=site_url("gallery/gallery/update/".$r->B.id)?>">Edit</a></td>
				<td width="100"><img src="<?php echo base_url();?>/images/icon_delete.png" alt="Delete" /><a href="<?=site_url("gallery/gallery/delete/".$r->B.id)?>">Delete</a></td>
			</tr>
		<?php } } ?>
		</table>
