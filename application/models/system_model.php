<?php
class System_model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function register()
    {
		$this->db->where('user_name', set_value('user_name'));
		$this->db->or_where('user_email', set_value('user_email'));
		$user_count = $this->db->count_all_results('user');
		if($user_count == 0)
		{
			$this->db->set('user_name', set_value('user_name'));
			$this->db->set('user_email', set_value('user_email'));
			$this->db->set('user_password', md5(set_value('user_password')));
			$this->db->insert('user');

			$user_id = $this->db->insert_id();

			$this->db->set('user_group_user_id', $user_id);
			$this->db->set('user_group_group_id', $this->config->item('config_new_user_group_id'));
			$this->db->insert('user_group');

			return TRUE;
		}
		else
		{
			return FALSE;
		}
    }

    function forgotpassword()
    {
    	$this->db->where('user_email', set_value('user_email'));
    	$this->db->from('user');
    	$result = $this->db->get();
		if($result->num_rows() > 0)
		{
			$user = $result->row();
			$this->load->helper('string');
			$key = random_string('alnum', 10);
			$this->db->set('user_confirmation_key', $key);
			$this->db->where('user_id', $user->user_id);
			$this->db->update('user');
			return $this->auth->get_user($user->user_id);
		}
		else
		{
			return FALSE;
		}
    }

    function get_user_by_confirmation_key($user_id, $key)
    {
    	$this->db->where('user_id', $user_id);
    	$this->db->where('user_confirmation_key', $key);
    	$this->db->from('user');
    	$result = $this->db->get();
		if($result->num_rows() > 0)
		{
			return $result->row();
		}
		else
		{
			return FALSE;
		}
    }

    function set_new_password($user_id)
    {
    	$this->load->helper('string');
    	$new_password = random_string('alnum', 10);
    	$this->load->helper('security');
		$this->db->set('user_password', dohash($new_password, 'md5'));
		$this->db->set('user_confirmation_key', '');
		$this->db->where('user_id', $user_id);
		$this->db->update('user');
		return $new_password;
    }
}