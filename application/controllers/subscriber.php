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



}

/* End of file page.php */
/* Location: ./application/controllers/admin/page.php */