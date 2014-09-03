<div class="box">
	<h2>
		Groups
	</h2>
	<?
		if($group_list['group_list'] == FALSE)
		{
	?>
			<h3>
				No groups
			</h3>
	<?
		}
		else
		{
	?>
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
			<? echo form_open('admin/group/overview', array('name' => 'group_delete', 'id' => 'group_delete')); ?>
			<table cellpadding="0" cellspacing="0" class="list">
				<thead>
					<tr>
						<th class="center">
							&nbsp;
						</th>
						<th>
							Name
						</th>
						<th>
							Users
						</th>
					</tr>
				</thead>
				<tbody>
					<?
						foreach($group_list['group_list'] as $group)
						{
					?>
							<tr>
								<td class="center">
					<?
									if($group['group_id'] == $this->config->item('config_new_user_group_id') OR $group['group_id'] == $this->config->item('config_not_logged_in_user_group_id'))
									{
										echo "&nbsp;";
									}
									else
									{
										$data = array(
										    'name'        => 'group_id[]',
										    'value'       => $group['group_id'],
										    'class'		=> 'no_border'
										    );

										echo form_checkbox($data);
									}
					?>
								</td>
								<td>
									<? echo anchor('admin/group/edit/'.$group['group_id'], $group['group_name']); ?>
								</td>
								<td>
									<? echo $group['user_count']; ?>
								</td>
							</tr>
					<?
						}
					?>
				</tbody>
				<tfoot>
					<tr>
						<th class="center">
							<?
								$data = array(
								              'name'        => 'submit',
								              'id'          => 'submit',
								              'value'		=> 'Delete',
								              'class'		=> 'submit'
								            );

								echo form_submit($data);
							?>
						</th>
						<th>
							Name
						</th>
						<th>
							Users
						</th>
					</tr>
				</tfoot>
			</table>
			<span class="small">Deleting groups won't delete the users assigned to them, instead they will be assigned to the standard group if otherwise they would be groupless. The standard group for new users can't be deleted.</span>
		<? echo form_close(); ?>
		<div class="pagination">
			<? echo $this->pagination->create_links($group_list['pagination_info']['page'], $group_list['pagination_info']['page_count'], 'admin/group/overview/');?>
		</div>
	<?
		}
	?>
</div>