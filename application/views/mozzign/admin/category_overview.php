<div class="box">
	<h2>
		Categories
	</h2>
	<?
		if($category_list['category_list'] == FALSE)
		{
	?>
			<h3>
				No categories
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
			<? echo form_open('admin/category/overview', array('name' => 'category_delete', 'id' => 'category_delete')); ?>
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
							Order
						</th>
					</tr>
				</thead>
				<tbody>
					<?
						foreach($category_list['category_list'] as $category)
						{
					?>
							<tr>
								<td class="center">
					<?
									if($category['category_is_assignable'] == 1)
									{
										$data = array(
										    'name'        => 'category_id[]',
										    'value'       => $category['category_id'],
										    'class'		=> 'no_border'
										    );

										echo form_checkbox($data);
									}
									else
									{
										echo "&nbsp;";
									}
					?>
								</td>
								<td>
									<? echo $category['category_name']; ?>
								</td>
								<td>
									<? echo $category['post_count']; ?>
								</td>
								<td>
									<? echo anchor('admin/category/sort/up/'.$category['category_id'], img($this->view->img_base_url('arrow_up.png'))); ?>
									<? echo anchor('admin/category/sort/down/'.$category['category_id'], img($this->view->img_base_url('arrow_down.png'))); ?>
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
							Order
						</th>
					</tr>
				</tfoot>
			</table>
			<span class="small">Deleting categories won't delete the posts assigned to them, instead they will be marked as uncatgorized.</span>
		<? echo form_close(); ?>
		<div class="pagination">
			<? echo $this->pagination->create_links($category_list['pagination_info']['page'], $category_list['pagination_info']['page_count'], 'admin/category/overview/');?>
		</div>
	<?
		}
	?>
</div>