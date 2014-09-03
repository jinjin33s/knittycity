<?php
class User_model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

	function get_user_list($page)
	{
		$total_user_count = $this->db->count_all('user');
		$pagination_info = $this->pagination->get_pagination_info($page, $total_user_count, $this->config->item('config_blog_entries_per_page'));

		$this->db->select('*');
		$this->db->select('(SELECT COUNT(*) FROM post WHERE post_author_user_id = user_id) AS post_count');
		$this->db->select('(SELECT COUNT(*) FROM comment WHERE comment_author_user_id = user_id) AS comment_count');
		$this->db->select('(SELECT COUNT(*) FROM comment WHERE comment_author_user_id = user_id AND comment_is_approved = 0) AS not_approved_comment_count');
		$this->db->order_by('user_name', 'asc');
		$this->db->limit($this->config->item('config_blog_entries_per_page'), (($pagination_info['page'] - 1) * $this->config->item('config_blog_entries_per_page')));
		$result = $this->db->get('user');

		if($result->num_rows() > 0)
		{
			$user_list = $result->result_array();
			return array('user_list' => $user_list, 'pagination_info' => $pagination_info);
		}
		else
		{
			return FALSE;
		}
	}

	function get_user($user_id)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('user');
		$user = $result->row_array();
		$user['group_list'] = $this->_get_group_list($user_id);
		return $user;
	}

	function is_valid_user($user_id)
	{
		$this->db->where('user_id', $user_id);
		if($this->db->count_all_results('user') > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function _get_group_list($user_id)
	{
		$this->db->select('group_id');
		$this->db->from('group');
		$this->db->join('user_group', 'group_id = user_group_group_id');
		$this->db->where('user_group_user_id', $user_id);
		$result = $this->db->get();
		if($result->num_rows() > 0)
		{
			$group_list = array();
			foreach($result->result_array() as $group)
			{
				$group_list[$group['group_id']] = TRUE;
			}

			return $group_list;
		}
		else
		{
			return FALSE;
		}
	}

	function get_group_list()
	{
		$result = $this->db->get('group');
		return $result->result_array();
	}

	function edit($user_id)
	{
		$this->db->set('user_email', set_value('user_email'));
		$this->db->set('user_website', set_value('user_website'));
		$this->db->where('user_id', $user_id);
		$this->db->update('user');

		if($this->auth->has_right('can_edit_user'))
		{
			// groups
			$this->_update_group_assoc($user_id);
		}

		return TRUE;
	}

	function _update_group_assoc($user_id)
	{
		$this->db->where('user_group_user_id', $user_id);
		$this->db->delete('user_group');
		if($this->input->post('group_id'))
		{
			foreach($this->input->post('group_id') as $group_id)
			{
				$this->db->set('user_group_user_id', $user_id);
				$this->db->set('user_group_group_id', $group_id);
				$this->db->insert('user_group');
			}
		}

		return TRUE;
	}

	function change_password($user_id)
	{
		$this->db->set('user_password', md5(set_value('user_password')));
		$this->db->where('user_id', $user_id);
		$this->db->update('user');

		return TRUE;
	}
}