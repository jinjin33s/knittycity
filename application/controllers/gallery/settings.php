<?php
class Settings extends Controller {
	function Settings() {
		parent::Controller();
		$this->load->model('gallery/settings_tbl');
                $this->view->set_design_folder($this->config->item('config_design_folder')."/".'gallery');
		$loggedin = $this->auth->get_user_name();
		if(!$this->auth->is_logged_in())
		{
                    redirect('system/login');
		}
	}
	function index() {
		$data['rows'] = $this->settings_tbl->viewSettings();
		$this->view->showGallery('settings_view', $data);
	}
	function update() {
		$this->settings_tbl->updateSettings();
	}
}