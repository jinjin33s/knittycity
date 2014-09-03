

<script>
  $(document).ready(function() {
    $("#datepicker").datepicker();
  });
</script>
<div class="box">
	<h2>
		Add new post
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
	<? echo form_open('admin/post/add'); ?>
		<table cellpadding="0" cellspacing="0" class="form">
			<tbody>
				<tr>
					<td>
						Title
					</td>
				</tr>
				<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'post_title',
							              'id'          => 'post_title',
							              'maxlength'   => '100',
							              'size'        => '85',
							              'value'		=> set_value('post_title')
							            );

							echo form_input($data);
						?>
					</td>
				</tr>
                                <tr>
					<td>
						Publish Date
					</td>
				</tr>
                                 <tr>
					<td>
						<?
                                                $post_date_publish = date("m/d/Y");
							$data = array(
							              'name'        => 'post_date_publish',
							              'id'          => 'datepicker',
							              'maxlength'   => '20',
							              'size'        => '20',
							              'value'		=> set_value('post_date_publish',$post_date_publish)
							            );

							echo form_input($data);
						?>
					</td>
				</tr>
                                <tr>
					<td>
						Content
					</td>
				</tr>
				<tr>
					<td>
						<?
							$fckeditorConfig = array(
													'instanceName' => 'post_content',
													'BasePath' => base_url().APPPATH.'plugins/fckeditor/',
													'ToolbarSet' => 'Default',
													'Width' => '710px',
													'Height' => '400',
													'Value' => unprep_for_form(set_value('post_content'))
													);
							$this->fckeditor->init($fckeditorConfig);
							echo $this->fckeditor->Create();
						?>
					</td>
				</tr>
				<tr>
					<td>
						Excerpt
					</td>
				</tr>
				<tr>
					<td>
						<?
							$fckeditorConfig = array(
													'instanceName' => 'post_excerpt',
													'BasePath' => base_url().APPPATH.'plugins/fckeditor/',
													'ToolbarSet' => 'Basic',
													'Width' => '710px',
													'Height' => '200',
													'Value' => unprep_for_form(set_value('post_excerpt'))
													);
							$this->fckeditor->init($fckeditorConfig);
							echo $this->fckeditor->Create();
						?>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="inner_box">
			<table cellpadding="0" cellspacing="0" class="small">
				<thead>
					<tr>
						<td colspan="2">
							<h3>
								Categories
							</h3>
						</td>
					</tr>
				</thead>
				<tbody>
					<?
						if(is_array($category_list))
						{
							foreach($category_list as $category)
							{
					?>
								<tr>
									<td>
										<? echo $category['category_name']; ?>
									</td>
									<td>
					<?
										$data = array(
										    'name'        => 'category_id[]',
										    'value'       => $category['category_id'],
										    'checked'     => set_checkbox('category_id[]', $category['category_id'], FALSE),
										    'class'		=> 'no_border'
										    );

										echo form_checkbox($data);
					?>
									</td>
								</tr>
					<?
							}
						}
					?>
					<tr>
						<td>
							New
						</td>
						<td>
							<?
								$data = array(
								              'name'        => 'categories',
								              'id'          => 'categories',
								              'maxlength'	=> '100',
								              'size'        => '30',
								              'value'		=> set_value('categories')
								            );

								echo form_input($data);
							?>
							<br/>
							<span class="small">Multiple categories must be seperated by comma</span>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="inner_box">
			<table cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<td colspan="2">
							<h3>
								Tags
							</h3>
						</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<?
								$data = array(
								              'name'        => 'tags',
								              'id'          => 'tags',
								              'size'        => '30',
								              'value'		=> set_value('tags')
								            );

								echo form_input($data);
							?>
							<br/>
							<span class="small">Multiple tags must be seperated by comma</span>
						</td>
					</tr>
					<tr>
						<td>
							Status
						</td>
					</tr>
					<tr>
						<td>
							<?
								$options = array
												(
								                  0  => 'Draft',
								                  1  => 'Published'
								                );

								echo form_dropdown('post_is_published', $options, set_value('post_is_published'));
							?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<table cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<td colspan="2">
						<h3>
							Trackback urls
						</h3>
					</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'trackbacks',
							              'id'          => 'trackbacks',
							              'size'        => '75',
							              'value'		=> set_value('trackbacks')
							            );

							echo form_input($data);
						?>
						<br/>
						<span class="small">Multiple trackback urls must be seperated by space</span>
					</td>
				</tr>
				<tr>
					<td>
						Trackbacks are allowed
					</td>
				</tr>
				<tr>
					<td>
						<?
							$options = array
											(
							                  0  => 'No',
							                  1  => 'Yes'
							                );

							echo form_dropdown('post_trackback_is_allowed', $options, set_value('post_trackback_is_allowed', 1));
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