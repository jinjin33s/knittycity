<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Akismet
{
	var $CI;
	var $user_agent;
	var $api_key;
	var $key_is_valid = FALSE;
	var $akismet_server = "rest.akismet.com";
	var $akismet_version = "1.1";

	function __construct($config = FALSE)
	{
		$this->CI =&get_instance();
		$this->user_agent = "DBlog/".$this->CI->config->item('dblog_version')." | Akismet/1.11";
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

	function is_valid_api_key()
	{
		$post_values = array('key' => $this->api_key, 'blog' => site_url());
		$response = $this->request($this->_create_query_string($post_values), $this->akismet_server, '/'.$this->akismet_version.'/verify-key');
		$this->key_is_valid = $response[1] == 'valid';
	}

	function comment_is_spam($comment)
	{
		if($this->key_is_valid)
		{
			$post_values = array(
								'blog' => site_url(),
								'user_ip' =>  $this->CI->input->ip_address(),
								'user_agent' => $this->CI->input->user_agent(),
								'referrer' => $this->CI->input->server('HTTP_REFERER'),
								'comment_type' => $comment['comment_type'],
								'comment_author' => $comment['comment_author'],
								'comment_author_email' => $comment['comment_author_email'],
								'comment_author_url' => $comment['comment_author_url'],
								'comment_content' => $comment['comment_content'],
								'permalink' => $comment['permalink']
								);
			$response = $this->request($this->_create_query_string($post_values), $this->api_key.".".$this->akismet_server, '/'.$this->akismet_version.'/comment-check');

			return $response[1] == 'true';
		}
		else
		{
			log_message('error', 'The Wordpress API key passed to the Akismet library is invalid.  Please obtain a valid one from http://wordpress.com/api-keys/');
			return FALSE;
		}
	}

	function submit_spam($comment)
	{
		$post_values = array(
							'blog' => site_url(),
							'user_ip' =>  $this->CI->input->ip_address(),
							'user_agent' => $this->CI->input->user_agent(),
							'referrer' => $this->CI->input->server('HTTP_REFERER'),
							'comment_type' => $comment['comment_type'],
							'comment_author' => $comment['comment_author'],
							'comment_author_email' => $comment['comment_author_email'],
							'comment_author_url' => $comment['comment_author_url'],
							'comment_content' => $comment['comment_content'],
							'permalink' => $comment['permalink']
							);
		$this->request($this->_create_query_string($post_values), $this->api_key.".".$this->akismet_server, '/'.$this->akismet_version.'/submit-spam');
	}

	function submit_ham($comment)
	{
		$post_values = array(
							'blog' => site_url(),
							'user_ip' =>  $this->CI->input->ip_address(),
							'user_agent' => $this->CI->input->user_agent(),
							'referrer' => $this->CI->input->server('HTTP_REFERER'),
							'comment_type' => $comment['comment_type'],
							'comment_author' => $comment['comment_author'],
							'comment_author_email' => $comment['comment_author_email'],
							'comment_author_url' => $comment['comment_author_url'],
							'comment_content' => $comment['comment_content'],
							'permalink' => $comment['permalink']
							);
		$this->request($this->_create_query_string($post_values), $this->api_key.".".$this->akismet_server, '/'.$this->akismet_version.'/submit-ham');
	}

	function request($query_string, $host, $path, $port = 80)
	{
		$request  = "POST $path HTTP/1.0\r\n";
		$request .= "Host: $host\r\n";
		$request .= "Content-Type: application/x-www-form-urlencoded; charset=utf-8\r\n";
		$request .= "Content-Length: " . strlen($query_string) . "\r\n";
		$request .= "User-Agent: ".$this->user_agent."\r\n";
		$request .= "\r\n";
		$request .= $query_string;

		$response = '';
		if(false !== ($fs = @fsockopen($host, $port, $errno, $errstr, 3)))
		{
			fwrite($fs, $request);
			while ( !feof($fs) )
			$response .= fgets($fs, 1160);
			fclose($fs);
			$response = explode("\r\n\r\n", $response, 2);
		}
		return $response;
	}

	function _create_query_string($post_value)
	{
		$query_string = "";
		foreach($post_value as $key => $value)
		{
			if($query_string == "")
			{
				$query_string = $key."=".urlencode($value);
			}
			else
			{
				$query_string .= "&".$key."=".urlencode($value);
			}
		}
		return $query_string;
	}

	function set_api_key($key)
	{
		$this->api_key = $key;
		$this->is_valid_api_key();
	}

	function set_akismet_server($server)
	{
		$this->akismet_server = $server;
	}

	function set_akismet_version($version)
	{
		$this->akismet_version = $version;
	}

}