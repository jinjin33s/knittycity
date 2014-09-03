<div id="top_nav_container">

                    <ul id="nav_main" class="sf-menu">
                        <li>
                            <a href="<? echo base_url() . 'kevent' ?>">
                                upcoming events
                            </a>
                        </li>
                        <li class="selected" style="color:yellowGreen;border-bottom: 5px solid #F8BB00" >
                            <a href="<? echo base_url() . 'keventpast' ?>" style="color: #F8BB00">
                                past events
                            </a>
                        </li>
                    </ul>

</div>


    <div class="postlist">


        <?
		if($kevent_list == FALSE)
		{
	?>
			<h3>
				No Events
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
                                    foreach($kevent_list['kevent_list'] as $kevent)
                                    {
                            ?>
                                    <div id="p_20" class="post">
                                        <h1>
                                            <div class="keventlisttitle">
                                            <a href="/knittyblog/index.php/kevent/view/<?php echo $kevent['event_id'];?>"><?php echo $kevent['eventTitle'];?></a>
                                            </div>
                                        </h1>
                                        <h2>
                                              <? echo date("D, M. j, Y,", strtotime($kevent['eventDate']));?> <? echo date(" g:iA", strtotime($kevent['eventTime']));?>
                                            &mdash; <? echo date("g:iA", strtotime($kevent['eventEndTime']));?>
                                        </h2>
                                         <div class="excerpt">
                                                            <? echo $kevent['eventSummary']; ?>
                                         </div>
                                    </div>
                            <?
                                    }
                            ?>
			<div class="pagination">
				<? echo $this->pagination->create_links($kevent_list['pagination_info']['page'], $kevent_list['pagination_info']['page_count'], 'keventpast/overview/');?>
			</div>
	<?
		}
	?>
    </div>