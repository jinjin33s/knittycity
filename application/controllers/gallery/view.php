<?php
class View extends Controller {
	function View() {
		parent::Controller();
		$this->load->model('gallery/gallery_xml');
	}
	function index() {
		$data['row'] = $this->gallery_xml->viewXML();
		$this->load->model('gallery/settings_tbl');
		$data['settings'] = $this->settings_tbl->viewSettings();
		$this->view->showGallery('view_xml', $data);
	}
	function xml() {
		$data['row'] = $this->gallery_xml->viewXML();
		$this->load->model('gallery/settings_tbl');
		$data['settings'] = $this->settings_tbl->viewSettings();
		$this->view->showGallery('view_xml', $data);
	}
	function json() {
		$data['row'] = $this->gallery_xml->viewXML();
		$this->load->model('gallery/settings_tbl');
		$data['settings'] = $this->settings_tbl->viewSettings();
		$this->view->showGallery('view_json', $data);
	}
}