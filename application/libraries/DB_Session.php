<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

// ------------------------------------------------------------------------

/**
 * Session Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Sessions
 * @author		Dready
 * @inpiredFrom Session class by Rick Ellis
 * @inspireFrom Native_Session by Dariusz Debowczyk
 * @link		http://dready.jexiste.fr/dotclear/index.php?2006/09/13/19-reworked-session-handler-for-code-igniter
 */
class DB_Session {

	var $now;
	var $encryption		= TRUE;
	var $use_database	= FALSE;
	var $session_table	= FALSE;
	var $sess_length	= 7200;
	var $sess_cookie	= 'session';
	var $userdata		= array();
	var $gc_probability	= 5;
	var $cookie_sent	= FALSE;
	var $object;
	var $flashdata 		= array();

	/**
	 * Session Constructor
	 *
	 * The constructor runs the session routines automatically
	 * whenever the class is instantiated.
	 */
	function __construct()
	{
		$this->object =& get_instance();
		log_message('debug', "Session Class Initialized (db)");
		$this->sess_run();
	}

	// --------------------------------------------------------------------

	/**
	 * Run the session routines
	 *
	 * @access	public
	 * @return	void
	 */
	function sess_run()
	{

		// We MUST use a database !
		if ($this->object->config->item('sess_use_database') === TRUE AND $this->object->config->item('sess_table_name') != '')
		{
			$this->use_database = TRUE;
			$this->session_table = $this->object->config->item('sess_table_name');
			$this->object->load->database();
		} else {
			log_message('error',__CLASS__.': sessions requires a database');
			return FALSE;
		}


		/*
		 *  Set the "now" time
		 *
// 		 * It can either set to GMT or time(). The pref
		 * is set in the config file.  If the developer
		 * is doing any sort of time localization they
		 * might want to set the session time to GMT so
		 * they can offset the "last_activity" and
		 * "last_visit" times based on each user's locale.
		 *
		 */
		if (strtolower($this->object->config->item('time_reference')) == 'gmt')
		{
			$now = time();
			$this->now = mktime(gmdate("H", $now), gmdate("i", $now), gmdate("s", $now), gmdate("m", $now), gmdate("d", $now), gmdate("Y", $now));

			if (strlen($this->now) < 10)
			{
				$this->now = time();
				log_message('error', 'The session class could not set a proper GMT timestamp so the local time() value was used.');
			}
		}
		else
		{
			$this->now = time();
		}

		/*
		 *  Set the session length
		 *
		 * If the session expiration is set to zero in
		 * the config file we'll set the expiration
		 * two years from now.
		 *
		 */
		$expiration = $this->object->config->item('sess_expiration');

		if (is_numeric($expiration))
		{
			if ($expiration > 0)
			{
				$this->sess_length = $this->object->config->item('sess_expiration');
			}
			else
			{
				$this->sess_length = (60*60*24*365*2);
			}
		}

		// Set the cookie name
		if ($this->object->config->item('sess_cookie_name') != FALSE)
		{
			$this->sess_cookie = $this->object->config->item('cookie_prefix').$this->object->config->item('sess_cookie_name');
		}

		/*
		 *  Fetch the current session
		 *
		 * If a session doesn't exist we'll create
		 * a new one.  If it does, we'll update it.
		 *
		 */
		if ( ! $this->sess_read())
		{
			$this->sess_create();
		}
		else
		{
			// We only update the session every five minutes
			if (($this->userdata['session_last_activity'] + 300) < $this->now)
			{
				$this->sess_update();
			}
		}

		// Delete expired sessions if necessary
		$this->sess_gc();
		/*
		// delete old flashdata (from last request)
		echo "pure: <pre>";
		print_r($this->userdata);
		echo "</pre><br/>";
    	$this->_flashdata_sweep();

    	// mark all new flashdata as old (data will be deleted before next request)
    	echo "after sweep: <pre>";
    	print_r($this->userdata);
    	echo "</pre><br/>";
    	$this->_flashdata_mark();
    	echo "after mark: <pre>";
    	print_r($this->userdata);
    	echo "</pre><br/>";
    	*/

		$this->_flashdata_sweep();
		$this->_flashdata_mark();
	}
	// END sess_run()

	// --------------------------------------------------------------------

	/**
	 * Fetch the current session data if it exists
	 *
	 * @access	public
	 * @return	void
	 */
	function sess_read()
	{
		// Fetch the cookie
		$session_id = $this->object->input->cookie($this->sess_cookie);

		if ($session_id === FALSE)
		{
			log_message('debug', 'A session cookie was not found.');
			return FALSE;
		}

		// Is there a corresponding session in the DB?
		$this->object->db->where('session_id', $session_id);
		// session should not have expired
		$this->object->db->where('session_last_activity >', ($this->now - $this->sess_length) );
		// matching IP ?
		if ($this->object->config->item('sess_match_ip') == TRUE)
		{
			$this->object->db->where('session_ip_address', $this->object->input->ip_address());
		}
		// matching user agent ?
		if ($this->object->config->item('sess_match_useragent') == TRUE)
		{
			$this->object->db->where('session_user_agent', substr($this->object->input->user_agent(), 0, 50));
		}

		$query = $this->object->db->get($this->session_table);

		if ($query->num_rows() == 0)
		{
			$this->sess_destroy();
			return FALSE;
		}
		else
		{
			$row = $query->row();
			if (($row->session_last_activity + $this->sess_length) < $this->now)
			{
				$this->object->db->where('session_id', $session_id);
				$this->object->db->delete($this->session_table);
				$this->sess_destroy();
				return FALSE;
			} else {
				$session = @unserialize($row->session_data);
				if ( ! is_array($session) ) {
					$session = array();
				}
				$session['session_id'] = $session_id;
				$session['session_ip_address'] = $row->session_ip_address;
				$session['session_user_agent'] = $row->session_user_agent;
				$session['session_last_activity'] = $row->session_last_activity;
			}
		}


		// Session is valid!
		$this->userdata = $session;
		unset($session);

		return TRUE;
	}
	// END sess_read()

	// --------------------------------------------------------------------

	/**
	 * Write the session cookie
	 *
	 * @access	public
	 * @param	boolean true if we want to send cookie even if a cookie has already been sent
	 * @return	void
	 */
	function sess_send_cookie($force = FALSE)
	{
		if ( !$force && $this->cookie_sent )	return;
		log_message('debug','sending session cookie');
		setcookie(
					$this->sess_cookie,
					$this->userdata['session_id'],
					$this->sess_length + $this->now,
					$this->object->config->item('cookie_path'),
					$this->object->config->item('cookie_domain'),
					0
				);
		//log_message('debug', "Cookie set: ".$this->sess_cookie);
		$this->cookie_sent = TRUE;
	}
	// END sess_send_cookie()

	// --------------------------------------------------------------------

	/**
	 * Create a new session
	 *
	 * @access	public
	 * @return	void
	 */
	function sess_create()
	{
		$sessid = '';
		while (strlen($sessid) < 32)
		{
			$sessid .= mt_rand(0, mt_getrandmax());
		}

		$this->userdata = array(
							'session_id' 	=> md5(uniqid($sessid, TRUE)),
							'session_ip_address' 	=> $this->object->input->ip_address(),
							'session_user_agent' 	=> substr($this->object->input->user_agent(), 0, 50),
							'session_last_activity'	=> $this->now
							);

		$this->object->db->query($this->object->db->insert_string($this->session_table, $this->userdata));

		// Write the cookie
		$this->sess_send_cookie();
	}
	// END sess_create()

	// --------------------------------------------------------------------

	/**
	 * Update an existing session
	 *
	 * @access	public
	 * @return	void
	 */
	function sess_update()
	{
		$this->userdata['session_last_activity'] = $this->now;
		// format query array to update database
		$ud = $this->userdata;
		$query_array = array('session_last_activity' => $ud['session_last_activity'],
					'session_user_agent'    => $ud['session_user_agent'],
					'session_ip_address'    => $ud['session_ip_address'] );
		unset($ud['session_id']);
		unset($ud['session_last_activity']);
		unset($ud['session_user_agent']);
		unset($ud['session_ip_address']);
		$query_array['session_data'] = serialize($ud);
		$this->object->db->query($this->object->db->update_string($this->session_table, $query_array, array('session_id' => $this->userdata['session_id'])));

		// Write the cookie
		$this->sess_send_cookie();
	}
	// END sess_update()

	// --------------------------------------------------------------------

	/**
	 * Destroy the current session
	 *
	 * @access	public
	 * @return	void
	 */
	function sess_destroy()
	{
		setcookie(
					$this->sess_cookie,
					'',
					($this->now - 31500000),
					$this->object->config->item('cookie_path'),
					$this->object->config->item('cookie_domain'),
					0
				);
		log_message('debug', "Cookie destroyed: ".$this->sess_cookie);
	}
	// END sess_destroy()

	// --------------------------------------------------------------------

	/**
	 * Garbage collection
	 *
	 * This deletes expired session rows from database
	 * if the probability percentage is met
	 *
	 * @access	public
	 * @return	void
	 */
    function sess_gc()
    {
		srand(time());
		if ((rand() % 100) < $this->gc_probability)
		{
			$expire = $this->now - $this->sess_length;
			$this->object->db->where("session_last_activity < {$expire}");
			$result = $this->object->db->get($this->session_table);
			$sessions = $result->result_array();
			foreach($sessions as $key=>$value)
			{
				$session_id = $value['session_id'];
				$this->object->db->where("session_id",$session_id);
				$this->object->db->delete($this->session_table);
			}
			log_message('debug', 'Session garbage collection performed.');
		}
    }
	// END sess_gc()

	// --------------------------------------------------------------------

	/**
	 * Fetch a specific item form  the session array
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function userdata($item = '')
	{
	if ( ! strlen($item) )	return $this->userdata;
    	return ( ! isset($this->userdata[$item])) ? FALSE : $this->userdata[$item];
	}
	// END userdata()

	// --------------------------------------------------------------------

	/**
	 * Add or change data in the "userdata" array
	 *
	 * @access	public
	 * @param	mixed
	 * @param	string
	 * @return	void
	 */
	function set_userdata($newdata = array(), $newval = '')
	{
		if (is_string($newdata))
		{
			$newdata = array($newdata => $newval);
		}

		if (count($newdata) > 0)
		{
			foreach ($newdata as $key => $val)
			{
				$this->userdata[$key] = $val;
			}
		}

    	$this->sess_update();
	}
	// END set_userdata()

	// --------------------------------------------------------------------

	/**
	 * Delete a session variable from the "userdata" array
	 *
	 * @access	array
	 * @return	void
	 */
	function unset_userdata($newdata = array())
	{
		if (is_string($newdata))
		{
			$newdata = array($newdata => '');
		}

		if (count($newdata) > 0)
		{
			foreach ($newdata as $key => $val)
			{
				unset($this->userdata[$key]);
			}
		}

    	$this->sess_update();
	}
	// END unset_userdata()


    /**
    * Sets "flash" data which will be available only in next request (then it will
    * be deleted from session). You can use it to implement "Save succeeded" messages
    * after redirect.
    */
    function set_flashdata($key, $value)
    {
    	if(isset($this->flashdata[$key]))
    	{
    		$this->flashdata[$key][] = $value;
    	}
    	else
    	{
    		$this->flashdata[$key] = array($value);
    	}
        $this->set_userdata('flashdata:new', $this->flashdata);
    	$this->sess_update();
    }

    /**
    * Keeps existing "flash" data available to next request.
    */
    function keep_flashdata($key)
    {
    	$old_flashdata = $this->userdata('flashdata:old');
        $value = $old_flashdata[$key];

        $this->set_flashdata($key, $value);
    }

    /**
    * Returns "flash" data for the given key.
    */
    function flashdata($key)
    {
    	$flashdata = $this->userdata('flashdata:old');
    	if(isset($flashdata[$key]))
    	{
    		return $flashdata[$key];
    	}
    	else
    	{
    		return FALSE;
    	}
    }

    /**
    * PRIVATE: Internal method - marks "flash" session attributes as 'old'
    */
    function _flashdata_mark()
    {
		$flashdata = $this->userdata('flashdata:new');
		$this->set_userdata('flashdata:old', $flashdata);
		$this->unset_userdata('flashdata:new');
    }

    /**
    * PRIVATE: Internal method - removes "flash" session marked as 'old'
    */
    function _flashdata_sweep()
    {
		$this->unset_userdata('flashdata:old');
    }

    function get_session_id()
    {
    	return $this->userdata['session_id'];
    }

	// --------------------------------------------------------------------
}
// END DB_Session Class

/*
CREATE TABLE IF NOT EXISTS  `session` (
session_id varchar(40) DEFAULT '0' NOT NULL,
session_ip_address varchar(16) DEFAULT '0' NOT NULL,
session_user_agent varchar(50) NOT NULL,
session_last_activity int(10) unsigned DEFAULT 0 NOT NULL,
session_data text default '' not null,
PRIMARY KEY (session_id)
);
*/

?>