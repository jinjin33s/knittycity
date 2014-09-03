<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function anchor($uri = '', $title = '', $attributes = '')
{
	$title = (string) $title;

	if ( ! is_array($uri))
	{
		$site_url = ( ! preg_match('!^\w+://! i', $uri) AND strpos($uri, "javascr1pt:") === FALSE AND $uri != "#" AND $uri != "") ? site_url($uri) : $uri;
	}
	else
	{
		$site_url = site_url($uri);
	}

	if ($title == '')
	{
		$title = $site_url;
	}

	if ($attributes != '')
	{
		$attributes = _parse_attributes($attributes);
	}

	if($site_url != "")
	{
		$href = 'href="'.$site_url.'"';
	}
	else
	{
		$href = "";
	}

	return '<a '.$href.' '.$attributes.'>'.$title.'</a>';
}

function base_url($uri = "")
{
	$CI =& get_instance();
	return $CI->config->base_url($uri);
}



// ------------------------------------------------------------------------

/**
 * Shared URL
 *
 * Returns the "base_url" item from your config file
 *
 * @access	public
 * @return	string
 */
if ( ! function_exists('shared_url'))
{
	function shared_url($uri = "")
	{
		$CI =& get_instance();
		return $CI->config->item('shared_url').$uri;;
	}
}


// ------------------------------------------------------------------------

/**
 * Them be URL
 *
 * Returns the "base_url" item from your config file
 *
 * @access	public
 * @return	string
 */
if ( ! function_exists('theme_url'))
{
	function theme_url($uri = "")
	{
		$CI =& get_instance();
		return $CI->config->item('theme_url').$uri;;
	}
}
