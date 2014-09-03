<?php include "gallery_tabs.php";?>

  <div class="box">
	<h2>
		<span style="font-size:1.5em;color:#FF9900"><?php echo $info[0]->title;?></span> &nbsp; Add Image
	</h2>

	<form action="<?php echo site_url("admin_gallery/gallery/do_upload")?>" method="post" name="insert_image" enctype="multipart/form-data">
		<table cellpadding="0" cellspacing="0" class="form">
			<tbody>
                           
                                  <tr>
					<td>
						Order ID: <em>Lower numbers will appear first</em>
					</td>

					<td>
						<select name="order_num" id="order_num">
                                                        <?php for($i=0;$i<101;$i++) { ?>
                                                        <?php echo("<option value='$i'>$i</option>"); ?>
                                                        <?php } ?>
                                                </select>
					</td>
				</tr>

				<tr>

                                        <td><span>Caption:<br /><em>You may enter HTML. Flash accepts basic HTML tags such as &lt;B&gt;, &lt;I&gt;, &lt;U&gt;, font color and font size tags and unordered lists. <a href="http://livedocs.adobe.com/flash/9.0/main/wwhelp/wwhimpl/common/html/wwhelp.htm?context=LiveDocs_Parts&file=00000922.html" target="_blank">View all supported HTML Tags for Flash</a></em><br /></span></td>
					<td>
						<textarea name="caption" id="caption"></textarea>
					</td>
				</tr>
                                <tr><td>
                                <span>Image:<br /><em>Only jpg, png and gif file formats are supported. Max upload size: 2MB.</em><br /></span>
                                    </td><td>
				<input type="file" name="filename" id="filename" style="margin-bottom:10px;" />
                                    </td>
                                </tr>

                                <tr>
                                        <input type="hidden" name="id" id="id" value="<?php echo $info[0]->id;?>" />
					<td colspan="2">
						<?
							$data = array(
							              'name'        => 'submit',
							              'id'          => 'submit',
							              'value'		=> 'Save',
							              'class'		=> 'submit'
							            );

							echo form_submit($data);
						?>
					</td>
				</tr>
			</tbody>
		</table>
	<? echo form_close(); ?>
            <p><a href="javascript:history.go(-1)">Cancel</a></p>
</div>

