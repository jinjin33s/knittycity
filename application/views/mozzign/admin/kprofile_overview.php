<div class="box">
	<h2>
		Monthly Profile
	</h2>
        <a href ="http://www.knittycity.com/knittyblog/index.php/admin/kprofile/add">New Entry</a>
	<?
		if($kprofile_list == FALSE)
		{
	?>
			<h3>
				No Profiles
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
					<? foreach($error_list as $error){ ?>
							<tr>
								<td class="error"><? echo $error; ?></td>
							</tr>
					<? }?>
					<? foreach($notice_list as $notice){ ?>
							<tr>
								<td class="notice"><? echo $notice; ?></td>
							</tr>
					<? }?>
				</tbody>
			</table>

	<? } ?>
			<? echo form_open('admin/kprofile/overview', array('name' => 'kprofile_delete', 'prof_id' => 'kprofile_delete')); ?>
			<table cellpadding="0" cellspacing="0" class="list">
				<thead>
					<tr>
						<th class="center" width="1">
							&nbsp;
						</th>
						<th>
							Name/Title
						</th>						
						<th>
							Date
						</th>
					</tr>
				</thead>
				<tbody>
					<?
						foreach($kprofile_list['kprofile_list'] as $kprofile)
						{
					?>
							<tr>
								<td class="center">
					<?
										$data = array(
										    'name'        => 'prof_id[]',
										    'value'       => $kprofile['prof_id'],
										    'class'		=> 'no_border'
										    );

										echo form_checkbox($data);
					?>
								</td>
								<td>
									<? echo anchor('admin/kprofile/edit/'.$kprofile['prof_id'], $kprofile['profTitle']); ?>
								</td>								
								<td>
									<?= $kprofile['profDate'];?>
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
				<? echo $this->pagination->create_links($kprofile_list['pagination_info']['page'], $kprofile_list['pagination_info']['page_count'], 'admin/kprofile/overview/');?>
			</div>
	<?
		}
	?>
</div>
