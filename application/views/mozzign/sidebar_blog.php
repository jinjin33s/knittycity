						<div class="sidebar" style="border-left: 1px solid #ECECEC; border-right: 1px solid #ECECEC">
							<?
								if($this->config->item('config_navigation_show_search') == 1)
								{
							?>
									<div id="search">
									  <div class="searchContainer" style="border: 1px solid #915AAA">
                                                                              
										
											<div class="div9" style="margin-left:0px;margin-top: -3px;">
                                                                                                <? echo form_open('search/perform',array('id'=>'form_search'));?>
                                                                                                <input id="search_term"
                                                                                                       name="search_term"
                                                                                                       style="color:#999999;margin-left:5px;margin-top:0px;
                                                                                                                width:80px;
                                                                                                                float:left"
                                                                                                       onkeydown="this.style.color='#000000'"
                                                                                                       onclick="this.value=''"
                                                                                                       value="Search">
												<? echo form_close();?>
											</div>
                                                                              
											<div style="float: right; margin-right: 2px;
                                                                                                    margin-top: -3px;">
                                                                                            <a onclick="$('#form_search').submit();">
                                                                                                <div class="search_button" style="margin-top:0px"></div>
                                                                                            </a>
											</div>
											
                                                                              </div>
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
													<div class="title" style="margin-bottom:6px;font-size:16px;letter-spacing: 1px;"><? echo $section['title']; ?></div>
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
														<? if ( $section['title'] == "Pages") {
                                                                                                                        echo "extra! extra!";
                                                                                                                   } else {
                                                                                                                        echo $section['title'];
                                                                                                                   }
                                                                                                                ?>
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
										
										<?php  if($this->auth->is_logged_in()){ ?>
												<?php if($this->auth->has_right('view_administration')){ ?>
                                                                                                            <div class="nav_title_item">
                                                                                                                    Admin
                                                                                                            </div>

                                                                                                            <div class="nav_item">
                                                                                                                    <? echo anchor('admin', 'Post and Edit'); ?>
                                                                                                            </div>
                                                                                                            <div class="nav_item">
                                                                                                                    <? echo anchor('admin/user/edit', 'Edit profile ('.$this->auth->get_user_name().')'); ?>
                                                                                                            </div>
                                                                                                            <div class="nav_item">
                                                                                                                    <? echo anchor('system/logout', 'Log out'); ?>
                                                                                                            </div>
												<?php }?>
										<?php }?>

									</div>
							<?
								}
							?>
                            
                            <!--
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
                            -->
                            
                            
						</div>