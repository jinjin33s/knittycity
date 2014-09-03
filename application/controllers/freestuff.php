<?php

class Freestuff extends MY_Controler {

        function index()
	{
            $this->load->model('Home_model');
            $homeViewModelContainer = $this->Home_model->getViewModel();
            $this->view->add_data('homeViewModelContainer', $homeViewModelContainer);
            $this->view->show_knitty("", 'freestuff', "template_topmenu", false, false);
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */