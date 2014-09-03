<script>
 $(document).ready(function() {
     $("#profDate").datepicker({dateFormat:'yy-mm-dd'});
     $('#profDate').val('<?= $kprofile['profDate'];?>');
 });

 </script>

<div class="box">
	<h2>
		Edit Profile
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
	<? echo form_open('admin/kprofile/edit/'.$kprofile['prof_id']); ?>
		<table cellpadding="0" cellspacing="0" class="form">
			<tbody>
                            <tr>
					<td>
						Title
					</td>
				
					<td>
						<?
							$data = array(
							              'name'        => 'profTitle',
							              'id'          => 'profTitle',
							              'size'        => '85',
							              'value'		=> set_value('profTitle', $kprofile['profTitle'])
							            );

							echo form_input($data);
						?>
					</td>
				</tr>
                                 <tr>
				<tr>
					<td>
						Summary
					</td>

					<td>
						<?
							$data = array(
							              'name'        => 'profSummary',
							              'id'          => 'profSummary',
							              'size'        => '85',
                                                                      'style'       =>'height:50px;',
							              'value'		=> set_value('profSummary', $kprofile['profSummary'])
							            );

							echo form_textarea($data);
						?>
					</td>
				</tr>
					
				</tr>
                                <tr>
					<td>Feature Date </td>
                                        <td><?
							$data = array(
							              'name'        => 'profDate',
							              'id'          => 'profDate',
							              'maxlength'   => '20',
							              'size'        => '20',
							              'value'		=> set_value('profileDate', $kprofile['profDate'])
							            );

							echo form_input($data);
						?>
						
					</td>
				</tr>

				<tr>
                                        <td>Description</td>
					<td>
						<?
							$fckeditorConfig = array(
													'instanceName' => 'profContent',
													'BasePath' => base_url().APPPATH.'plugins/fckeditor/',
													'ToolbarSet' => 'Default',
													'Width' => '710px',
													'Height' => '400',
													'Value' => unprep_for_form(set_value('profContent', $kprofile['profContent']))
													);
							$this->fckeditor->init($fckeditorConfig);
							echo $this->fckeditor->Create();
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