<?php

class Link extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
		if(!$this->auth->has_right('view_administration') OR !$this->auth->has_right('can_manage_links'))
		{
			redirect('post/overview');
		}
		$this->view->set_design_folder($this->config->item('config_design_folder')."/".'admin');
		$this->load->model('admin/Link_model');
	}

	function index()
	{
		$this->overview();
	}

	function overview($page = 1)
	{
		$this->load->library('Pagination');
		$this->load->library('form_validation');
		if ($this->form_validation->run('link_delete') == TRUE)
		{
			if($this->Link_model->delete())
			{
				$this->message_storage->add_session_notice('Links deleted');
			}
			redirect('admin/link/overview');
		}
		$this->view->add_data('link_list', $this->Link_model->get_link_list($page));
		$this->view->show('Links', 'link_overview');
	}

	function add()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '#;#');
		if ($this->form_validation->run('link') == FALSE)
		{
			$this->message_storage->add_validation_errors($this->form_validation->error_string());
		}
		else
		{
			$link_id = $this->Link_model->add();
			$this->message_storage->add_session_notice('Link added');
			redirect('admin/link/edit/'.$link_id);
		}
		$this->view->show('Add link', 'link_add');
	}

	function edit($link_id = FALSE)
	{
		if($link_id == FALSE)
		{
			redirect('admin/link/overview');
		}
		else
		{
			if($this->Link_model->is_valid_link($link_id))
			{
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('', '#;#');
				if ($this->form_validation->run('link') == FALSE)
				{
					$this->message_storage->add_validation_errors($this->form_validation->error_string());
				}
				else
				{
					$this->Link_model->edit($link_id);
					$this->message_storage->add_session_notice('Link edited');
					redirect('admin/link/edit/'.$link_id);
				}
				$this->view->add_data('link', $this->Link_model->get_link($link_id));
				$this->view->show('Edit link', 'link_edit');
			}
			else
			{
				redirect('admin/link/overview');
			}
		}
	}
}

/* End of file page.php */
/* Location: ./application/controllers/admin/page.php */