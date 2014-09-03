<?php
class Kcalendar_model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

	function get_kcalendar_list($page)
	{
		$total_page_count = $this->db->count_all('kcalendar');

		$pagination_info = $this->pagination->get_pagination_info($page, $total_page_count, $this->config->item('config_other_entries_per_page'));
//query make here
		$this->db->select('*');
		$this->db->select("DATE_FORMAT(calendardate, '".$this->config->item('config_small_date_format')."') AS calendardate_formatted", FALSE);
		$this->db->from('kcalendar');
		$this->db->order_by('calendarDate', 'desc');

                if(empty($perpage) || $perpage == 0) $perpage = 4;

                $this->db->limit($perpage, (($pagination_info['page'] - 1) * $perpage));

		//$this->db->limit($this->config->item('config_other_entries_per_page'), (($pagination_info['page'] - 1) * $this->config->item('config_other_entries_per_page')));
		
                $result = $this->db->get();

		if($result->num_rows() > 0)
		{
			$kcalendar_list = $result->result_array();

                        return array('kcalendar_list' => $kcalendar_list, 'pagination_info' => $pagination_info);
		}
		else
		{
			return FALSE;
		}
	}

        function get_kcalendar_list_by_month($month)
	{
		$total_page_count = $this->db->count_all('kcalendar');
/*
                $this->db->select('*');
		$this->db->select("DATE_FORMAT(calendardate, '".$this->config->item('config_small_date_format')."') AS calendardate_formatted", FALSE);
		$this->db->from('kcalendar');
		$this->db->order_by('calendarDate', 'desc');
 */
                $date = getdate();

                $year = $date['year'];

                $month = $date['mon'];

                $this->db->select('*');

                $this->db->from('kcalendar');

                $this->db->where("calendarDate like '$year-$month%'");

                $result = $this->db->get();

		if($result->num_rows() > 0)
		{
			$kcalendar_list = $result->result_array();
			
                        //return array('kcalendar_list' => $kcalendar_list);
                        
                        return $kcalendar_list;
		}
		else
		{
			return  false;
		}
	}

         function get_kcalendar_list_by_range($start,$end)
	{
		
                $this->db->select('*');

                $this->db->from('kcalendar');

                $this->db->where("calendarDate BETWEEN '$start' and '$end'");

                
                
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



	function add()
	{
		$this->db->set('calendarTitle', $this->input->post('calendarTitle'));
		$this->db->set('calendarSummary', $this->input->post('calendarSummary'));

                $this->db->set('calendarContent', $this->input->post('calendarContent'));
		$this->db->set('calendarDate',$this->input->post('calendarDate'));
		$this->db->set('calendarTime', $this->input->post('calendarTime'));

                $this->db->set('calendarEndDate', $this->input->post('calendarEndDate'));
		$this->db->set('calendarEndTime', $this->input->post('calendarEndTime'));

		$this->db->set('calendarLocation', $this->input->post('calendarLocation'));
		$this->db->insert('kcalendar');
		$calendar_id = $this->db->insert_id();

		return $calendar_id;
	}

	function edit($calendar_id)
	{
		$this->db->set('calendarTitle', $this->input->post('calendarTitle'));
		$this->db->set('calendarSummary', $this->input->post('calendarSummary'));

                $this->db->set('calendarContent', $this->input->post('calendarContent'));
		$this->db->set('calendarDate',$this->input->post('calendarDate'));
		$this->db->set('calendarTime', $this->input->post('calendarTime'));

                $this->db->set('calendarEndDate', $this->input->post('calendarEndDate'));
		$this->db->set('calendarEndTime', $this->input->post('calendarEndTime'));

		$this->db->set('calendarLocation', $this->input->post('calendarLocation'));

		$this->db->where('calendar_id', $calendar_id);

                $this->db->update('kcalendar');

		return TRUE;
	}

	function is_valid_kcalendar($calendar_id)
	{
		$this->db->where('calendar_id', $calendar_id);
		if($this->db->count_all_results('kcalendar') > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}


	function get_kcalendar($calendar_id)
	{
		$this->db->where('calendar_id', $calendar_id);
		$result = $this->db->get('kcalendar');

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
		if($this->input->post('calendar_id'))
		{
			foreach($this->input->post('calendar_id') as $calendar_id)
			{
				$this->db->where('calendar_id', $calendar_id);
				$this->db->delete('kcalendar');
			}
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function sort($direction, $calendar_id)
	{
		$page = $this->get_kcalendar($calendar_id);
		$next_page = $this->_get_next_page($direction, $kcalendar['datecalendar']);
		if(is_array($next_page))
		{
			$this->db->set('calendarDate', $next_page['calendarDate']);
			$this->db->where('calendar_id', $page['calendar_id']);
			$this->db->update('kcalendar');

			$this->db->set('calendarDate', $page['calendarDate']);
			$this->db->where('calendar_id', $next_page['calendar_id']);
			$this->db->update('kcalendar');

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
			$this->db->where("calendarDate < $order_by");
			$this->db->order_by('calendarDate', 'desc');
			$this->db->limit(1, 0);
		}
		else
		{
			$this->db->where("calendarDate > $order_by");
			$this->db->order_by('calendarDate', 'asc');
			$this->db->limit(1, 0);
		}
		$result = $this->db->get('kcalendar');

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