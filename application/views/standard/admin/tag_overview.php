<div class="box">
	<h2>
		Tags
	</h2>
	<?
		if($tag_list['tag_list'] == FALSE)
		{
	?>
			<h3>
				No tags
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
			<? echo form_open('admin/tag/overview', array('name' => 'tag_delete', 'id' => 'tag_delete')); ?>
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
							Posts
						</th>
						<th>
							Last used
						</th>
					</tr>
				</thead>
				<tbody>
					<?
						foreach($tag_list['tag_list'] as $tag)
						{
					?>
							<tr>
								<td class="center">
					<?
										$data = array(
										    'name'        => 'tag_id[]',
										    'value'       => $tag['tag_id'],
										    'class'		=> 'no_border'
										    );

										echo form_checkbox($data);
					?>
								</td>
								<td>
									<? echo $tag['tag_name']; ?>
								</td>
								<td>
									<? echo $tag['post_count']; ?>
								</td>
								<td>
									<? echo $tag['tag_date_last_used_formatted']; ?>
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
							Posts
						</th>
						<th>
							Last used
						</th>
					</tr>
				</tfoot>
			</table>
			<? echo form_close(); ?>
			<div class="pagination">
				<? echo $this->pagination->create_links($tag_list['pagination_info']['page'], $tag_list['pagination_info']['page_count'], 'admin/tag/overview/');?>
			</div>
	<?
		}
	?>
</div>