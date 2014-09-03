<?php include "gallery_tabs.php";?>
<script>

 $(document).ready(function() {
     $("#date").datepicker({dateFormat:'yy-mm-dd'});
 });
</script>
<div class="box">
	<h2>
		Create Album
	</h2>

	<form action="<?php echo site_url("admin_gallery/gallery/insert")?>" method="post" name="insert_work">
		<table cellpadding="0" cellspacing="0" class="form">
			<tbody>
                            <tr>
                                <td>
					Title
				</td>
				<td>
					<input type="text" name="title" id="title" value="" />
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
							              'value'		=> set_value('date', date('Y-m-d'))
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
                                        <select name="order_id" id="order_id">
                                              <?php for($i=0;$i<101;$i++) { ?>
                                              <?php echo("<option value='$i'>$i</option>"); ?>
                                              <?php } ?>
                                        </select>
                                    </td>
				</tr>

				<tr>

                                        <td>Description</td>
					<td>
						<textarea name="description" id="description"></textarea>
					</td>
				</tr>
                                <tr>

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