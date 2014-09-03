<?php

class Home extends MY_Controler {

	function __construct()
	{

            parent::__construct();
            $this->load->model('Home_model');

            $this->load->model('Home_model');
            $homeViewModelContainer = $this->Home_model->getViewModel();
            $this->view->add_data('homeViewModelContainer', $homeViewModelContainer);
	}

	function index()
	{
	   // $this->view->show_knitty("", 'home_view', "home_template", false, false);
           
            $homeViewModelContainer = $this->Home_model->getViewModel();
            $this->extractImageTag($homeViewModelContainer);
           
           
            $this->view->add_data('homeViewModelContainer', $homeViewModelContainer);
            $this->view->add_data('view_name', 'home_view');
	    $this->view->show_knitty("", 'home_view', "home_template", false, true);
	}

        function extractImageTag( &$homelist)
        {
          
            foreach($homelist['post_list'] as &$item)
            {
                $htmlContent = $item['post_content'];
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
          

               $item['post_image'] = $found;
          
            }
          
           
        }

        function index2()
	{
            $homeViewModelContainer = $this->Home_model->getViewModel();
             echo var_dump($homeViewModelContainer['gallery_list']);
             echo "<br />---------------------------------<br />";
             echo var_dump($homeViewModelContainer['kprofile_list']);
             echo "<br />---------------------------------<br />";
             echo var_dump($homeViewModelContainer['kclass_list']);
             echo "<br />---------------------------------<br />";
             echo var_dump($homeViewModelContainer['product_list']);
             echo "<br />---------------------------------<br />";
            echo  var_dump($homeViewModelContainer['post_list']);
            echo "<br />---------------------------------<br />";
            die();
            $this->view->add_data('homeViewModelContainer', $homeViewModelContainer);
            $this->view->add_data('view_name', 'home_view2');
	    $this->view->show_knitty("", 'home_view2', "home_template", false, true);
	}

        function aboutus()
	{
             $homeViewModelContainer = $this->Home_model->getViewModel();
           
            $this->view->add_data('homeViewModelContainer', $homeViewModelContainer);
            $this->view->show_knitty("", 'aboutus_view', "aboutus_template", false, false);
	}

        function aboutus_welcome()
	{
            $this->view->show_knitty("", 'aboutus_welcome', "aboutus_template", false, false);
	}

        function aboutus_press()
	{
            $this->view->show_knitty("", 'aboutus_press', "aboutus_template", false, false);
	}

        function direction()
        {
            $this->view->show_knitty("", 'direction_view', "aboutus_template", false, false);
        }
		
	
	function addajax()
	{
		$this->load->model('admin/Subscriber_model'); 
		$this->load->library('form_validation');		
		$this->form_validation->set_error_delimiters('', '#;#');

		if ($this->form_validation->run('subscriber') == FALSE)
		{
              echo $this->form_validation->error_string() + "Registration Failed!";
		}
		else
		{         
			$subscriber_msg = $this->Subscriber_model->addajax();
			echo $subscriber_msg;
		}
		
		

	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */