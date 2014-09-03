<?php
class ViewG extends Admin_Controller {
	function ViewG() {
		parent::Controller();                
                $this->load->model('gallery/gallery_xml');
                $this->view->set_design_folder($this->config->item('config_design_folder')."/".'gallery');
	}

	function index() {
		$this->load->model('gallery/settings_tbl');
                $this->view->add_data('row',  $this->gallery_xml->viewXML());
                $this->view->add_data('settings',  $this->settings_tbl->viewSettings());
		$this->view->showGallery('view_xml', TRUE);
	}
	function xml() {
		$this->load->model('gallery/settings_tbl');
                $this->view->add_data('row',  $this->gallery_xml->viewXML());
                $this->view->add_data('settings',  $this->settings_tbl->viewSettings());
		$this->view->show_simple('view_xml', TRUE);
	}
	function json() {
		$this->load->model('gallery/settings_tbl');
                $this->view->add_data('row',  $this->gallery_xml->viewXML());
                $this->view->add_data('settings',  $this->settings_tbl->viewSettings());
                $this->view->show_simple('view_json', TRUE);
		
	}
}