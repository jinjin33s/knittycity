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
							<? echo form_open('system/login'); ?>
								<table cellpadding="0" cellspacing="0" class="form">
									<tbody>
										<tr>
											<td class="left">
												Name
											</td>
											<td class="right">
												<?
													$data = array(
													              'name'        => 'user_name',
													              'id'          => 'user_name',
													              'maxlength'   => '30',
													              'size'        => '30'
													            );

													echo form_input($data);
												?>
											</td>
										</tr>
										<tr>
											<td class="left">
												Password
											</td>
											<td class="right">
												<?
													$data = array(
													              'name'        => 'user_password',
													              'id'          => 'user_password',
													              'maxlength'   => '100',
													              'size'        => '30'
													            );

													echo form_password($data);
												?>
											</td>
										</tr>
										<tr>
											<td class="center" colspan="2">
												<? echo form_submit('submit', 'Log in'); ?>
												<? echo anchor("system/forgotpassword", 'Forgot password'); ?>
												<?
													if($this->config->item('config_enable_registration') == 1)
													{
														echo " | ".anchor("system/register", 'Register');
													}
												?>
											</td>
										</tr>
									</tbody>
								</table>
							<? echo form_close(); ?>
						</div>