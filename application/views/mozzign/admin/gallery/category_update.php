<?php include "gallery_tabs.php";?>
<script>

 $(document).ready(function() {
     $("#date").datepicker({dateFormat:'yy-mm-dd'});
 });
</script>
      
<div class="box">
	<h2>
		Edit Category
	</h2>

	<form action="<?php echo site_url("admin_gallery/gallery/updatecat")?>" method="post" name="insert_work">
		<table cellpadding="0" cellspacing="0" class="form">
			<tbody>
                            <tr>
					<td>
						Title
					</td>

					<td>
						<input type="text" name="title" id="title" value="<?php echo $rows[0]->title; ?>" />
					</td>
				</tr>
                                <tr>
                                <td>
					Date
				</td>
                                        <td> <?
							$data = array(
							              'name'        => 'date',
							              'id'          => 'date',
							              'maxlength'   => '20',
							              'size'        => '20',
							              'value'       => set_value('date', $rows[0]->date)
							            );

							echo form_input($data);
						?>
					</td>
                                </tr>
                                  <tr>
					<td>
						Order ID: <em>Lower numbers will appear first</em>
					</td>

					<td>
						<?php $currID = $rows[0]->order_id; ?>
                                                <select name="order_id" id="order_id">
                                                        <?php for($i=0;$i<101;$i++) { ?>
                                                        <option value="<?php echo $i;?>"<?php if($i==$currID) echo ' selected="selected"'; ?>><?php echo $i;?></option>
                                                        <?php } ?>
                                                </select>
					</td>
				</tr>
                               
				<tr>

                                        <td>Content</td>
					<td>
						<textarea name="description" id="description"><?php echo $rows[0]->description; ?></textarea>
					</td>
				</tr>
                                <tr>
                                        <input type="hidden" name="id" value="<?php echo $this->uri->segment(4)?>">
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
</div>