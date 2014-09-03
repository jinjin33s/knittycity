<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Pagination extends CI_Pagination
{
	var $CI;

    function __construct()
    {
        $this->CI =& get_instance();
        parent::__construct();
    }

	function get_pagination_info($page, $entry_count, $entries_per_page = 5, $last = 0)
	{
                if($entries_per_page == 0) $entries_per_page = 5;
		$page_count = round($entry_count / $entries_per_page);
		if($page_count * $entries_per_page < $entry_count)
		{
			$page_count ++;
		}
		if(is_numeric($page))
		{
			if($page > $page_count)
			{
				$page = $page_count;
			}
			if($page <= 0)
			{
				$page = 1;
			}
		}
		else
		{
			$page = 1;
		}

		$pagination_info = array();
		$pagination_info['page'] = $page;
		$pagination_info['page_count'] = $page_count;
		return $pagination_info;
	}

	function create_links($page, $page_count, $base_url)
	{
		$top_page = false;
		$pagination = "";
		if($page == 1)
		{
			if($page_count >= 5)
			{
				for($i=1; $i <= 5; $i++)
				{
					if($i != $page)
					{
						$anchor = anchor($base_url.$i, $i);
					}
					else
					{
						$anchor = $i;
					}
					if($pagination == "")
					{
						$pagination = $anchor;
					}
					else
					{
						$pagination .= " ".$anchor;
					}
				}
				if($page_count > 5)
				{
					$top_page = false;
					for($i=$page+1; $i <= $page+10; $i++)
					{
						if($i <= $page_count)
						{
							$top_page = $i;
						}
					}
					if($top_page != false)
					{
						$anchor = anchor($base_url.$top_page, $top_page);
						$pagination .= " ".$anchor;
					}
				}
			}
			else
			{
				for($i=1; $i <= $page_count; $i++)
				{
					if($i != $page)
					{
						$anchor = anchor($base_url.$i, $i);
					}
					else
					{
						$anchor = $i;
					}
					if($pagination == "")
					{
						$pagination = $anchor;
					}
					else
					{
						$pagination .= " ".$anchor;
					}
				}
			}
		}
		else
		{
			for($i = $page-2; $i <= $page+2; $i++)
			{
				if($i <= $page_count)
				{
					if($i > 0)
					{
						if($i != $page)
						{
							$anchor = anchor($base_url.$i, $i);
						}
						else
						{
							$anchor = $i;
						}
						if($pagination == "")
						{
							$pagination = $anchor;
						}
						else
						{
							$pagination .= " ".$anchor;
						}
					}
				}
			}
			$top_page = false;
			for($i=$page+3; $i <= $page+10; $i++)
			{
				if($i <= $page_count)
				{
					$top_page = $i;
				}
			}
			if($top_page != false)
			{
				$anchor = anchor($base_url.$top_page, $top_page);
				$pagination .= " ".$anchor;
			}
			$min_page = false;
			for($i=$page-10; $i <= $page-3; $i++)
			{
				if($i > 0 && $min_page == false)
				{
					$min_page = $i;
				}
			}
			if($min_page != false)
			{
				$anchor = anchor($base_url.$min_page, $min_page);
				$pagination = $anchor." ".$pagination;
			}
		}
		if($page > 1)
		{
			$previous_page = $page - 1;
			$previous = anchor($base_url.$previous_page, '<');
			$pagination = $previous." ".$pagination;
		}
		if($page < $page_count)
		{
			$next_page = $page + 1;
			$next = anchor($base_url.$next_page, '>');
			$pagination .= " ".$next;
		}
		if($page > 1 && $min_page > 1)
		{
			$first = anchor($base_url."1", 'First');
			$pagination = $first." ".$pagination;
		}
		if($page < $page_count && $top_page < $page_count)
		{
			$last = anchor($base_url.$page_count, 'Last');
			$pagination .= " ".$last;
		}
		return 'Page: '.$pagination;
	}
}

?>