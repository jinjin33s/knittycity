<?php

class Kprofile extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
		if(!$this->auth->has_right('view_administration') OR !$this->auth->has_right('can_manage_pages'))
		{
			redirect('kprofile/overview');
		}
		$this->view->set_design_folder($this->config->item('config_design_folder')."/".'admin');
		$this->load->model('admin/kprofile_model');
	}

	function index()
	{
            $this->overview();
        }

	function overview($page = 1)
	{
		$this->load->library('Pagination');
		$this->load->library('form_validation');

		if ($this->form_validation->run('kprofile_delete') == TRUE)
		{
			if($this->kprofile_model->delete())
			{
				$this->message_storage->add_session_notice('prof deleted');
			}
			redirect('admin/kprofile/overview');
		}
		$this->view->add_data('kprofile_list', $this->kprofile_model->get_kprofile_list($page));

                $this->view->show('kprofile', 'kprofile_overview');

	}

	function add()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '#;#');

		if ($this->form_validation->run('kprofile') == FALSE)
		{
                    //log_mesage("debug", "kprofile add validation failed");
                    $this->message_storage->add_validation_errors($this->form_validation->error_string());
		}
		else
		{
			$prof_id = $this->kprofile_model->add();
			$this->message_storage->add_session_notice('prof added');
			redirect('admin/kprofile/edit/'.$prof_id);
		}
		$fckeditorConfig = array(
                                        'instanceName' => 'profContent',
                                        'BasePath' => base_url().APPPATH.'plugins/fckeditor/',
                                        'ToolbarSet' => 'Default',
                                        'Width' => '710px',
                                        'Height' => '400',
                                        'Value' => unprep_for_form(set_value('profContent'))
                                        );
		$this->load->library('fckeditor', $fckeditorConfig);
		$this->view->show('Add prof', 'kprofile_add');
	}

	function edit($prof_id = FALSE)
	{
		if($prof_id == FALSE)
		{
			redirect('admin/kprofile/overview');
		}
		else
		{
			if($this->kprofile_model->is_valid_kprofile($prof_id))
			{

				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('', '#;#');
				if ($this->form_validation->run('kprofile') == FALSE)
				{
                                    $this->message_storage->add_validation_errors($this->form_validation->error_string());
				}
				else
				{

					$this->kprofile_model->edit($prof_id);
					$this->message_storage->add_session_notice('prof edited');
					redirect('admin/kprofile/edit/'.$prof_id);
				}

				$kprofile = $this->kprofile_model->get_kprofile($prof_id);
				$fckeditorConfig = array(
										'instanceName' => 'profContent',
										'BasePath' => base_url().APPPATH.'plugins/fckeditor/',
										'ToolbarSet' => 'Default',
										'Width' => '710px',
										'Height' => '400',
										'Value' => unprep_for_form(set_value('profContent', $kprofile['profContent']))
										);
				$this->load->library('fckeditor', $fckeditorConfig);
				$this->view->add_data('kprofile', $kprofile);
				$this->view->show('Edit prof', 'kprofile_edit');
			}
			else
			{
				redirect('admin/kprofile/overview');
			}
		}
	}

	function sort($direction = 'up', $page_id = FALSE)
	{
		if($page_id == FALSE)
		{
			redirect('admin/kprofile/overview');
		}
		else
		{
			if($this->kprofile_model->is_valid_page($prof_id))
			{
				switch($direction)
				{
					case 'up':
						$this->kprofile_model->sort($direction, $prof_id);
						break;
					case 'down':
						$this->kprofile_model->sort($direction, $prof_id);
						break;
					default:
						break;
				}
				redirect('admin/kprofile/overview');
			}
			else
			{
				redirect('admin/kprofile/overview');
			}
		}
	}
}

/* End of file page.php */
/* Location: ./application/controllers/admin/page.php */