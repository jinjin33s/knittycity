
<?php if($this->auth->has_right('view_administration')){ ?>
    <ul class="nav left" style="display: none;">
                <li><a class="top" href="<?echo base_url('admin/dashboard');?>">Dashboard</a></li>
                
		<li><a class="top">Blog</a>
                        <ul>
                                <li><a class="">Post</a>
                                    <ul>
                                    <li><? echo anchor('admin/post/overview', 'Overview'); ?></li>
                                    <li><? echo anchor('admin/post/add', 'Add'); ?></li>
                                    <li><? echo anchor('admin/tag/overview', 'Tags'); ?></li>
                                    <li><? echo anchor('admin/category/overview', 'Categories'); ?></li>
                                    </ul>
                                </li>
                                 <li><a class="">Page</a>
                                    <ul>
                                            <li><? echo anchor('admin/page/overview', 'Overview'); ?></li>
                                            <li><? echo anchor('admin/page/add', 'Add'); ?></li>
                                    </ul>
                                </li>
                                 <li><a class="">link</a>
                                    <ul>
                                            <li><? echo anchor('admin/link/overview', 'Link Overview'); ?></li>
                                            <li><? echo anchor('admin/link/add', 'Add Link'); ?></li>

                                    </ul>
                                 </li>
                        </ul>
                </li>
                      
               
               
               <li><a class="top">Gallery</a>
                        <ul>
                                <li><? echo anchor('admin_gallery/gallery', 'Overview'); ?></li>
               <!--             <li><? echo anchor('admin_gallery/settings', 'Settings'); ?></li>   -->
                        </ul>
                </li>
                
                <li><a class="top">Classes</a>
                        <ul>
                                <li><? echo anchor('admin/kclass/overview', 'Overview'); ?></li>
                                <li><? echo anchor('admin/kclass/add', 'Add'); ?></li>
                        </ul>
                </li>
                <li><a class="top">Events</a>
                        <ul>
                                <li><? echo anchor('admin/kevent/overview', 'Overview'); ?></li>
                                <li><? echo anchor('admin/kevent/add', 'Add'); ?></li>
                        </ul>
                </li>
                <li><a class="top">Profiles</a>
                        <ul>
                                <li><? echo anchor('admin/kprofile/overview', 'Overview'); ?></li>
                                <li><? echo anchor('admin/kprofile/add', 'Add'); ?></li>
                        </ul>
                </li>

                <li><a class="top">Calendar</a>
                        <ul>
                                <li><? echo anchor('admin/kcalendar/overview', 'Overview'); ?></li>
                                <li><? echo anchor('admin/kcalendar/add', 'Add'); ?></li>
                        </ul>
                </li>

                <li><a class="top">Users</a>
                        <? if($this->auth->has_right('can_edit_user')){ ?><? } ?>
                        <ul>
                            <li><a class="">User</a>
                                <ul>
                                        <li><? echo anchor('admin/user/overview', 'Overview'); ?></li>

                                        <li><? echo anchor('admin/user/edit', 'Own profile'); ?></li>
                                </ul>
                            </li>
                        
                            <li><a class="">Group</a>
                                    <ul>
                                        <li><? echo anchor('admin/group/overview', 'Overview'); ?></li>
                                        <li><? echo anchor('admin/group/add', 'Add'); ?></li>
                                    </ul>
                            </li>
                            
                            <li><a class="">Subscriber</a>
                                    <ul>
                                        <li><? echo anchor('admin/subscriber/overview', 'Overview'); ?></li>
                                        <li><? echo anchor('admin/subscriber/add', 'Add'); ?></li>
                                    </ul>
                            </li>
                        </ul>
                </li>

                <li><a class="top">Misc</a>
                    <ul>
                        <li><a class="top">File</a>
                                <ul>
                                    <li><? echo anchor('admin/file/overview', 'File Management'); ?></li>
                                    <li><? echo anchor('admin/file/add', 'New File'); ?></li>
                                </ul>
                        </li>
                        <li><a class="top">Group</a>
                                <ul>
                                    <li><? echo anchor('admin/group/overview', 'Overview'); ?></li>
                                    <li><? echo anchor('admin/group/add', 'Add'); ?></li>
                                </ul>
                        </li>
                    </ul>
                </li>

                 <li><a class="top">Comments</a>
                        <ul>
                                <li><? echo anchor('admin/comment/overview', 'Overview'); ?></li>
                        </ul>
                </li>
                
                <li><a class="top" href="<?echo base_url("admin/config");?>">Config</a>
                </li>
    
</ul>
    <?php }?>



  <script type="text/javascript"><!--
    $(document).ready(function() {
        
        
	$('.nav').superfish({
		hoverClass	 : 'sfHover',
		pathClass	 : 'overideThisToUse',
		delay		 : 0,
		animation	 : {height: 'show'},
		speed		 : 'normal',
		autoArrows      : false,
		dropShadows     : false,
		disableHI	 : false, /* set to true to disable hoverIntent detection */
		onInit		 : function(){},
		onBeforeShow     : function(){},
		onShow		 : function(){},
		onHide		 : function(){}
	});
	$('.nav').css('display', 'block');
    });

//--></script>

  <script type="text/javascript"><!--
    function getURLVar(urlVarName) {
	var urlHalves = String(document.location).toLowerCase().split('?');
	var urlVarValue = '';
	if (urlHalves[1]) {
		var urlVars = urlHalves[1].split('&');
		for (var i = 0; i <= (urlVars.length); i++) {
			if (urlVars[i]) {
				var urlVarPair = urlVars[i].split('=');
				if (urlVarPair[0] && urlVarPair[0] == urlVarName.toLowerCase()) {
					urlVarValue = urlVarPair[1];
				}
			}
		}
	}
	return urlVarValue;
    }

    $(document).ready(function() {

            route = getURLVar('route');
            if (!route) {
                    $('#dashboard').addClass('selected');
            } else {
                    part = route.split('/');
                    url = part[0];
                    if (part[1]) {
                            url += '/' + part[1];
                    }
                    $('a[href*=\'' + url + '\']').parents('li[id]').addClass('selected');
            }
    });

//--></script>
