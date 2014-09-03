<?php

class Kevent extends MY_Controler {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('admin/kevent_model');

                $this->load->model('Home_model');
                 $homeViewModelContainer = $this->Home_model->getViewModel();
                $this->view->add_data('homeViewModelContainer', $homeViewModelContainer);
	}

	function index()
	{

		$this->overview();
        }

	function overview($page = 1)
	{
		$this->load->library('Pagination');
		$this->load->library('form_validation');
                
		$this->view->add_data('kevent_list', $this->kevent_model->get_kevent_list_by_coming($page));
               
                //show_knitty($page_title = '', $view_name = '', $template_name, $debug = FALSE, $simple = FALSE, $add_data = TRUE)
                 $this->view->show_knitty('kevent', 'kevent_overview','event_template');
	}

	

	function view($event_id = FALSE)
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
				
				$this->view->add_data('kevent', $kevent);
				//$this->view->show('Edit event', 'kevent_edit');
                                $this->view->show_knitty('Event', 'kevent_view','event_template');
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