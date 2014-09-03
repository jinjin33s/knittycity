<?php

class File extends MY_Controler {

	function __construct()
	{
		parent::__construct();
		$this->load->model('File_model');
	}

	function index()
	{
		redirect('file/overview');
	}

	function view($file_id = FALSE)
	{
		if($file_id == FALSE)
		{
			redirect('file/overview');
		}
		else
		{
			if($this->File_model->is_valid_file($file_id))
			{
				$file = $this->File_model->get_file($file_id);
				$this->view->add_data('file', $file);
				$this->view->show('File - '.$file['file_title'], 'file_view');
			}
			else
			{
				redirect('file/overview');
			}
		}
	}

	function get($file_id = FALSE, $mirror_id = FALSE)
	{
		if($file_id == FALSE)
		{
			redirect('file/overview');
		}
		else
		{
			if($this->File_model->is_valid_file($file_id))
			{
				if($mirror_id == FALSE)
				{
					redirect('file/view/'.$file_id);
				}
				else
				{
					if($this->File_model->is_valid_mirror($file_id, $mirror_id))
					{
						$mirror = $this->File_model->get_mirror($file_id, $mirror_id);

						$this->File_model->increase_download_count($file_id);
						if($mirror['source'] == 'intern')
						{
							$this->load->helper('download');
							$data = file_get_contents($mirror['file']);
							$file_path = explode('/', $mirror['file']);
							$name = $file_path[count($file_path)-1];
							force_download($name, $data);
						}
						else
						{
							redirect($mirror['file']);
						}
					}
					else
					{
						redirect('file/view/'.$file_id);
					}
				}
			}
			else
			{
				redirect('file/overview');
			}
		}
	}

	function overview($page = 1)
	{
		$this->load->library('Pagination');
		$this->view->add_data('file_list', $this->File_model->get_file_list($page));
		$this->view->show('File overview', 'file_overview');
	}
}

/* End of file file.php */
/* Location: ./application/controllers/file.php */