<?php

class Category extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
		if(!$this->auth->has_right('view_administration') OR !$this->auth->has_right('can_manage_categories'))
		{
			redirect('post/overview');
		}
		$this->view->set_design_folder($this->config->item('config_design_folder')."/".'admin');
		$this->load->model('admin/Category_model');
	}

	function index()
	{
		$this->overview();
	}

	function overview($page = 1)
	{
		$this->load->library('Pagination');
		$this->load->library('form_validation');
		$this->load->helper('html');
		if ($this->form_validation->run('category_delete') == TRUE)
		{
			if($this->Category_model->delete())
			{
				$this->message_storage->add_session_notice('Categories deleted');
			}
			redirect('admin/category/overview');
		}
		$this->view->add_data('category_list', $this->Category_model->get_category_list($page));
		$this->view->show('Categories', 'category_overview');         
            
	}

	function sort($direction = 'up', $category_id = FALSE)
	{
		if($category_id == FALSE)
		{
			redirect('admin/category/overview');
		}
		else
		{
			if($this->Category_model->is_valid_category($category_id))
			{
				switch($direction)
				{
					case 'up':
						$this->Category_model->sort($direction, $category_id);
						break;
					case 'down':
						$this->Category_model->sort($direction, $category_id);
						break;
					default:
						break;
				}
				redirect('admin/category/overview');
			}
			else
			{
				redirect('admin/category/overview');
			}
		}
	}
}

/* End of file category.php */
/* Location: ./application/controllers/admin/category.php */