<?php

class Kevent extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
		if(!$this->auth->has_right('view_administration') OR !$this->auth->has_right('can_manage_pages'))
		{
			redirect('kevent/overview');
		}
		$this->view->set_design_folder($this->config->item('config_design_folder')."/".'admin');
		$this->load->model('admin/kevent_model');
	}

	function index()
	{

		$this->overview();
        }

	function overview($page = 1)
	{
		$this->load->library('Pagination');
		$this->load->library('form_validation');

		if ($this->form_validation->run('kevent_delete') == TRUE)
		{
			if($this->kevent_model->delete())
			{
				$this->message_storage->add_session_notice('event deleted');
			}
			redirect('admin/kevent/overview');
		}
		$this->view->add_data('kevent_list', $this->kevent_model->get_kevent_list($page));

                $this->view->show('Event', 'kevent_overview');

	}

	function add()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '#;#');

		if ($this->form_validation->run('kevent') == FALSE)
		{
                    //log_mesage("debug", "kevent add validation failed");
                    $this->message_storage->add_validation_errors($this->form_validation->error_string());
		}
		else
		{
			$event_id = $this->kevent_model->add();
			$this->message_storage->add_session_notice('event added');
			redirect('admin/kevent/edit/'.$event_id);
		}
               
		$fckeditorConfig = array(
                                        'instanceName' => 'eventContent',
                                        'BasePath' => base_url().APPPATH.'plugins/fckeditor/',
                                        'ToolbarSet' => 'Default',
                                        'Width' => '710px',
                                        'Height' => '400',
                                        'Value' => unprep_for_form(set_value('eventContent'))
                                        );
		$this->load->library('fckeditor', $fckeditorConfig);
		$this->view->show('Add event', 'kevent_add');
                 
                 
                
	}

	function edit($event_id = FALSE)
	{
		if($event_id == FALSE)
		{
			redirect('admin/kevent/overview');
		}
		else
		{
			if($this->kevent_model->is_valid_kevent($event_id))
			{

				$this->load->library('form_validation');

                                $this->form_validation->set_error_delimiters('', '#;#');

                                if ($this->form_validation->run('kevent') == FALSE)
				{
                                    $this->message_storage->add_validation_errors($this->form_validation->error_string());
                                   
				}
				else
				{

                                        $this->kevent_model->edit($event_id);
                                        
                                        $this->message_storage->add_session_notice('event edited');
					redirect('admin/kevent/edit/'.$event_id);
				}

				$kevent = $this->kevent_model->get_kevent($event_id);

				$fckeditorConfig = array(
                                                            'instanceName' => 'eventContent',
                                                            'BasePath' => base_url().APPPATH.'plugins/fckeditor/',
                                                            'ToolbarSet' => 'Default',
                                                            'Width' => '710px',
                                                            'Height' => '400',
                                                            'Value' => unprep_for_form(set_value('eventContent', $kevent['eventContent']))
                                                        );

				$this->load->library('fckeditor', $fckeditorConfig);
				$this->view->add_data('kevent', $kevent);
				$this->view->show('Edit event', 'kevent_edit');
			}
			else
			{
				redirect('admin/kevent/overview');
			}
		}
	}

	function sort($direction = 'up', $page_id = FALSE)
	{
		if($page_id == FALSE)
		{
			redirect('admin/kevent/overview');
		}
		else
		{
			if($this->kevent_model->is_valid_page($event_id))
			{
				switch($direction)
				{
					case 'up':
						$this->kevent_model->sort($direction, $event_id);
						break;

					case 'down':
						$this->kevent_model->sort($direction, $event_id);
						break;
					default:
						break;
				}
				redirect('admin/kevent/overview');
			}
			else
			{
				redirect('admin/kevent/overview');
			}
		}
	}
}

/* End of file page.php */
/* Location: ./application/controllers/admin/page.php */