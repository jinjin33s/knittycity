						<h1><? echo $post['post_title']; ?></h1>
						<h3>
							<? echo $post['post_date_create_formatted']; ?> by <? echo $post['user_name']; ?>
						</h3>
						<h3>
							Posted in
							<?	if($post['category_list'] == FALSE)
								{
									echo "No category";
								}
								else
								{
									$categories = "";
									foreach($post['category_list'] as $category)
									{
										if($categories != "")
										{
											$categories .= ", ".anchor('category/view/'.$category['category_id'], $category['category_name']);
										}
										else
										{
											$categories = anchor('category/view/'.$category['category_id'], $category['category_name']);
										}
									}
									echo $categories;
								}
							?>
						</h3>
						<? echo $post['post_content']; ?>
						<?
							if($this->config->item('config_show_social_bookmarking_links'))
							{
						?>
								<p>
									<a href="http://digg.com/submit?url=<?php echo urlencode(site_url('post/view/'.$post['post_id'])); ?>&amp;title=<?php echo urlencode($post['post_title']); ?>"><img src="<?php echo $this->view->img_base_url('digg.jpg'); ?>" alt="submit to digg" class="no-border" /> </a>
									<a href="http://www.reddit.com/submit?url=<?php echo urlencode(site_url('post/view/'.$post['post_id'])); ?>"> <img src="http://www.reddit.com/static/spreddit1.gif" alt="submit to reddit" class="no-border" /> </a>
									<a href="http://www.stumbleupon.com/submit?url=<?php echo urlencode(site_url('post/view/'.$post['post_id'])); ?>&amp;title=<?php echo urlencode($post['post_title']); ?>"> <img border=0 src="http://cdn.stumble-upon.com/images/24x24_su.gif" class="no-border" /></a>
									<a href="http://delicious.com/save?v=5&amp;noui&amp;jump=close&amp;url=<?php echo urlencode(site_url('post/view/'.$post['post_id'])); ?>&amp;title=<?php echo urlencode($post['post_title']); ?>"><img src="http://static.delicious.com/img/delicious.small.gif" height="10" width="10" alt="Delicious" class="no-border" /></a>
								</p>
						<?
							}
						?>
						<p>
							Tags:
							<?	if($post['tag_list'] == FALSE)
								{
									echo "No tags";
								}
								else
								{
									$tags = "";
									foreach($post['tag_list'] as $tag)
									{
										if($tags != "")
										{
											$tags .= ", ".anchor('tag/view/'.$tag['tag_id'], $tag['tag_name']);
										}
										else
										{
											$tags = anchor('tag/view/'.$tag['tag_id'], $tag['tag_name']);
										}
									}
									echo $tags;
								}
							?>
						</p>
						<h2>
							Trackbacks
						</h2>
						<?
							if($post['trackback_list'] == FALSE)
							{
								echo "No trackbacks";
							}
							else
							{
								echo "<ul>";
								foreach($post['trackback_list'] as $trackback)
								{
									echo "<li>";
									echo anchor($trackback['trackback_url'], $trackback['trackback_title']);
									if($trackback['trackback_blog_name'] != '')
									{
										echo " | ".$trackback['trackback_blog_name'];
									}
									echo " | ".$trackback['trackback_date_added_formatted'];
									echo "</li>";
								}
								echo "</ul>";
							}
						?>
						<br/>
						Leave a <? echo anchor('post/trackback/'.$post['post_id'], 'trackback', array('rel' => 'nofollow')); ?> from your own site.
						<h2>
							Comments
						</h2>
							<a name="comments"></a>
							<?	if($post['comment_list'] == FALSE)
								{
							?>
									<h3>
										No comments
									</h3>
							<?
								}
								else
								{
									foreach($post['comment_list'] as $comment)
									{
							?>			<div class="comment">
											<p>
												<strong>
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
												</strong> says:<br/>
												<a name="comment-<? echo $comment['comment_id']; ?>"></a>
												<? echo anchor('post/view/'.$post['post_id']."/".$comment['comment_id']."/#comment-".$comment['comment_id'], $comment['comment_date_create_formatted']); ?><br/>
												<? echo nl2br($comment['comment_content']); ?>
												<?
													if($this->auth->has_right('can_manage_comments'))
													{
												?>
														<hr/>
														<? echo anchor('admin/comment/edit/'.$comment['comment_id'], 'Edit'); ?> -
														<? echo anchor('admin/comment/unapprove/'.$comment['comment_id'], 'Unapprove'); ?> -
														<? echo anchor('admin/comment/spam/'.$comment['comment_id'], 'Spam')." - "; ?>
														<? echo anchor('admin/comment/delete/'.$comment['comment_id'], 'Delete'); ?>
												<?
													}
												?>
											</p>
										</div>
							<?
									}
							?>
									<div id="pagination">
										<? echo $this->pagination->create_links($post['comment_list_pagination_info']['page'], $post['comment_list_pagination_info']['page_count'], 'post/view/'.$post['post_id'].'/');?>
									</div>
							<?
								}
								if($this->auth->has_right('can_create_comment'))
								{
							?>
									<h2>
										Leave a comment
									</h2>
									<a name="reply"></a>
									<? echo form_open('post/view/'.$post['post_id'].'#reply'); ?>
										<?
											if(count($error_list) > 0)
											{
										?>
												<table cellpadding="0" cellspacing="0" class="form_error">
													<tbody>
														<?
															foreach($error_list as $error)
															{
														?>
																<tr>
																	<td>
																		<? echo $error; ?>
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
										<p>
											<?
												if(!$this->auth->is_logged_in())
												{
											?>
													<? echo form_label('Name', 'comment_author_name'); ?>
													<?
														$data = array(
														              'name'        => 'comment_author_name',
														              'id'          => 'comment_author_name',
														              'maxlength'   => '30',
														              'size'        => '30',
														              'value'		=> set_value('comment_author_name')
														            );

														echo form_input($data);
													?>
													<? echo form_label('E-Mail', 'comment_author_email'); ?>
													<?
														$data = array(
														              'name'        => 'comment_author_email',
														              'id'          => 'comment_author_email',
														              'maxlength'   => '30',
														              'size'        => '30',
														              'value'		=> set_value('comment_author_email')
														            );

														echo form_input($data);
													?>
													<? echo form_label('Website', 'comment_author_website'); ?>
													<?
														$data = array(
														              'name'        => 'comment_author_website',
														              'id'          => 'comment_author_website',
														              'maxlength'   => '30',
														              'size'        => '30',
														              'value'		=> set_value('comment_author_website')
														            );

														echo form_input($data);
													?>
											<?
												}
											?>
											<? echo form_label('Content', 'comment_content'); ?>
											<?
												$data = array(
												              'name'        => 'comment_content',
												              'id'          => 'comment_content',
												              'cols'  		=> '80',
												              'rows'        => '10',
												              'value'		=> set_value('comment_content')
												            );

												echo form_textarea($data);
											?>
											<br />
											<? echo form_submit('submit', 'Submit Comment'); ?>
										</p>
									<? echo form_close(); ?>
							<?
								}
							?>