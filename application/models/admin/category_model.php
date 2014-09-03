<?php
class Category_model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

	function get_category_list($page)
	{
		$total_category_count = $this->db->count_all('category');
		$pagination_info = $this->pagination->get_pagination_info($page, $total_category_count, $this->config->item('config_blog_entries_per_page'));

		$this->db->select('*');
		$this->db->select('(SELECT COUNT(*) FROM post_category WHERE post_category_category_id = category_id) as post_count', FALSE);
		$this->db->order_by('category_order_by', 'asc');
		$this->db->limit($this->config->item('config_blog_entries_per_page'), (($pagination_info['page'] - 1) * $this->config->item('config_blog_entries_per_page')));
		$result = $this->db->get('category');

		if($result->num_rows() > 0)
		{
			$category_list = $result->result_array();
			return array('category_list' => $category_list, 'pagination_info' => $pagination_info);
		}
		else
		{
			return FALSE;
		}
	}

	function delete()
	{
		if($this->input->post('category_id'))
		{
			foreach($this->input->post('category_id') as $category_id)
			{
				$this->db->where('post_category_category_id', $category_id);
				$this->db->delete('post_category');

				$this->db->where('category_id', $category_id);
				$this->db->where('category_is_assignable', 1);
				$this->db->delete('category');
			}

			$this->db->select('post_id');
			$this->db->where('post_id NOT IN (SELECT DISTINCT post_category_post_id FROM post_category)');
			$result = $this->db->get('post');
			if($result->num_rows() > 0)
			{
				foreach($result->result_array() as $post)
				{
					$this->db->set('post_category_post_id', $post['post_id']);
					$this->db->set('post_category_category_id', 1);
					$this->db->insert('post_category');
				}
			}

			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function is_valid_category($category_id)
	{
		$this->db->where('category_id', $category_id);
		if($this->db->count_all_results('category') > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function sort($direction, $category_id)
	{
		$category = $this->_get_category($category_id);
		$next_category = $this->_get_next_category($direction, $category['category_order_by']);
		if(is_array($next_category))
		{
			$this->db->set('category_order_by', $next_category['category_order_by']);
			$this->db->where('category_id', $category['category_id']);
			$this->db->update('category');

			$this->db->set('category_order_by', $category['category_order_by']);
			$this->db->where('category_id', $next_category['category_id']);
			$this->db->update('category');

			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function _get_category($category_id)
	{
		$this->db->where('category_id', $category_id);
		$result = $this->db->get('category');
		return $result->row_array();
	}

	function _get_next_category($direction, $order_by)
	{
		if($direction == 'up')
		{
			$this->db->where("category_order_by < $order_by");
			$this->db->order_by('category_order_by', 'desc');
			$this->db->limit(1, 0);
		}
		else
		{
			$this->db->where("category_order_by > $order_by");
			$this->db->order_by('category_order_by', 'asc');
			$this->db->limit(1, 0);
		}
		$result = $this->db->get('category');

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