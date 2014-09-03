<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Daisy extends Controller {
  function Daisy(){
    parent::Controller();

  }



  function index(){
	$data['main_content'] = 'daisy_view';
	 //$this->load->view('calendar_home',$data);
	//$this->load->vars($data);
	$this->load->view('includes/template', $data);
  }

}

?>