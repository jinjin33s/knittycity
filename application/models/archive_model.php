<?php
class Archive_model extends MY_Model
{

    function __construct()
    {
        parent::__construct();
    }

	function get_post_list($year, $month, $page)
	{
		$this->db->where('post_is_published', 1);
		$this->db->where("DATE_FORMAT(post_date_create, '%Y/%m') = ".$this->db->escape("$year/$month"));
		$this->db->from('post');
		$total_post_count = $this->db->count_all_results();
		$pagination_info = $this->pagination->get_pagination_info($page, $total_post_count, $this->config->item('config_blog_entries_per_page'));

		$this->db->select('post_id, post_title, post_content, post_excerpt, post_url_name, user_name');
		$this->db->select("DATE_FORMAT(post_date_create, '".$this->config->item('config_date_format')."') AS post_date_create_formatted", FALSE);
		$this->db->select('(SELECT COUNT(*) FROM comment WHERE comment_post_id = post_id AND comment_is_approved = 1) as comment_count', FALSE);
		$this->db->from('post');
		$this->db->join('user', 'post_author_user_id = user_id');
		$this->db->where('post_is_published', 1);
		$this->db->where("DATE_FORMAT(post_date_create, '%Y/%m') = ".$this->db->escape("$year/$month"));
		$this->db->order_by('post_date_create', 'desc');
		$this->db->limit($this->config->item('config_blog_entries_per_page'), (($pagination_info['page'] - 1) * $this->config->item('config_blog_entries_per_page')));
		$result = $this->db->get();

		if($result->num_rows() > 0)
		{
			$post_list = $result->result_array();
			foreach($post_list as $key => $value)
			{
				$post_list[$key]['category_list'] = $this->_get_category_list($value['post_id']);

				$post_list[$key]['tag_list'] = $this->_get_tag_list($value['post_id']);
			}
			return array('post_list' => $post_list, 'pagination_info' => $pagination_info);
		}
		else
		{
			return FALSE;
		}
	}

	function is_valid_archive($year, $month)
	{
		$this->db->where('post_is_published', 1);
		$this->db->where("DATE_FORMAT(post_date_create, '%Y/%m') = ".$this->db->escape("$year/$month"));
		if($this->db->count_all_results('post') > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function get_archive($year, $month)
	{
    	$this->db->distinct();
    	$this->db->select("DATE_FORMAT(post_date_create, '%Y/%m') AS archive_id", FALSE);
    	$this->db->select("DATE_FORMAT(post_date_create, '%M %Y') AS archive_name", FALSE);
		$this->db->where('post_is_published', 1);
		$this->db->where("DATE_FORMAT(post_date_create, '%Y/%m') = ".$this->db->escape("$year/$month"));
		$result = $this->db->get('post');
		return $result->row_array();
	}
}