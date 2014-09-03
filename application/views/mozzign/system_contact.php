									<div class="contact">
										<h1>
											Contact
										</h1>
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
										<? echo form_open('system/contact'); ?>
											<table cellpadding="0" cellspacing="0" class="contact_form">
												<tbody>
													<?
														if(!$this->auth->is_logged_in())
														{
													?>
															<tr>
																<td class="left">
																	Name
																</td>
																<td class="right">
																	<?
																		$data = array(
																		              'name'        => 'contact_name',
																		              'id'          => 'contact_name',
																		              'maxlength'   => '30',
																		              'size'        => '30',
																		              'value'		=> set_value('contact_name')
																		            );

																		echo form_input($data);
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
																		              'name'        => 'contact_email',
																		              'id'          => 'contact_email',
																		              'maxlength'   => '100',
																		              'size'        => '30',
																		              'value'		=> set_value('contact_email')
																		            );

																		echo form_input($data);
																	?>
																</td>
															</tr>
													<?
														}
														else
														{
													?>
															<tr>
																<td class="left">
																	Name
																</td>
																<td class="right">
																	<? echo $user['user_name']; ?>
																	<? echo form_hidden('contact_name', $user['user_name']); ?>
																</td>
															</tr>
															<tr>
																<td class="left">
																	E-Mail
																</td>
																<td class="right">
																	<? echo $user['user_email']; ?>
																	<? echo form_hidden('contact_email', $user['user_email']); ?>
																</td>
															</tr>
													<?
														}
													?>
													<tr>
														<td class="left">
															Subject
														</td>
														<td class="right">
															<?
																$data = array(
																              'name'        => 'contact_subject',
																              'id'          => 'contact_subject',
																              'maxlength'   => '30',
																              'size'        => '30',
																              'value'		=> set_value('contact_subject')
																            );

																echo form_input($data);
															?>
														</td>
													</tr>
													<tr>
														<td class="right" colspan="2">
															<?
																$data = array(
																              'name'        => 'contact_content',
																              'id'          => 'contact_content',
																              'cols'  		=> '80',
																              'rows'        => '10',
																              'value'		=> set_value('contact_content')
																            );

																echo form_textarea($data);
															?>
														</td>
													</tr>
													<tr>
														<td class="right" colspan="2">
															<? echo form_submit('submit', 'Submit'); ?>
														</td>
													</tr>
												</tbody>
											</table>
										<? echo form_close(); ?>
									</div>