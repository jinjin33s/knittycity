


    <div class="postlist_profile">
        <?
		if($kprofile_list == FALSE)
		{
	?>
			<h3>
				No profiles
			</h3>
	<?
		}
		else
		{
                                    if(count($error_list) > 0 OR count($notice_list) > 0)
                                    {
                            ?>
                                            <table cellpadding="0" cellspacing="0" class="form_info">
                                                    <tbody>
                                                            <?
                                                                    foreach($error_list as $error)
                                                                    {
                                                            ?>
                                                                            <tr>
                                                                                    <td class="error">
                                                                                            <? echo $error; ?>
                                                                                    </td>
                                                                            </tr>
                                                            <?
                                                                    }
                                                            ?>
                                                            <?
                                                                    foreach($notice_list as $notice)
                                                                    {
                                                            ?>
                                                                            <tr>
                                                                                    <td class="notice">
                                                                                            <? echo $notice; ?>
                                                                                    </td>
                                                                            </tr>
                                                            <?
                                                                    }
                                                            ?>
                                                    </tbody>
                                            </table>

                            <?
                                    }
                            ?> 

                            <?
                                    foreach($homeViewModelContainer['kprofile_list'] as $kprofile)
                                    {
                            ?>
                                    <div id="p_20" class="post" style="width:698px;">
                                        <h1>
                                            <a href="/knittyblog/index.php/kprofile/view/<?php echo $kprofile['prof_id'];?>"><?php echo $kprofile['profTitle'];?></a>
                                        </h1>
                                        <h2>
                                            <a href="/knittyblog/index.php/kprofile/view/<?php echo $kprofile['prof_id'];?>"><img width="120" src="<?php echo $kprofile['kprofile_image'];?>"></a>
                                            <? echo $kprofile['profSummary']; ?>
                                        </h2>
                                        <h3>
                                              <? echo date("D, M. j, Y", strtotime($kprofile['profDate']));?>
                                        </h3>
                                    </div>
                            <?
                                    }
                            ?>
			<div class="pagination" style="width:698px;">
				<? echo $this->pagination->create_links($kprofile_list['pagination_info']['page'], $kprofile_list['pagination_info']['page_count'], 'admin/kprofile/overview/');?>
			</div>
	<?
		}
	?>
    </div>