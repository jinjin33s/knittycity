							<? 	if($post_list == FALSE)
								{
							?>
									<h1>
										No results
									</h1>
							<?
								}
								else
								{
									$this->view->show_simple('post_list');
							?>
									<div id="pagination">
										<? echo $this->pagination->create_links($post_list['pagination_info']['page'], $post_list['pagination_info']['page_count'], 'search/result/'.$search_id.'/');?>
									</div>
							<?
								}
							?>