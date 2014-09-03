<?php

class Subscriber extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
                if(!$this->auth->has_right('view_administration') OR !$this->auth->has_right('can_manage_pages'))
		{
			redirect('subscriber/overview');
		}
		$this->view->set_design_folder($this->config->item('config_design_folder')."/".'admin');
		$this->load->model('admin/Subscriber_model');                
	}

	function index()
	{

		$this->overview();
        }

	function overview($page = 1)
	{
		$this->load->library('Pagination');
		$this->load->library('form_validation');

		if ($this->form_validation->run('subscriber_delete') == TRUE)
		{
			if($this->Subscriber_model->delete())
			{
                            $this->message_storage->add_session_notice('Subscriber deleted');
			}
			redirect('admin/subscriber/overview');
		}
		$this->view->add_data('subscriber_list', $this->Subscriber_model->get_subscriber_list($page));

                $this->view->show('Subscriber', 'subscriber_overview', FALSE, FALSE, TRUE);
	}

	function add()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '#;#');

		if ($this->form_validation->run('subscriber') == FALSE)
		{
                    $this->message_storage->add_validation_errors($this->form_validation->error_string());
		}
		else
		{                    
			$subscriber_id = $this->Subscriber_model->add();
			$this->message_storage->add_session_notice('subscriber added');
			redirect('admin/subscriber/edit/'.$subscriber_id);
		}

            $this->view->show('Add Subscriber', 'subscriber_add');
	}
	
	

	function edit($subscriber_id = FALSE)
	{

            if($subscriber_id == FALSE)
		{
			redirect('admin/subscriber/overview');
		}
		else
		{
                    if($this->Subscriber_model->is_valid_subscriber($subscriber_id))
			{
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('', '#;#');
				if ($this->form_validation->run('subscriber') == FALSE)
				{
                                    $this->message_storage->add_validation_errors($this->form_validation->error_string());
                                    }
				else
				{
					$this->Subscriber_model->edit($subscriber_id);
					$this->message_storage->add_session_notice('subscriber edited');
					redirect('admin/subscriber/edit/'.$subscriber_id);
				}

                                $subscriber = $this->Subscriber_model->get_subscriber($subscriber_id);

				$this->view->add_data('subscriber', $subscriber);
				$this->view->show('Edit subscriber', 'subscriber_edit');
			}
			else
			{
				redirect('admin/subscriber/overview');
			}
		}
	}

	function sort($direction = 'up', $page_id = FALSE)
	{
		if($page_id == FALSE)
		{
			redirect('admin/subscriber/overview');
		}
		else
		{
			if($this->Subscriber_model->is_valid_page($subscriber_id))
			{
				switch($direction)
				{
					case 'up':
						$this->Subscriber_model->sort($direction, $subscriber_id);
						break;
					case 'down':
						$this->Subscriber_model->sort($direction, $subscriber_id);
						break;
					default:
						break;
				}
				redirect('admin/subscriber/overview');
			}
			else
			{
				redirect('admin/subscriber/overview');
			}
		}
	}
}

/* End of file page.php */
/* Location: ./application/controllers/admin/page.php */