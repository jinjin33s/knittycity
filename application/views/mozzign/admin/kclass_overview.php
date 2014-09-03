
<div class="box">
	<h2>
		Class
	</h2>
    <a href ="http://www.knittycity.com/knittyblog/index.php/admin/kclass/add">New Entry</a>
	<?
		if($kclass_list == FALSE)
		{
	?>
			<h3>
				No classses
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
			<? echo form_open('admin/kclass/overview', array('name' => 'kclass_delete', 'class_id' => 'kclass_delete')); ?>
			<table cellpadding="0" cellspacing="0" class="list">
				<thead>
					<tr>
						<th class="center" width="1">
							&nbsp;
						</th>
						<th>
							Class Name
						</th>
						<th>
							Instructor
						</th>
						<th>
							Date
						</th>
					</tr>
				</thead>
				<tbody>
					<?
						foreach($kclass_list['kclass_list'] as $kclass)
						{
					?>
							<tr>
								<td class="center">
					<?
										$data = array(
										    'name'        => 'class_id[]',
										    'value'       => $kclass['class_id'],
										    'class'		=> 'no_border'
										    );

										echo form_checkbox($data);
					?>
								</td>
								<td>
									<? echo anchor('admin/kclass/edit/'.$kclass['class_id'], $kclass['classTitle']); ?>
								</td>
								<td>
									<? echo anchor('admin/kclass/edit/'.$kclass['class_id'], $kclass['classInstructor']); ?>
								</td>
								<td>
									<?

											echo $kclass['classDate']." ".date('A h:i',strtotime("2005-03-30 ".$kclass['classTime']));

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
							Class Name
						</th>
						<th>
							Instructor
						</th>
						<th>
							Date
						</th>
					</tr>
				</tfoot>
			</table>
			<? echo form_close(); ?>
			<div class="pagination">
				<? echo $this->pagination->create_links($kclass_list['pagination_info']['page'], $kclass_list['pagination_info']['page_count'], 'admin/kclass/overview/');?>
			</div>
	<?
		}
	?>
</div>
