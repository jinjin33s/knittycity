<?php

class System extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
		$this->view->set_design_folder($this->config->item('config_design_folder')."/".'admin');
	}

	function index()
	{
		$this->css();
	}

	function css()
	{
		$this->output->set_header('Content-type:text/css');
		$this->view->set_root_view('system_css');
		$this->view->show();
	}
}

/* End of file system.php */
/* Location: ./application/controllers/admin/system.php */