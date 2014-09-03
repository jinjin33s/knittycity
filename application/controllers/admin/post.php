<?php

class Post extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
		if(!$this->auth->has_right('view_administration'))
		{
			redirect('post/overview');
		}
		//$this->view->set_design_folder($this->config->item('config_design_folder')."/".'admin');
		$this->load->model('admin/Post_model');
	}

	function index()
	{
		$this->overview();
	}

	function overview($page = 1)
	{
		if($this->auth->has_right(array('can_add_post', 'can_edit_own_posts', 'can_edit_others_posts')))
		{
			$this->load->library('Pagination');
			$this->load->library('form_validation');
			if($this->auth->has_right('can_delete_post'))
			{
				if ($this->form_validation->run('post_delete') == TRUE)
				{
					if($this->Post_model->delete())
					{
						$this->message_storage->add_session_notice('Posts deleted');
					}
					redirect('admin/post/overview');
				}
			}
			$this->view->add_data('post_list', $this->Post_model->get_post_list($page));
			$this->view->show('Posts', 'post_overview');
		}
		else
		{
			redirect('post/overview');
		}
	}

	function add()
	{
		if($this->auth->has_right('can_add_post'))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('', '#;#');
			if ($this->form_validation->run('post') == FALSE)
			{
				$this->message_storage->add_validation_errors($this->form_validation->error_string());
			}
			else
			{
				$post_id = $this->Post_model->add();
				$this->message_storage->add_session_notice('Post added');
				redirect('admin/post/edit/'.$post_id);
			}
			$fckeditorConfig = array(
									'instanceName' => 'post_content',
									'BasePath' => base_url().APPPATH.'plugins/fckeditor/',
									'ToolbarSet' => 'Default',
									'Width' => '710px',
									'Height' => '400',
									'Value' => unprep_for_form(set_value('post_content'))
									);
			$this->load->library('fckeditor', $fckeditorConfig);
			$this->view->add_data('category_list', $this->Post_model->get_category_list());
			$this->view->show('Add post', 'post_add');
		}
		else
		{
			redirect('admin/post/overview');
		}
	}

	function edit($post_id = FALSE)
	{
		if($this->auth->has_right(array('can_edit_own_posts', 'can_edit_others_posts')))
		{
			if($post_id == FALSE)
			{
				redirect('admin/post/overview');
			}
			else
			{
				if($this->Post_model->is_valid_post($post_id))
				{
					$this->load->library('form_validation');
					$this->form_validation->set_error_delimiters('', '#;#');
					if ($this->form_validation->run('post') == FALSE)
					{
                                             log_message("debug", "knitty - running 3 validation " . $post_id);
						$this->message_storage->add_validation_errors($this->form_validation->error_string());
					}
					else
					{
						$this->Post_model->edit($post_id);
						$this->message_storage->add_session_notice('Post edited');
						redirect('admin/post/edit/'.$post_id);
					}
					$post = $this->Post_model->get_post($post_id);
					if($this->auth->has_right('can_edit_others_posts') OR ($this->auth->has_right('can_edit_own_posts') AND $post['post_author_user_id'] == $this->auth->get_user_id()))
					{
						$this->load->library('fckeditor');
						$this->view->add_data('post', $post);
						$this->view->add_data('category_list', $this->Post_model->get_category_list());
						$this->view->show('Edit post', 'post_edit');
					}
					else
					{
						redirect('admin/post/overview');
					}
				}
				else
				{
					redirect('admin/post/overview');
				}
			}
		}
		else
		{
			redirect('admin/post/overview');
		}
	}
}

/* End of file post.php */
/* Location: ./application/controllers/admin/post.php */