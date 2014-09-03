	
	

  <div class="box">
	<h2>
		Update Image
	</h2>

	<form action="<?php echo site_url("admin_gallery/gallery/do_updateimage")?>" method="post" name="update_image">
		<table cellpadding="0" cellspacing="0" class="form">
			<tbody>
                            <tr>
					<td>
						Image
					</td>

					<td>
						<img src="<?php echo base_url().'uploads/'.$rows[0]->thumbnail; ?>" alt="" />
					</td>
				</tr>
                                  <tr>
					<td>
						Order ID: <em>Lower numbers will appear first</em>
					</td>

					<td>
						<?php $currID = $rows[0]->order_num; ?>
                                                    <select name="order_num" id="order_num">
                                                            <?php for($i=0;$i<101;$i++) { ?>
                                                            <option value="<?php echo $i;?>"<?php if($i==$currID) echo ' selected="selected"'; ?>><?php echo $i;?></option>
                                                            <?php } ?>
                                                    </select>
					</td>
				</tr>

				<tr>

                                        <td>Caption:</td>
					<td>
						<textarea name="caption" id="caption"><?php echo $rows[0]->caption; ?></textarea>
					</td>
				</tr>
                                <tr>
                                        <input type="hidden" name="img_id" id="img_id" value="<?php echo $rows[0]->img_id;?>" />
                                        <input type="hidden" name="cat_id" id="cat_id" value="<?php echo $rows[0]->cat_id;?>" />
					<td colspan="2">
						<?
							$data = array(
							              'name'        => 'submit',
							              'id'          => 'submit',
							              'value'		=> 'Save',
							              'class'		=> 'submit'
							            );

							echo form_submit($data);
						?>
					</td>
				</tr>
			</tbody>
		</table>
	<? echo form_close(); ?>
            <p><a href="javascript:history.go(-1)">Cancel</a></p>
</div>

