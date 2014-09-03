<?php

class Archive extends MY_Controler {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Archive_model');
	}

	function index()
	{
		redirect('post/overview');
	}

	function view($year = FALSE, $month = FALSE, $page = 1)
	{
		if($year == FALSE)
		{
			redirect('post/overview');
		}
		else
		{
			if($this->Archive_model->is_valid_archive($year, $month))
			{
				$this->load->library('Pagination');
				$this->view->add_data('post_list', $this->Archive_model->get_post_list($year, $month, $page));
				$archive = $this->Archive_model->get_archive($year, $month);
				$this->view->add_data('archive_id', $archive['archive_id']);
				$this->view->show('Archive - '.$archive['archive_name'], 'archive_view');
			}
			else
			{
				redirect('post/overview');
			}
		}
	}
}

/* End of file archve.php */
/* Location: ./application/controllers/archve.php */