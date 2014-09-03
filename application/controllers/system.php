<?php

class System extends MY_Controler {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->login();
	}

	function css()
	{
		$this->output->set_header('Content-type:text/css');
		$this->view->set_root_view('system_css');
		$this->view->show();
	}

	function login()
	{
            /*
		if($this->auth->is_logged_in())
		{
			redirect('post/overview');
		}
		else
		{
             *
             */
			$this->load->library('Form_validation');
			$this->form_validation->set_error_delimiters('', '#;#');

			if ($this->form_validation->run('login') == FALSE)
			{
				$this->message_storage->add_validation_errors($this->form_validation->error_string());
			}
			else
			{
				$login = $this->auth->login(set_value('user_name'), set_value('user_password'));
				if($login == TRUE)
				{
					//redirect('post/overview');
                                    redirect('admin');
				}
				else
				{
					$this->message_storage->add_error('Unknown username/password combination or your user is not yet activated.');
				}
			}
			$this->view->set_root_view('index_system');
			$this->view->show('Login', 'system_login');
		//}
	}

	function register()
	{
		if($this->auth->is_logged_in())
		{
			redirect('post/overview');
		}
		else
		{
			if($this->config->item('config_enable_registration') == 1)
			{
				$this->load->library('Form_validation');
				$this->form_validation->set_error_delimiters('', '#;#');

				if ($this->form_validation->run('register') == FALSE)
				{
					$this->message_storage->add_validation_errors($this->form_validation->error_string());
				}
				else
				{
					$this->load->model('System_model');
					$register = $this->System_model->register();
					if($register == TRUE)
					{
						$this->message_storage->add_session_notice('Registered successfully. You may login now.');
						redirect('system/login');
					}
					else
					{
						$this->message_storage->add_error('Either the username is already taken or there already is an account associated with that e-mail address.');
					}
				}
				$this->view->set_root_view('index_system');
				$this->view->show('Register', 'system_register');
			}
			else
			{
				redirect('system/login');
			}
		}
	}

	function forgotpassword($user_id = "", $key = "")
	{
		if($this->auth->is_logged_in())
		{
			redirect('post/overiew');
		}
		else
		{
			if($user_id != "" AND $key != "")
			{
				$this->load->model('System_model');
				$user = $this->System_model->get_user_by_confirmation_key($user_id, $key);
				if($user !== FALSE)
				{
					$new_password = $this->System_model->set_new_password($user_id);
					$this->load->library('email');
					$this->email->from($this->config->item('config_owner_email'), 'No reply');
					$this->email->to($user->user_email);
					$this->email->subject('New password');
					$this->email->message(sprintf("The password for your account was reset. Please use these info to login:\n\nUsername: %s\nPassword: %s\n\nOnce you are logged in, you should change your password again.", $user->user_name, $new_password));
					$this->email->send();

					$this->message_storage->add_session_notice('A new password was generated and sent to your e-mail address.');
					redirect('system/login');
				}
				else
				{
					$this->message_storage->add_session_error('Invalid confirmation link.');
					redirect('system/login');
				}
			}
			else
			{
				$this->load->library('Form_validation');
				$this->form_validation->set_error_delimiters('', '#;#');

				if ($this->form_validation->run('forgotpassword') == FALSE)
				{
					$this->message_storage->add_validation_errors($this->form_validation->error_string());
				}
				else
				{
					$this->load->model('System_model');
					$user = $this->System_model->forgotpassword();
					if(is_array($user))
					{
						$this->load->library('email');
						$this->email->from($this->config->item('config_owner_email'), 'No reply');
						$this->email->to(set_value('user_email'));
						$this->email->subject('Forgot password');
						$link = site_url('system/forgotpassword/'.$user['user_id']."/".$user['user_confirmation_key']);
						$this->email->message(sprintf("A request for a new password was submitted using your e-mail address.\n\nPlease confirm the request using this links: %s.\n\nOr ignore this e-mail if you did not submit this request.", $link));
						$this->email->send();

						$this->message_storage->add_session_notice('An e-mail was send to the provided e-mail address. Please follow the confirmation link to reset your password.');
						redirect('system/login');
					}
					else
					{
						$this->message_storage->add_error('The submitted e-mail address seems not to be valid.');
					}
				}
				$this->view->set_root_view('index_system');
				$this->view->show('Forgot password', 'system_forgotpassword');
			}
		}
	}

	function logout()
	{
		$this->auth->logout();
		redirect("post/overview");
	}

	function contact()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '#;#');
		if ($this->form_validation->run('contact') == FALSE)
		{
			$this->message_storage->add_validation_errors($this->form_validation->error_string());
		}
		else
		{
			$this->load->library('email');
			$this->email->from(set_value('contact_email'), set_value('contact_name'));
			$this->email->to($this->config->item('config_owner_email'));
			$this->email->subject('Contact - '.set_value('contact_subject'));
			$this->email->message(sprintf("Hello %s,\n%s used the contact form on %s and sends you this message:\n\n%s", $this->config->item('config_owner_name'), set_value('contact_name'), base_url(), set_value('contact_content')));
			$this->email->send();
			$this->message_storage->add_session_notice('Contact request sent');
			redirect('system/contact');
		}
		$this->view->add_data('user', $this->auth->get_user());
		$this->view->show('Contact', 'system_contact');
	}
}

/* End of file system.php */
/* Location: ./application/controllers/system.php */