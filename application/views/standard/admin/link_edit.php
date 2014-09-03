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
	<? echo form_open('admin/link/edit/'.$link['link_id']); ?>
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
							              'name'        => 'link_title',
							              'id'          => 'link_title',
							              'maxlength'   => '100',
							              'size'        => '85',
							              'value'		=> set_value('link_title', $link['link_title'])
							            );

							echo form_input($data);
						?>
					</td>
				</tr>
				<tr>
					<td>
						Url
					</td>
				</tr>
				<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'link_url',
							              'id'          => 'link_url',
							              'maxlength'   => '200',
							              'size'        => '85',
							              'value'		=> set_value('link_url', $link['link_url'])
							            );

							echo form_input($data);
						?>
					</td>
				</tr>
				<tr>
					<td>
						Is blog
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

							echo form_dropdown('link_is_blog', $options, set_value('link_is_blog', $link['link_is_blog']));
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