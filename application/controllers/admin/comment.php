<?php

class Comment extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
		if(!$this->auth->is_logged_in())
		{
			redirect('post/overview');
		}
		//$this->view->set_design_folder($this->config->item('config_design_folder')."/".'admin');
		$this->load->model('admin/Comment_model');
	}

	function index()
	{
		$this->overview();
	}

	function overview($page = 1)
	{
		if(!$this->auth->has_right('view_administration') OR !$this->auth->has_right('can_manage_comments'))
		{
			redirect('post/overview');
		}
		else
		{
			$this->load->library('Pagination');
			$this->load->library('form_validation');
			$this->view->add_data('comment_list', $this->Comment_model->get_comment_list($page));
			$this->view->show('Comments', 'comment_overview');
		}
	}

	function edit($comment_id = FALSE)
	{
		if(!$this->auth->has_right('view_administration') OR !$this->auth->has_right('can_manage_comments'))
		{
			redirect('post/overview');
		}
		else
		{
			if($comment_id == FALSE)
			{
				redirect('admin/comment/overview');
			}
			else
			{
				if($this->Comment_model->is_valid_comment($comment_id))
				{
					$this->load->library('form_validation');
					$this->form_validation->set_error_delimiters('', '#;#');
					if ($this->form_validation->run('comment_admin') == FALSE)
					{
						$this->message_storage->add_validation_errors($this->form_validation->error_string());
					}
					else
					{
						$this->Comment_model->edit($comment_id);
						$this->message_storage->add_session_notice('Comment edited');
						redirect('admin/comment/edit/'.$comment_id);
					}
					$this->view->add_data('comment', $this->Comment_model->get_comment($comment_id));
					$this->view->show('Edit comment', 'comment_edit');
				}
				else
				{
					redirect('admin/comment/overview');
				}
			}
		}
	}

	function approve($comment_id = FALSE)
	{
		if(!$this->auth->has_right('view_administration') OR !$this->auth->has_right('can_manage_comments'))
		{
			redirect('post/overview');
		}
		else
		{
			if($comment_id == FALSE)
			{
				redirect('admin/comment/overview');
			}
			else
			{
				if($this->Comment_model->is_valid_comment($comment_id))
				{
					$this->Comment_model->approve($comment_id);
					$this->message_storage->add_session_notice('Comment approved');
					redirect('admin/comment/overview');
				}
				else
				{
					redirect('admin/comment/overview');
				}
			}
		}
	}

	function unapprove($comment_id = FALSE)
	{
		if(!$this->auth->has_right('view_administration') OR !$this->auth->has_right('can_manage_comments'))
		{
			redirect('post/overview');
		}
		else
		{
			if($comment_id == FALSE)
			{
				redirect('admin/comment/overview');
			}
			else
			{
				if($this->Comment_model->is_valid_comment($comment_id))
				{
					$this->Comment_model->unapprove($comment_id);
					$this->message_storage->add_session_notice('Comment unapproved');
					redirect('admin/comment/overview');
				}
				else
				{
					redirect('admin/comment/overview');
				}
			}
		}
	}

	function delete($comment_id = FALSE)
	{
		if(!$this->auth->has_right('view_administration') OR !$this->auth->has_right('can_manage_comments'))
		{
			redirect('post/overview');
		}
		else
		{
			if($comment_id == FALSE)
			{
				redirect('admin/comment/overview');
			}
			else
			{
				if($this->Comment_model->is_valid_comment($comment_id))
				{
					$this->Comment_model->delete($comment_id);
					$this->message_storage->add_session_notice('Comment deleted');
					redirect('admin/comment/overview');
				}
				else
				{
					redirect('admin/comment/overview');
				}
			}
		}
	}

	function spam($comment_id = FALSE)
	{
		if(!$this->auth->has_right('view_administration') OR !$this->auth->has_right('can_manage_comments'))
		{
			redirect('post/overview');
		}
		else
		{
			if($comment_id == FALSE)
			{
				redirect('admin/comment/overview');
			}
			else
			{
				if($this->Comment_model->is_valid_comment($comment_id))
				{
					$this->Comment_model->spam($comment_id);
					$this->message_storage->add_session_notice('Comment marked as spam');
					redirect('admin/comment/overview');
				}
				else
				{
					redirect('admin/comment/overview');
				}
			}
		}
	}

	function unspam($comment_id = FALSE)
	{
		if(!$this->auth->has_right('view_administration') OR !$this->auth->has_right('can_manage_comments'))
		{
			redirect('post/overview');
		}
		else
		{
			if($comment_id == FALSE)
			{
				redirect('admin/comment/overview');
			}
			else
			{
				if($this->Comment_model->is_valid_comment($comment_id))
				{
					$this->Comment_model->unspam($comment_id);
					$this->message_storage->add_session_notice('Comment unmarked as spam');
					redirect('admin/comment/overview');
				}
				else
				{
					redirect('admin/comment/overview');
				}
			}
		}
	}
}

/* End of file comment.php */
/* Location: ./application/controllers/admin/comment.php */