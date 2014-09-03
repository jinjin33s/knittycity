<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This library can be used to create tag clouds, either as plain text lists or as a list with font size of the tags depending on each tags count
 *
 */
class Cloud
{
	var $CI = null;
	var $tags = array();
	var $min_count = -1;
	var $max_count = -1;

	/**
	 * Constructor
	 *
	 * @param array $config
	 * @return Cloud
	 */
	function Cloud($config = array())
	{
		$this->CI =& get_instance();
		if (count($config) > 0)
		{
			$this->initialize($config);
		}
	}

	/**
	 * Initialize config according to config set in config/cloud.php
	 *
	 * @param array $config
	 */
	function initialize($config = array())
	{
		$this->clear();
		foreach ($config as $key => $val)
		{
			if (isset($this->$key))
			{
				$method = 'set_'.$key;

				if (method_exists($this, $method))
				{
					$this->$method($val);
				}
				else
				{
					$this->$key = $val;
				}
			}
		}
	}

	/**
	 * Clear config
	 *
	 */
	function clear()
	{
		$this->tags = array();
		$this->min_count = -1;
		$this->max_count = -1;
	}

	/**
	 * Add a tag to the list
	 *
	 * @param string $tag
	 * @param number $count
	 * @param string $url
	 * @return boolean
	 */
	function add_tag($tag = '', $count = 0, $url = '')
	{
		if($tag == '')
		{
			return FALSE;
		}
		else
		{
			if(is_array($tag))
			{
				foreach($tag as $tag_item)
				{
					$this->add_tag($tag_item['name'], $tag_item['count'], $tag_item['url']);
				}
			}
			else
			{
				$next_tag_index = count($this->tags);
				$this->tags[$next_tag_index] = array();
				$this->tags[$next_tag_index]['name'] = $tag;
				if(!is_numeric($count))
				{
					$count = 0;
				}
				if($this->min_count > $count OR $this->min_count == -1)
				{
					$this->min_count = $count;
				}
				if($this->max_count < $count OR $this->max_count == -1)
				{
					$this->max_count = $count;
				}
				$this->tags[$next_tag_index]['count'] = $count;
				$this->tags[$next_tag_index]['url'] = $url;
			}
			return TRUE;
		}
	}

	/**
	 * Get a plain list of tags seperated by the delimiter parameter. Depending on the other 2 parameters the tags are linked and/or shuffled.
	 *
	 * @param string $delimiter
	 * @param boolean $link_tags
	 * @param boolean $shuffle
	 * @return mixed
	 */
	function get_plain_list($delimiter = ', ', $link_tags = TRUE, $shuffle = FALSE)
	{
		if(count($this->tags) == 0)
		{
			return FALSE;
		}
		else
		{
			$list = "";
			$tags = $this->tags;
			if($shuffle)
			{
				shuffle($tags);
			}
			foreach($tags as $tag)
			{
				if($link_tags)
				{
					if($tag['url'] != '')
					{
						$name = anchor($tag['url'], $tag['name']);
					}
					else
					{
						$name = $tag['name'];
					}
				}
				else
				{
					$name = $tag['name'];
				}
				if($list == "")
				{
					$list = $name;
				}
				else
				{
					$list .= $delimiter.$name;
				}
			}
			return $list;
		}
	}

	/**
	 * Enter description here...
	 *
	 * @param string $delimiter
	 * @param boolean $link_tags
	 * @param boolean $shuffle
	 * @return mixed
	 */
	function get_cloud($delimiter = ', ', $link_tags = TRUE, $shuffle = FALSE)
	{
		if(count($this->tags) == 0)
		{
			return FALSE;
		}
		else
		{

			if(count($this->tags) <= 10)
			{
				$last_count = 0;
				$last_class = count($this->tags) + 1;
				foreach($this->tags as $key => $value)
				{
					if($last_class > 1)
					{
						if($value['count'] != $last_count)
						{
							$last_class = $last_class - 1;
							$last_count = $value['count'];
						}
						$this->tags[$key]['class'] = "cloud-".($last_class);
					}
					else
					{
						$this->tags[$key]['class'] = "cloud-1";
					}
				}
			}
			else
			{
				foreach($this->tags as $key => $value)
				{
					$last_count = 0;
					$last_class = 11;
					if($last_class > 1)
					{
						if($value['count'] != $last_count)
						{
							$last_class = $last_class - 1;
							$last_count = $value['count'];
						}
						$this->tags[$key]['class'] = "cloud-".($last_class);
					}
					else
					{
						$this->tags[$key]['class'] = "cloud-1";
					}
				}
			}

			$cloud = "";
			$tags = $this->tags;
			if($shuffle)
			{
				shuffle($tags);
			}
			foreach($tags as $tag)
			{
				if($link_tags)
				{
					if($tag['url'] != '')
					{
						$name = anchor($tag['url'], $tag['name']);
					}
					else
					{
						$name = $tag['name'];
					}
				}
				else
				{
					$name = $tag['name'];
				}

				$name = "<span class='".$tag['class']."'>".$name."</span>";

				if($cloud == "")
				{
					$cloud = $name;
				}
				else
				{
					$cloud .= $delimiter.$name;
				}
			}
			return $cloud;
		}
	}
}
