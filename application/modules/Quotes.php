<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Quotes
{
	var $quotes_list = array();

	var $module_version = '0.1';
	var $module_name = 'Quotes';
	var $module_description = '';

	function __construct($config = FALSE)
	{
		if(is_array($config))
		{
			$this->init($config);
		}
	}

	function init($config)
	{
		foreach($config as $key => $value)
		{
			$method = "set_$key";
			$this->$method($value);
		}
	}

	function set_quotes_list($value)
	{
		$this->quotes_list = $value;
	}

	function quotes_css()
	{
		echo "
		<style type='text/css'>
			#quote_module
			{
				color: red;
				font-weight: bold;
				float: right;
			}
		</style>
		";
	}

	function get_quote()
	{
		echo "<div id='quote_module'>".$this->quotes_list[mt_rand(0, count($this->quotes_list)-1)]."</div>";
	}

	function get_actions()
	{
		return array('admin_view_head' => 'quotes_css', 'admin_view_top_bar' => 'get_quote');
	}

	function get_info()
	{
		return array('module_name' => $this->module_name, 'module_description' => $this->module_description, 'module_version' => $this->module_version, 'module_url' => 'http://www.davidbehler.de');
	}
}