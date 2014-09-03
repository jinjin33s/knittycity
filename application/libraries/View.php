<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class View
{
	var $root_view = 'template';
	var $CI = null;
	var $data = array();
	var $design_folder = '';
	var $css_list = array();
	var $js_list = array();

	function __construct()
	{
		$this->CI = &get_instance();
	}

	function set_root_view($view)
	{
		$this->root_view = $view;
	}

	function add_data($name, $data)
	{
		$this->data[$name] = $data;
	}

	function set_design_folder($folder)
	{
		$this->design_folder = $folder;
	}

	function add_css($file)
	{
		$this->css_list[] = $file;
	}

	function add_js($file)
	{
		$this->js_list[] = $file;
	}

	function show($page_title = '', $view_name = '', $debug = FALSE, $simple = FALSE, $add_data = TRUE)
	{
		if($simple == FALSE)
		{
			$this->add_data('page_title', $page_title);
			$this->add_data('view_name', $view_name);
			$this->add_data('error_list', $this->CI->message_storage->get_errors());
			$this->add_data('notice_list', $this->CI->message_storage->get_notices());
			$this->add_data('css_list', $this->css_list);
			$this->add_data('js_list', $this->js_list);
			if($debug)
			{
				echo "<pre>";
				print_r($this->data);
				echo "</pre>";
			}
			if($add_data == FALSE)
			{
				$this->CI->load->view($this->design_folder."/".$this->root_view);
			}
			else
			{
				$this->CI->load->view($this->design_folder."/".$this->root_view, $this->data);
			}
		}
		else
		{
			if($add_data == FALSE)
			{
				$this->CI->load->view($this->design_folder."/".$view_name);
			}
			else
			{
				$this->CI->load->view($this->design_folder."/".$view_name, $this->data);
			}
		}
	}


        function showtest($page_title = '', $view_name = '', $debug = FALSE, $simple = FALSE, $add_data = TRUE)
	{

		if($simple == FALSE)
		{            
			$this->add_data('page_title', $page_title);
			$this->add_data('view_name', $view_name);
			$this->add_data('error_list', $this->CI->message_storage->get_errors());
			$this->add_data('notice_list', $this->CI->message_storage->get_notices());
			$this->add_data('css_list', $this->css_list);
			$this->add_data('js_list', $this->js_list);
			if($debug)
			{
				echo "<pre>";
				print_r($this->data);
				echo "</pre>";
			}
			if($add_data == FALSE)
				{
				$this->CI->load->view($this->design_folder."/".$view_name);
			}
			else
			{
				$this->CI->load->view($this->design_folder."/".$view_name, $this->data);
			}
		}
		else
		{        
			if($add_data == FALSE)
			{                           
				$this->CI->load->view($this->design_folder."/".$view_name);
			}
			else
			{                          
				$this->CI->load->view($this->design_folder."/".$view_name, $this->data);
			}
		}

	}

        

        function show_knitty($page_title = '', $view_name = '', $template_name, $debug = FALSE, $simple = FALSE, $add_data = TRUE)
	{
		if($simple == FALSE)
		{
			$this->add_data('page_title', $page_title);
			$this->add_data('view_name', $view_name);
			$this->add_data('error_list', $this->CI->message_storage->get_errors());
			$this->add_data('notice_list', $this->CI->message_storage->get_notices());
			$this->add_data('css_list', $this->css_list);
			$this->add_data('js_list', $this->js_list);
                        $this->add_data('view_name', $view_name);

			if($debug)
			{
				echo "<pre>";
				print_r($this->data);
				echo "</pre>";
			}
			if($add_data == FALSE)
			{
				$this->CI->load->view($this->design_folder."/".$template_name);
			}
			else
			{
				$this->CI->load->view($this->design_folder."/".$template_name, $this->data);
			}
		}
		else
		{
			if($add_data == FALSE)
			{
				$this->CI->load->view($this->design_folder."/".$template_name);
			}
			else
			{
				$this->CI->load->view($this->design_folder."/".$template_name, $this->data);
			}
		}
	}

        function showSimpleGallery($page_title = '', $view_name = '', $template_name, $debug = FALSE, $simple = FALSE, $add_data = TRUE)
	{

		if($simple == FALSE)
		{
			$this->add_data('page_title', $page_title);
			$this->add_data('error_list', $this->CI->message_storage->get_errors());
			$this->add_data('notice_list', $this->CI->message_storage->get_notices());
			$this->add_data('css_list', $this->css_list);
			$this->add_data('js_list', $this->js_list);
                        $this->add_data('view_name', $view_name);

                        if($debug)
			{
				echo "<pre>";
				print_r($this->data);
				echo "</pre>";
			}
			if($add_data == FALSE)
			{
				$this->CI->load->view($this->design_folder."/".$template_name);
			}
			else
			{
				$this->CI->load->view($this->design_folder."/".$template_name, $this->data);
			}
		}
		else
		{
			if($add_data == FALSE)
			{
				$this->CI->load->view($this->design_folder."/".$template_name);
			}
			else
			{
				$this->CI->load->view($this->design_folder."/".$template_name, $this->data);
			}
		}
        }


	function showGallery($view_name = '', $add_data = FALSE)
	{
		$this->showSimpleGallery('', $view_name, 'template', FALSE, FALSE, $add_data);
	}

	function show_simple($view_name = '', $add_data = FALSE)
	{
		$this->show('', $view_name, FALSE, TRUE, $add_data);
	}

	function img_base_url($file_name)
	{
		return base_url('images/styles/'.$this->design_folder."/".$file_name);
	}
}