<?php

class kprofile extends MY_Controler {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('admin/kprofile_model');

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
                
		$this->view->add_data('kprofile_list', $this->kprofile_model->get_kprofile_list($page));

                //by Jin
                $homeViewModelContainer = $this->kprofile_model->get_kprofile_list($page);
                $this->extractImageTag($homeViewModelContainer);

                $this->view->add_data('homeViewModelContainer', $homeViewModelContainer);
               
                //show_knitty($page_title = '', $view_name = '', $template_name, $debug = FALSE, $simple = FALSE, $add_data = TRUE)
                $this->view->show_knitty('kprofile', 'kprofile_overview','kprofile_template');
	}

	function extractImageTag( &$homelist)
        {

            foreach($homelist['kprofile_list'] as &$item)
            {
                $htmlContent = $item['profContent'];
                preg_match_all('/<img[^>]+>/i',$htmlContent, $result);

                $found = '';
                foreach( $result[0] as $img_tag)
                {
                    preg_match_all('/(src)="([^"]*)"/i',$img_tag, $img);
                    if(count($img) > 0)
                    {

                        if(strlen($img[2][0]) > 0)
                         {
                            $found = $img[2][0];
                            break;
                          }
                      }


                }


               $item['kprofile_image'] = $found;

            }


        }

	function view($profile_id = FALSE)
	{
		if($profile_id == FALSE)
		{
			redirect('admin/kprofile/overview');
		}
		else
		{
			if($this->kprofile_model->is_valid_kprofile($profile_id))
			{

				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('', '#;#');
				if ($this->form_validation->run('kprofile') == FALSE)
				{
                                    $this->message_storage->add_validation_errors($this->form_validation->error_string());
				}
				else
				{

					$this->kprofile_model->edit($profile_id);
					$this->message_storage->add_session_notice('event edited');
					redirect('admin/kprofile/edit/'.$profile_id);
				}

				$kprofile = $this->kprofile_model->get_kprofile($profile_id);
				
				$this->view->add_data('kprofile', $kprofile);
				//$this->view->show('Edit event', 'kprofile_edit');
                                $this->view->show_knitty('Profile', 'kprofile_view','kprofile_template');
			}
			else
			{
				redirect('admin/kprofile/overview');
			}
		}
	}

	function sort($direction = 'up', $page_id = FALSE)
	{
		if($page_id == FALSE)
		{
			redirect('admin/kprofile/overview');
		}
		else
		{
			if($this->kprofile_model->is_valid_page($profile_id))
			{
				switch($direction)
				{
					case 'up':
						$this->kprofile_model->sort($direction, $profile_id);
						break;
					case 'down':
						$this->kprofile_model->sort($direction, $profile_id);
						break;
					default:
						break;
				}
				redirect('admin/kprofile/overview');
			}
			else
			{
				redirect('admin/kprofile/overview');
			}
		}
	}
}

/* End of file page.php */
/* Location: ./application/controllers/admin/page.php */