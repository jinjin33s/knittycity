<?php
class Post_model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

	function get_post_list($page)
	{
		$total_post_count = $this->db->count_all('post');
		$pagination_info = $this->pagination->get_pagination_info($page, $total_post_count, $this->config->item('config_blog_entries_per_page'));

		$this->db->select('post_id, post_title, post_content, post_excerpt, post_url_name, user_name, user_id, post_is_published');
                $this->db->select("DATE_FORMAT(post_date_publish, '".$this->config->item('config_small_date_format')."')AS post_date_publish_formatted", FALSE);
		$this->db->select("DATE_FORMAT(post_date_edit, '".$this->config->item('config_small_date_format')."') AS post_date_edit_formatted", FALSE);
		$this->db->select('(SELECT COUNT(*) FROM comment WHERE comment_post_id = post_id) as comment_count', FALSE);
		$this->db->select('(SELECT COUNT(*) FROM comment WHERE comment_post_id = post_id AND comment_is_approved = 0) as not_approved_comment_count', FALSE);
		$this->db->from('post');
		$this->db->join('user', 'post_author_user_id = user_id');
		$this->db->order_by('post_date_create', 'desc');
		$this->db->limit($this->config->item('config_blog_entries_per_page'), (($pagination_info['page'] - 1) * $this->config->item('config_blog_entries_per_page')));
		$result = $this->db->get();

		if($result->num_rows() > 0)
		{
			$post_list = $result->result_array();
			return array('post_list' => $post_list, 'pagination_info' => $pagination_info);
		}
		else
		{
			return FALSE;
		}
	}

	function get_category_list($assignable_only = TRUE)
	{
		if($assignable_only)
		{
			$this->db->where('category_is_assignable', 1);
		}
		$result = $this->db->get('category');
		if($result->num_rows() > 0)
		{
			return $result->result_array();
		}
		else
		{
			return FALSE;
		}
	}

	function get_tag_list()
	{
		$result = $this->db->get('tag');
		if($result->num_rows() > 0)
		{
			return $result->result_array();
		}
		else
		{
			return FALSE;
		}
	}

	function add()
	{
		$this->db->set('post_title', set_value('post_title'));
		$this->db->set('post_content', unprep_for_form(set_value('post_content')));
		$this->db->set('post_excerpt', unprep_for_form(set_value('post_excerpt')));

                $time = strtotime( set_value('post_date_publish') );
                $mysqldate = date( 'Y-m-d', $time);
                $this->db->set('post_date_publish',$mysqldate);

		$this->db->set('post_date_create', 'NOW()', FALSE);
		$this->db->set('post_date_edit', 'NOW()', FALSE);
		$this->db->set('post_is_published', set_value('post_is_published'));
		$this->db->set('post_author_user_id', $this->auth->get_user_id());
		$this->db->set('post_trackback_is_allowed', set_value('post_trackback_is_allowed'));
		$this->db->insert('post');
		$post_id = $this->db->insert_id();

		// categories
		$this->_update_category_assoc($post_id);

		// tags
		$this->_update_tag_assoc($post_id);

		if(set_value('post_is_published') == 1)
		{
			// trackbacks
			$this->_update_trackback($post_id);
		}

		return $post_id;
	}

	function edit($post_id)
	{
		$this->db->set('post_title', set_value('post_title'));
		$this->db->set('post_content', unprep_for_form(set_value('post_content')));
		$this->db->set('post_excerpt', unprep_for_form(set_value('post_excerpt')));

//                $tmpDate = set_value('post_date_publish');
//                $m = date('m', $tmpDate);
//                $d = date('d', $tmpDate);
//                $y = date('Y', $tmpDate);

                $time = strtotime( set_value('post_date_publish') );
                $mysqldate = date( 'Y-m-d', $time);               
                $this->db->set('post_date_publish',$mysqldate);
                
		$this->db->set('post_date_edit', 'NOW()', FALSE);
		$this->db->set('post_is_published', set_value('post_is_published'));
		$this->db->set('post_trackback_is_allowed', set_value('post_trackback_is_allowed'));
		$this->db->where('post_id', $post_id);
		$this->db->update('post');

		// categories
		$this->_update_category_assoc($post_id);

		// tags
		$this->_update_tag_assoc($post_id);

		if(set_value('post_is_published') == 1)
		{
			// trackbacks
			$this->_update_trackback($post_id);
		}

		return TRUE;
	}

	function is_valid_post($post_id)
	{
		$this->db->where('post_id', $post_id);
		if($this->db->count_all_results('post') > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}


	function get_post($post_id)
	{
                $this->db->select("*");
                $this->db->select("DATE_FORMAT(post_date_publish, '".$this->config->item('config_small_date_format')."')AS post_date_publish_formatted", FALSE);
		$this->db->where('post_id', $post_id);
		$result = $this->db->get('post');

		if($result->num_rows() > 0)
		{
			$post = $result->row_array();

			$post['category_list'] = $this->_get_category_list($post['post_id']);

			$post['tag_list'] = $this->_get_tag_list($post['post_id']);

			return $post;
		}
		else
		{
			return FALSE;
		}
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
			$category_list = array();
			foreach($result->result_array() as $category)
			{
				$category_list[$category['category_id']] = TRUE;
			}

			return $category_list;
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
			$tag_list = '';
			foreach($result->result_array() as $tag)
			{
				if($tag_list == '')
				{
					$tag_list = $tag['tag_name'];
				}
				else
				{
					$tag_list .= ", ".$tag['tag_name'];
				}
			}
			return $tag_list;
		}
		else
		{
			return FALSE;
		}
	}

	function _update_tag_assoc($post_id)
	{
		$this->db->where('post_tag_post_id', $post_id);
		$this->db->delete('post_tag');
		if($this->input->post('tags'))
		{
			$new_tag_list = explode(',', set_value('tags'));
			// make sure there are no 2 new tags with the same name
			$unique_tag_list = array();
			foreach($new_tag_list as $key => $value)
			{
				$found = FALSE;
				foreach($unique_tag_list as $unique_name)
				{
					if(trim($value) == $unique_name)
					{
						$found = TRUE;
					}
				}
				if($found == FALSE)
				{
					$unique_tag_list[] = trim($value);
				}
			}
			$tag_list = $this->get_tag_list();
			foreach($unique_tag_list as $new_tag_name)
			{
				$exists = FALSE;
				if(is_array($tag_list))
				{
					foreach($tag_list as $tag)
					{
						if($tag['tag_name'] == $new_tag_name)
						{
							$exists = TRUE;
							$this->db->set('post_tag_post_id', $post_id);
							$this->db->set('post_tag_tag_id', $tag['tag_id']);
							$this->db->insert('post_tag');

							$this->db->set('tag_date_last_used', 'NOW()', FALSE);
							$this->db->where('tag_id', $tag['tag_id']);
							$this->db->update('tag');
						}
					}
				}
				if($exists == FALSE)
				{
					$this->db->set('tag_name', $new_tag_name);
					$this->db->set('tag_date_last_used', 'NOW()', FALSE);
					$this->db->insert('tag');

					$this->db->set('post_tag_post_id', $post_id);
					$this->db->set('post_tag_tag_id', $this->db->insert_id());
					$this->db->insert('post_tag');
				}
			}
		}

		return TRUE;
	}

	function _update_category_assoc($post_id)
	{
		$this->db->where('post_category_post_id', $post_id);
		$this->db->delete('post_category');
		if($this->input->post('category_id'))
		{
			foreach($this->input->post('category_id') as $category_id)
			{
				$this->db->set('post_category_post_id', $post_id);
				$this->db->set('post_category_category_id', $category_id);
				$this->db->insert('post_category');
			}
		}
		else
		{
			if(!$this->input->post('categories'))
			{
				$this->db->set('post_category_post_id', $post_id);
				$this->db->set('post_category_category_id', 1);
				$this->db->insert('post_category');
			}
		}

		if($this->input->post('categories'))
		{
			$this->db->select_max('category_order_by');
			$result = $this->db->get('category');

			$row = $result->row_array();
			$max_category_order_by = $row['category_order_by'];

			$new_category_list = explode(',', set_value('categories'));
			// make sure there are no 2 new categories with the same name
			$unique_category_list = array();
			foreach($new_category_list as $key => $value)
			{
				$found = FALSE;
				foreach($unique_category_list as $unique_name)
				{
					if(trim($value) == $unique_name)
					{
						$found = TRUE;
					}
				}
				if($found == FALSE)
				{
					$unique_category_list[] = trim($value);
				}
			}

			$category_list = $this->get_category_list(FALSE);
			foreach($unique_category_list as $new_category_name)
			{
				$exists = FALSE;
				if(is_array($category_list))
				{
					foreach($category_list as $category)
					{
						if($category['category_name'] == $new_category_name)
						{
							$exists = TRUE;
						}
					}
				}
				if($exists == FALSE)
				{
					$max_category_order_by++;
					$this->db->set('category_name', $new_category_name);
					$this->db->set('category_order_by', $max_category_order_by);
					$this->db->set('category_is_assignable', 1);
					$this->db->insert('category');

					$this->db->set('post_category_post_id', $post_id);
					$this->db->set('post_category_category_id', $this->db->insert_id());
					$this->db->insert('post_category');
				}
			}
		}

		return TRUE;
	}

	function delete()
	{
		if($this->input->post('post_id'))
		{
			foreach($this->input->post('post_id') as $post_id)
			{
				$this->db->where('comment_post_id', $post_id);
				$this->db->delete('comment');

				$this->db->where('post_tag_post_id', $post_id);
				$this->db->delete('post_tag');

				$this->db->where('post_category_post_id', $post_id);
				$this->db->delete('post_category');

				$this->db->where('post_id', $post_id);
				$this->db->delete('post');
			}
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function _update_trackback($post_id)
	{
		if(set_value('trackbacks') != '')
		{
			$this->db->where('post_id', $post_id);
			$result = $this->db->get('post');
			$post = $result->row_array();
			$post_trackback_list = explode(' ', $post['post_trackback_list']);
			foreach($post_trackback_list as $key => $value)
			{
				if($value == '')
				{
					unset($post_trackback_list[$key]);
				}
			}
			$trackback_list = explode(' ', set_value('trackbacks'));
			foreach($trackback_list as $trackback)
			{
				if(count($post_trackback_list) == 0)
				{
					$this->_do_trackback($post_id, $trackback, $post['post_title']);
					$post_trackback_list[] = $trackback;
				}
				else
				{
					$found = FALSE;
					foreach($post_trackback_list as $post_trackback)
					{
						if($trackback == $post_trackback)
						{
							$found = TRUE;
						}
					}
					if($found == FALSE)
					{
						$this->_do_trackback($post_id, $trackback, $post['post_title']);
						$post_trackback_list[] = $trackback;
					}
				}
			}

			$this->db->set('post_trackback_list', implode(' ', $post_trackback_list));
			$this->db->where('post_id', $post_id);
			$this->db->update('post');

			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function _do_trackback($post_id, $target_url, $title)
	{
		$post_excerpt = set_value('post_excerpt');
		$post_content = set_value('post_content');
		if($post_excerpt == '')
		{
			$excerpt = $post_content;
		}
		else
		{
			$excerpt = $post_excerpt;
		}
		$data = implode('&', array("url=".site_url('post/view/'.$post_id), "title=".urlencode($title), "blog_name=".urlencode($this->config->item('config_blog_title')), "excerpt=".urlencode($excerpt)));
		// format --> test1=a&test2=b etc.

		// parse the given URL
		$url = parse_url($target_url);
		if ($url['scheme'] != 'http')
		{
			return FALSE;
		}

		// extract host and path:
		$host = $url['host'];
		$path = $url['path'];

		// open a socket connection on port 80
		$fp = fsockopen($host, 80);

		// send the request headers:
		fputs($fp, "POST $path HTTP/1.1\r\n");
		fputs($fp, "Host: $host\r\n");
		fputs($fp, "Referer: ".site_url()."\r\n");
		fputs($fp, "Content-type: application/x-www-form-urlencoded; charset=utf-8\r\n");
		fputs($fp, "Content-length: ". strlen($data) ."\r\n");
		fputs($fp, "Connection: close\r\n\r\n");
		fputs($fp, $data);

		$result = '';
		while(!feof($fp))
		{
			// receive the results of the request
			$result .= fgets($fp, 128);
		}

		// close the socket connection:
		fclose($fp);

		// split the result header from the content
		$result = explode("\r\n\r\n", $result, 2);

		$header = isset($result[0]) ? $result[0] : '';
		$content = isset($result[1]) ? $result[1] : '';

		// return as array:
		return array($header, $content);
	}

}