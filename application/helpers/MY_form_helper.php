<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	function unprep_for_form($value)
	{
		return str_replace(array("&#39;", "&quot;", '&lt;', '&gt;'), array("'", '"', '<', '>'), $value);
	}

	function form_open($action = '', $attributes = '', $hidden = array())
	{
		$CI =& get_instance();

		if ($attributes == '')
		{
			$attributes = 'method="post"';
		}

		$action = ( strpos($action, '://') === FALSE) ? ((strpos($action, 'javascript:') === FALSE) ? $CI->config->site_url($action): $action) : $action;

		$form = '<form action="'.$action.'"';

		$form .= _attributes_to_string($attributes, TRUE);

		$form .= '>';

		if (is_array($hidden) AND count($hidden) > 0)
		{
			$form .= form_hidden($hidden);
		}

		return $form;
	}