<?php
class Link_model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

	function get_link_list($page)
	{
		$total_link_count = $this->db->count_all('link');
		$pagination_info = $this->pagination->get_pagination_info($page, $total_link_count, $this->config->item('config_blog_entries_per_page'));

		$this->db->from('link');
		$this->db->order_by('link_title', 'asc');
		$this->db->limit($this->config->item('config_blog_entries_per_page'), (($pagination_info['page'] - 1) * $this->config->item('config_blog_entries_per_page')));
		$result = $this->db->get();

		if($result->num_rows() > 0)
		{
			$link_list = $result->result_array();
			return array('link_list' => $link_list, 'pagination_info' => $pagination_info);
		}
		else
		{
			return FALSE;
		}
	}

	function add()
	{
		$this->db->set('link_title', set_value('link_title'));
		$this->db->set('link_url', set_value('link_url'));
		$this->db->set('link_is_blog', set_value('link_is_blog'));
		$this->db->insert('link');

		return $this->db->insert_id();;
	}

	function edit($link_id)
	{
		$this->db->set('link_title', set_value('link_title'));
		$this->db->set('link_url', set_value('link_url'));
		$this->db->set('link_is_blog', set_value('link_is_blog'));
		$this->db->where('link_id', $link_id);
		$this->db->update('link');

		return TRUE;
	}

	function is_valid_link($link_id)
	{
		$this->db->where('link_id', $link_id);
		if($this->db->count_all_results('link') > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}


	function get_link($link_id)
	{
		$this->db->where('link_id', $link_id);
		$result = $this->db->get('link');

		if($result->num_rows() > 0)
		{
			return $result->row_array();
		}
		else
		{
			return FALSE;
		}
	}

	function delete()
	{
		if($this->input->post('link_id'))
		{
			foreach($this->input->post('link_id') as $link_id)
			{
				$this->db->where('link_id', $link_id);
				$this->db->delete('link');
			}
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

}