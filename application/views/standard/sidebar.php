						<div class="sidebar">
							<?
								if($this->config->item('config_navigation_show_search') == 1)
								{
							?>
									<div class="search">
										<span class="title">Search</span><br/>
										<?
											echo form_open('search/perform');
											$data = array(
											              'name'        => 'search_term',
											              'id'          => 'search_term',
											              'size'        => '25',
											              'maxlength'	=> '100'
											            );

											echo form_input($data)."&nbsp;".form_submit('submit', 'Search');
											echo form_close();
										?>
									</div>
							<?
								}
							?>
							<?
								if($this->config->item('config_navigation_show_post_overview') == 1)
								{
							?>
									<div class="navigation">
										<div class="nav_title_item">
											<? echo anchor('post/overview', 'Post overview'); ?>
										</div>
									</div>
							<?
								}
							?>
							<?
								if(is_array($navigation))
								{
									foreach($navigation as $section)
									{
										if(is_array($section) AND is_array($section['entries']))
										{
											if(isset($section['is_cloud']) AND $section['is_cloud'] == 1)
											{
							?>
												<div class="cloud">
													<span class="title"><? echo $section['title']; ?></span><br/>
													<?
														$this->cloud->clear();
														$this->cloud->add_tag($section['entries']);
														echo $this->cloud->get_cloud(', ', TRUE, TRUE);
													?>
												</div>
							<?
											}
											else
											{
							?>
												<div class="navigation">
													<div class="nav_title_item">
														<? echo $section['title']; ?>
													</div>
													<?
														foreach($section['entries'] as $entry)
														{
													?>
															<div class="nav_item">
																<? echo $entry; ?>
															</div>
													<?
														}
													?>
												</div>
											<?
											}
										}
									}
								}
							?>
							<?
								if($this->config->item('config_navigation_show_meta') == 1)
								{
							?>
									<div class="navigation">
										<div class="nav_title_item">
											Meta
										</div>
										<?
											if($this->auth->is_logged_in())
											{
										?>
												<?
													if($this->auth->has_right('view_administration'))
													{
												?>
														<div class="nav_item">
															<? echo anchor('admin', 'Administration'); ?>
														</div>
												<?
													}
												?>

												<div class="nav_item">
													<? echo anchor('admin/user/edit', 'Edit profile ('.$this->auth->get_user_name().')'); ?>
												</div>
												<div class="nav_item">
													<? echo anchor('system/logout', 'Log out'); ?>
												</div>
										<?
											}
											else
											{
										?>
												<div class="nav_item">
													<? echo anchor('system/login', 'Log in'); ?>
												</div>
										<?
											}
										?>

									</div>
							<?
								}
							?>
							<div class="bottom">
								<? echo anchor('system/contact', 'Contact'); ?>&nbsp;|&nbsp;
								<?
									switch($this->uri->segment(1))
									{
										case 'post':
											echo anchor('post/rss', 'RSS Feed '.img($this->view->img_base_url('rss.png')));
											break;
										case 'category':
											echo anchor('category/rss/'.$this->uri->segment(3), 'RSS Feed '.img($this->view->img_base_url('rss.png')));
											break;
										case 'tag':
											echo anchor('tag/rss/'.$this->uri->segment(3), 'RSS Feed '.img($this->view->img_base_url('rss.png')));
											break;
										default:
											echo anchor('post/rss', 'RSS Feed '.img($this->view->img_base_url('rss.png')));
											break;
									}
								?>
							</div>
						</div>