						<div class="post_view">
							<h1>
								Files
							</h1>
							<div class="post_content">
								<table cellpadding="0" cellspacing="0">
									<thead>
										<tr>
											<th class="left">
												File
											</th>
											<th class="left">
												Size
											</th>
											<th class="left">
												# of downloads
											</th>
											<th class="left">
												Date added
											</th>
										</tr>
									</thead>
									<tbody>
										<?
											if(count($file_list['file_list']) > 0)
											{
												foreach($file_list['file_list'] as $file)
												{
										?>
													<tr>
														<td>
															<? echo anchor('file/view/'.$file['file_id'], $file['file_title']); ?>
														</td>
														<td>
															<? echo $file['file_size']; ?>
														</td>
														<td>
															<? echo $file['file_download_count']; ?>
														</td>
														<td>
															<? echo $file['file_date_add_formatted']; ?>
														</td>
													</tr>
										<?
												}
											}
											else
											{
										?>
												<tr>
													<td colspan="4">
														No files
													</td>
												</tr>
										<?
											}
										?>
									</tbody>
								</table>
								<div class="pagination">
									<? echo $this->pagination->create_links($file_list['pagination_info']['page'], $file_list['pagination_info']['page_count'], 'file/overview/');?>
								</div>
							</div>
						</div>