<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_config extends CI_config
{

	var $CI;

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function base_url($uri = '')
    {
        if (is_array($uri))
        {
            $uri = implode('/', $uri);
        }

        if ($uri == '')
        {
            return $this->slash_item('base_url');
        }
        else
        {
            return $this->slash_item('base_url').$uri;
        }
    }
}