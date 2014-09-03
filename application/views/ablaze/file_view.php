							<h1>
								<? echo $file['file_title']; ?>
							</h1>
							<h3>
								Added <? echo $file['file_date_add_formatted']; ?>
							</h3>
							<p>
								<? echo $file['file_description']; ?>
							</p>
							<p>
								Downloads so far: <? echo $file['file_download_count']; ?>
								<br/>
								Size: <? echo $file['file_size']; ?>
								<br/>
								<?
									$mirror_list = explode('<br />', nl2br($file['file_mirror']));
									$mirror_id = 1;
									foreach($mirror_list as $key => $mirror)
									{
										$mirror_id = $key + 1;
										if($mirror != '')
										{
											$mirror_info = explode('||', $mirror);
											if(isset($mirror_info[2]))
											{
												echo "Mirror #$mirror_id: ".anchor('file/get/'.$file['file_id'].'/'.$mirror_id, $mirror_info[2])."<br/>";
											}
										}
									}
								?>
							</p>