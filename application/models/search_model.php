<?php
class Search_model extends MY_Model
{

    function __construct()
    {
        parent::__construct();
    }

	function perform_search($search_id = FALSE)
	{
		if($search_id == FALSE)
		{
			$this->db->where('search_term', set_value('search_term'));
			$result = $this->db->get('search');
			if($result->num_rows() > 0)
			{
				$search = $result->row_array();
				$this->db->set('search_perform_count', 'search_perform_count + 1', FALSE);
				$this->db->set('search_date_last_performed', 'NOW()', FALSE);
				$this->db->where('search_id', $search['search_id']);
				$this->db->update('search');
				return $search['search_id'];
			}
			else
			{
				$this->db->set('search_term', set_value('search_term'));
				$this->db->set('search_perform_count', 1);
				$this->db->set('search_date_last_performed', 'NOW()', FALSE);
				$this->db->insert('search');
				return $this->db->insert_id();
			}
		}
		else
		{
			$this->db->set('search_perform_count', 'search_perform_count + 1', FALSE);
			$this->db->set('search_date_last_performed', 'NOW()', FALSE);
			$this->db->where('search_id', $search_id);
			$this->db->update('search');
		}
	}

	function is_valid_search($search_id)
	{
		$this->db->where('search_id', $search_id);
		if($this->db->count_all_results('search') > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function get_result_list($search_id, $page)
	{
		$this->db->where('search_id', $search_id);
		$result = $this->db->get('search');
		$search = $result->row_array();

		$this->db->like('post_title', $search['search_term']);
		$this->db->or_like('post_excerpt', $search['search_term']);
		$this->db->or_like('post_content', $search['search_term']);
		$this->db->order_by('post_date_create', 'desc');
		$result = $this->db->get('post');

		$result_count = $result->num_rows();

		if($result_count > 0)
		{
			$id_list = "";
			foreach($result->result_array() as $post)
			{
				if($id_list == "")
				{
					$id_list = $post['post_id'];
				}
				else
				{
					$id_list .= ", ".$post['post_id'];
				}
			}

			$pagination_info = $this->pagination->get_pagination_info($page, $result_count, $this->config->item('config_blog_entries_per_page'));

			$this->db->select('post_id, post_title, post_content, post_excerpt, post_url_name, user_name');
			$this->db->select("DATE_FORMAT(post_date_create, '".$this->config->item('config_date_format')."') AS post_date_create_formatted", FALSE);
			$this->db->select('(SELECT COUNT(*) FROM comment WHERE comment_post_id = post_id AND comment_is_approved = 1) as comment_count', FALSE);
			$this->db->from('post');
			$this->db->join('user', 'post_author_user_id = user_id');
			$this->db->where('post_is_published', 1);
			$this->db->where("post_id in ($id_list)");
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
		else
		{
			return FALSE;
		}
	}
}