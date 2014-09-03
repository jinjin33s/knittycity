<?php

class Kcalendar extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
                if(!$this->auth->has_right('view_administration') OR !$this->auth->has_right('can_manage_pages'))
		{
			redirect('kcalendar/overview');
		}		
                $this->view->set_design_folder($this->config->item('config_design_folder')."/".'admin');
		$this->load->model('admin/kcalendar_model');
	}

	function index()
	{

		$this->overview();
        }

	function overview($page = 1)
	{
		$this->load->library('Pagination');
		$this->load->library('form_validation');

		if ($this->form_validation->run('kcalendar_delete') == TRUE)
		{
			if($this->kcalendar_model->delete())
			{
                            $this->message_storage->add_session_notice('calendar deleted');
			}
			redirect('admin/kcalendar/overview');
		}
		$this->view->add_data('kcalendar_list', $this->kcalendar_model->get_kcalendar_list($page));

                $this->view->show('kcalendar', 'kcalendar_overview');

	}

	function add()
	{
		
                   $this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('', '#;#');

		if ($this->form_validation->run('kcalendar') == FALSE)
		{
                    //log_mesage("debug", "kcalendar add validation failed");
                    $this->message_storage->add_validation_errors($this->form_validation->error_string());

		}
		else
		{
			$calendar_id = $this->kcalendar_model->add();
			$this->message_storage->add_session_notice('calendar added');
			redirect('admin/kcalendar/edit/'.$calendar_id);
		}
               
		$fckeditorConfig = array(
                                        'instanceName' => 'calendarContent',
                                        'BasePath' => base_url().APPPATH.'plugins/fckeditor/',
                                        'ToolbarSet' => 'Default',
                                        'Width' => '710px',
                                        'Height' => '400',
                                        'Value' => unprep_for_form(set_value('calendarContent'))
                                        );
		$this->load->library('fckeditor', $fckeditorConfig);
		$this->view->show('Add calendar', 'kcalendar_add');
                
                 //$this->view->show('kcalendar', 'kcalendar_overview');
                
	}

	function edit($calendar_id = FALSE)
	{
		if($calendar_id == FALSE)
		{
			redirect('admin/kcalendar/overview');
		}
		else
		{
			if($this->kcalendar_model->is_valid_kcalendar($calendar_id))
			{

				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('', '#;#');
				if ($this->form_validation->run('kcalendar') == FALSE)
				{
                                    $this->message_storage->add_validation_errors($this->form_validation->error_string());
				}
				else
				{

					$this->kcalendar_model->edit($calendar_id);
					$this->message_storage->add_session_notice('calendar edited');
					redirect('admin/kcalendar/edit/'.$calendar_id);
				}

				$kcalendar = $this->kcalendar_model->get_kcalendar($calendar_id);
				$fckeditorConfig = array(
										'instanceName' => 'calendarContent',
										'BasePath' => base_url().APPPATH.'plugins/fckeditor/',
										'ToolbarSet' => 'Default',
										'Width' => '710px',
										'Height' => '400',
										'Value' => unprep_for_form(set_value('calendarContent', $kcalendar['calendarContent']))
										);
				$this->load->library('fckeditor', $fckeditorConfig);
				$this->view->add_data('kcalendar', $kcalendar);
				$this->view->show('Edit calendar', 'kcalendar_edit');
			}
			else
			{
				redirect('admin/kcalendar/overview');
			}
		}
	}

	function sort($direction = 'up', $page_id = FALSE)
	{
		if($page_id == FALSE)
		{
			redirect('admin/kcalendar/overview');
		}
		else
		{
			if($this->kcalendar_model->is_valid_page($calendar_id))
			{
				switch($direction)
				{
					case 'up':
						$this->kcalendar_model->sort($direction, $calendar_id);
						break;
					case 'down':
						$this->kcalendar_model->sort($direction, $calendar_id);
						break;
					default:
						break;
				}
				redirect('admin/kcalendar/overview');
			}
			else
			{
				redirect('admin/kcalendar/overview');
			}
		}
	}
}

/* End of file page.php */
/* Location: ./application/controllers/admin/page.php */