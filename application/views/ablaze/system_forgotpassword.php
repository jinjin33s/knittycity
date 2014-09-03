							<? echo form_open('system/forgotpassword'); ?>
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
								<? echo form_label('E-Mail', 'user_email'); ?>
								<?
									$data = array(
									              'name'        => 'user_email',
									              'id'          => 'user_email',
									              'maxlength'   => '30',
									              'size'        => '30'
									            );

									echo form_input($data);
								?>
								<br/>
								<br/>
								<? echo form_submit('submit', 'Request new password'); ?>
							<? echo form_close(); ?>