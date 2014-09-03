<div class="box">
	<h2>
		Comments
	</h2>
	<?
		if(count($error_list) > 0 OR count($notice_list) > 0)
		{
	?>
			<table cellpadding="0" cellspacing="0" class="form_info">
				<tbody>
					<?
						foreach($error_list as $error)
						{
					?>
							<tr>
								<td class="error">
									<? echo $error; ?>
								</td>
							</tr>
					<?
						}
					?>
					<?
						foreach($notice_list as $notice)
						{
					?>
							<tr>
								<td class="notice">
									<? echo $notice; ?>
								</td>
							</tr>
					<?
						}
					?>
				</tbody>
			</table>

	<?
		}
	?>
	<?
		if($comment_list == FALSE)
		{
	?>
			<h3>
				No comments
			</h3>
	<?
		}
		else
		{
			foreach($comment_list['comment_list'] as $comment)
			{
	?>
				<div class="comment">
					<span class="user">
	<?
		if($comment['user_name'] == '')
		{
			if($comment['comment_author_website'] == '')
			{
				echo $comment['comment_author_name'];
			}
			else
			{
				echo anchor($comment['comment_author_website'], $comment['comment_author_name']);
			}
		}
		else
		{
			if($comment['user_website'] == '')
			{
				echo $comment['user_name'];
			}
			else
			{
				echo anchor($comment['user_website'], $comment['user_name']);
			}
		}
	?>
					</span> says in <? echo anchor('post/view/'.$comment['post_id'], $comment['post_title']); ?>:<br/>
					<? echo $comment['comment_date_create_formatted']; ?>
					<p class="comment_content">
						<? echo nl2br($comment['comment_content']); ?>
					</p>
					<hr/>
					<? echo anchor('admin/comment/edit/'.$comment['comment_id'], 'Edit'); ?> -
					<?
						if($comment['comment_is_approved'] == 0)
						{
							echo anchor('admin/comment/approve/'.$comment['comment_id'], 'Approve')." - ";
						}
					?>
					<?
						if($comment['comment_is_spam'] == 1)
						{
							echo anchor('admin/comment/unspam/'.$comment['comment_id'], 'Unspam')." - ";
						}
						else
						{
							echo anchor('admin/comment/spam/'.$comment['comment_id'], 'Spam')." - ";
						}
					?>
					<? echo anchor('admin/comment/delete/'.$comment['comment_id'], 'Delete'); ?>
				</div>
	<?
			}
	?>
			<div class="pagination">
				<? echo $this->pagination->create_links($comment_list['pagination_info']['page'], $comment_list['pagination_info']['page_count'], 'admin/comment/overview/');?>
			</div>
	<?
		}
	?>
</div>