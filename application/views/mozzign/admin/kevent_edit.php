<script>
 var optionList =  "<option value='00:00:00'>AM 00:00</option>"
                + "<option value='00:30:00'>AM 00:30</option>"
                + "<option value='01:00:00'>AM 01:00</option>"
                + "<option value='01:30:00'>AM 01:30</option>"
                + "<option value='02:00:00'>AM 02:00</option>"
                + "<option value='02:30:00'>AM 02:30</option>"
                + "<option value='03:00:00'>AM 03:00</option>"
                + "<option value='03:30:00'>AM 03:30</option>"
                + "<option value='04:00:00'>AM 04:00</option>"
                + "<option value='04:30:00'>AM 04:30</option>"
                + "<option value='05:00:00'>AM 05:00</option>"
                + "<option value='05:30:00'>AM 05:30</option>"
                + "<option value='06:00:00'>AM 06:00</option>"
                + "<option value='06:30:00'>AM 06:30</option>"
                + "<option value='07:00:00'>AM 07:00</option>"
                + "<option value='07:30:00'>AM 07:30</option>"
                + "<option value='08:00:00'>AM 08:00</option>"
                + "<option value='08:30:00'>AM 08:30</option>"
                + "<option value='09:00:00'>AM 09:00</option>"
                + "<option value='09:30:00'>AM 09:30</option>"
                + "<option value='10:00:00'>AM 10:00</option>"
                + "<option value='10:30:00'>AM 10:30</option>"
                + "<option value='11:00:00'>AM 11:00</option>"
                + "<option value='11:30:00'>AM 11:30</option>"
                + "<option value='12:00:00'>PM 12:00</option>"
                + "<option value='12:30:00'>PM 12:30</option>"
                + "<option value='13:00:00'>PM 01:00</option>"
                + "<option value='13:30:00'>PM 01:30</option>"
                + "<option value='14:00:00'>PM 02:00</option>"
                + "<option value='14:30:00'>PM 02:30</option>"
                + "<option value='15:00:00'>PM 03:00</option>"
                + "<option value='15:30:00'>PM 03:30</option>"
                + "<option value='16:00:00'>PM 04:00</option>"
                + "<option value='16:30:00'>PM 04:30</option>"
                + "<option value='17:00:00'>PM 05:00</option>"
                + "<option value='17:30:00'>PM 05:30</option>"
                + "<option value='18:00:00'>PM 06:00</option>"
                + "<option value='18:30:00'>PM 06:30</option>"
                + "<option value='19:00:00'>PM 07:00</option>"
                + "<option value='19:30:00'>PM 07:30</option>"
                + "<option value='20:00:00'>PM 08:00</option>"
                + "<option value='20:30:00'>PM 08:30</option>"
                + "<option value='21:00:00'>PM 09:00</option>"
                + "<option value='21:30:00'>PM 09:30</option>"
                + "<option value='22:00:00'>PM 10:00</option>"
                + "<option value='22:30:00'>PM 10:30</option>"
                + "<option value='23:00:00'>PM 11:00</option>"
                + "<option value='23:30:00'>PM 11:30</option>"

 var timelist = "<select name='eventTime' id='eventTime'>"
                + optionList
                +"</select>";
            
var endTimelist = "<select name='eventEndTime' id='eventEndTime'>"
                + optionList
                +"</select>";


 $(document).ready(function() {
     $('#eventTime').replaceWith(timelist);
     $('#eventTime').val('<?= $kevent['eventTime'];?>');
     $('#eventEndTime').replaceWith(endTimelist);
     $('#eventEndTime').val('<?= $kevent['eventEndTime'];?>');
     $("#eventDate").datepicker({dateFormat:'yy-mm-dd'});
     $('#eventDate').val('<?= $kevent['eventDate'];?>');
     $("#eventEndDate").datepicker({dateFormat:'yy-mm-dd'});
     $('#eventEndDate').val('<?= $kevent['eventEndDate'];?>');
 });

 </script>
<div class="box">
	<h2>
		Edit Event
	</h2>
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
	<? echo form_open('admin/kevent/edit/'.$kevent['event_id']); ?>
		<table cellpadding="0" cellspacing="0" class="form">
			<tbody>
                            <tr>
					<td>
						Title
					</td>
				
					<td>
						<?
							$data = array(
							              'name'        => 'eventTitle',
							              'id'          => 'eventTitle',
							              'maxlength'   => '100',
							              'size'        => '85',
							              'value'		=> set_value('eventTitle', $kevent['eventTitle'])
							            );

							echo form_input($data);
						?>
					</td>
				</tr> 
                                <tr>
					<td>
						Location
					</td>
					<td>
						<?
							$data = array('name'        => 'eventLocation',
							              'id'          => 'eventLocation',
							              'maxlength'   => '100',
							              'size'        => '85',
							              'value'		=> set_value('eventLocation', $kevent['eventLocation']));

							echo form_input($data);
						?>
					</td>
				</tr>
                                <tr>
					<td>
						Summary
					</td>
					<td>
						<?
							$data = array(
							              'name'        => 'eventSummary',
							              'id'          => 'eventSummary',
							              'maxlength'   => '100',
							              'size'        => '85',
                                                                      'style'       =>'height:50px;',

							              'value'		=> set_value('eventSummary', $kevent['eventSummary'])
							            );

							echo form_textarea($data);
						?>
					</td>
				</tr>
                                <tr>
					<td>
						Start Date
                                        </td>
                                        <td>       <?
							$data = array(
							              'name'        => 'eventDate',
							              'id'          => 'eventDate',
							              'maxlength'   => '20',
							              'size'        => '20',
							              'value'       => set_value('eventDate', $kevent['eventDate'])
							            );

							echo form_input($data);
						?>
                                        </td>
                                </tr>
                                <tr>
                                        <td>&nbsp;</td>
                                         <td>       <?
							$data = array(
							              'name'        => 'eventTime',
							              'id'          => 'eventTime',
							              'maxlength'   => '20',
							              'size'        => '20',
							              'value'		=> set_value('eventTime', $kevent['eventTime'])
							            );

							echo form_input($data);
						?>
					</td>
				</tr>
                                 <tr>
					<td>End Date</td>
                                         <td>               <?
							$data = array(
							              'name'        => 'eventEndDate',
							              'id'          => 'eventEndDate',
							              'maxlength'   => '2c',
							              'size'        => '20',
							              'value'       => set_value('eventEndDate', $kevent['eventEndDate'])
							            );

							echo form_input($data);
						?></td>
                                 </tr>
                                 <tr>
						<td>&nbsp;</td>
                                                <td> <?
							$data = array(
							              'name'        => 'eventEndTime',
							              'id'          => 'eventEndTime',
							              'maxlength'   => '20',
							              'size'        => '20',
							              'value'       => set_value('eventEndTime', $kevent['eventEndTime'])
							            );

							echo form_input($data);
						?>
					</td>
				</tr>

				<tr>
                                        <td>Content</td>
					<td>
						<?
							$fckeditorConfig = array(
                                                                            'instanceName' => 'eventContent',
                                                                            'BasePath' => base_url().APPPATH.'plugins/fckeditor/',
                                                                            'ToolbarSet' => 'Default',
                                                                            'Width' => '710px',
                                                                            'Height' => '400',
                                                                            'Value' => unprep_for_form(set_value('eventContent', $kevent['eventContent']))
                                                                            );
							$this->fckeditor->init($fckeditorConfig);
							echo $this->fckeditor->Create();
						?>
					</td>
				</tr>

                                <tr>
					<td colspan="2">
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