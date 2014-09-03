<div calendar="box">
	<h2>
		Calendar
	</h2>
    <a href ="http://www.knittycity.com/knittyblog/index.php/admin/kcalendar/add">New Entry</a>
	<?
		if($kcalendar_list == FALSE)
		{
	?>
			<h3>
				No calendars
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
			<table cellpadding="0" cellspacing="0" calendar="form_info">
				<tbody>
					<?
						foreach($error_list as $error)
						{
					?>
							<tr>
								<td calendar="error">
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
								<td calendar="notice">
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
			<? echo form_open('admin/kcalendar/overview', array('name' => 'kcalendar_delete', 'calendar_id' => 'kcalendar_delete')); ?>
			<table cellpadding="0" cellspacing="0" class="list">
				<thead>
					<tr>
						<th class="center" width="1">
							&nbsp;
						</th>
						<th>
							Event Title
						</th>
						<th>
							Date
						</th>						
					</tr>
				</thead>
				<tbody>
					<?
						foreach($kcalendar_list['kcalendar_list'] as $kcalendar)
						{
					?>
							<tr>
								<td class="center">
					<?
										$data = array(
										    'name'          => 'calendar_id[]',
										    'value'         => $kcalendar['calendar_id'],
										    'calendar'      => 'no_border'
										    );

										echo form_checkbox($data);
					?>
								</td>
                                                                <td>
                                                                    <? echo anchor('admin/kcalendar/edit/'.$kcalendar['calendar_id'], $kcalendar['calendarTitle']); ?>
                                                                </td>

								<td>
									<? echo $kcalendar['calendarDate']." ".date('A h:i',strtotime("2005-03-30 ".$kcalendar['calendarTime'])); ?>
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
								              'value'       => 'Delete',
								              'calendar'    => 'submit'
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
				<? echo $this->pagination->create_links($kcalendar_list['pagination_info']['page'], $kcalendar_list['pagination_info']['page_count'], 'admin/kcalendar/overview/');?>
			</div>
	<?
		}
	?>
</div>
