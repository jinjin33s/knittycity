<?php
class File_model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

	function is_valid_file($file_id)
	{
		$this->db->where('file_id', $file_id);
		$this->db->where('file_is_online', 1);
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
		$this->db->select('*');
		$this->db->select("DATE_FORMAT(file_date_add, '".$this->config->item('config_small_date_format')."') AS file_date_add_formatted", FALSE);
		$this->db->where('file_id', $file_id);
		$this->db->where('file_is_online', 1);
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

	function is_valid_mirror($file_id, $mirror_id)
	{
		if(is_numeric($mirror_id))
		{
			$file = $this->get_file($file_id);
			$mirror_list = explode('<br />', nl2br($file['file_mirror']));
			if(isset($mirror_list[$mirror_id - 1]))
			{
				if($mirror_list[$mirror_id - 1] != '')
				{
					return TRUE;
				}
				else
				{
					return FALSE;
				}
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
			return FALSE;
		}
	}

	function get_mirror($file_id, $mirror_id)
	{
		$file = $this->get_file($file_id);
		$mirror_list = explode('<br />', nl2br($file['file_mirror']));
		$mirror = explode('||', $mirror_list[$mirror_id-1]);
		return array('source' => trim($mirror[0]), 'file' => trim($mirror[1]), 'title' => trim($mirror[2]));
	}

	function increase_download_count($file_id)
	{
		$this->db->set('file_download_count', 'file_download_count + 1', FALSE);
		$this->db->where('file_id', $file_id);
		$this->db->update('file');

		return TRUE;
	}

	function get_file_list($page)
	{
		$total_file_count = $this->db->count_all('file');
		$pagination_info = $this->pagination->get_pagination_info($page, $total_file_count, $this->config->item('config_blog_entries_per_page'));

		$this->db->select('*');
		$this->db->select("DATE_FORMAT(file_date_add, '".$this->config->item('config_small_date_format')."') AS file_date_add_formatted", FALSE);
		$this->db->from('file');
		$this->db->where('file_is_online', 1);
		$this->db->order_by('file_date_add', 'desc');
		$this->db->limit($this->config->item('config_blog_entries_per_page'), (($pagination_info['page'] - 1) * $this->config->item('config_blog_entries_per_page')));
		$result = $this->db->get();

		if($result->num_rows() > 0)
		{
			return array('file_list' => $result->result_array(), 'pagination_info' => $pagination_info);
		}
		else
		{
			return FALSE;
		}
	}
}