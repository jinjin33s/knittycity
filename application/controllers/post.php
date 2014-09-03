<?php

class Post extends MY_Controler {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Post_model');
	}

	function index()
	{
		$this->overview();
	}

	function overview($page = 1)
	{
		$this->load->library('Pagination');
		$this->view->add_data('post_list', $this->Post_model->get_post_list($page));
		$this->view->show('Overview', 'post_overview');
	}

	function view($post_id = FALSE, $page = 1)
	{
		if($post_id == FALSE)
		{
			redirect('post/overview');
		}
		else
		{
			if($this->Post_model->is_valid_post($post_id))
			{
				$this->load->library('Pagination');
				if($this->auth->has_right('can_create_comment'))
				{
					$this->load->library('form_validation');
					$this->form_validation->set_error_delimiters('', '#;#');
					if($this->auth->is_logged_in())
					{
						$validation_set = 'comment_logged_in';
					}
					else
					{
						$validation_set = 'comment';
					}
					if ($this->form_validation->run($validation_set) == FALSE)
					{
						$this->message_storage->add_validation_errors($this->form_validation->error_string());
					}
					else
					{
						$comment_info = $this->Post_model->add_comment($post_id);
						redirect('post/view/'.$post_id.'/'.$comment_info['page'].'#comment-'.$comment_info['comment_id']);
					}
				}

				$post = $this->Post_model->get_post($post_id, $page);
                               
                                $this->view->add_data('post', $post);

                                $this->view->show('Post - '.$post['post_title'], 'post_view');
			}
			else
			{
				redirect('post/overview');
			}
		}
	}

	function rss()
	{
		$this->load->library('Pagination');
		$this->view->add_data('post_list', $this->Post_model->get_post_list(1));
		$this->view->set_root_view('index_rss');
		$this->view->add_data('description', 'Overview of the '.$this->config->item('config_blog_entries_per_page').' newests posts');
		$this->view->show('Newest posts', 'post_rss');
	}

	function trackback($post_id = FALSE)
	{
		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			if($post_id == FALSE)
			{
				$this->_trackback_response(1, 'No such post');
			}
			else
			{
				if($this->Post_model->is_valid_post($post_id))
				{
					$this->load->library('form_validation');
					if ($this->form_validation->run('trackback') == FALSE)
					{
						$this->_trackback_response(1, 'No url submitted');
					}
					else
					{
						if($this->Post_model->trackback_is_allowed($post_id))
						{
							if(!$this->Post_model->trackback_exists($post_id))
							{
								$this->Post_model->add_trackback($post_id);
								$this->_trackback_response(0);
							}
							else
							{
								$this->_trackback_response(1, 'A trackback from that url already exists');
							}
						}
						else
						{
							$this->_trackback_response(1, 'No trackbacks allowed for this post');
						}
					}
				}
				else
				{
					$this->_trackback_response(1, 'No such post');
				}
			}
		}
		else
		{
			redirect('post/overview');
		}
	}

	function _trackback_response($error_code = 0, $error_message = FALSE)
	{
		$this->output->set_header("Content-Type: text/xml; charset=UTF-8");
		$this->view->add_data('error_code', $error_code);
		$this->view->add_data('error_message', $error_message);
		$this->view->show_simple('post_trackback_response', TRUE);
	}
}

/* End of file post.php */
/* Location: ./application/controllers/post.php */