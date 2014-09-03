<div class="box">
	<h2>
		Subscriber
	</h2>
    <a href ="http://www.knittycity.com/knittyblog/index.php/admin/subscriber/add">New Entry</a>
	<?
		if($subscriber_list == FALSE)
		{
	?>
			<h3>
				No Subscribers
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
			<? echo form_open('admin/subscriber/overview', array('name' => 'subscriber_delete', 'subscriber_id' => 'subscriber_delete')); ?>
			<table cellpadding="0" cellspacing="0" class="list">
				<thead>
					<tr>
						<th class="center" width="1">&nbsp;
							
						</th>
						<th>
							Last Name
						</th>
						<th>
							First Name
						</th>
                        <th>
							email
						</th>
						<th>
							Register Date
						</th>
					</tr>
				</thead>
				<tbody>
					<?
						foreach($subscriber_list['subscriber_list'] as $subscriber)
						{

					?>
							<tr>
								<td class="center">
					<?
										$data = array(
										    'name'        => 'subscriber_id[]',
										    'value'       => $subscriber['subscriber_id'],
										    'class'		=> 'no_border'
										    );

										echo form_checkbox($data);
					?>
								</td>
								<td>
									<? echo anchor('admin/subscriber/edit/'.$subscriber['subscriber_id'], $subscriber['lastName']); ?>
								</td>
								<td>
									<? echo anchor('admin/subscriber/edit/'.$subscriber['subscriber_id'], $subscriber['firstName']); ?>
								</td>
                                <td>
									<? echo anchor('admin/subscriber/edit/'.$subscriber['subscriber_id'], $subscriber['email']); ?>
								</td>
								<td>
									<?

											echo $subscriber['regDate']."<br/> registered";

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
							First Name
						</th>
						<th>
							Last Name
						</th> <th>
							email
						</th>
						<th>
							Registered Date
						</th>
					</tr>
				</tfoot>
			</table>
			<? echo form_close(); ?>
			<div class="pagination">
				<? echo $this->pagination->create_links($subscriber_list['pagination_info']['page'], $subscriber_list['pagination_info']['page_count'], 'admin/subscriber/overview/');?>
			</div>
	<?
		}
	?>
</div>
