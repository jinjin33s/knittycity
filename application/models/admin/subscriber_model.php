<?php
class Subscriber_model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

	function get_subscriber_list($page)
	{
		$total_page_count = $this->db->count_all('subscriber');
		$pagination_info = $this->pagination->get_pagination_info($page, $total_page_count, $this->config->item('config_other_entries_per_page'));

		$this->db->select('*');
		$this->db->select("DATE_FORMAT(regdate, '".$this->config->item('config_small_date_format')."') AS regdate_formatted", FALSE);
		$this->db->from('subscriber');
		$this->db->order_by('regdate', 'desc');
		
                  if(empty($perpage) || $perpage == 0) $perpage = 4;
		$this->db->limit($perpage, (($pagination_info['page'] - 1) * $perpage));
                //$this->db->limit($this->config->item('config_other_entries_per_page'), (($pagination_info['page'] - 1) * $this->config->item('config_other_entries_per_page')));

                $result = $this->db->get();

		if($result->num_rows() > 0)
		{
			$subscriber_list = $result->result_array();
			return array('subscriber_list' => $subscriber_list, 'pagination_info' => $pagination_info);
		}
		else
		{
			return FALSE;
		}
	}


	function add()
	{
		$this->db->set('firstName', set_value('firstName'));
		$this->db->set('lastName', set_value('lastName'));
        $this->db->set('regDate', set_value('regDate'));
		$this->db->set('email', set_value('email'));            
				
		$this->db->insert('subscriber');
		$subscriber_id = $this->db->insert_id();

		return $subscriber_id;
	}

	function addajax()
	{	
		$regDate = date("Y-m-d"); 

		$this->db->set('firstName', set_value('firstName'));
		$this->db->set('lastName', set_value('lastName'));
        $this->db->set('regDate', $regDate);
		$this->db->set('email', set_value('email'));                 
		
		$this->db->insert('subscriber');
		$subscriber_id = $this->db->insert_id();

		if($subscriber_id > 0){
			return "Successfully Registered!";
		}
	}
	
	function edit($subscriber_id)
	{
		$this->db->set('firstName', set_value('firstName'));
		$this->db->set('lastName', set_value('lastName'));
        $this->db->set('regDate', set_value('regDate'));
		$this->db->set('email', set_value('email'));            

		$this->db->where('subscriber_id', $subscriber_id);
		$this->db->update('subscriber');

		return TRUE;
	}

	function is_valid_subscriber($subscriber_id)
	{
		$this->db->where('subscriber_id', $subscriber_id);
		if($this->db->count_all_results('subscriber') > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}


	function get_subscriber($subscriber_id)
	{
		$this->db->where('subscriber_id', $subscriber_id);
		$result = $this->db->get('subscriber');

		if($result->num_rows() > 0)
		{
			return $result->row_array();
		}
		else
		{
			return FALSE;
		}
	}

	function delete()
	{
		if($this->input->post('subscriber_id'))
		{
			foreach($this->input->post('subscriber_id') as $subscriber_id)
			{
				$this->db->where('subscriber_id', $subscriber_id);
				$this->db->delete('subscriber');
			}
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function sort($direction, $subscriber_id)
	{
		$page = $this->get_subscriber($subscriber_id);
		$next_page = $this->_get_next_page($direction, $subscriber['regDate']);
		if(is_array($next_page))
		{
			$this->db->set('regDate', $next_page['regDate']);
			$this->db->where('subscriber_id', $page['subscriber_id']);
			$this->db->update('subscriber');

			$this->db->set('regDate', $page['regDate']);
			$this->db->where('subscriber_id', $next_page['subscriber_id']);
			$this->db->update('subscriber');

			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function _get_next_page($direction, $order_by)
	{
		if($direction == 'up')
		{
			$this->db->where("regDate < $order_by");
			$this->db->order_by('regDate', 'desc');
			$this->db->limit(1, 0);
		}
		else
		{
			$this->db->where("regDate > $order_by");
			$this->db->order_by('regDate', 'asc');
			$this->db->limit(1, 0);
		}
		$result = $this->db->get('subscriber');

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