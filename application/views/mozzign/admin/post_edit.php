

<script>
  $(document).ready(function() {
    $("#post_date_publish").datepicker();
  });
</script>

<div class="box">
	<h2>
		Edit post
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
	<? echo form_open('admin/post/edit/'.$post['post_id']); ?>
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
							              'value'		=> set_value('post_title', $post['post_title'])
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
							$data = array(
							              'name'        => 'post_date_publish',
							              'id'          => 'post_date_publish',
							              'maxlength'   => '20',
							              'size'        => '20',
							              'value'		=> set_value('post_date_publish', $post['post_date_publish_formatted'])
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
													'Value' => unprep_for_form(set_value('post_content', $post['post_content']))
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
													'Value' => unprep_for_form(set_value('post_excerpt', $post['post_excerpt']))
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
										    'checked'     => set_checkbox('category_id[]', $category['category_id'], isset($post['category_list'][$category['category_id']])),
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
								              'value'		=> set_value('tags', $post['tag_list'])
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

								echo form_dropdown('post_is_published', $options, set_value('post_is_published', $post['post_is_published']));
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
							Trackback
						</h3>
					</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						Add trackback urls
					</td>
				</tr>
				<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'trackbacks',
							              'id'          => 'trackbacks',
							              'size'        => '75',
							              'value'		=> set_value('trackbacks', $post['post_trackback_list'])
							            );

							echo form_input($data);
						?>
						<br/>
						<span class="small">Multiple trackback urls must be seperated by space</span>
					</td>
				</tr>
				<tr>
					<td>
						Already pinged
					</td>
				</tr>
				<tr>
					<td>
						<?
							$list = explode(' ', $post['post_trackback_list']);
							if(count($list) > 0)
							{
								foreach($list as $trackback)
								{
									if($trackback != '')
									{
										echo "- ".$trackback."<br/>";
									}
								}
							}
						?>
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

							echo form_dropdown('post_trackback_is_allowed', $options, set_value('post_trackback_is_allowed', $post['post_trackback_is_allowed']));
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