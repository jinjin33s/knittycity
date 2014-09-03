<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Message_Storage {

	var $errors = array();
	var $notices = array();
	var $messages = array('error' => array(), 'notice' => array());
	var $CI;

	function __construct()
	{
		$this->CI =& get_instance();
	}

    function add_error ($error_text, $plain_text = 1)
    {
    	$error_text = trim($error_text);
    	if($error_text != '')
    	{
    		$this->errors[] = $error_text;
    	}
    }

    function add_notice ($notice_text)
    {
    	$notice_text = trim($notice_text);
    	if($notice_text != '')
    	{
    		$this->notices[] = $notice_text;
    	}
    }

    function get_errors()
    {
    	$session_error = $this->CI->db_session->flashdata('session_error');
    	$errors = $this->errors;
    	if(count($session_error) > 0 AND is_array($session_error))
    	{
    		foreach($session_error as $error)
    		{
	    		$errors[] = $error;
    		}
    	}
    	return $errors;
    }

    function get_notices()
    {
    	$session_notice = $this->CI->db_session->flashdata('session_notice');
    	$notices = $this->notices;
    	if(count($session_notice) > 0 AND is_array($session_notice))
    	{
    		foreach($session_notice as $notice)
    		{
    			$notices[] = $notice;
    		}
    	}
    	return $notices;
    }

    function add_session_error($error_text)
    {
    	$error_text = trim($error_text);
    	if($error_text != '')
    	{
    		$this->CI->db_session->set_flashdata('session_error', $error_text);
    	}
    }

    function add_session_notice($notice_text)
    {
    	$notice_text = trim($notice_text);
    	if($notice_text != '')
    	{
    		$this->CI->db_session->set_flashdata('session_notice', $notice_text);
    	}
    }

    function add_validation_errors ($errors, $flash = FALSE)
    {
		$error_list = explode('#;#',$errors);
		foreach($error_list as $error)
		{
			if($error != '')
			{
				if($flash == FALSE)
				{
					$this->add_error($error);
				}
				else
				{
					$this->add_session_error($error);
				}
			}
		}
    }

    function add_upload_errors ($errors)
    {
		$error_list = explode('<p>',$errors);
		foreach($error_list as $key => $value)
		{
			if($value != '')
			{
				$value = str_replace('</p>','', $value);
				$this->add_error($value);
			}
		}
    }

    function get_error_count()
    {
    	$errors = $this->get_errors();
    	return count($errors);
    }

    function get_notice_count()
    {
    	$notices = $this->get_notices();
    	return count($notices);
    }
}

?>