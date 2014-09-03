<?php

class Tag extends MY_Controler {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Tag_model');
	}

	function index()
	{
		redirect('post/overview');
	}

	function view($tag_id = FALSE, $page = 1)
	{
		if($tag_id == FALSE)
		{
			redirect('post/overview');
		}
		else
		{
			if($this->Tag_model->is_valid_tag($tag_id))
			{
				$this->load->library('Pagination');
				$this->view->add_data('post_list', $this->Tag_model->get_post_list($tag_id, $page));
				$tag = $this->Tag_model->get_tag($tag_id);
				$this->view->add_data('tag_id', $tag_id);
				$this->view->show('Tag - '.$tag['tag_name'], 'tag_view');
			}
			else
			{
				redirect('post/overview');
			}
		}
	}

	function rss($tag_id = FALSE)
	{
		if($tag_id == FALSE)
		{
			redirect('post/rss');
		}
		else
		{
			if($this->Tag_model->is_valid_tag($tag_id))
			{
				$this->load->library('Pagination');
				$this->view->add_data('post_list', $this->Tag_model->get_post_list($tag_id, 1));
				$tag = $this->Tag_model->get_tag($tag_id);
				$this->view->set_root_view('index_rss');
				$this->view->add_data('description', 'Overview of the '.$this->config->item('config_blog_entries_per_page').' newests posts with the tag'.$tag['tag_name']);
				$this->view->show('Newest posts with the tag '.$tag['tag_name'], 'post_rss');
			}
			else
			{
				redirect('post/rss');
			}
		}
	}
}

/* End of file tag.php */
/* Location: ./application/controllers/tag.php */