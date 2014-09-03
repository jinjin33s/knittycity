<?php
class Kprofile_model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

	function get_kprofile_list($page)
	{
		$total_page_count = $this->db->count_all('kprofile');
		$pagination_info = $this->pagination->get_pagination_info($page, $total_page_count, $this->config->item('config_other_entries_per_page'));

		$this->db->select('*');
		$this->db->select("DATE_FORMAT(profdate, '".$this->config->item('config_small_date_format')."') AS profdate_formatted", FALSE);
		$this->db->from('kprofile');
		$this->db->order_by('profDate', 'desc');
                 $perpage = $this->config->item('config_other_entries_per_page');
                if(empty($perpage) || $perpage == 0) $perpage = 4;
		$this->db->limit($perpage, (($pagination_info['page'] - 1) * $perpage));
                
		$result = $this->db->get();

		if($result->num_rows() > 0)
		{
			$kprofile_list = $result->result_array();
			return array('kprofile_list' => $kprofile_list, 'pagination_info' => $pagination_info);
		}
		else
		{
			return FALSE;
		}
	}

	function add()
	{
		$this->db->set('profTitle', $this->input->post('profTitle'));
		$this->db->set('profContent', $this->input->post('profContent'));
                $this->db->set('profSummary', $this->input->post('profSummary'));
		$this->db->set('profDate',$this->input->post('profDate'));
                $this->db->set('profPicture',$this->input->post('profPicture'));
                
		$this->db->insert('kprofile');
		$prof_id = $this->db->insert_id();

		return $prof_id;
	}

	function edit($prof_id)
	{
           // die("profSummary ".$this->input->post('profSummary'));
		$this->db->set('profTitle', $this->input->post('profTitle'));
		$this->db->set('profContent', $this->input->post('profContent'));
                $this->db->set('profSummary', $this->input->post('profSummary'));
		$this->db->set('profDate',$this->input->post('profDate'));
                $this->db->set('profPicture',$this->input->post('profPicture'));

		$this->db->where('prof_id', $prof_id);
		$this->db->update('kprofile');

		return TRUE;
	}

	function is_valid_kprofile($prof_id)
	{
		$this->db->where('prof_id', $prof_id);
		if($this->db->count_all_results('kprofile') > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}


	function get_kprofile($prof_id)
	{
		$this->db->where('prof_id', $prof_id);
		$result = $this->db->get('kprofile');

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
		if($this->input->post('prof_id'))
		{
			foreach($this->input->post('prof_id') as $prof_id)
			{
				$this->db->where('prof_id', $prof_id);
				$this->db->delete('kprofile');
			}
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function sort($direction, $prof_id)
	{
		$page = $this->get_kprofile($prof_id);
		$next_page = $this->_get_next_page($direction, $kprofile['dateClass']);
		if(is_array($next_page))
		{
			$this->db->set('profDate', $next_page['profDate']);
			$this->db->where('prof_id', $page['prof_id']);
			$this->db->update('kprofile');

			$this->db->set('profDate', $page['profDate']);
			$this->db->where('prof_id', $next_page['prof_id']);
			$this->db->update('kprofile');

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
			$this->db->where("profDate < $order_by");
			$this->db->order_by('profDate', 'desc');
			$this->db->limit(1, 0);
		}
		else
		{
			$this->db->where("profDate > $order_by");
			$this->db->order_by('profDate', 'asc');
			$this->db->limit(1, 0);
		}
		$result = $this->db->get('kprofile');

		if($result->num_rows() == 1)
		{
			return $result->row_array();
		}
		else
		{
			return FALSE;
		}
	}


         function get_kprofile_list_for_home($limit=2)
	{

		$this->db->select('*');
		$this->db->select("DATE_FORMAT(profdate, '".$this->config->item('config_small_date_format')."') AS profdate_formatted", FALSE);
		$this->db->from('kprofile');
		$this->db->order_by('profDate', 'desc');
		$this->db->limit($limit);
		$result = $this->db->get();

		if($result->num_rows() > 0)
		{
			$kprofile_list = $result->result_array();
			return $kprofile_list;
		}
		else
		{
			return FALSE;
		}
	}

}