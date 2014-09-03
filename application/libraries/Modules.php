<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Modules
{
	var $CI;
	var $modules = array();
	var $actions = array();

	function __construct()
	{
		$this->CI =& get_instance();
		$this->register_modules();
	}

	function register_modules()
	{
		$this->CI->load->helper('file');
		$module_list = array();
		$modules_folder = APPPATH.'modules/';
		$handle = opendir($modules_folder);
		while ($file = readdir ($handle))
		{
			if($file != "." && $file != "..")
			{
				if(!is_dir($modules_folder."/".$file))
				{
					$name = explode('.', $file);
					if($name[1] == 'php')
					{
						$module_list[] = $name[0];
					}
				}
			}
		}
		$registered_modules = $this->get_registered_modules();
		foreach($module_list as $module)
		{
			require_once(APPPATH.'modules/'.$module.'.php');
			if(file_exists(APPPATH.'modules/config/'.$module.'.php'))
			{
				require_once(APPPATH.'modules/config/'.$module.'.php');
				$this->$module = new $module($config);
				unset($config);
			}
			else
			{
				$this->$module = new $module();
			}
			$module_info = $this->$module->get_info();
			$module_info['module_file_name'] = $module.'.php';
			if(isset($registered_modules[$module.'.php']))
			{
				$this->update_module($module_info);
				if($registered_modules[$module.'.php']['module_is_active'] == 1)
				{
					$actions = $this->$module->get_actions();
					foreach($actions as $hook => $function)
					{
						$this->actions[$hook][] = array('module' => $module, 'function' => $function);
					}
				}
			}
			else
			{
				$this->register_module($module_info);
			}
		}
	}

	function call_hook($hook, $param = FALSE, $default = null)
	{
		if(isset($this->actions[$hook]))
		{
			$result = $default;
			foreach($this->actions[$hook] as $action)
			{
				$result = $this->$action['module']->$action['function']($param, $result);
			}
			return $result;
		}
		else
		{
			return $default;
		}
	}

	function get_registered_modules()
	{
		$result = $this->CI->db->get('module');
		if($result->num_rows() > 0)
		{
			$rows = $result->result_array();
			$modules = array();
			foreach($rows as $key => $value)
			{

				$modules[$value['module_file_name']] = $value;
			}
			return $modules;
		}
		else
		{
			return FALSE;
		}
	}

	function register_module($module_info)
	{
		$this->CI->db->set('module_name', $module_info['module_name']);
		$this->CI->db->set('module_description', $module_info['module_description']);
		$this->CI->db->set('module_version', $module_info['module_version']);
		$this->CI->db->set('module_is_active', 0);
		$this->CI->db->set('module_file_name', $module_info['module_file_name']);
		$this->CI->db->set('module_url', $module_info['module_url']);
		$this->CI->db->insert('module');
	}

	function update_module($module_info)
	{
		$this->CI->db->set('module_name', $module_info['module_name']);
		$this->CI->db->set('module_description', $module_info['module_description']);
		$this->CI->db->set('module_version', $module_info['module_version']);
		$this->CI->db->set('module_url', $module_info['module_url']);
		$this->CI->db->where('module_file_name', $module_info['module_file_name']);
		$this->CI->db->update('module');
	}
}