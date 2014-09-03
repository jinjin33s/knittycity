<?php
class File_model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

	function get_file_list($page)
	{
		$total_file_count = $this->db->count_all('file');
		$pagination_info = $this->pagination->get_pagination_info($page, $total_file_count, $this->config->item('config_blog_entries_per_page'));

		$this->db->select('*');
		$this->db->select("DATE_FORMAT(file_date_add, '".$this->config->item('config_small_date_format')."') AS file_date_add_formatted", FALSE);
		$this->db->from('file');
		$this->db->order_by('file_date_add', 'desc');
		$this->db->limit($this->config->item('config_blog_entries_per_page'), (($pagination_info['page'] - 1) * $this->config->item('config_blog_entries_per_page')));
		$result = $this->db->get();

		if($result->num_rows() > 0)
		{
			$file_list = $result->result_array();
			return array('file_list' => $file_list, 'pagination_info' => $pagination_info);
		}
		else
		{
			return FALSE;
		}
	}

	function add()
	{
		$this->db->set('file_title', set_value('file_title'));
		$this->db->set('file_description', unprep_for_form(set_value('file_description')));
		$this->db->set('file_mirror', set_value('file_mirror'));
		$this->db->set('file_is_online', set_value('file_is_online'));
		$this->db->set('file_size', set_value('file_size'));
		$this->db->set('file_date_add', 'NOW()', false);
		$this->db->insert('file');

		return $this->db->insert_id();;
	}

	function edit($file_id)
	{
		$this->db->set('file_title', set_value('file_title'));
		$this->db->set('file_description', unprep_for_form(set_value('file_description')));
		$this->db->set('file_mirror', set_value('file_mirror'));
		$this->db->set('file_is_online', set_value('file_is_online'));
		$this->db->set('file_size', set_value('file_size'));
		$this->db->where('file_id', $file_id);
		$this->db->update('file');

		return TRUE;
	}

	function is_valid_file($file_id)
	{
		$this->db->where('file_id', $file_id);
		if($this->db->count_all_results('file') > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}


	function get_file($file_id)
	{
		$this->db->where('file_id', $file_id);
		$result = $this->db->get('file');

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
		if($this->input->post('file_id'))
		{
			foreach($this->input->post('file_id') as $file_id)
			{
				$this->db->where('file_id', $file_id);
				$this->db->delete('file');
			}
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

}