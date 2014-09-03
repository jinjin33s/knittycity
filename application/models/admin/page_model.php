<?php
class Page_model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

	function get_page_list($page)
	{
		$total_page_count = $this->db->count_all('page');
		$pagination_info = $this->pagination->get_pagination_info($page, $total_page_count, $this->config->item('config_blog_entries_per_page'));

		$this->db->select('*');
		$this->db->select("DATE_FORMAT(page_date_edit, '".$this->config->item('config_small_date_format')."') AS page_date_edit_formatted", FALSE);
		$this->db->from('page');
		$this->db->order_by('page_order_by', 'asc');
		$this->db->limit($this->config->item('config_blog_entries_per_page'), (($pagination_info['page'] - 1) * $this->config->item('config_blog_entries_per_page')));
		$result = $this->db->get();

		if($result->num_rows() > 0)
		{
			$page_list = $result->result_array();
			return array('page_list' => $page_list, 'pagination_info' => $pagination_info);
		}
		else
		{
			return FALSE;
		}
	}

	function add()
	{
		$this->db->set('page_title', set_value('page_title'));
		$this->db->set('page_content', unprep_for_form(set_value('page_content')));
		$this->db->set('page_date_create', 'NOW()', FALSE);
		$this->db->set('page_date_edit', 'NOW()', FALSE);
		$this->db->set('page_is_published', set_value('page_is_published'));
		$this->db->insert('page');
		$page_id = $this->db->insert_id();

		return $page_id;
	}

	function edit($page_id)
	{
		$this->db->set('page_title', set_value('page_title'));
		$this->db->set('page_content', unprep_for_form(set_value('page_content')));
		$this->db->set('page_date_edit', 'NOW()', FALSE);
		$this->db->set('page_is_published', set_value('page_is_published'));
		$this->db->where('page_id', $page_id);
		$this->db->update('page');

		return TRUE;
	}

	function is_valid_page($page_id)
	{
		$this->db->where('page_id', $page_id);
		if($this->db->count_all_results('page') > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}


	function get_page($page_id)
	{
		$this->db->where('page_id', $page_id);
		$result = $this->db->get('page');

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
		if($this->input->post('page_id'))
		{
			foreach($this->input->post('page_id') as $page_id)
			{
				$this->db->where('page_id', $page_id);
				$this->db->delete('page');
			}
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function sort($direction, $page_id)
	{
		$page = $this->get_page($page_id);
		$next_page = $this->_get_next_page($direction, $page['page_order_by']);
		if(is_array($next_page))
		{
			$this->db->set('page_order_by', $next_page['page_order_by']);
			$this->db->where('page_id', $page['page_id']);
			$this->db->update('page');

			$this->db->set('page_order_by', $page['page_order_by']);
			$this->db->where('page_id', $next_page['page_id']);
			$this->db->update('page');

			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function _get_next_page($direction, $order_by)
	{
		if($direction == 'up')
		{
			$this->db->where("page_order_by < $order_by");
			$this->db->order_by('page_order_by', 'desc');
			$this->db->limit(1, 0);
		}
		else
		{
			$this->db->where("page_order_by > $order_by");
			$this->db->order_by('page_order_by', 'asc');
			$this->db->limit(1, 0);
		}
		$result = $this->db->get('page');

		if($result->num_rows() == 1)
		{
			return $result->row_array();
		}
		else
		{
			return FALSE;
		}
	}

}