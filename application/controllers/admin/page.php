<?php

class Page extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
		if(!$this->auth->has_right('view_administration') OR !$this->auth->has_right('can_manage_pages'))
		{
			redirect('post/overview');
		}
		$this->view->set_design_folder($this->config->item('config_design_folder')."/".'admin');
		$this->load->model('admin/Page_model');
	}

	function index()
	{
		$this->overview();
	}

	function overview($page = 1)
	{
		$this->load->library('Pagination');
		$this->load->library('form_validation');
		if ($this->form_validation->run('page_delete') == TRUE)
		{
			if($this->Page_model->delete())
			{
				$this->message_storage->add_session_notice('Pages deleted');
			}
			redirect('admin/page/overview');
		}
		$this->view->add_data('page_list', $this->Page_model->get_page_list($page));
		$this->view->show('Pages', 'page_overview');
	}

	function add()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '#;#');
		if ($this->form_validation->run('page') == FALSE)
		{
			$this->message_storage->add_validation_errors($this->form_validation->error_string());
		}
		else
		{
			$post_id = $this->Page_model->add();
			$this->message_storage->add_session_notice('Page added');
			redirect('admin/page/edit/'.$post_id);
		}
		$fckeditorConfig = array(
								'instanceName' => 'page_content',
								'BasePath' => base_url().APPPATH.'plugins/fckeditor/',
								'ToolbarSet' => 'Default',
								'Width' => '710px',
								'Height' => '400',
								'Value' => unprep_for_form(set_value('page_content'))
								);
		$this->load->library('fckeditor', $fckeditorConfig);
		$this->view->show('Add page', 'page_add');
	}

	function edit($page_id = FALSE)
	{
		if($page_id == FALSE)
		{
			redirect('admin/page/overview');
		}
		else
		{
			if($this->Page_model->is_valid_page($page_id))
			{
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('', '#;#');
				if ($this->form_validation->run('page') == FALSE)
				{
					$this->message_storage->add_validation_errors($this->form_validation->error_string());
				}
				else
				{
					$this->Page_model->edit($page_id);
					$this->message_storage->add_session_notice('Page edited');
					redirect('admin/page/edit/'.$page_id);
				}
				$page = $this->Page_model->get_page($page_id);
				$fckeditorConfig = array(
										'instanceName' => 'page_content',
										'BasePath' => base_url().APPPATH.'plugins/fckeditor/',
										'ToolbarSet' => 'Default',
										'Width' => '710px',
										'Height' => '400',
										'Value' => unprep_for_form(set_value('page_content', $page['page_content']))
										);
				$this->load->library('fckeditor', $fckeditorConfig);
				$this->view->add_data('page', $page);
				$this->view->show('Edit page', 'page_edit');
			}
			else
			{
				redirect('admin/post/overview');
			}
		}
	}

	function sort($direction = 'up', $page_id = FALSE)
	{
		if($page_id == FALSE)
		{
			redirect('admin/page/overview');
		}
		else
		{
			if($this->Page_model->is_valid_page($page_id))
			{
				switch($direction)
				{
					case 'up':
						$this->Page_model->sort($direction, $page_id);
						break;
					case 'down':
						$this->Page_model->sort($direction, $page_id);
						break;
					default:
						break;
				}
				redirect('admin/page/overview');
			}
			else
			{
				redirect('admin/page/overview');
			}
		}
	}
}

/* End of file page.php */
/* Location: ./application/controllers/admin/page.php */