<div class="box">
	<h2>
		Add group
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
	<? echo form_open('admin/group/add'); ?>
		<table cellpadding="0" cellspacing="0" class="form">
			<tbody>
				<tr>
					<td>
						Name
					</td>
				</tr>
				<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'group_name',
							              'id'          => 'group_name',
							              'maxlength'   => '30',
							              'size'        => '85',
							              'value'		=> set_value('group_name')
							            );

							echo form_input($data);
						?>
						<br/>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="inner_box">
			<table cellpadding="0" cellspacing="0" class="small">
				<thead>
					<tr>
						<td colspan="2">
							<h3>
								Rights
							</h3>
						</td>
					</tr>
				</thead>
				<tbody>
					<?
						if(is_array($right_list))
						{
							foreach($right_list as $right)
							{
					?>
								<tr>
									<td>
										<? echo $right['right_title']; ?>
									</td>
									<td>
					<?
										$data = array(
										    'name'        => 'right_id[]',
										    'value'       => $right['right_id'],
										    'checked'     => set_checkbox('right_id[]', $right['right_id'], FALSE),
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
	<? echo form_close(); ?>
</div>