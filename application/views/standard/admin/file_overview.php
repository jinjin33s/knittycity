<div class="box">
	<h2>
		Files
	</h2>
	<?
		if($file_list == FALSE)
		{
	?>
			<h3>
				No files
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
			<? echo form_open('admin/file/overview', array('name' => 'file_delete', 'id' => 'file_delete')); ?>
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
							Date added
						</th>
						<th>
							Counter
						</th>
						<th>
							Is online
						</th>
					</tr>
				</thead>
				<tbody>
					<?
						foreach($file_list['file_list'] as $file)
						{
					?>
							<tr>
								<td class="center">
					<?
										$data = array(
										    'name'        => 'file_id[]',
										    'value'       => $file['file_id'],
										    'class'		=> 'no_border'
										    );

										echo form_checkbox($data);
					?>
								</td>
								<td>
									<? echo anchor('admin/file/edit/'.$file['file_id'], $file['file_title']); ?>
								</td>
								<td>
									<? echo $file['file_date_add_formatted']; ?>
								</td>
								<td>
									<? echo $file['file_download_count']; ?>
								</td>
								<td>
									<?
										if($file['file_is_online'] == 1)
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
				<? echo $this->pagination->create_links($file_list['pagination_info']['page'], $file_list['pagination_info']['page_count'], 'admin/file/overview/');?>
			</div>
	<?
		}
	?>
</div>