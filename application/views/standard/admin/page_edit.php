<div class="box">
	<h2>
		Edit page
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
	<? echo form_open('admin/page/edit/'.$page['page_id']); ?>
		<table cellpadding="0" cellspacing="0" class="form">
			<tbody>
				<tr>
					<td>
						Title
					</td>
				</tr>
				<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'page_title',
							              'id'          => 'page_title',
							              'maxlength'   => '100',
							              'size'        => '85',
							              'value'		=> set_value('page_title', $page['page_title'])
							            );

							echo form_input($data);
						?>
					</td>
				</tr>
				<tr>
					<td>
						Content
					</td>
				</tr>
				<tr>
					<td>
						<?
							echo $this->fckeditor->Create();
						?>
					</td>
				</tr>
				<tr>
					<td>
						Status
					</td>
				</tr>
				<tr>
					<td>
						<?
							$options = array
											(
							                  0  => 'Draft',
							                  1  => 'Published'
							                );

							echo form_dropdown('page_is_published', $options, set_value('page_is_published', $page['page_is_published']));
						?>
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