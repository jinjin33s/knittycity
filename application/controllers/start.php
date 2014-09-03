<?php

class Start extends MY_Controler {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		redirect($this->config->item('config_start_page'));
	}
}

/* End of file start.php */
/* Location: ./application/controllers/start.php */