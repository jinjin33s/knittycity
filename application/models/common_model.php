<?php
class Common_model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_navigation()
    {
    	if($this->config->item('config_navigation_items') != '')
    	{
			$navigation = explode(',',$this->config->item('config_navigation_items'));
			foreach($navigation as $section)
			{
				$method = "_get_".trim($section);
				if(method_exists($this, $method))
				{
					$navigation[trim($section)] = $this->$method();
				}
			}
			return $navigation;
    	}
    	else
    	{
    		return false;
    	}
    }

    function _get_pages()
    {
		$this->db->select('*');
		$this->db->where('page_is_published', 1);
		$this->db->order_by('page_order_by', 'asc');
		$result = $this->db->get('page');

		if($result->num_rows() > 0)
		{
			$entries = array();
			foreach($result->result_array() as $entry)
			{
				$entries[] = anchor('page/view/'.$entry['page_id'], $entry['page_title']);
			}
			return array('title' => 'Pages', 'entries' => $entries);
		}
		else
		{
			return FALSE;
		}
    }

    function _get_archives()
    {
    	$this->db->distinct();
    	$this->db->select("DATE_FORMAT(post_date_create, '%Y/%m') AS archive_id", FALSE);
    	$this->db->select("DATE_FORMAT(post_date_create, '%M %Y') AS archive_name", FALSE);
    	$this->db->where('post_is_published', 1);
    	$this->db->order_by('archive_id');
    	$result = $this->db->get('post');

		if($result->num_rows() > 0)
		{
			$entries = array();
			foreach($result->result_array() as $entry)
			{
				$entries[] = anchor('archive/view/'.$entry['archive_id'], $entry['archive_name']);
			}
			return array('title' => 'Archive', 'entries' => $entries);
		}
		else
		{
			return FALSE;
		}
    }

    function _get_categories()
    {
    	$this->db->select('category_name, category_id');
    	$this->db->select('COUNT(*) AS post_count', FALSE);
    	$this->db->from('category');
    	$this->db->join('post_category', 'category_id = post_category_category_id');
    	$this->db->join('post', 'post_category_post_id = post_id');
    	$this->db->where('post_is_published', 1);
    	$this->db->group_by('category_name, category_id');
    	$this->db->having('post_count > 0');
    	$this->db->order_by('category_order_by');
    	$result = $this->db->get();

		if($result->num_rows() > 0)
		{
			$entries = array();
			foreach($result->result_array() as $entry)
			{
				$entries[] = anchor('category/view/'.$entry['category_id'], $entry['category_name']." (".$entry['post_count'].")");
			}
			return array('title' => 'Categories', 'entries' => $entries);
		}
		else
		{
			return FALSE;
		}
    }

    function _get_links()
    {
		$this->db->select('*');
		$this->db->where('link_is_blog', 0);
		$result = $this->db->get('link');

		if($result->num_rows() > 0)
		{
			$entries = array();
			foreach($result->result_array() as $entry)
			{
				$entries[] = anchor($entry['link_url'], $entry['link_title'], array('target' => '_blank'));
			}
			return array('title' => 'Links', 'entries' => $entries);
		}
		else
		{
			return FALSE;
		}
    }

    function _get_blogs()
    {
		$this->db->select('*');
		$this->db->where('link_is_blog', 1);
		$result = $this->db->get('link');

		if($result->num_rows() > 0)
		{
			$entries = array();
			foreach($result->result_array() as $entry)
			{
				$entries[] = anchor($entry['link_url'], $entry['link_title'], array('target' => '_blank'));
			}
			return array('title' => 'Blogs', 'entries' => $entries);
		}
		else
		{
			return FALSE;
		}
    }

    function _get_tag_cloud()
    {
    	$this->db->select('tag_id, tag_name as name', 'tag_date_last_used');
    	$this->db->select('COUNT(*) AS count');
    	$this->db->from('tag');
    	$this->db->join('post_tag', 'post_tag_tag_id = tag_id');
    	$this->db->join('post', 'post_tag_post_id = post_id');
    	$this->db->where('post_is_published', 1);
    	$this->db->group_by('tag_id, tag_name', 'tag_date_last_used');
    	$this->db->order_by('count', 'desc');
    	$this->db->limit(10, 0);
    	$result = $this->db->get();
    	if($result->num_rows() > 0)
    	{
	    	$tag_list = $result->result_array();
	    	foreach($tag_list as $key => $value)
	    	{
	    		$tag_list[$key]['url'] = 'tag/view/'.$value['tag_id'];
	    	}
    	}
    	else
    	{
    		$tag_list = FALSE;
    	}
    	return array('title' => 'Recent tags', 'entries' => $tag_list, 'is_cloud' => 1);
    }

    function _get_search_cloud()
    {
    	$this->db->select('search_id, search_term as name, search_perform_count as count');
    	$this->db->from('search');
    	$this->db->order_by('count', 'desc');
    	$this->db->limit(10, 0);
    	$result = $this->db->get();
    	if($result->num_rows() > 0)
    	{
	    	$search_list = $result->result_array();
	    	foreach($search_list as $key => $value)
	    	{
	    		$search_list[$key]['url'] = 'search/result/'.$value['search_id'];
	    	}
    	}
    	else
    	{
    		$search_list = FALSE;
    	}
    	return array('title' => 'Recent search terms', 'entries' => $search_list, 'is_cloud' => 1);
    }

    function _get_newest_files()
    {
		$this->db->select('*');
		$this->db->where('file_is_online', 1);
		$this->db->order_by('file_date_add', 'desc');
		$this->db->limit(5, 0);
		$result = $this->db->get('file');

		if($result->num_rows() > 0)
		{
			$entries = array();
			foreach($result->result_array() as $entry)
			{
				$entries[] = anchor('file/view/'.$entry['file_id'], $entry['file_title']);
			}
			return array('title' => anchor('file/overview', 'Newest files'), 'entries' => $entries);
		}
		else
		{
			return FALSE;
		}
    }

    function _get_top_files()
    {
		$this->db->select('*');
		$this->db->where('file_is_online', 1);
		$this->db->order_by('file_download_count', 'desc');
		$this->db->order_by('file_date_add', 'desc');
		$this->db->limit(5, 0);
		$result = $this->db->get('file');

		if($result->num_rows() > 0)
		{
			$entries = array();
			foreach($result->result_array() as $entry)
			{
				$entries[] = anchor('file/view/'.$entry['file_id'], $entry['file_title']);
			}
			return array('title' => anchor('file/overview', 'Top files'), 'entries' => $entries);
		}
		else
		{
			return FALSE;
		}
    }
}