<?php
class Comment_model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

	function get_comment_list($page)
	{
		$total_comment_count = $this->db->count_all('comment');
		$pagination_info = $this->pagination->get_pagination_info($page, $total_comment_count, $this->config->item('config_comments_per_page'));

		$this->db->select('comment.*, user_name, user_email, user_website');
		$this->db->select('post_id, post_title');
		$this->db->select("DATE_FORMAT(comment_date_create, '".$this->config->item('config_date_time_format')."') AS comment_date_create_formatted", FALSE);
		$this->db->from('comment');
		$this->db->join('user', 'comment_author_user_id = user_id', 'left outer');
		$this->db->join('post', 'comment_post_id = post_id');
		$this->db->where('comment_is_approved', 0);
		$this->db->or_where('comment_is_spam', 1);
		$this->db->limit($this->config->item('config_comments_per_page'), (($pagination_info['page'] - 1) * $this->config->item('config_comments_per_page')));
		$result = $this->db->get();

		if($result->num_rows() > 0)
		{
			$comment_list = $result->result_array();
			return array('comment_list' => $comment_list, 'pagination_info' => $pagination_info);
		}
		else
		{
			return FALSE;
		}
	}

	function is_valid_comment($comment_id)
	{
		$this->db->where('comment_id', $comment_id);
		if($this->db->count_all_results('comment') > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function get_comment($comment_id)
	{
		$this->db->from('comment');
		$this->db->where('comment_id', $comment_id);
		$result = $this->db->get();

		if($result->num_rows() > 0)
		{
			return $result->row_array();
		}
		else
		{
			return FALSE;
		}
	}

	function edit($comment_id)
	{
		$this->db->set('comment_content', set_value('comment_content'));
		$this->db->set('comment_is_approved', set_value('comment_is_approved'));
		$this->db->where('comment_id', $comment_id);
		$this->db->update('comment');
	}

	function approve($comment_id)
	{
		$this->db->set('comment_is_approved', 1);
		$this->db->where('comment_id', $comment_id);
		$this->db->update('comment');
	}

	function unapprove($comment_id)
	{
		$this->db->set('comment_is_approved', 0);
		$this->db->where('comment_id', $comment_id);
		$this->db->update('comment');
	}

	function delete($comment_id)
	{
		$this->db->where('comment_id', $comment_id);
		$this->db->delete('comment');
	}

	function spam($comment_id)
	{
		$comment = $this->get_comment($comment_id);
		$spam_check = array(
							'comment_type' => 'comment',
							'comment_author' => $comment['comment_author_name'],
							'comment_author_email' => $comment['comment_author_email'],
							'comment_author_url' => $comment['comment_author_website'],
							'comment_content' => $comment['comment_content'],
							'permalink' => site_url('post/view/'.$comment['comment_post_id'])
						);
		if($comment['comment_author_user_id'] > 0)
		{
			$user = $this->auth->get_user($comment['comment_author_user_id']);
			$spam_check['comment_author'] = $user['user_name'];
			$spam_check['comment_author_url'] = $user['user_website'];
			$spam_check['comment_author_email'] = $user['user_email'];
		}
		// Call hook admin_comment_spam
		$this->modules->call_hook('admin_comment_spam', $spam_check, TRUE);

		$this->db->set('comment_is_spam', 1);
		$this->db->where('comment_id', $comment_id);
		$this->db->update('comment');
	}

	function unspam($comment_id)
	{
		$comment = $this->get_comment($comment_id);

		$spam_check = array(
							'comment_type' => 'comment',
							'comment_author' => $comment['comment_author_name'],
							'comment_author_email' => $comment['comment_author_email'],
							'comment_author_url' => $comment['comment_author_website'],
							'comment_content' => $comment['comment_content'],
							'permalink' => site_url('post/view/'.$comment['comment_post_id'])
						);
		if($comment['comment_author_user_id'] > 0)
		{
			$user = $this->auth->get_user($comment['comment_author_user_id']);
			$spam_check['comment_author'] = $user['user_name'];
			$spam_check['comment_author_url'] = $user['user_website'];
			$spam_check['comment_author_email'] = $user['user_email'];
		}
		// Call hook admin_comment_unspam
		$this->modules->call_hook('admin_comment_unspam', $spam_check, TRUE);

		$this->db->set('comment_is_spam', 0);
		$this->db->where('comment_id', $comment_id);
		$this->db->update('comment');
	}
}