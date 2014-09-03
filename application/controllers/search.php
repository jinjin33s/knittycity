<?php

class Search extends MY_Controler {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Search_model');
	}

	function index()
	{
		redirect('post/overview');
	}

	function perform()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '#;#');
		if ($this->form_validation->run('search') == FALSE)
		{
			redirect('post/overview');
		}
		else
		{
			$search_id = $this->Search_model->perform_search();
			redirect('search/result/'.$search_id);
		}
	}

	function result($search_id = FALSE, $page = 1)
	{
		if($search_id == FALSE)
		{
			redirect('post/overview');
		}
		else
		{
			if($this->Search_model->is_valid_search($search_id))
			{
				$this->load->library('Pagination');
				$post_list = $this->Search_model->get_result_list($search_id, $page);
				if($post_list['pagination_info']['page'] == 1)
				{
					$this->Search_model->perform_search($search_id);
				}
				$this->view->add_data('post_list', $post_list);
				$this->view->add_data('search_id', $search_id);
				$this->view->show('Search result', 'search_result');
			}
			else
			{
				redirect('post/overview');
			}
		}
	}
}

/* End of file search.php */
/* Location: ./application/controllers/search.php */