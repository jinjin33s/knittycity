	<channel>
		<title><? echo $this->config->item('config_blog_title')." - RSS Feed - ".$page_title; ?></title>
		<link><? echo site_url(); ?></link>
		<description><? echo $description; ?></description>
		<language>en-en</language>
		<copyright><? echo $this->config->item('config_owner_name'); ?></copyright>
		<? 	if($post_list != FALSE)
			{
				foreach($post_list['post_list'] as $post)
				{
		?>
					<item>
						<title><? echo $post['post_title']; ?></title>
						<description><? if($post['post_excerpt'] == '') { echo htmlspecialchars($post['post_content']); }else{ echo htmlspecialchars($post['post_excerpt']); } ?></description>
						<link><? echo site_url('post/view/'.$post['post_id']); ?></link>
						<author><? echo $post['user_name']; ?>, <? echo $this->config->item('config_owner_email'); ?></author>
						<guid><? echo $post['post_id']; ?></guid>
					</item>
		<?
				}
			}
		?>
	</channel>