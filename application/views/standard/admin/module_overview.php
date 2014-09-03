<div class="box">
	<h2>
		Modules
	</h2>
	<?
		if($module_list == FALSE)
		{
	?>
			<h3>
				No modules
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
							Version
						</th>
						<th>
							Description
						</th>
						<th>
							Action
						</th>
					</tr>
				</thead>
				<tbody>
					<?
						foreach($module_list['module_list'] as $module)
						{
					?>
							<tr>
								<td>
									<?
										if($module['module_url'] != '')
										{
											echo anchor($module['module_url'], $module['module_name']);
										}
										else
										{
											echo $module['module_name'];
										}
									?>
								</td>
								<td>
									<? echo $module['module_version']; ?>
								</td>
								<td>
									<? echo $module['module_description']; ?>
								</td>
								<td>
									<?
										if($module['module_is_active'] == 1)
										{
											echo anchor('admin/module/deactivate/'.$module['module_id'], 'Deactivate');
										}
										else
										{
											echo anchor('admin/module/activate/'.$module['module_id'], 'Activate');
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
						<th>
							Name
						</th>
						<th>
							Version
						</th>
						<th>
							Description
						</th>
						<th>
							Action
						</th>
					</tr>
				</tfoot>
			</table>
			<div class="pagination">
				<? echo $this->pagination->create_links($module_list['pagination_info']['page'], $module_list['pagination_info']['page_count'], 'admin/module/overview/');?>
			</div>
	<?
		}
	?>
</div>