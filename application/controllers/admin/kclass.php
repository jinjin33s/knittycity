<?php

class Kclass extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
		if(!$this->auth->has_right('view_administration') OR !$this->auth->has_right('can_manage_pages'))
		{
			redirect('kclass/overview');
		}
		$this->view->set_design_folder($this->config->item('config_design_folder')."/".'admin');
		$this->load->model('admin/Kclass_model');
	}

	function index()
	{

		$this->overview();
        }

	function overview($page = 1)
	{
		$this->load->library('Pagination');
		$this->load->library('form_validation');
                
		if ($this->form_validation->run('kclass_delete') == TRUE)
		{
			if($this->Kclass_model->delete())
			{
				$this->message_storage->add_session_notice('Class deleted');
			}
			redirect('admin/kclass/overview');
		}

                

                 

		$this->view->add_data('kclass_list', $this->Kclass_model->get_kclass_list($page));

                $this->view->show('Class', 'kclass_overview');

	}

	function add()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '#;#');

		if ($this->form_validation->run('kclass') == FALSE)
		{
                    //log_mesage("debug", "kclass add validation failed");
                    $this->message_storage->add_validation_errors($this->form_validation->error_string());
		}
		else
		{
			$class_id = $this->Kclass_model->add();
			$this->message_storage->add_session_notice('Class added');
			redirect('admin/kclass/edit/'.$class_id);
		}
		$fckeditorConfig = array(
                                        'instanceName' => 'classContent',
                                        'BasePath' => base_url().APPPATH.'plugins/fckeditor/',
                                        'ToolbarSet' => 'Default',
                                        'Width' => '710px',
                                        'Height' => '400',
                                        'Value' => unprep_for_form(set_value('classContent'))
                                        );
		$this->load->library('fckeditor', $fckeditorConfig);
		$this->view->show('Add Class', 'kclass_add');
	}

	function edit($class_id = FALSE)
	{
		if($class_id == FALSE)
		{
			redirect('admin/kclass/overview');
		}
		else
		{
			if($this->Kclass_model->is_valid_kclass($class_id))
			{

				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('', '#;#');
				if ($this->form_validation->run('kclass') == FALSE)
				{
                                    $this->message_storage->add_validation_errors($this->form_validation->error_string());
				}
				else
				{

					$this->Kclass_model->edit($class_id);
					$this->message_storage->add_session_notice('class edited');
					redirect('admin/kclass/edit/'.$class_id);
				}

				$kclass = $this->Kclass_model->get_kclass($class_id);
				$fckeditorConfig = array(
										'instanceName' => 'classContent',
										'BasePath' => base_url().APPPATH.'plugins/fckeditor/',
										'ToolbarSet' => 'Default',
										'Width' => '710px',
										'Height' => '400',
										'Value' => unprep_for_form(set_value('classContent', $kclass['classContent']))
										);
				$this->load->library('fckeditor', $fckeditorConfig);
				$this->view->add_data('kclass', $kclass);
				$this->view->show('Edit class', 'kclass_edit');
			}
			else
			{
				redirect('admin/kclass/overview');
			}
		}
	}

	function sort($direction = 'up', $page_id = FALSE)
	{
		if($page_id == FALSE)
		{
			redirect('admin/kclass/overview');
		}
		else
		{
			if($this->Kclass_model->is_valid_page($class_id))
			{
				switch($direction)
				{
					case 'up':
						$this->Kclass_model->sort($direction, $class_id);
						break;
					case 'down':
						$this->Kclass_model->sort($direction, $class_id);
						break;
					default:
						break;
				}
				redirect('admin/kclass/overview');
			}
			else
			{
				redirect('admin/kclass/overview');
			}
		}
	}
}

/* End of file page.php */
/* Location: ./application/controllers/admin/page.php */