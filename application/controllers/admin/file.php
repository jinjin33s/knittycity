<?php

class File extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
		if(!$this->auth->has_right('view_administration') OR !$this->auth->has_right('can_manage_files'))
		{
			redirect('post/overview');
		}
		$this->view->set_design_folder($this->config->item('config_design_folder')."/".'admin');
		$this->load->model('admin/File_model');
	}

	function index()
	{
		$this->overview();
	}

	function overview($page = 1)
	{
		$this->load->library('Pagination');
		$this->load->library('form_validation');
		if ($this->form_validation->run('file_delete') == TRUE)
		{
			if($this->File_model->delete())
			{
				$this->message_storage->add_session_notice('Files deleted');
			}
			redirect('admin/file/overview');
		}
		$this->view->add_data('file_list', $this->File_model->get_file_list($page));
		$this->view->show('Files', 'file_overview');
	}

	function add()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '#;#');
		if ($this->form_validation->run('file') == FALSE)
		{
			$this->message_storage->add_validation_errors($this->form_validation->error_string());
		}
		else
		{
			$file_id = $this->File_model->add();
			$this->message_storage->add_session_notice('File added');
			redirect('admin/file/edit/'.$file_id);
		}
		$fckeditorConfig = array(
								'instanceName' => 'file_description',
								'BasePath' => base_url().APPPATH.'plugins/fckeditor/',
								'ToolbarSet' => 'Default',
								'Width' => '710px',
								'Height' => '400',
								'Value' => unprep_for_form(set_value('file_description'))
								);
		$this->load->library('fckeditor', $fckeditorConfig);
		$this->view->show('Add file', 'file_add');
	}

	function edit($file_id = FALSE)
	{
		if($file_id == FALSE)
		{
			redirect('admin/file/overview');
		}
		else
		{
			if($this->File_model->is_valid_file($file_id))
			{
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('', '#;#');
				if ($this->form_validation->run('file') == FALSE)
				{
					$this->message_storage->add_validation_errors($this->form_validation->error_string());
				}
				else
				{
					$this->File_model->edit($file_id);
					$this->message_storage->add_session_notice('File edited');
					redirect('admin/file/edit/'.$file_id);
				}
				$file = $this->File_model->get_file($file_id);
				$fckeditorConfig = array(
										'instanceName' => 'file_description',
										'BasePath' => base_url().APPPATH.'plugins/fckeditor/',
										'ToolbarSet' => 'Default',
										'Width' => '710px',
										'Height' => '400',
										'Value' => unprep_for_form(set_value('file_description', $file['file_description']))
										);
				$this->load->library('fckeditor', $fckeditorConfig);
				$this->view->add_data('file', $file);
				$this->view->show('Edit file', 'file_edit');
			}
			else
			{
				redirect('admin/file/overview');
			}
		}
	}
}

/* End of file file.php */
/* Location: ./application/controllers/admin/file.php */