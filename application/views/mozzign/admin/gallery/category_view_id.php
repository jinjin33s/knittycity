<?php include "gallery_tabs.php";?>
               
		
<div class="box">
 <h1>Category Details</h1>
		<p><a href="<?php echo site_url("admin_gallery/gallery")?>">Back to Gallery</a></p>
		<table cellpadding="0" cellspacing="0" class="form">
			<tbody>
                            <tr>
					<td>
						Title
					</td>

					<td>
						<?php echo $rows[0]->title; ?>
					</td>
				</tr>
                                <tr>
					<td>
						Description:
					</td>
					<td>
						<?php echo $rows[0]->description; ?><
					</td>
				</tr>
                                
			</tbody>
		</table>
</div>