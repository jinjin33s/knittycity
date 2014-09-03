    <div class="postlist">

        <table cellspacing="0">
		

        </table>            


        <?
		if($kcalendar_list == FALSE)
		{
	?>
			<h3>
				No Calendar
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
                                    foreach($kcalendar_list['kcalendar_list'] as $kcalendar)
                                    {
                            ?>
                                    <div id="p_20" class="post">
                                        <h1>
                                            <a href="/knittyblog/index.php/kcalendar/view/<?php echo $kcalendar['calendar_id'];?>"><?php echo $kcalendar['calendarTitle'];?></a>
                                        </h1>
                                        <h2>
                                              <? echo $kcalendar['user'];?>&nbsp;
                                              <? echo $kcalendar['calendarDate']." Calendar";?>
                                        </h2>
                                         <div class="excerpt">
                                                            <? echo $kcalendar['calendarSummary']; ?>
                                         </div>
                                    </div>
                            <?
                                    }
                            ?>

                             <?
                                    foreach($kclass_list['kclass_list'] as $kclass)
                                    {
                            ?>
                                    <div id="p_20" class="post">
                                        <h1>
                                            <a href="/knittyblog/index.php/kclass/view/<?php echo $kclass['class_id'];?>"><?php echo $kclass['classTitle'];?></a>
                                        </h1>
                                        <h2>
                                              <? echo $kclass['user'];?>&nbsp;
                                              <? echo $kclass['classDate']." Class";?>
                                              <? echo $kclass['classInstructor'];?>

                                        </h2>
                                         <div class="excerpt">
                                                            <? echo $kclass['classSummary']; ?>
                                         </div>
                                    </div>
                            <?
                                    }
                            ?>

                             <?
                                    foreach($kevent_list['kevent_list'] as $kevent)
                                    {
                            ?>
                                    <div id="p_20" class="post">
                                        <h1>
                                            <a href="/knittyblog/index.php/kevent/view/<?php echo $kevent['event_id'];?>"><?php echo $kevent['eventTitle'];?></a>
                                        </h1>
                                        <h2>
                                              <? echo $kevent['user'];?>&nbsp;
                                              <? echo $kevent['eventDate']." Event";?>
                                        </h2>
                                         <div class="excerpt">
                                                            <? echo $kevent['eventSummary']; ?>
                                         </div>
                                    </div>
                            <?
                                    }
                            ?>

			<div class="pagination">
				<? echo $this->pagination->create_links($kcalendar_list['pagination_info']['page'], $kcalendar_list['pagination_info']['page_count'], 'kcalendar/overview/');?>
			</div>
	<?
		}
	?>
    </div>
