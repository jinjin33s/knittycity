<?php

class Page extends MY_Controler {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Page_model');
	}

	function index()
	{
		redirect('post/overview');
	}

	function view($page_id = FALSE)
	{
		if($page_id == FALSE)
		{
			redirect('post/overview');
		}
		else
		{
			if($this->Page_model->is_valid_page($page_id))
			{
				$page = $this->Page_model->get_page($page_id);
				$this->view->add_data('page', $page);
				$this->view->show('Page - '.$page['page_title'], 'page_view');
			}
			else
			{
				redirect('post/overview');
			}
		}
	}
}

/* End of file page.php */
/* Location: ./application/controllers/page.php */