
<?php if($this->auth->has_right('view_administration')){ ?>
    <ul class="nav left" style="display: none;">
                <li><? echo anchor('admin/dashboard', 'Dashboard'); ?></li>
                
		<li>Blog<? echo anchor('admin/post/overview', 'Overview'); ?>
                        <ul>
                                <li><? echo anchor('admin/post/overview', 'Overview'); ?></li>
                                <li><? echo anchor('admin/post/add', 'Add'); ?></li>
                                <li><? echo anchor('admin/tag/overview', 'Tags'); ?></li>
                                <li><? echo anchor('admin/category/overview', 'Categories'); ?></li>
                        </ul>
                </li>
                <li>
                        <span style="text-transform: uppercase; color:#999; size:.8em; font-family:Helvetica, Arial, sans-serif; letter-spacing:1px;">Page</span>
                        <ul>
                                <li><? echo anchor('admin/page/overview', 'Overview'); ?></li>
                                <li><? echo anchor('admin/page/add', 'Add'); ?></li>
                        </ul>
                </li>
                <li>Comments
                        <ul>
                                <li><? echo anchor('admin/comment/overview', 'Overview'); ?></li>
                        </ul>
                </li>
                <li>Links
                        <ul>
                                <li><? echo anchor('admin/link/overview', 'Overview'); ?></li>
                                <li><? echo anchor('admin/link/add', 'Add'); ?></li>
                        </ul>
                </li>
            
                <li>Files
                        <ul>
                                <li><? echo anchor('admin/file/overview', 'Overview'); ?></li>
                                <li><? echo anchor('admin/file/add', 'Add'); ?></li>
                        </ul>
                </li>

                <li>classes
                        <ul>
                                <li><? echo anchor('admin/kclass/overview', 'Overview'); ?></li>
                                <li><? echo anchor('admin/kclass/add', 'Add'); ?></li>
                        </ul>
                </li>
                <li>events
                        <ul>
                                <li><? echo anchor('admin/kevent/overview', 'Overview'); ?></li>
                                <li><? echo anchor('admin/kevent/add', 'Add'); ?></li>
                        </ul>
                </li>
                <li>Profiles
                        <ul>
                                <li><? echo anchor('admin/kprofile/overview', 'Overview'); ?></li>
                                <li><? echo anchor('admin/kprofile/add', 'Add'); ?></li>
                        </ul>
                </li>

                <li>Calendar
                        <ul>
                                <li><? echo anchor('admin/kcalendar/overview', 'Overview'); ?></li>
                                <li><? echo anchor('admin/kcalendar/add', 'Add'); ?></li>
                        </ul>
                </li>

                <li>Subscriber
                        <ul>
                                <li><? echo anchor('admin/subscriber/overview', 'Overview'); ?></li>
                                <li><? echo anchor('admin/subscriber/add', 'Add'); ?></li>
                        </ul>
                </li>

                <li>Group
                        <span style="text-transform: uppercase; size:.8em; font-family:Helvetica, Arial, sans-serif; letter-spacing:1px;">Groups</span>
                        <ul>
                                <li><? echo anchor('admin/group/overview', 'Overview'); ?></li>
                                <li><? echo anchor('admin/group/add', 'Add'); ?></li>
                        </ul>
                </li>

                <li>Users
                        <? if($this->auth->has_right('can_edit_user')){ ?>
                        <ul>
                                <li><? echo anchor('admin/user/overview', 'Overview'); ?></li>
                        </ul>
                        <? } ?>
                        <ul style="border:0px">
                                <li><? echo anchor('admin/user/edit', 'Own profile'); ?></li>
                        </ul>
                </li>

                <li style="font-size:12px; text-transform:uppercase; margin-bottom:10px; margin-top:10x; text-align:right">
                        <? echo anchor('admin/config', '> Config'); ?>
                </li>
    
</ul>
    <?php }?>
