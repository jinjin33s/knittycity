<?php

class Module extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
		if(!$this->auth->is_logged_in())
		{
			redirect('post/overview');
		}
		$this->view->set_design_folder($this->config->item('config_design_folder')."/".'admin');
		$this->load->model('admin/Module_model');
	}

	function index()
	{
		$this->overview();
	}

	function overview($page = 1)
	{
		if(!$this->auth->has_right('view_administration') OR !$this->auth->has_right('can_manage_modules'))
		{
			redirect('post/overview');
		}
		else
		{
			$this->load->library('Pagination');
			$this->load->library('form_validation');
			$this->view->add_data('module_list', $this->Module_model->get_module_list($page));
			$this->view->show('Modules', 'module_overview');
		}
	}

	function deactivate($module_id = FALSE)
	{
		if($module_id == FALSE)
		{
			redirect('admin/module/overview');
		}
		else
		{
			if($this->Module_model->is_valid_module($module_id))
			{
				$this->Module_model->deactivate($module_id);
				redirect('admin/module/overview');
			}
			else
			{
				redirect('admin/module/overview');
			}
		}
	}

	function activate($module_id = FALSE)
	{
		if($module_id == FALSE)
		{
			redirect('admin/module/overview');
		}
		else
		{
			if($this->Module_model->is_valid_module($module_id))
			{
				$this->Module_model->activate($module_id);
				redirect('admin/module/overview');
			}
			else
			{
				redirect('admin/module/overview');
			}
		}
	}
}

/* End of file module.php */
/* Location: ./application/controllers/admin/module.php */