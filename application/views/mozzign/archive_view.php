						<div class="postlist">
							<? 	if($post_list == FALSE)
								{
							?>
									<h1>
										No entries
									</h1>
							<?
								}
								else
								{
									$this->view->show_simple('post_list');
							?>
									<div class="pagination">
										<? echo $this->pagination->create_links($post_list['pagination_info']['page'], $post_list['pagination_info']['page_count'], 'archive/view/'.$archive_id.'/');?>
									</div>
							<?
								}
							?>
						</div>