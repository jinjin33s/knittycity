<div class="box">
	<h2>
		Links
	</h2>
	<?
		if($link_list == FALSE)
		{
	?>
			<h3>
				No links
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
			<? echo form_open('admin/link/overview', array('name' => 'link_delete', 'id' => 'link_delete')); ?>
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
							Url
						</th>
						<th>
							Is blog
						</th>
					</tr>
				</thead>
				<tbody>
					<?
						foreach($link_list['link_list'] as $link)
						{
					?>
							<tr>
								<td class="center">
					<?
										$data = array(
										    'name'        => 'link_id[]',
										    'value'       => $link['link_id'],
										    'class'		=> 'no_border'
										    );

										echo form_checkbox($data);
					?>
								</td>
								<td>
									<? echo anchor('admin/link/edit/'.$link['link_id'], $link['link_title']); ?>
								</td>
								<td>
									<? echo $link['link_url']; ?>
								</td>
								<td>
									<?
										if($link['link_is_blog'] == 1)
										{
											echo "Yes";
										}
										else
										{
											echo "No";
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
							Url
						</th>
						<th>
							Is blog
						</th>
					</tr>
				</tfoot>
			</table>
			<? echo form_close(); ?>
			<div class="pagination">
				<? echo $this->pagination->create_links($link_list['pagination_info']['page'], $link_list['pagination_info']['page_count'], 'admin/link/overview/');?>
			</div>
	<?
		}
	?>
</div>