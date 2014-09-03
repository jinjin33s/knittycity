							<? echo form_open('system/login'); ?>
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
								<?
									if(count($notice_list) > 0)
									{
								?>
										<table cellpadding="0" cellspacing="0" class="form_notice">
											<tbody>
												<?
													foreach($notice_list as $notice)
													{
												?>
														<tr>
															<td>
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
								<? echo form_label('Name', 'user_name'); ?>
								<?
									$data = array(
									              'name'        => 'user_name',
									              'id'          => 'user_name',
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
								<br/>
								<br/>
								<? echo form_submit('submit', 'Log in'); ?>
								<? echo anchor("system/forgotpassword", 'Forgot password'); ?>
								<?
									if($this->config->item('config_enable_registration') == 1)
									{
										echo " | ".anchor("system/register", 'Register');
									}
								?>
							<? echo form_close(); ?>