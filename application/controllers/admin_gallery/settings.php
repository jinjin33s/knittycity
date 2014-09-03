<?php
class Settings extends Admin_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('gallery/settings_tbl');
                $this->view->set_design_folder($this->config->item('config_design_folder')."/admin");
		$loggedin = $this->auth->get_user_name();
		if(!$this->auth->is_logged_in())
		{
                    redirect('system/login');
		}
	}
	function index() {
                $this->view->add_data('rows', $this->settings_tbl->viewSettings());
		$this->view->show('Settings','gallery/settings_view');
	}
	function update() {
		$this->settings_tbl->updateSettings();
	}
}