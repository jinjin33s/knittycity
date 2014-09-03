<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class DB_config
{

	var $CI;

    function __construct()
    {
    	$this->CI =& get_instance();
		$this->set_db_config();
    }

    function set_db_config()
    {
		$result = $this->CI->db->get('config');
    	foreach($result->row_array() as $key => $value)
    	{
    		$this->CI->config->set_item($key, $value);
    	}
    }
}