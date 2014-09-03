<?php
class Kevent_model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

	function get_kevent_list($page)
	{
		$total_page_count = $this->db->count_all('kevent');
		$pagination_info = $this->pagination->get_pagination_info($page, $total_page_count, $this->config->item('config_other_entries_per_page'));

		$this->db->select('*');
		$this->db->select("DATE_FORMAT(eventdate, '".$this->config->item('config_small_date_format')."') AS eventdate_formatted", FALSE);
		$this->db->from('kevent');
		$this->db->order_by('eventDate', 'desc');
                $perpage = $this->config->item('config_other_entries_per_page');
                if(empty($perpage) || $perpage == 0) $perpage = 4;
		$this->db->limit($perpage, (($pagination_info['page'] - 1) * $perpage));
		$result = $this->db->get();

		if($result->num_rows() > 0)
		{
			$kevent_list = $result->result_array();
			return array('kevent_list' => $kevent_list, 'pagination_info' => $pagination_info);
		}
		else
		{
			return FALSE;
		}
	}

        function get_kevent_list_by_coming($page)
	{
		$total_page_count = $this->db->count_all('kevent where eventdate > SYSDATE()');
		$pagination_info = $this->pagination->get_pagination_info($page, $total_page_count, $this->config->item('config_other_entries_per_page'));

		$this->db->select('*');
		$this->db->select("DATE_FORMAT(eventdate, '".$this->config->item('config_small_date_format')."') AS eventdate_formatted", FALSE);
		$this->db->from('kevent');
                $this->db->where('eventDate >= SYSDATE()');
		$this->db->order_by('eventDate', 'asc');
                $perpage = $this->config->item('config_other_entries_per_page');
                if(empty($perpage) || $perpage == 0) $perpage = 4;
		$this->db->limit($perpage, (($pagination_info['page'] - 1) * $perpage));
		$result = $this->db->get();

		if($result->num_rows() > 0)
		{
			$kevent_list = $result->result_array();
			return array('kevent_list' => $kevent_list, 'pagination_info' => $pagination_info);
		}
		else
		{
			return FALSE;
		}
	}

        function get_kevent_list_by_past($page)
	{
		$total_page_count = $this->db->count_all('kevent where eventdate < SYSDATE()');
		$pagination_info = $this->pagination->get_pagination_info($page, $total_page_count, $this->config->item('config_other_entries_per_page'));

		$this->db->select('*');
		$this->db->select("DATE_FORMAT(eventdate, '".$this->config->item('config_small_date_format')."') AS eventdate_formatted", FALSE);
		$this->db->from('kevent');
                $this->db->where('eventDate < SYSDATE()');
		$this->db->order_by('eventDate', 'desc');
                $perpage = $this->config->item('config_other_entries_per_page');
                if(empty($perpage) || $perpage == 0) $perpage = 4;
		$this->db->limit($perpage, (($pagination_info['page'] - 1) * $perpage));
		$result = $this->db->get();

		if($result->num_rows() > 0)
		{
			$kevent_list = $result->result_array();
			return array('kevent_list' => $kevent_list, 'pagination_info' => $pagination_info);
		}
		else
		{
			return FALSE;
		}
	}

         function get_kcalendar_list_by_range($start,$end)
	{
		
                $this->db->select('*');

                $this->db->from('kevent');

                $this->db->where("eventDate BETWEEN '$start' and '$end'");

                $result = $this->db->get();

		if($result->num_rows() > 0)
		{
			$kcalendar_list = $result->result_array();

                        return $kcalendar_list;
		}
		else
		{
			return  false;
		}
	}

        function get_kcalendar_list_by_month($month)
	{
		$total_page_count = $this->db->count_all('kevent');

                $date = getdate();
                $year = $date['year'];
                $month = $date['mon'];

                $this->db->select('*');
                $this->db->from('kevent');
                $this->db->where("eventDate like '$year-$month%'");

                $result = $this->db->get();

		if($result->num_rows() > 0)
		{
			$kcalendar_list = $result->result_array();
			//return array('kevent_list' => $kcalendar_list);
                        return $kcalendar_list;
		}
		else
		{
			return FALSE;
		}
	}

	function add()
	{
		$this->db->set('eventTitle', $this->input->post('eventTitle'));

		$this->db->set('eventSummary', $this->input->post('eventSummary'));
                
                $this->db->set('eventContent', $this->input->post('eventContent'));
		$this->db->set('eventDate',$this->input->post('eventDate'));
		$this->db->set('eventTime', $this->input->post('eventTime'));

                $this->db->set('eventEndDate', $this->input->post('eventEndDate'));
		$this->db->set('eventEndTime', $this->input->post('eventEndTime'));

		$this->db->set('eventLocation', $this->input->post('eventLocation'));
		$this->db->insert('kevent');
		$event_id = $this->db->insert_id();
                
		return $event_id;
	}

	function edit($event_id)
	{
		$this->db->set('eventTitle', $this->input->post('eventTitle'));
		$this->db->set('eventSummary', $this->input->post('eventSummary'));

                $this->db->set('eventContent', $this->input->post('eventContent'));
		$this->db->set('eventDate',$this->input->post('eventDate'));
		$this->db->set('eventTime', $this->input->post('eventTime'));

                $this->db->set('eventEndDate', $this->input->post('eventEndDate'));
		$this->db->set('eventEndTime', $this->input->post('eventEndTime'));

		$this->db->set('eventLocation', $this->input->post('eventLocation'));
		$this->db->where('event_id', $event_id);
		$this->db->update('kevent');
                
		return TRUE;
	}

	function is_valid_kevent($event_id)
	{
		$this->db->where('event_id', $event_id);
		if($this->db->count_all_results('kevent') > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}


	function get_kevent($event_id)
	{
		$this->db->where('event_id', $event_id);
		$result = $this->db->get('kevent');

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
		if($this->input->post('event_id'))
		{
			foreach($this->input->post('event_id') as $event_id)
			{
				$this->db->where('event_id', $event_id);
				$this->db->delete('kevent');
			}
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function sort($direction, $event_id)
	{
		$page = $this->get_kevent($event_id);
		$next_page = $this->_get_next_page($direction, $kevent['dateevent']);
		if(is_array($next_page))
		{
			$this->db->set('eventDate', $next_page['eventDate']);
			$this->db->where('event_id', $page['event_id']);
			$this->db->update('kevent');

			$this->db->set('eventDate', $page['eventDate']);
			$this->db->where('event_id', $next_page['event_id']);
			$this->db->update('kevent');

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
			$this->db->where("eventDate < $order_by");
			$this->db->order_by('eventDate', 'desc');
			$this->db->limit(1, 0);
		}
		else
		{
			$this->db->where("eventDate > $order_by");
			$this->db->order_by('eventDate', 'asc');
			$this->db->limit(1, 0);
		}
		$result = $this->db->get('kevent');

		if($result->num_rows() == 1)
		{
			return $result->row_array();
		}
		else
		{
			return FALSE;
		}
	}

        function get_kevent_list_for_home($limit=2)
	{


                $this->db->select('*');
		$this->db->select("DATE_FORMAT(eventdate, '".$this->config->item('config_small_date_format')."') AS eventdate_formatted", FALSE);
		$this->db->from('kevent');
		$this->db->where('eventDate > SYSDATE()');
		$this->db->order_by('eventDate', 'asc');
		$this->db->limit($limit);
		$result = $this->db->get();

		if($result->num_rows() > 0)
		{
			$kevent_list = $result->result_array();
			return $kevent_list;
		}
		else
		{
			return FALSE;
		}
	}

}