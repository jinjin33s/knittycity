							<? echo form_open('system/register'); ?>
								<?
									if(count($error_list) > 0)
									{
								?>
										<table cellpadding="0" cellspacing="0" class="form_error">
											<tbody>
												<?
													foreach($error_list as $error)
													{
												?>
														<tr>
															<td>
																<? echo $error; ?>
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
								<? echo form_label('Name', 'user_name'); ?>
								<?
									$data = array(
									              'name'        => 'user_name',
									              'id'          => 'user_name',
									              'value'       => set_value('user_name'),
									              'maxlength'   => '30',
									              'size'        => '30'
									            );

									echo form_input($data);
								?>
								<? echo form_label('Password', 'user_password'); ?>
								<?
									$data = array(
									              'name'        => 'user_password',
									              'id'          => 'user_password',
									              'maxlength'   => '100',
									              'size'        => '30'
									            );

									echo form_password($data);
								?>
								<? echo form_label('Password confirmation', 'user_password_conf'); ?>
								<?
									$data = array(
									              'name'        => 'user_password_conf',
									              'id'          => 'user_password_conf',
									              'maxlength'   => '100',
									              'size'        => '30'
									            );

									echo form_password($data);
								?>
								<? echo form_label('E-Mail', 'user_email'); ?>
								<?
									$data = array(
									              'name'        => 'user_email',
									              'id'          => 'user_email',
									              'value'       => set_value('user_email'),
									              'maxlength'   => '30',
									              'size'        => '30'
									            );

									echo form_input($data);
								?>
								<? echo form_label('E-Mail confirmation', 'user_email_conf'); ?>
								<?
									$data = array(
									              'name'        => 'user_email_conf',
									              'id'          => 'user_email_conf',
									              'value'       => set_value('user_email_conf'),
									              'maxlength'   => '30',
									              'size'        => '30'
									            );

									echo form_input($data);
								?>
								<br/>
								<br/>
								<? echo form_submit('submit', 'Register'); ?>
							<? echo form_close(); ?>