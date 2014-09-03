<?php

class User extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
		if(!$this->auth->is_logged_in())
		{
			redirect('post/overview');
		}
		$this->view->set_design_folder($this->config->item('config_design_folder')."/".'admin');
		$this->load->model('admin/User_model');
	}

	function index()
	{
		$this->overview();
	}

	function overview($page = 1)
	{
		if(!$this->auth->has_right('view_administration') OR !$this->auth->has_right('can_edit_user'))
		{
			redirect('post/overview');
		}
		else
		{
			$this->load->library('Pagination');
			$this->load->library('form_validation');
			$this->view->add_data('user_list', $this->User_model->get_user_list($page));
			$this->view->show('Users', 'user_overview');
		}
	}

	function edit($user_id = FALSE)
	{
		if($user_id == FALSE)
		{
			$this->edit($this->auth->get_user_id());
		}
		else
		{
			if($this->User_model->is_valid_user($user_id))
			{
				if(($this->auth->has_right('can_edit_own_user') AND $this->auth->get_user_id() == $user_id) OR $this->auth->has_right('can_edit_user'))
				{
					$this->load->library('form_validation');
					$this->form_validation->set_error_delimiters('', '#;#');
					if ($this->form_validation->run('user') == FALSE)
					{
						$this->message_storage->add_validation_errors($this->form_validation->error_string());
					}
					else
					{
						$this->User_model->edit($user_id);
						$this->message_storage->add_session_notice('User edited');
						redirect('admin/user/edit/'.$user_id);
					}
					$this->view->add_data('user', $this->User_model->get_user($user_id));
					$this->view->add_data('group_list', $this->User_model->get_group_list());
					$this->view->show('Edit user', 'user_edit');
				}
				else
				{
					redirect('post/overview');
				}
			}
			else
			{
				$this->edit($this->auth->get_user_id());
			}
		}
	}

	function changepass($user_id = FALSE)
	{
		if($user_id == FALSE)
		{
			$this->edit($this->auth->get_user_id());
		}
		else
		{
			if($this->User_model->is_valid_user($user_id))
			{
				if(($this->auth->has_right('can_edit_own_user') AND $this->auth->get_user_id() == $user_id) OR $this->auth->has_right('can_edit_user'))
				{
					$this->load->library('form_validation');
					$this->form_validation->set_error_delimiters('', '#;#');
					if(($this->auth->has_right('can_edit_own_user') AND $this->auth->get_user_id() == $user_id))
					{
						$validation = 'change_own_password';
					}
					else
					{
						$validation = 'change_password';
					}
					if ($this->form_validation->run($validation) == FALSE)
					{
						$this->message_storage->add_validation_errors($this->form_validation->error_string(), TRUE);
						redirect('admin/user/edit/'.$user_id);
					}
					else
					{
						$this->User_model->change_password($user_id);
						$this->message_storage->add_session_notice('Password changed');
						redirect('admin/user/edit/'.$user_id);
					}
				}
				else
				{
					redirect('post/overview');
				}
			}
			else
			{
				$this->edit($this->auth->get_user_id());
			}
		}
	}
}

/* End of file post.php */
/* Location: ./application/controllers/admin/post.php */