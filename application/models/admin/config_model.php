<?php
class Config_model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

	function get_group_list()
	{
		$result = $this->db->get('group');
		$group_list = array();
		foreach($result->result_array() as $group)
		{
			$group_list[$group['group_id']] = $group['group_name'];
		}
		return $group_list;
	}

	function edit()
	{
		$this->db->set('config_blog_title', set_value('config_blog_title'));
		$this->db->set('config_blog_sub_title', set_value('config_blog_sub_title'));
		$this->db->set('config_blog_entries_per_page', set_value('config_blog_entries_per_page'));
                $this->db->set('config_other_entries_per_page', set_value('config_other_entries_per_page'));
		$this->db->set('config_comments_per_page', set_value('config_comments_per_page'));
		$this->db->set('config_date_format', set_value('config_date_format'));
		$this->db->set('config_date_time_format', set_value('config_date_time_format'));
		$this->db->set('config_small_date_format', set_value('config_small_date_format'));
		$this->db->set('config_navigation_items', set_value('config_navigation_items'));
		$this->db->set('config_navigation_show_search', set_value('config_navigation_show_search'));
		$this->db->set('config_navigation_show_meta', set_value('config_navigation_show_meta'));
		$this->db->set('config_not_logged_in_user_group_id', set_value('config_not_logged_in_user_group_id'));
		$this->db->set('config_design_folder', set_value('config_design_folder'));
		$this->db->set('config_new_user_group_id', set_value('config_new_user_group_id'));
		$this->db->set('config_google_tracker_id', set_value('config_google_tracker_id'));
		$this->db->set('config_owner_name', set_value('config_owner_name'));
		$this->db->set('config_owner_email', set_value('config_owner_email'));
		$this->db->set('config_start_page', set_value('config_start_page'));
		$this->db->set('config_navigation_show_post_overview', set_value('config_navigation_show_post_overview'));
		$this->db->set('config_show_social_bookmarking_links', set_value('config_show_social_bookmarking_links'));
		$this->db->set('config_meta_description', set_value('config_meta_description'));
		$this->db->set('config_meta_keywords', set_value('config_meta_keywords'));
		$this->db->update('config');
	}

	function get_config()
	{
		$result = $this->db->get('config');

		return $result->row_array();
	}

	function get_design_folder_list()
	{
		$design_folder_list = array();

		$view_folder = APPPATH.'views';
		$ordner = "./meinverzeichnis";
		$handle = opendir($view_folder);
		while ($file = readdir ($handle))
		{
			if($file != "." && $file != "..")
			{
				if(is_dir($view_folder."/".$file))
				{
					$design_folder_list[$file] = $file;
				}
			}
		}
		closedir($handle);

		return $design_folder_list;
	}

	function get_start_page_list()
	{
		$start_page_list = array();
		$start_page_list['post/overview'] = 'Post overview';

		$this->db->where('page_is_published', 1);
		$result = $this->db->get('page');

		if($result->num_rows() > 0)
		{
			foreach($result->result_array() as $page)
			{
				$start_page_list['page/view/'.$page['page_id']] = 'Page - '.$page['page_title'];
			}
		}

		return $start_page_list;
	}

}