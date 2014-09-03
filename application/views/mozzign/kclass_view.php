
<div class="post_view">
							<h1>
                                                            <div class="kclasstitle">
								<? echo $kclass['classTitle']; ?>
                                                            </div>
							</h1>
							<h3>
                                                            <div>
                                                                <span style="color: #333">class date:</span>
                                                                <span style="font-size: 1.4em;font-weight: 100"><? echo date("D, M.j, Y", strtotime($kclass['classDate']));?></span>
                                                            </div>
                                                            <div>
                                                                <span style="color: #333">class time:</span>
                                                                <span style="font-size: 1.4em;font-weight: 100"> <? echo date("g:i A", strtotime($kclass['classTime']));?>
                                                                    &mdash;
                                                                    <? echo date("g:i A", strtotime($kclass['classEndTime']));?></span>
                                                            </div>
                                                            <div>
                                                                <span style="color: #333">instructor:</span>
                                                                <span style="font-size: 1.4em;font-weight: 100"><? echo $kclass['classInstructor']; ?></span>
                                                            </div>
                                                        </h3>
                                                       
							
							<div class="post_content" style="margin-top:25px;">
							    <? echo $kclass['classContent']; ?>
                                                        </div>
																						</div>

							<?
								if($this->config->item('config_show_social_bookmarking_links'))
								{
							?>
									<div class="info">
										<a href="http://digg.com/submit?url=<?php echo urlencode(site_url('post/view/'.$post['post_id'])); ?>&amp;title=<?php echo urlencode($post['post_title']); ?>"><img src="<?php echo $this->view->img_base_url('digg.jpg'); ?>" alt="submit to digg" border="0" /> </a>
										<a href="http://www.reddit.com/submit?url=<?php echo urlencode(site_url('post/view/'.$post['post_id'])); ?>"> <img src="http://www.reddit.com/static/spreddit1.gif" alt="submit to reddit" border="0" /> </a>
										<a href="http://www.stumbleupon.com/submit?url=<?php echo urlencode(site_url('post/view/'.$post['post_id'])); ?>&amp;title=<?php echo urlencode($post['post_title']); ?>"> <img border=0 src="http://cdn.stumble-upon.com/images/24x24_su.gif" alt="" /></a>
										<a href="http://delicious.com/save?v=5&amp;noui&amp;jump=close&amp;url=<?php echo urlencode(site_url('post/view/'.$post['post_id'])); ?>&amp;title=<?php echo urlencode($post['post_title']); ?>"><img src="http://static.delicious.com/img/delicious.small.gif" height="10" width="10" alt="Delicious" /></a>
									</div>
							<?
								}

							?>