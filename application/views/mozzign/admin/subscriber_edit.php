<script>

 $(document).ready(function() {
     $("#regDate").datepicker({dateFormat:'yy-mm-dd'});
 });

 </script>

<div class="box">
	<h2>
		Edit Subscriber
	</h2>
        <a href="<?=base_url()."admin/subscriber/";?>">back to list</a>
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
	<? echo form_open('admin/subscriber/edit/'.$subscriber['subscriber_id']); ?>
		<table cellpadding="0" cellspacing="0" class="form">
			<tbody>
                            <tr>
					<td>
						First Name
					</td>
				</tr>
				<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'firstName',
							              'id'          => 'firstName',
							              'maxlength'   => '100',
							              'size'        => '85',
							              'value'		=> set_value('firstName', $subscriber['firstName'])
							            );

							echo form_input($data);
						?>
					</td>
				</tr> 
                                <tr>
					<td>
						Last Name
					</td>
				</tr>
                                <tr>
					<td>
						<?
							$data = array(
							              'name'        => 'lastName',
							              'id'          => 'lastName',
							              'maxlength'   => '100',
							              'size'        => '85',
							              'value'		=> set_value('lastName', $subscriber['lastName'])
							            );

							echo form_input($data);
						?>
					</td>
				</tr>
                                     <tr>
					<td>
						Registered Date
					</td>
				</tr><tr>
					<td>
						email
					</td>
				</tr>
				<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'email',
							              'id'          => 'email',
							              'maxlength'   => '100',
							              'size'        => '85',
							              'value'		=> set_value('email', $subscriber['email'])
							            );

							echo form_input($data);
						?>
					</td>
				</tr> 
                                <tr>
					<td>
						<?
							$data = array(
							              'name'        => 'regDate',
							              'id'          => 'regDate',
							              'maxlength'   => '100',
							              'size'        => '85',
							              'value'		=> set_value('regDate', $subscriber['regDate'])
							            );

							echo form_input($data);
						?>
					</td>
				</tr>


<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'submit',
							              'id'          => 'submit',
							              'value'		=> 'Save',
							              'class'		=> 'submit'
							            );

							echo form_submit($data);
						?>
					</td>
				</tr>
			</tbody>
		</table>
	<? echo form_close(); ?>
</div>