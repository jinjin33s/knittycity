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
							<? echo form_open('system/register'); ?>
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
													              'value'       => set_value('user_name'),
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
											<td class="left">
												Password confirmation
											</td>
											<td class="right">
												<?
													$data = array(
													              'name'        => 'user_password_conf',
													              'id'          => 'user_password_conf',
													              'maxlength'   => '100',
													              'size'        => '30'
													            );

													echo form_password($data);
												?>
											</td>
										</tr>
										<tr>
											<td class="left">
												E-Mail
											</td>
											<td class="right">
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
											</td>
										</tr>
										<tr>
											<td class="left">
												E-Mail confirmation
											</td>
											<td class="right">
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
											</td>
										</tr>
										<tr>
											<td class="center" colspan="2">
												<? echo form_submit('submit', 'Register'); ?>
											</td>
										</tr>
									</tbody>
								</table>
							<? echo form_close(); ?>
						</div>