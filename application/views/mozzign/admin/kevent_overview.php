<div event="box">
	<h2>
		Event
	</h2>
    <a href ="http://www.knittycity.com/knittyblog/index.php/admin/kevent/add">New Entry</a>
	<?
		if($kevent_list == FALSE)
		{
	?>
			<h3>
				No Events
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
			<table cellpadding="0" cellspacing="0" event="form_info">
				<tbody>
					<?
						foreach($error_list as $error)
						{
					?>
							<tr>
								<td event="error">
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
								<td event="notice">
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
			<? echo form_open('admin/kevent/overview', array('name' => 'kevent_delete', 'event_id' => 'kevent_delete')); ?>
			<table cellpadding="0" cellspacing="0" class="list">
				<thead>
					<tr>
						<th class="center" width="1">
							&nbsp;
						</th>
						<th>
							Title
						</th>						
						<th>
							Date
						</th>
					</tr>
				</thead>
				<tbody>
					<?
						foreach($kevent_list['kevent_list'] as $kevent)
						{
					?>
							<tr>
								<td class="center">
					<?
										$data = array(
										    'name'          => 'event_id[]',
										    'value'         => $kevent['event_id'],
										    'event'         => 'no_border'
										    );

										echo form_checkbox($data);
					?>
								</td>
								<td>
                                                                    <? echo anchor('admin/kevent/edit/'.$kevent['event_id'], $kevent['eventTitle']); ?>
								</td>
								
								<td>
									<? echo $kevent['eventDate']." ".date('A h:i',strtotime("2005-03-30 ".$kevent['eventTime']));?>
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
								              'event'       => 'submit'
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
				<? echo $this->pagination->create_links($kevent_list['pagination_info']['page'], $kevent_list['pagination_info']['page_count'], 'admin/kevent/overview/');?>
			</div>
	<?
		}
	?>
</div>
