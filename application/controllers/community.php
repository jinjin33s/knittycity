<?php

class Community extends MY_Controler {

        function __construct()
	{
		parent::__construct();

		
                $this->load->model('Home_model');
                 $homeViewModelContainer = $this->Home_model->getViewModel();
                $this->view->add_data('homeViewModelContainer', $homeViewModelContainer);
	}

        function index()
	{
            $this->view->show_knitty("", 'community', "template_topmenu", false, false);
            
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */