<div class="box">
	<h2>
		Edit comment
	</h2>
	<?
		if(count($error_list) > 0 OR count($notice_list) > 0)
		{
	?>
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

	<?
		}
	?>
	<? echo form_open('admin/comment/edit/'.$comment['comment_id']); ?>
		<table cellpadding="0" cellspacing="0" class="form">
			<tbody>
				<tr>
					<td>
						Content
					</td>
				</tr>
				<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'comment_content',
							              'id'          => 'comment_content',
							              'cols'  		=> '112',
							              'rows'        => '5',
							              'value'		=> set_value('comment_content', $comment['comment_content'])
							            );

							echo form_textarea($data);
						?>
					</td>
				</tr>
				<tr>
					<td>
						Approved
					</td>
				</tr>
				<tr>
					<td>
						<?
							$options = array
											(
							                  0  => 'No',
							                  1  => 'Yes'
							                );

							echo form_dropdown('comment_is_approved', $options, set_value('comment_is_approved', $comment['comment_is_approved']));
						?>
					</td>
				</tr>
				<tr>
					<td>
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