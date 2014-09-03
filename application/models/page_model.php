<?php
class Page_model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

	function is_valid_page($page_id)
	{
		$this->db->where('page_id', $page_id);
		$this->db->where('page_is_published', 1);
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
		$this->db->select('*');
		$this->db->where('page_id', $page_id);
		$this->db->where('page_is_published', 1);
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
}