<div class="box">
	<h2>
		Posts
	</h2>
	<?
		if($post_list == FALSE)
		{
	?>
			<h3>
				No posts
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
			<? echo form_open('admin/post/overview', array('name' => 'post_delete', 'id' => 'post_delete')); ?>
			<table cellpadding="0" cellspacing="0" class="list">
				<thead>
					<tr>
						<th class="center">
							&nbsp;
						</th>
						<th>
							Title
						</th>
						<th>
							Author
						</th>
						<th>
							Date
						</th>
					</tr>
				</thead>
				<tbody>
					<?
						foreach($post_list['post_list'] as $post)
						{
					?>
							<tr>
								<td class="center">
					<?
										$data = array(
										    'name'        => 'post_id[]',
										    'value'       => $post['post_id'],
										    'class'		=> 'no_border'
										    );

										echo form_checkbox($data);
					?>
								</td>
								<td>
									<? echo anchor('admin/post/edit/'.$post['post_id'], $post['post_title']); ?> (<? echo $post['comment_count']; ?> comments total, <? echo $post['not_approved_comment_count']; ?> not approved)
								</td>
								<td>
									<? echo anchor('admin/user/edit/'.$post['user_id'], $post['user_name']); ?>
								</td>
								<td>
									<?
										if($post['post_is_published'] == 1)
										{
											echo $post['post_date_edit_formatted']."<br/> published";
										}
										else
										{
											echo $post['post_date_edit_formatted']."<br/> last modified";
										}
									?>
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
							Title
						</th>
						<th>
							Author
						</th>
						<th>
							Date
						</th>
					</tr>
				</tfoot>
			</table>
			<? echo form_close(); ?>
			<div class="pagination">
				<? echo $this->pagination->create_links($post_list['pagination_info']['page'], $post_list['pagination_info']['page_count'], 'admin/post/overview/');?>
			</div>
	<?
		}
	?>
</div>