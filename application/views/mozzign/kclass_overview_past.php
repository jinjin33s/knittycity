<div id="top_nav_container">

                    <ul id="nav_main" class="sf-menu">
                        <li>
                            <a href="<? echo base_url() . 'kclass' ?>">
                                upcoming classes
                            </a>
                        </li>
                        <li class="selected" style="color:yellowGreen;border-bottom: 5px solid yellowGreen" >
                            <a href="<? echo base_url() . 'kclasspast' ?>" style="color:yellowGreen;">
                                past classes
                            </a>
                        </li>
                    </ul>

</div>

<div class="postlist">

        <? if($kclass_list == FALSE){ ?>
			<h3>
				No classes
			</h3>
	<? }else{
        if(count($error_list) > 0 OR count($notice_list) > 0){ ?>

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
                                    foreach($kclass_list['kclass_list'] as $kclass)
                                    {
                            ?>
                                    <div id="p_20" class="post">
                                        <h1>
                                            <div class="kclasslisttitle">
                                            <a href="/knittyblog/index.php/kclasspast/view/<?php echo $kclass['class_id'];?>"><?php echo $kclass['classTitle'];?></a>
                                            </div>
                                        </h1>
                                        <h2>
                                             <? echo date("D, M. j, Y,", strtotime($kclass['classDate']));?> <? echo date(" g:iA", strtotime($kclass['classTime']));?>
                                            &mdash; <? echo date("g:iA", strtotime($kclass['classEndTime']));?>
                                            <span style="color: #333; margin-left: 20px;">instructor:</span> <? echo $kclass['classInstructor'];?>&nbsp;
                                        </h2>
                                         <div class="excerpt">
                                                            <? echo $kclass['classSummary']; ?>
                                         </div>
                                    </div>
                            <?
                                    }
                            ?>
			<div class="pagination">
				<? echo $this->pagination->create_links($kclass_list['pagination_info']['page'], $kclass_list['pagination_info']['page_count'], 'kclasspast/overview/');?>
			</div>
	<?
		}
	?>
    </div>