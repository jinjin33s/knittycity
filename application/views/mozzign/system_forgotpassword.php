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
							<? echo form_open('system/forgotpassword'); ?>
								<table cellpadding="0" cellspacing="0" class="form">
									<tbody>
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
											<td class="center" colspan="2">
												<? echo form_submit('submit', 'Request new password'); ?>
											</td>
										</tr>
									</tbody>
								</table>
							<? echo form_close(); ?>
						</div>