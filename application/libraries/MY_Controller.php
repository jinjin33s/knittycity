<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controler extends Controller
{

    function __construct()
    {
        
        parent::__construct();
      
        $this->load->library('cloud');
        
        $this->load->model('Common_model');
       
        $this->load->helper('form');
         
        $this->view->add_data('navigation', $this->Common_model->get_navigation());
        $this->view->set_design_folder($this->config->item('config_design_folder'));
    }
}

class Admin_Controller extends Controller
{

    function __construct()
    {
        parent::__construct();
       
        $this->view->set_design_folder($this->config->item('config_design_folder')."/admin");
        $this->view->set_root_view("common/template");

    }
}

class Gallery_Controller extends Controller
{

    function __construct()
    {
        parent::__construct();

        $this->view->set_design_folder($this->config->item('config_design_folder')."/admin/gallery");
        $this->view->set_root_view("common/template");

    }
}