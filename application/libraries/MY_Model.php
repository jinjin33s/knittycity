<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

	function _get_category_list($post_id)
	{
		$this->db->select('category_id, category_name');
		$this->db->from('category');
		$this->db->join('post_category', 'category_id = post_category_category_id');
		$this->db->where('post_category_post_id', $post_id);
		$result = $this->db->get();
		if($result->num_rows() > 0)
		{
			return $result->result_array();
		}
		else
		{
			return FALSE;
		}
	}

	function _get_tag_list($post_id)
	{
		$this->db->select('tag_id, tag_name');
		$this->db->from('tag');
		$this->db->join('post_tag', 'tag_id = post_tag_tag_id');
		$this->db->where('post_tag_post_id', $post_id);
		$result = $this->db->get();
		if($result->num_rows() > 0)
		{
			return $result->result_array();
		}
		else
		{
			return FALSE;
		}
	}
}