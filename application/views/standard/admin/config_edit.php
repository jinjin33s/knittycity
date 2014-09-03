<div class="box">
	<h2>
		Edit config
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
</div>
<div id="tabs">
	<div id="general">
		General
	</div>
	<div id="navigation">
		Navigation
	</div>
	<div id="users">
		Users
	</div>
	<div id="design">
		Design
	</div>
</div>
<? echo form_open('admin/config/edit'); ?>
	<div id="general_panel" class="panel">
		<table cellpadding="0" cellspacing="0" class="form">
			<tbody>
				<tr>
					<td>
						Blog title
					</td>
				</tr>
				<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'config_blog_title',
							              'id'          => 'config_blog_title',
							              'maxlength'   => '100',
							              'size'        => '85',
							              'value'		=> set_value('config_blog_title', $config['config_blog_title'])
							            );

							echo form_input($data);
						?>
					</td>
				</tr>
				<tr>
					<td>
						Sub title
					</td>
				</tr>
				<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'config_blog_sub_title',
							              'id'          => 'config_blog_sub_title',
							              'maxlength'   => '100',
							              'size'        => '85',
							              'value'		=> set_value('config_blog_sub_title', $config['config_blog_sub_title'])
							            );

							echo form_input($data);
						?>
					</td>
				</tr>
				<tr>
					<td>
						Site description
					</td>
				</tr>
				<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'config_meta_description',
							              'id'          => 'config_meta_description',
							              'maxlength'   => '255',
							              'size'        => '85',
							              'value'		=> set_value('config_meta_description', $config['config_meta_description'])
							            );

							echo form_input($data);
						?>
						<br/>
						<small class="small">Will be added to the header of every page</small>
					</td>
				</tr>
				<tr>
					<td>
						Keywords
					</td>
				</tr>
				<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'config_meta_keywords',
							              'id'          => 'config_meta_keywords',
							              'maxlength'   => '255',
							              'size'        => '85',
							              'value'		=> set_value('config_meta_keywords', $config['config_meta_keywords'])
							            );

							echo form_input($data);
						?>
						<br/>
						<small class="small">Will be added to the header of every page</small>
					</td>
				</tr>
				<tr>
					<td>
						Blog entries per page
					</td>
				</tr>
				<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'config_blog_entries_per_page',
							              'id'          => 'config_blog_entries_per_page',
							              'maxlength'   => '2',
							              'size'        => '5',
							              'value'		=> set_value('config_blog_entries_per_page', $config['config_blog_entries_per_page'])
							            );

							echo form_input($data);
						?>
					</td>
				</tr>
				<tr>
					<td>
						Comments per page
					</td>
				</tr>
				<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'config_comments_per_page',
							              'id'          => 'config_comments_per_page',
							              'maxlength'   => '2',
							              'size'        => '5',
							              'value'		=> set_value('config_comments_per_page', $config['config_comments_per_page'])
							            );

							echo form_input($data);
						?>
					</td>
				</tr>
				<tr>
					<td>
						Date format
					</td>
				</tr>
				<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'config_date_format',
							              'id'          => 'config_date_format',
							              'maxlength'   => '100',
							              'size'        => '85',
							              'value'		=> set_value('config_date_format', $config['config_date_format'])
							            );

							echo form_input($data);
						?>
					</td>
				</tr>
				<tr>
					<td>
						Small date format
					</td>
				</tr>
				<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'config_small_date_format',
							              'id'          => 'config_small_date_format',
							              'maxlength'   => '100',
							              'size'        => '85',
							              'value'		=> set_value('config_small_date_format', $config['config_small_date_format'])
							            );

							echo form_input($data);
						?>
					</td>
				</tr>
				<tr>
					<td>
						Date time format
					</td>
				</tr>
				<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'config_date_time_format',
							              'id'          => 'config_date_time_format',
							              'maxlength'   => '100',
							              'size'        => '85',
							              'value'		=> set_value('config_date_time_format', $config['config_date_time_format'])
							            );

							echo form_input($data);
						?>
					</td>
				</tr>
				<tr>
					<td>
						Google tracker ID
					</td>
				</tr>
				<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'config_google_tracker_id',
							              'id'          => 'config_google_tracker_id',
							              'maxlength'   => '100',
							              'size'        => '85',
							              'value'		=> set_value('config_google_tracker_id', $config['config_google_tracker_id'])
							            );

							echo form_input($data);
						?>
					</td>
				</tr>
				<tr>
					<td>
						Owner name
					</td>
				</tr>
				<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'config_owner_name',
							              'id'          => 'config_owner_name',
							              'maxlength'   => '100',
							              'size'        => '85',
							              'value'		=> set_value('config_owner_name', $config['config_owner_name'])
							            );

							echo form_input($data);
						?>
					</td>
				</tr>
				<tr>
					<td>
						Owner e-mail
					</td>
				</tr>
				<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'config_owner_email',
							              'id'          => 'config_owner_email',
							              'maxlength'   => '100',
							              'size'        => '85',
							              'value'		=> set_value('config_owner_email', $config['config_owner_email'])
							            );

							echo form_input($data);
						?>
					</td>
				</tr>
				<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'submit_general',
							              'id'          => 'submit_general',
							              'value'		=> 'Save',
							              'class'		=> 'submit'
							            );

							echo form_submit($data);
						?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div id="navigation_panel" class="panel">
		<table cellpadding="0" cellspacing="0" class="form">
			<tbody>
				<tr>
					<td>
						Navigation items
					</td>
				</tr>
				<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'config_navigation_items',
							              'id'          => 'config_navigation_items',
							              'maxlength'   => '100',
							              'size'        => '85',
							              'value'		=> set_value('config_navigation_items', $config['config_navigation_items'])
							            );

							echo form_input($data);
						?>
						<br/>
						<small class="small">Possible items: pages, archives, categories, links, blogs, tag_cloud, search_cloud, newest_files, top_files</small>
					</td>
				</tr>
				<tr>
					<td>
						Show link to post overview in navigation
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

							echo form_dropdown('config_navigation_show_post_overview', $options, set_value('config_navigation_show_post_overview', $config['config_navigation_show_post_overview']));
						?>
					</td>
				</tr>
				<tr>
					<td>
						Show search in navigation
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

							echo form_dropdown('config_navigation_show_search', $options, set_value('config_navigation_show_search', $config['config_navigation_show_search']));
						?>
					</td>
				</tr>
				<tr>
					<td>
						Show meta links in navigation
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

							echo form_dropdown('config_navigation_show_meta', $options, set_value('config_navigation_show_meta', $config['config_navigation_show_meta']));
						?>
					</td>
				</tr>
				<tr>
					<td>
						Start page
					</td>
				</tr>
				<tr>
					<td>
						<?
							echo form_dropdown('config_start_page', $start_page_list, set_value('config_start_page', $config['config_start_page']));
						?>
					</td>
				</tr>
				<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'submit_navigation',
							              'id'          => 'submit_navigation',
							              'value'		=> 'Save',
							              'class'		=> 'submit'
							            );

							echo form_submit($data);
						?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div id="users_panel" class="panel">
		<table cellpadding="0" cellspacing="0" class="form">
			<tbody>
				<tr>
					<td>
						Group for not logged in users
					</td>
				</tr>
				<tr>
					<td>
						<?
							echo form_dropdown('config_not_logged_in_user_group_id', $group_list, set_value('config_not_logged_in_user_group_id', $config['config_not_logged_in_user_group_id']));
						?>
					</td>
				</tr>
				<tr>
					<td>
						Default group for new users
					</td>
				</tr>
				<tr>
					<td>
						<?
							echo form_dropdown('config_new_user_group_id', $group_list, set_value('config_new_user_group_id', $config['config_new_user_group_id']));
						?>
					</td>
				</tr>
				<tr>
					<td>
						Enable registration
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

							echo form_dropdown('config_enable_registration', $options, set_value('config_enable_registration', $config['config_enable_registration']));
						?>
					</td>
				</tr>
				<tr>
					<td>
						<?
							$data = array(
							              'name'        => 'submit_users',
							              'id'          => 'submit_users',
							              'value'		=> 'Save',
							              'class'		=> 'submit'
							            );

							echo form_submit($data);
						?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div id="design_panel" class="panel">
		<table cellpadding="0" cellspacing="0" class="form">
			<tbody>
				<tr>
					<td>
						Design folder
					</td>
				</tr>
				<tr>
					<td>
						<?
							echo form_dropdown('config_design_folder', $design_folder_list, set_value('config_design_folder', $config['config_design_folder']));
						?>
					</td>
				</tr>
				<tr>
					<td>
						Show social bookmarking links
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

							echo form_dropdown('config_show_social_bookmarking_links', $options, set_value('config_show_social_bookmarking_links', $config['config_show_social_bookmarking_links']));
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
	</div>
<? echo form_close(); ?>