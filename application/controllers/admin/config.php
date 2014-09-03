<?php

class Config extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
		if(!$this->auth->has_right('view_administration'))
		{
			redirect('post/overview');
		}
		$this->view->set_design_folder($this->config->item('config_design_folder')."/".'admin');
		$this->load->model('admin/Config_model');
	}

	function index()
	{
		$this->edit();
	}

	function edit()
	{
		if($this->auth->has_right('can_edit_config'))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('', '#;#');
			if ($this->form_validation->run('config') == FALSE)
			{
				$this->message_storage->add_validation_errors($this->form_validation->error_string());
			}
			else
			{
				$this->Config_model->edit();
				$this->message_storage->add_session_notice('Config edited');
				redirect('admin/config/edit');
			}
			$this->view->add_data('config', $this->Config_model->get_config());
			$this->view->add_data('group_list', $this->Config_model->get_group_list());
			$this->view->add_data('start_page_list', $this->Config_model->get_start_page_list());
			$this->view->add_data('design_folder_list', $this->Config_model->get_design_folder_list());
			$this->view->add_js('prototype.js');
			$this->view->add_js('effects.js');
			$this->view->add_js('tabr.js');
			$this->view->show('Edit config', 'config_edit');
		}
		else
		{
			redirect('admin/dashboard');
		}
	}
}

/* End of file post.php */
/* Location: ./application/controllers/admin/post.php */