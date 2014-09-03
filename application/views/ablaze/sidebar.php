						<div id="sidebar" >
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
												<div class="sidebox">
													<h1><? echo $section['title']; ?></h1>
													<div class="cloud">
														<?
															$this->cloud->clear();
															$this->cloud->add_tag($section['entries']);
															echo $this->cloud->get_cloud(', ', TRUE, TRUE);
														?>
													</div>
												</div>
							<?
											}
											else
											{
							?>
												<div class="sidebox">
													<h1><? echo $section['title']; ?></h1>
													<ul class="sidemenu">
													<?
														foreach($section['entries'] as $entry)
														{
													?>
															<li><? echo $entry; ?></li>
													<?
														}
													?>
													</ul>
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
									<div class="sidebox">
										<h1>Meta</h1>
										<ul class="sidemenu">
										<?
											if($this->auth->is_logged_in())
											{
										?>
												<?
													if($this->auth->has_right('view_administration'))
													{
												?>
														<li><? echo anchor('admin', 'Administration'); ?></li>
												<?
													}
												?>

												<li><? echo anchor('admin/user/edit', 'Edit profile ('.$this->auth->get_user_name().')'); ?></li>
												<li><? echo anchor('system/logout', 'Log out'); ?></li>
										<?
											}
											else
											{
										?>
												<li><? echo anchor('system/login', 'Log in'); ?></li>
										<?
											}
										?>
										</ul>
									</div>
							<?
								}
							?>
						</div>