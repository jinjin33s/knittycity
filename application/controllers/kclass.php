<?php

class Kclass extends MY_Controler {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('admin/Kclass_model');
                
                $this->load->model('Home_model');
                 $homeViewModelContainer = $this->Home_model->getViewModel();
                $this->view->add_data('homeViewModelContainer', $homeViewModelContainer);
	}

	function index()
	{

		$this->overview();
        }

	function overview($page = 1)
	{
		$this->load->library('Pagination');
		$this->load->library('form_validation');
                
		$this->view->add_data('kclass_list', $this->Kclass_model->get_kclass_list_by_coming($page));

                //$this->view->show('Kclass', 'kclass_overview');
                  $this->view->show_knitty('Kclass', 'kclass_overview','class_template');
	}

	

	function view($class_id = FALSE)
	{
		if($class_id == FALSE)
		{
			redirect('admin/kclass/overview');
		}
		else
		{
			if($this->Kclass_model->is_valid_kclass($class_id))
			{

				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('', '#;#');
				if ($this->form_validation->run('kclass') == FALSE)
				{
                                    $this->message_storage->add_validation_errors($this->form_validation->error_string());
				}
				else
				{

					$this->Kclass_model->edit($class_id);
					$this->message_storage->add_session_notice('class edited');
					redirect('admin/kclass/view/'.$class_id);
				}

				$kclass = $this->Kclass_model->get_kclass($class_id);
				
				$this->view->add_data('kclass', $kclass);
				//$this->view->show('Edit class', 'kclass_view');
                                $this->view->show_knitty('Class', 'kclass_view','class_template');
			}
			else
			{
				redirect('admin/kclass/overview');
			}
		}
	}

	function sort($direction = 'up', $page_id = FALSE)
	{
		if($page_id == FALSE)
		{
			redirect('admin/kclass/overview');
		}
		else
		{
			if($this->Kclass_model->is_valid_page($class_id))
			{
				switch($direction)
				{
					case 'up':
						$this->Kclass_model->sort($direction, $class_id);
						break;
					case 'down':
						$this->Kclass_model->sort($direction, $class_id);
						break;
					default:
						break;
				}
				redirect('admin/kclass/overview');
			}
			else
			{
				redirect('admin/kclass/overview');
			}
		}
	}
}

/* End of file page.php */
/* Location: ./application/controllers/admin/page.php */