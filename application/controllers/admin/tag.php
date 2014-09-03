<?php

class Tag extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
		if(!$this->auth->has_right('view_administration') OR !$this->auth->has_right('can_manage_tags'))
		{
			redirect('post/overview');
		}
		$this->view->set_design_folder($this->config->item('config_design_folder')."/".'admin');
		$this->load->model('admin/Tag_model');
	}

	function index()
	{
		$this->overview();
	}

	function overview($page = 1)
	{
		$this->load->library('Pagination');
		$this->load->library('form_validation');
		if ($this->form_validation->run('tag_delete') == TRUE)
		{
			if($this->Tag_model->delete())
			{
				$this->message_storage->add_session_notice('Tags deleted');
			}
			redirect('admin/tag/overview');
		}
		$this->view->add_data('tag_list', $this->Tag_model->get_tag_list($page));
		$this->view->show('Tags', 'tag_overview');
	}
}

/* End of file tag.php */
/* Location: ./application/controllers/admin/tag.php */