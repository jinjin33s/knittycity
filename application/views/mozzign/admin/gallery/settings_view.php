<?php include "gallery_tabs.php";?>
<h1>Settings</h1>
	<div id="settings-update" class="form-page">

            <form action="<?php echo site_url("admin_gallery/settings/update")?>" method="post" name="update_settings">
            <table cellpadding="0" cellspacing="0" class="form">
			<tbody>
                            <tr>
					<td>
						Wide Thumbnail Width:
					</td>

					<td>
						<input type="text" name="thumb_width" id="thumb_width" value="<?php echo $rows[0]->thumb_width; ?>" maxlength="3" />
					</td>
				</tr>
                               <tr>
					<td>
						Wide Thumbnail Height:
					</td>

					<td>
                                            <input type="text" name="thumb_height" id="thumb_height" value="<?php echo $rows[0]->thumb_height; ?>" maxlength="3" />
                                        </td>
                                        
                                  </tr>
                                  <tr>
                                        <td>Preview Size</td>
                                         <td>
                                                    <div id="preview1" style="width:<?php echo $rows[0]->thumb_width;?>px; 
                                                                                height:<?php echo $rows[0]->thumb_height; ?>px;
                                                                                border:1px solid #666;
                                                                                background:#ccc;
                                                                                font-size:10px;
                                                                                text-align:center;
                                                                                margin-left:40px;"></div>
                                                   
                                          </td>
                                  </tr>

                                   <tr>
                                        <td colspan="2">
                                            <input type="submit" value="Submit" id="submit" />
                                        </td>
                                   </tr>
                        </tbody>
            </table>
				
            </form>
