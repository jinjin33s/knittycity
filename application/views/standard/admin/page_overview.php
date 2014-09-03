<div class="box">
	<h2>
		Pages
	</h2>
	<?
		if($page_list == FALSE)
		{
	?>
			<h3>
				No pages
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
			<? echo form_open('admin/page/overview', array('name' => 'page_delete', 'id' => 'page_delete')); ?>
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
							Date
						</th>
						<th>
							Order
						</th>
					</tr>
				</thead>
				<tbody>
					<?
						foreach($page_list['page_list'] as $page)
						{
					?>
							<tr>
								<td class="center">
					<?
										$data = array(
										    'name'        => 'page_id[]',
										    'value'       => $page['page_id'],
										    'class'		=> 'no_border'
										    );

										echo form_checkbox($data);
					?>
								</td>
								<td>
									<? echo anchor('admin/page/edit/'.$page['page_id'], $page['page_title']); ?>
								</td>
								<td>
									<?
										if($page['page_is_published'] == 1)
										{
											echo $page['page_date_edit_formatted']."<br/> published";
										}
										else
										{
											echo $page['page_date_edit_formatted']."<br/> last modified";
										}
									?>
								</td>
								<td>
									<? echo anchor('admin/page/sort/up/'.$page['page_id'], img($this->view->img_base_url('arrow_up.png'))); ?>
									<? echo anchor('admin/page/sort/down/'.$page['page_id'], img($this->view->img_base_url('arrow_down.png'))); ?>
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
							Date
						</th>
					</tr>
				</tfoot>
			</table>
			<? echo form_close(); ?>
			<div class="pagination">
				<? echo $this->pagination->create_links($page_list['pagination_info']['page'], $page_list['pagination_info']['page_count'], 'admin/page/overview/');?>
			</div>
	<?
		}
	?>
</div>