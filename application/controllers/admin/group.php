<?php

class Group extends Controller {

	function __construct()
	{
		parent::__construct();
		if(!$this->auth->has_right('view_administration'))
		{
			redirect('post/overview');
		}
		$this->view->set_design_folder($this->config->item('config_design_folder')."/".'admin');
		$this->load->model('admin/Group_model');
	}

	function index()
	{
		$this->overview();
	}

	function overview($page = 1)
	{
		$this->load->library('Pagination');
		$this->load->library('form_validation');
		$this->load->helper('html');
		if ($this->form_validation->run('group_delete') == TRUE)
		{
			if($this->Group_model->delete())
			{
				$this->message_storage->add_session_notice('Groups deleted');
			}
			redirect('admin/group/overview');
		}
		$this->view->add_data('group_list', $this->Group_model->get_group_list($page));
		$this->view->show('Groups', 'group_overview');
	}

	function edit($group_id = FALSE)
	{
		if($group_id == FALSE)
		{
			redirect('admin/group/overview');
		}
		else
		{
			if($this->Group_model->is_valid_group($group_id))
			{
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('', '#;#');
				if ($this->form_validation->run('group') == FALSE)
				{
					$this->message_storage->add_validation_errors($this->form_validation->error_string());
				}
				else
				{
					$this->Group_model->edit($group_id);
					$this->message_storage->add_session_notice('Group edited');
					redirect('admin/group/edit/'.$group_id);
				}
				$this->view->add_data('group', $this->Group_model->get_group($group_id));
				$this->view->add_data('right_list', $this->Group_model->get_right_list());
				$this->view->show('Edit group', 'group_edit');
			}
			else
			{
				redirect('admin/group/overview');
			}
		}
	}

	function add()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '#;#');
		if ($this->form_validation->run('group') == FALSE)
		{
			$this->message_storage->add_validation_errors($this->form_validation->error_string());
		}
		else
		{
			$group_id = $this->Group_model->add();
			$this->message_storage->add_session_notice('Group added');
			redirect('admin/group/edit/'.$group_id);
		}
		$this->view->add_data('right_list', $this->Group_model->get_right_list());
		$this->view->show('Add group', 'group_add');
	}
}

/* End of file category.php */
/* Location: ./application/controllers/admin/category.php */