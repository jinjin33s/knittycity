							<?
								foreach($post_list['post_list'] as $post)
								{
							?>
									<h1><? echo anchor('post/view/'.$post['post_id'], $post['post_title'], array('class' => 'post_title')); ?></h1>
									<h2>
										<? echo $post['post_date_create_formatted']; ?> by <? echo $post['user_name']; ?>
									</h2>
									<? 	if($post['post_excerpt'] != '')
										{
											echo $post['post_excerpt'];
										}
										else
										{
											echo $post['post_content'];
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
									<?
										if($this->config->item('config_show_social_bookmarking_links'))
										{
									?>
											<p>
												<a href="http://digg.com/submit?url=<?php echo urlencode(site_url('post/view/'.$post['post_id'])); ?>&amp;title=<?php echo urlencode($post['post_title']); ?>"><img src="<?php echo $this->view->img_base_url('digg.jpg'); ?>" alt="submit to digg" class="no-border" /> </a>
												<a href="http://www.reddit.com/submit?url=<?php echo urlencode(site_url('post/view/'.$post['post_id'])); ?>"> <img src="http://www.reddit.com/static/spreddit1.gif" alt="submit to reddit" class="no-border" /> </a>
												<a href="http://www.stumbleupon.com/submit?url=<?php echo urlencode(site_url('post/view/'.$post['post_id'])); ?>&amp;title=<?php echo urlencode($post['post_title']); ?>"> <img border=0 src="http://cdn.stumble-upon.com/images/24x24_su.gif" class="no-border" /></a>
												<a href="http://delicious.com/save?v=5&amp;noui&amp;jump=close&amp;url=<?php echo urlencode(site_url('post/view/'.$post['post_id'])); ?>&amp;title=<?php echo urlencode($post['post_title']); ?>"><img src="http://static.delicious.com/img/delicious.small.gif" height="10" width="10" alt="Delicious" class="no-border"/></a>
											</p>
									<?
										}
									?>
									<p>
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
										 | Edit |
										<?
											if($post['comment_count'] == 0)
											{
												echo anchor('post/view/'.$post['post_id'].'#reply', $post['comment_count']." Comment(s)"); $post['comment_count'];
											}
											else
											{
												echo anchor('post/view/'.$post['post_id'].'#comments', $post['comment_count']." Comment(s)"); $post['comment_count'];
											}
										?>
									</p>
								<?
									}
								?>