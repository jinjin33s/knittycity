<div class="box">
	<h2>
		Edit file
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
	<? echo form_open('admin/file/edit/'.$file['file_id']); ?>
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
							              'name'        => 'file_title',
							              'id'          => 'file_title',
							              'maxlength'   => '100',
							              'size'        => '85',
							              'value'		=> set_value('file_title', $file['file_title'])
							            );

							echo form_input($data);
						?>
					</td>
				</tr>
				<tr>
					<td>
						Mirrors
					</td>
				</tr>
				<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'file_mirror',
							              'id'          => 'file_mirror',
							              'cols'   		=> '110',
							              'rows'        => '10',
							              'value'		=> set_value('file_mirror', $file['file_mirror'])
							            );

							echo form_textarea($data);
						?>
						<br/>
						<small class="small">One mirror per row, source type, url and title seperated by ||.<br/>Example:<br/>extern || http://www.example.com/path/to/file || Title of this download<br/>intern || path/to/file || Title of this download</small>
					</td>
				</tr>
				<tr>
					<td>
						Description
					</td>
				</tr>
				<tr>
					<td>
						<?
							$fckeditorConfig = array(
													'instanceName' => 'file_description',
													'BasePath' => base_url().APPPATH.'plugins/fckeditor/',
													'ToolbarSet' => 'Default',
													'Width' => '710px',
													'Height' => '400',
													'Value' => unprep_for_form(set_value('file_description', $file['file_description']))
													);
							$this->fckeditor->init($fckeditorConfig);
							echo $this->fckeditor->Create();
						?>
					</td>
				</tr>
				<tr>
					<td>
						Size
					</td>
				</tr>
				<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'file_size',
							              'id'          => 'file_size',
							              'maxlength'   => '100',
							              'size'        => '85',
							              'value'		=> set_value('file_size', $file['file_size'])
							            );

							echo form_input($data);
						?>
					</td>
				</tr>
				<tr>
					<td>
						Is online
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

							echo form_dropdown('file_is_online', $options, set_value('file_is_online', $file['file_is_online']));
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