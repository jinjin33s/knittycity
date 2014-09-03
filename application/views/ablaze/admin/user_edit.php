<div class="box">
	<h2>
		Edit user
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
	<? echo form_open('admin/user/edit/'.$user['user_id']); ?>
		<table cellpadding="0" cellspacing="0" class="form">
			<tbody>
				<tr>
					<td>
						Name <span class="small">(Cannot be changed)</span>
					</td>
				</tr>
				<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'user_name',
							              'id'          => 'user_name',
							              'maxlength'   => '30',
							              'size'        => '85',
							              'disabled'	=> 'disabled',
							              'value'		=> set_value('user_name', $user['user_name'])
							            );

							echo form_input($data);
						?>
						<br/>
					</td>
				</tr>
				<tr>
					<td>
						E-Mail
					</td>
				</tr>
				<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'user_email',
							              'id'          => 'user_email',
							              'maxlength'   => '100',
							              'size'        => '85',
							              'value'		=> set_value('user_email', $user['user_email'])
							            );

							echo form_input($data);
						?>
					</td>
				</tr>
				<tr>
					<td>
						Website
					</td>
				</tr>
				<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'user_website',
							              'id'          => 'user_euser_websitemail',
							              'maxlength'   => '200',
							              'size'        => '85',
							              'value'		=> set_value('user_website', $user['user_website'])
							            );

							echo form_input($data);
						?>
					</td>
				</tr>
			</tbody>
		</table>
		<?
			if($this->auth->has_right('can_edit_user'))
			{
		?>
				<div class="inner_box">
					<table cellpadding="0" cellspacing="0" class="small">
						<thead>
							<tr>
								<td colspan="2">
									<h3>
										Groups
									</h3>
								</td>
							</tr>
						</thead>
						<tbody>
							<?
								if(is_array($group_list))
								{
									foreach($group_list as $group)
									{
							?>
										<tr>
											<td>
												<? echo $group['group_name']; ?>
											</td>
											<td>
							<?
												$data = array(
												    'name'        => 'group_id[]',
												    'value'       => $group['group_id'],
												    'checked'     => set_checkbox('group_id[]', $group['group_id'], isset($user['group_list'][$group['group_id']])),
												    'class'		=> 'no_border'
												    );

												echo form_checkbox($data);
							?>
											</td>
										</tr>
							<?
									}
								}
							?>
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
				</div>
		<?
			}
			else
			{
		?>
				<table cellpadding="0" cellspacing="0" class="form">
					<tbody>
						<tr>
							<td>
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
		<?
			}
		?>
		<? echo form_close(); ?>
		<? echo form_open('admin/user/changepass/'.$user['user_id']); ?>
		<div class="inner_box">
			<table cellpadding="0" cellspacing="0" class="small">
				<thead>
					<tr>
						<td colspan="2">
							<h3>
								Change password
							</h3>
						</td>
					</tr>
				</thead>
				<tbody>
		<?
					if(($this->auth->has_right('can_edit_own_user') AND $this->auth->get_user_id() == $user['user_id']))
					{
		?>
						<tr>
							<td class="left">
								Current password
							</td>
							<td class="right">
								<?
									$data = array(
									              'name'        => 'current_password',
									              'id'          => 'current_password',
									              'maxlength'   => '100',
									              'size'        => '30'
									            );

									echo form_password($data);
								?>
							</td>
						</tr>
		<?
					}
		?>
					<tr>
						<td class="left">
							New password
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
						<td colspan="2">
							<?
								$data = array(
								              'name'        => 'submit_password',
								              'id'          => 'submit_password',
								              'value'		=> 'Save',
								              'class'		=> 'submit'
								            );

								echo form_submit($data);
							?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	<? echo form_close(); ?>
</div>