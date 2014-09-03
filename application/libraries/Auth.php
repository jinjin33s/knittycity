<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth
{

	var $user = FALSE;
	var $rights = FALSE;
	var $CI;

    function __construct()
    {
    	$this->CI =& get_instance();
    	$this->refresh();
    }

    function is_logged_in()
    {
    	return is_array($this->user);
    }

    function refresh ()
    {
		$user = $this->CI->db_session->userdata('user');
		if($user != FALSE)
		{
			$this->user = $this->get_user($user['user_id']);
		}
		$this->_get_rights($this->get_user_id());
    }

    function login($username, $password)
    {
    	$this->CI->db->where('user_name', $username);
    	$this->CI->db->where('user_password', md5($password));
    	$result = $this->CI->db->get('user');

    	if($result->num_rows() == 1)
    	{
    		$this->user = $result->row_array();
    		$this->CI->db_session->set_userdata('user', $this->user['user_id']);
    	}
    	return $this->is_logged_in();
    }

    function logout()
    {
		$this->user = FALSE;
		$this->CI->db_session->unset_userdata('user');
		return TRUE;
    }

    function get_user_name()
    {
    	if($this->is_logged_in())
    	{
			return $this->user['user_name'];
    	}
    	else
    	{
    		return FALSE;
    	}
    }

    function get_user_id()
    {
    	if($this->is_logged_in())
    	{
			return $this->user['user_id'];
    	}
    	else
    	{
    		return FALSE;
    	}
    }

    function get_user($user_id = '')
    {
    	if($this->is_logged_in() AND $user_id == '')
    	{
			$user_id = $this->get_user_id();
    	}
		$this->CI->db->where('user_id', $user_id);
		$result = $this->CI->db->get('user');
		return $result->row_array();
    }

    function _get_rights($user_id = FALSE)
    {
    	if($this->is_logged_in())
    	{
	    	$this->CI->db->distinct();
	    	$this->CI->db->where('user_group_user_id', $user_id);
	    	$this->CI->db->from('user_group');
	    	$this->CI->db->join('group_right', 'group_right_group_id = user_group_group_id');
	    	$this->CI->db->join('right', 'right_id = group_right_right_id');
    	}
    	else
    	{
    		$this->CI->db->distinct();
    		$this->CI->db->from('config');
    		$this->CI->db->join('group_right', 'config_not_logged_in_user_group_id = group_right_group_id');
    		$this->CI->db->join('right', 'right_id = group_right_right_id');
    	}
    	$result = $this->CI->db->get();
    	if($result->num_rows() > 0)
    	{
    		$this->rights = array();
			foreach($result->result_array() as $right)
			{
				$this->rights[$right['right_name']] = TRUE;
			}
    	}
    	else
    	{
    		$this->rights = FALSE;
    	}
    }

    function has_right($right)
    {
 		if($this->rights == FALSE)
 		{
 			return FALSE;
 		}
 		else
 		{
 			if(is_array($right))
 			{
				foreach($right as $value)
				{
					if(isset($this->rights[$value]))
					{
						return TRUE;
					}
				}
 			}
 			else
 			{
 				return isset($this->rights[$right]);
 			}
 		}
    }
}

?>