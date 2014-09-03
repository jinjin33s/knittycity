<?php
class Post_model extends MY_Model
{

    function __construct()
    {
        parent::__construct();
    }

	function get_post_list($page)
	{
		$total_post_count = $this->db->count_all('post');
		$pagination_info = $this->pagination->get_pagination_info($page, $total_post_count, $this->config->item('config_blog_entries_per_page'));

		$this->db->select('post_id, post_title, post_content, post_excerpt, post_url_name, user_name');
                $this->db->select("DATE_FORMAT(post_date_publish, '".$this->config->item('config_small_date_format')."')AS post_date_publish_formatted", FALSE);
		$this->db->select("DATE_FORMAT(post_date_create, '".$this->config->item('config_date_format')."') AS post_date_create_formatted", FALSE);
		$this->db->select('(SELECT COUNT(*) FROM comment WHERE comment_post_id = post_id AND comment_is_approved = 1) as comment_count', FALSE);
		$this->db->from('post');
		$this->db->join('user', 'post_author_user_id = user_id');
		$this->db->where('post_is_published', 1);
		$this->db->order_by('post_date_publish', 'desc');
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

	function is_valid_post($post_id)
	{
		$this->db->where('post_id', $post_id);
		$this->db->where('post_is_published', 1);
		if($this->db->count_all_results('post') > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function get_post($post_id, $page)
	{
		$this->db->select('post_id, post_title, post_content, post_excerpt, post_url_name, user_name');
                $this->db->select("DATE_FORMAT(post_date_publish, '".$this->config->item('config_small_date_format')."') AS post_date_publish_formatted", FALSE);
		$this->db->select("DATE_FORMAT(post_date_create, '".$this->config->item('config_date_format')."') AS post_date_create_formatted", FALSE);
		$this->db->join('user', 'post_author_user_id = user_id');
		$this->db->where('post_id', $post_id);
		$this->db->where('post_is_published', 1);
		$result = $this->db->get('post');

		if($result->num_rows() > 0)
		{
			$post = $result->row_array();

			$post['category_list'] = $this->_get_category_list($post['post_id']);

			$post['tag_list'] = $this->_get_tag_list($post['post_id']);

			$post['trackback_list'] = $this->_get_trackback_list($post['post_id']);


			$comment_list = $this->_get_comment_list($post['post_id'], $page);
			$post['comment_list'] = $comment_list['comment_list'];
			$post['comment_list_pagination_info'] = $comment_list['comment_list_pagination_info'];

			return $post;
		}
		else
		{
			return FALSE;
		}
	}

	function _get_comment_list($post_id, $page)
	{
		$this->db->where('comment_post_id', $post_id);
		$this->db->where('comment_is_approved', 1);
		$total_comment_count = $this->db->count_all_results('comment');
		$pagination_info = $this->pagination->get_pagination_info($page, $total_comment_count, $this->config->item('config_comments_per_page'));

		$this->db->select('comment_id, user_name, user_email, user_website, comment_date_create, comment_content, comment_author_name, comment_author_email, comment_author_website');
		$this->db->select("DATE_FORMAT(comment_date_create, '".$this->config->item('config_date_time_format')."') AS comment_date_create_formatted", FALSE);
		$this->db->from('comment');
		$this->db->join('user', 'comment_author_user_id = user_id', 'left outer');
		$this->db->where('comment_post_id', $post_id);
		$this->db->where('comment_is_approved', 1);
		$this->db->where('comment_is_spam', 0);
		$this->db->limit($this->config->item('config_comments_per_page'), (($pagination_info['page'] - 1) * $this->config->item('config_comments_per_page')));
		$result = $this->db->get();
		if($result->num_rows() > 0)
		{
			return array('comment_list' => $result->result_array(), 'comment_list_pagination_info' => $pagination_info);
		}
		else
		{
			return array('comment_list' => FALSE, 'comment_list_pagination_info' => FALSE);
		}
	}

	function _get_trackback_list($post_id)
	{
		$this->db->select('*');
		$this->db->select("DATE_FORMAT(trackback_date_added, '".$this->config->item('config_date_time_format')."') AS trackback_date_added_formatted", FALSE);
		$this->db->where('trackback_post_id', $post_id);
		$result = $this->db->get('trackback');

		if($result->num_rows() > 0)
		{
			return $result->result_array();
		}
		else
		{
			return FALSE;
		}
	}

	function add_comment($post_id)
	{
		if(!$this->auth->is_logged_in())
		{
			$this->db->set('comment_author_name', set_value('comment_author_name'));
			$this->db->set('comment_author_email', set_value('comment_author_email'));
			$this->db->set('comment_author_website', set_value('comment_author_website'));
		}
		else
		{
			$this->db->set('comment_author_user_id', $this->auth->get_user_id());
		}

		if($this->auth->has_right('comment_without_approval'))
		{
			$this->db->set('comment_is_approved', 1);
		}
		else
		{
			$this->db->set('comment_is_approved', 0);
		}

		$spam_check = array(
							'comment_type' => 'comment',
							'comment_author' => set_value('comment_author_name'),
							'comment_author_email' => set_value('comment_author_email'),
							'comment_author_url' => set_value('comment_author_website'),
							'comment_content' => set_value('comment_content'),
							'permalink' => site_url('post/view/'.$post_id)
						);
		if($this->auth->is_logged_in())
		{
			$user = $this->auth->get_user();
			$spam_check['comment_author'] = $user['user_name'];
			$spam_check['comment_author_url'] = $user['user_website'];
			$spam_check['comment_author_email'] = $user['user_email'];
		}

		// Call hook comment_submit_spam_check
		$this->db->set('comment_is_spam', $this->modules->call_hook('comment_submit_spam_check', $spam_check, FALSE));

		$this->db->set('comment_content', set_value('comment_content'));
		$this->db->set('comment_date_create', 'NOW()', FALSE);
		$this->db->set('comment_post_id', $post_id);
		$this->db->insert('comment');

		$comment_id = $this->db->insert_id();

		$this->db->where('comment_post_id', $post_id);
		$this->db->where('comment_is_approved', 1);
		$total_comment_count = $this->db->count_all_results('comment');
		$pagination_info = $this->pagination->get_pagination_info(1, $total_comment_count, $this->config->item('config_comments_per_page'));

		return array('comment_id' => $comment_id, 'page' => $pagination_info['page_count']);
	}

	function get_search_result($search_result)
	{
		$id_list = $search_result['id_list'];
		$this->db->select('post_id, post_title, post_content, post_excerpt, post_url_name, user_name');
                $this->db->select("DATE_FORMAT(post_date_publish, '".$this->config->item('config_small_date_format')."') AS post_date_publish_formatted", FALSE);
		$this->db->select("DATE_FORMAT(post_date_create, '".$this->config->item('config_date_format')."') AS post_date_create", FALSE);
		$this->db->select('(SELECT COUNT(*) FROM comment WHERE comment_post_id = post_id AND comment_is_approved = 1) as comment_count', FALSE);
		$this->db->from('post');
		$this->db->join('user', 'post_author_user_id = user_id');
		$this->db->where('post_is_published', 1);
		$this->db->where("post_id in ($id_list)");
		foreach($search_result['search_order_by'] as $key => $value)
		{
			$this->db->order_by($key, $value);
		}
		$result = $this->db->get();
		echo $this->db->last_query();

		if($result->num_rows() > 0)
		{
			$post_list = $result->result_array();
			foreach($post_list as $key => $value)
			{
				$post_list[$key]['category_list'] = $this->_get_category_list($value['post_id']);

				$post_list[$key]['tag_list'] = $this->_get_tag_list($value['post_id']);
			}
			return $post_list;
		}
		else
		{
			return FALSE;
		}
	}

	function trackback_is_allowed($post_id)
	{
		$this->db->where('post_id', $post_id);
		$result = $this->db->get('post');

		$post = $result->row_array();
		return $post['post_trackback_is_allowed'];
	}

	function trackback_exists($post_id)
	{
		$this->db->where('trackback_post_id', $post_id);
		$this->db->where('trackback_url', set_value('url'));
		$trackback_count = $this->db->count_all_results('trackback');

		if($trackback_count > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function add_trackback($post_id)
	{
		$this->db->set('trackback_post_id', $post_id);
		$this->db->set('trackback_url', set_value('url'));
		$this->db->set('trackback_date_added', 'NOW()', FALSE);
		$this->db->set('trackback_title', set_value('title'));
		$this->db->set('trackback_blog_name', set_value('blog_name'));
		$this->db->set('trackback_excerpt', set_value('excerpt'));
		$this->db->insert('trackback');

		return TRUE;
	}
}