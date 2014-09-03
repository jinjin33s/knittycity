<?php
class Kclass_model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

	function get_kclass_list($page)
	{
		$total_page_count = $this->db->count_all('kclass');
		$pagination_info = $this->pagination->get_pagination_info($page, $total_page_count, $this->config->item('config_other_entries_per_page'));

		$this->db->select('*');
		$this->db->select("DATE_FORMAT(classdate, '".$this->config->item('config_small_date_format')."') AS classdate_formatted", FALSE);
		$this->db->from('kclass');
		$this->db->order_by('classDate', 'desc');
                $perpage = $this->config->item('config_other_entries_per_page');
                if(empty($perpage) || $perpage == 0) $perpage = 4;
		$this->db->limit($perpage, (($pagination_info['page'] - 1) * $perpage));
		$result = $this->db->get();

		if($result->num_rows() > 0)
		{
			$kclass_list = $result->result_array();
			return array('kclass_list' => $kclass_list, 'pagination_info' => $pagination_info);
		}
		else
		{
			return FALSE;
		}
	}

        function get_kclass_list_by_coming($page)
	{
		$total_page_count = $this->db->count_all('kclass where classdate > SYSDATE()');
		$pagination_info = $this->pagination->get_pagination_info($page, $total_page_count, $this->config->item('config_other_entries_per_page'));

		$this->db->select('*');
		$this->db->select("DATE_FORMAT(classdate, '".$this->config->item('config_small_date_format')."') AS classdate_formatted", FALSE);
		$this->db->from('kclass');
                $this->db->where('classdate >= SYSDATE()');
		$this->db->order_by('classDate', 'asc');
                $perpage = $this->config->item('config_other_entries_per_page');
                if(empty($perpage) || $perpage == 0) $perpage = 4;
		$this->db->limit($perpage, (($pagination_info['page'] - 1) * $perpage));
		$result = $this->db->get();

		if($result->num_rows() > 0)
		{
			$kclass_list = $result->result_array();
			return array('kclass_list' => $kclass_list, 'pagination_info' => $pagination_info);
		}
		else
		{
			return FALSE;
		}
	}

        function get_kclass_list_by_past($page)
	{
		$total_page_count = $this->db->count_all('kclass where classdate < SYSDATE()');
		$pagination_info = $this->pagination->get_pagination_info($page, $total_page_count, $this->config->item('config_other_entries_per_page'));

		$this->db->select('*');
		$this->db->select("DATE_FORMAT(classdate, '".$this->config->item('config_small_date_format')."') AS classdate_formatted", FALSE);
		$this->db->from('kclass');
                $this->db->where('classdate < SYSDATE()');
		$this->db->order_by('classDate', 'desc');
                $perpage = $this->config->item('config_other_entries_per_page');
                if(empty($perpage) || $perpage == 0) $perpage = 4;
		$this->db->limit($perpage, (($pagination_info['page'] - 1) * $perpage));
		$result = $this->db->get();

		if($result->num_rows() > 0)
		{
			$kclass_list = $result->result_array();
			return array('kclass_list' => $kclass_list, 'pagination_info' => $pagination_info);
		}
		else
		{
			return FALSE;
		}
	}
        
        function get_kcalendar_list_by_range($start,$end)
	{
               
		$this->db->select('*');

                $this->db->from('kclass');

                $this->db->where("classdate BETWEEN '$start' and '$end'");

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
		$total_page_count = $this->db->count_all('kcalendar');

                $date = getdate();
                $year = $date['year'];
                $month = $date['mon'];

                $this->db->select('*');
                $this->db->from('kclass');
                $this->db->where("classDate like '$year-$month%'");

                $result = $this->db->get();

		if($result->num_rows() > 0)
		{
			$kcalendar_list = $result->result_array();
			//return array('kclass_list' => $kcalendar_list);
                        return $kcalendar_list;
		}
		else
		{
			return FALSE;
		}
	}

	function add()
	{
		$this->db->set('classTitle', $this->input->post('classTitle'));
		//$this->db->set('classContent', unprep_for_form(set_value('classContent')));
                $this->db->set('classContent', $this->input->post('classContent'));
                $this->db->set('classSummary', $this->input->post('classSummary'));
                
		$this->db->set('classDate',$this->input->post('classDate'));
		$this->db->set('classTime', $this->input->post('classTime'));
                $this->db->set('classEndTime', $this->input->post('classEndTime'));

                $this->db->set('classInstructor', $this->input->post('classInstructor'));
		$this->db->set('classLocation', $this->input->post('classLocation'));
		$this->db->insert('kclass');
		$class_id = $this->db->insert_id();

		return $class_id;
	}

	function edit($class_id)
	{
               
                
		$this->db->set('classTitle', $this->input->post('classTitle'));
		$this->db->set('classContent', $this->input->post('classContent'));
		$this->db->set('classSummary', $this->input->post('classSummary'));
                $this->db->set('classDate',$this->input->post('classDate'));
		$this->db->set('classTime', $this->input->post('classTime'));
                $this->db->set('classEndTime', $this->input->post('classEndTime'));
                $this->db->set('classInstructor', $this->input->post('classInstructor'));
                
		$this->db->set('classLocation', $this->input->post('classLocation'));
		$this->db->where('class_id', $class_id);
		$this->db->update('kclass');

		return TRUE;
	}

	function is_valid_kclass($class_id)
	{
		$this->db->where('class_id', $class_id);
		if($this->db->count_all_results('kclass') > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}


	function get_kclass($class_id)
	{
		$this->db->where('class_id', $class_id);

		$result = $this->db->get('kclass');
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
		if($this->input->post('class_id'))
		{
			foreach($this->input->post('class_id') as $class_id)
			{
				$this->db->where('class_id', $class_id);
				$this->db->delete('kclass');
			}
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function sort($direction, $class_id)
	{
		$page = $this->get_kclass($class_id);
		$next_page = $this->_get_next_page($direction, $kclass['dateClass']);
		if(is_array($next_page))
		{
			$this->db->set('classDate', $next_page['classDate']);
			$this->db->where('class_id', $page['class_id']);
			$this->db->update('kclass');

			$this->db->set('classDate', $page['classDate']);
			$this->db->where('class_id', $next_page['class_id']);
			$this->db->update('kclass');

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
			$this->db->where("classDate < $order_by");
			$this->db->order_by('classDate', 'desc');
			$this->db->limit(1, 0);
		}
		else
		{
			$this->db->where("classDate > $order_by");
			$this->db->order_by('classDate', 'asc');
			$this->db->limit(1, 0);
		}
		$result = $this->db->get('kclass');

		if($result->num_rows() == 1)
		{
			return $result->row_array();
		}
		else
		{
			return FALSE;
		}
	}


        function get_kclass_list_for_home($limit=2)
	{
		$this->db->select('*');
		$this->db->select("DATE_FORMAT(classdate, '".$this->config->item('config_small_date_format')."') AS classdate_formatted", FALSE);
		$this->db->from('kclass');
		$this->db->where('classdate > SYSDATE()');
		$this->db->order_by('classDate', 'asc');
		$this->db->limit($limit);
		$result = $this->db->get();

		if($result->num_rows() > 0)
		{
			$kclass_list = $result->result_array();
			return $kclass_list;
		}
		else
		{
			return FALSE;
		}
	}

}