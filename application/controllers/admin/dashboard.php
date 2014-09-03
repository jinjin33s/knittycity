<?php

class Dashboard extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
		if(!$this->auth->has_right('view_administration'))
		{
			redirect('post/overview');
		}
		//$this->view->set_design_folder($this->config->item('config_design_folder')."/".'admin');
		$this->load->model('admin/Dashboard_model');
	}

	function index()
	{
		//$this->view->set_root_view('index');
		//$this->view->show('Dashboard', 'dashboard_index');
               $this->view->show('Dashboard', 'dashboard');
	}
}

/* End of file system.php */
/* Location: ./application/controllers/admin/dashboad.php */