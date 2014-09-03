<div class="box">
	<h2>
		Users
	</h2>
	<?
		if($user_list == FALSE)
		{
	?>
			<h3>
				No users
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
			<table cellpadding="0" cellspacing="0" class="list">
				<thead>
					<tr>
						<th>
							Name
						</th>
						<th>
							E-Mail
						</th>
						<th>
							Posts
						</th>
						<th>
							Comments
						</th>
					</tr>
				</thead>
				<tbody>
					<?
						foreach($user_list['user_list'] as $user)
						{
					?>
							<tr>
								<td>
									<? echo anchor('admin/user/edit/'.$user['user_id'], $user['user_name']); ?>
								</td>
								<td>
									<? echo $user['user_email']; ?>
								</td>
								<td>
									<? echo $user['post_count']; ?>
								</td>
								<td>
									<? echo $user['comment_count']; ?> (<? echo $user['not_approved_comment_count']; ?> not approved)
								</td>
							</tr>
					<?
						}
					?>
				</tbody>
				<tfoot>
					<tr>
						<th>
							Name
						</th>
						<th>
							E-Mail
						</th>
						<th>
							Posts
						</th>
						<th>
							Comments
						</th>
					</tr>
				</tfoot>
			</table>
			<div class="pagination">
				<? echo $this->pagination->create_links($user_list['pagination_info']['page'], $user_list['pagination_info']['page_count'], 'admin/user/overview/');?>
			</div>
	<?
		}
	?>
</div>