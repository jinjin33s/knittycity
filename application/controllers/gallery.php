<?php
class Gallery extends MY_Controler
{
	function __construct()
        {
            parent::__construct();
            $this->load->model('Gallery_model');
            $this->load->model('Home_model');
            $homeViewModelContainer = $this->Home_model->getViewModel();
            $this->view->add_data('homeViewModelContainer', $homeViewModelContainer);
	}

	function index()
        {
                $this->overview();
		//$this->view->showGallery('gallery_list', TRUE);
	}
        
	function overview($page = 1)
	{
            $this->load->library('Pagination');
            $rows = $this->Gallery_model->viewCategoriesWithImage($page);
            $this->view->add_data('rows',$rows['list'] );
            $this->view->add_data('pagination_info',$rows['pagination_info']);
            $this->view->show_knitty("", 'gallery_list', "gallery_template", false, false); 
	}
	
	function view()
        {
		$data['rows'] = $this->Gallery_model->showImages($this->uri->segment(3));
                $this->view->add_data('rows', $data['rows']);
                $this->view->show_knitty("", 'gallery_view', "gallery_template", false, false);
	}

}