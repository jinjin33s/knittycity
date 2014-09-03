<?php
class Module_model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

	function get_module_list($page)
	{
		$total_module_count = $this->db->count_all('module');
		$pagination_info = $this->pagination->get_pagination_info($page, $total_module_count, $this->config->item('config_comments_per_page'));

		$this->db->order_by('module_name', 'asc');
		$this->db->limit($this->config->item('config_comments_per_page'), (($pagination_info['page'] - 1) * $this->config->item('config_comments_per_page')));
		$result = $this->db->get('module');

		if($result->num_rows() > 0)
		{
			$module_list = $result->result_array();
			return array('module_list' => $module_list, 'pagination_info' => $pagination_info);
		}
		else
		{
			return FALSE;
		}
	}

	function is_valid_module($module_id)
	{
		$this->db->where('module_id', $module_id);
		if($this->db->count_all_results('module') > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function deactivate($module_id)
	{
		$this->db->set('module_is_active', 0);
		$this->db->where('module_id', $module_id);
		$this->db->update('module');
	}

	function activate($module_id)
	{
		$this->db->set('module_is_active', 1);
		$this->db->where('module_id', $module_id);
		$this->db->update('module');
	}
}