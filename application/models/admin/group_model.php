<?php
class Group_model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

	function get_group_list($page)
	{
		$total_group_count = $this->db->count_all('group');
		$pagination_info = $this->pagination->get_pagination_info($page, $total_group_count, $this->config->item('config_blog_entries_per_page'));

		$this->db->select('group_id, group_name');
		$this->db->select('COUNT(*) AS user_count');
		$this->db->from('group');
		$this->db->join('user_group', 'group_id = user_group_group_id', 'left outer');
		$this->db->order_by('group_name', 'asc');
		$this->db->group_by('group_id, group_name');
		$this->db->limit($this->config->item('config_blog_entries_per_page'), (($pagination_info['page'] - 1) * $this->config->item('config_blog_entries_per_page')));
		$result = $this->db->get();

		if($result->num_rows() > 0)
		{
			return array('group_list' => $result->result_array(), 'pagination_info' => $pagination_info);
		}
		else
		{
			return FALSE;
		}
	}

	function delete()
	{
		if($this->input->post('group_id'))
		{
			foreach($this->input->post('group_id') as $group_id)
			{
				$this->db->select('user_id');
				$this->db->select('COUNT(*) AS group_count', FALSE);
				$this->db->from('user_group');
				$this->db->join('user', 'user_group_user_id = user_id');
				$this->db->where('user_id IN (SELECT user_id FROM user_group WHERE user_group_group_id = '.$this->db->escape($group_id).')');
				$this->db->group_by('user_id');
				$result = $this->db->get();

				$this->db->where('user_group_group_id', $group_id);
				$this->db->delete('user_group');

				//$this->db->where('group_id', $group_id);
				//$this->db->delete('group');

				$query = "DELETE FROM `group` WHERE group_id = ".$this->db->escape($group_id);
				$this->db->query($query);

				if($result->num_rows() > 0)
				{
					foreach($result->result_array() as $user)
					{
						if($user['group_count'] == 1)
						{
							$this->db->set('user_group_user_id', $user['user_id']);
							$this->db->set('user_group_group_id', $this->config->item('config_new_user_group_id'));
							$this->db->insert('user_group');
						}
					}
				}
			}

			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function is_valid_group($group_id)
	{
		$this->db->where('group_id', $group_id);
		if($this->db->count_all_results('group') > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function get_group($group_id)
	{
		$this->db->where('group_id', $group_id);
		$result = $this->db->get('group');
		$user = $result->row_array();
		$user['right_list'] = $this->_get_right_list($group_id);
		return $user;
	}

	function _get_right_list($group_id)
	{
		$this->db->select('right_id');
		$this->db->from('right');
		$this->db->join('group_right', 'right_id = group_right_right_id');
		$this->db->where('group_right_group_id', $group_id);
		$result = $this->db->get();
		if($result->num_rows() > 0)
		{
			$right_list = array();
			foreach($result->result_array() as $right)
			{
				$right_list[$right['right_id']] = TRUE;
			}

			return $right_list;
		}
		else
		{
			return FALSE;
		}
	}

	function get_right_list()
	{
		$result = $this->db->get('right');
		return $result->result_array();
	}

	function edit($group_id)
	{
		$this->db->set('group_name', set_value('group_name'));
		$this->db->where('group_id', $group_id);
		$this->db->update('group');

		// rights
		$this->_update_right_assoc($group_id);

		return TRUE;
	}

	function add()
	{
		$this->db->set('group_name', set_value('group_name'));
		$this->db->insert('group');

		$group_id = $this->db->insert_id();

		// rights
		$this->_update_right_assoc($group_id);

		return $group_id;
	}

	function _update_right_assoc($group_id)
	{
		$this->db->where('group_right_group_id', $group_id);
		$this->db->delete('group_right');
		if($this->input->post('right_id'))
		{
			foreach($this->input->post('right_id') as $right_id)
			{
				$this->db->set('group_right_right_id', $right_id);
				$this->db->set('group_right_group_id', $group_id);
				$this->db->insert('group_right');
			}
		}

		return TRUE;
	}
}