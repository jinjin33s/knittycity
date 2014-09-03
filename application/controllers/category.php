<?php

class Category extends MY_Controler {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Category_model');
	}

	function index()
	{
		redirect('post/overview');
	}

	function view($category_id = FALSE, $page = 1)
	{
		if($category_id == FALSE)
		{
			redirect('post/overview');
		}
		else
		{
			if($this->Category_model->is_valid_category($category_id))
			{
				$this->load->library('Pagination');
				$this->view->add_data('post_list', $this->Category_model->get_post_list($category_id, $page));
				$category = $this->Category_model->get_category($category_id);
				$this->view->add_data('category_id', $category_id);
				$this->view->show('Category - '.$category['category_name'], 'category_view');
			}
			else
			{
				redirect('post/overview');
			}
		}
	}

	function rss($category_id = FALSE)
	{
		if($category_id == FALSE)
		{
			redirect('post/rss');
		}
		else
		{
			if($this->Category_model->is_valid_category($category_id))
			{
				$this->load->library('Pagination');
				$this->view->add_data('post_list', $this->Category_model->get_post_list($category_id, 1));
				$category = $this->Category_model->get_category($category_id);
				$this->view->set_root_view('index_rss');
				$this->view->add_data('description', 'Overview of the '.$this->config->item('config_blog_entries_per_page').' newests posts in the category '.$category['category_name']);
				$this->view->show('Newest posts in category '.$category['category_name'], 'post_rss');
			}
			else
			{
				redirect('post/rss');
			}
		}
	}
}

/* End of file category.php */
/* Location: ./application/controllers/category.php */