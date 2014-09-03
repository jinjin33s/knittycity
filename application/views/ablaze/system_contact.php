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
											<p>
												<?
													if(!$this->auth->is_logged_in())
													{
												?>
													<? echo form_label('Name', 'contact_name'); ?>
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
													<? echo form_label('E-Mail', 'contact_email'); ?>
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
												<?
													}
													else
													{
												?>
													<? echo form_label('Name', 'contact_name'); ?>
													<?
														$data = array(
														              'name'        => 'contact_name',
														              'id'          => 'contact_name',
														              'maxlength'   => '30',
														              'size'        => '30',
														              'value'		=> set_value('contact_name', $user['user_name']),
														              'readonly'	=> 1
														            );

														echo form_input($data);
													?>
													<? echo form_label('E-Mail', 'contact_email'); ?>
													<?
														$data = array(
														              'name'        => 'contact_email',
														              'id'          => 'contact_email',
														              'maxlength'   => '100',
														              'size'        => '30',
														              'value'		=> set_value('contact_email', $user['user_email']),
														              'readonly'	=> 1
														            );

														echo form_input($data);
													?>
												<?
													}
												?>
												<? echo form_label('Subject', 'contact_subject'); ?>
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
												<? echo form_label('Subject', 'contact_subject'); ?>
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
												<br/>
												<? echo form_submit('submit', 'Submit'); ?>
											</p>
										<? echo form_close(); ?>