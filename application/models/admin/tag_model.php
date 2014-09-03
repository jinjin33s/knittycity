<?php
class Tag_model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

	function get_tag_list($page)
	{
		$total_tag_count = $this->db->count_all('tag');
		$pagination_info = $this->pagination->get_pagination_info($page, $total_tag_count, $this->config->item('config_blog_entries_per_page'));

		$this->db->select('*');
		$this->db->select("DATE_FORMAT(tag_date_last_used, '".$this->config->item('config_small_date_format')."') AS tag_date_last_used_formatted", FALSE);
		$this->db->select('(SELECT COUNT(*) FROM post_tag WHERE post_tag_tag_id = tag_id) as post_count', FALSE);
		$this->db->order_by('tag_name', 'asc');
		$this->db->limit($this->config->item('config_blog_entries_per_page'), (($pagination_info['page'] - 1) * $this->config->item('config_blog_entries_per_page')));
		$result = $this->db->get('tag');

		if($result->num_rows() > 0)
		{
			$tag_list = $result->result_array();
			return array('tag_list' => $tag_list, 'pagination_info' => $pagination_info);
		}
		else
		{
			return FALSE;
		}
	}

	function delete()
	{
		if($this->input->post('tag_id'))
		{
			foreach($this->input->post('tag_id') as $tag_id)
			{
				$this->db->where('post_tag_tag_id', $tag_id);
				$this->db->delete('post_tag');

				$this->db->where('tag_id', $tag_id);
				$this->db->delete('tag');
			}
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

}