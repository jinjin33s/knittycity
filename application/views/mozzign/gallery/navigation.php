<ul style="border-top:0px">
	<?
		if($this->auth->has_right('view_administration'))
		{
	?>
    		<!--
			<li style="font-size:10px; text-transform:uppercase;">
				<? echo anchor('admin/dashboard', 'Dashboard'); ?>
			</li>
            -->
			<li>
            	<span style="font-size:26px; font-family:Georgia, 'Times New Roman', Times, serif; font-style:italic; text-transform:lowercase; font-weight:100; margin-top:10px;">
                blog </span><br />
				<span style="text-transform: uppercase; color:#999; size:.8em; font-family:Helvetica, Arial, sans-serif; letter-spacing:1px">Posts</span>
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
			<li>
				<span style="text-transform: uppercase; color:#999; size:.8em; font-family:Helvetica, Arial, sans-serif; letter-spacing:1px;">Comments</span>
				<ul>
					<li><? echo anchor('admin/comment/overview', 'Overview'); ?></li>
				</ul>
			</li>
			<li>
				<span style="text-transform: uppercase; color:#999; size:.8em; font-family:Helvetica, Arial, sans-serif; letter-spacing:1px;">Links</span>
				<ul>
					<li><? echo anchor('admin/link/overview', 'Overview'); ?></li>
					<li><? echo anchor('admin/link/add', 'Add'); ?></li>
				</ul>
			</li>
            <!--
			<li>
				<span style="text-transform: uppercase; color:#999; size:.8em; font-family:Helvetica, Arial, sans-serif; letter-spacing:1px;">Files</span>
				<ul>
					<li><? echo anchor('admin/file/overview', 'Overview'); ?></li>
					<li><? echo anchor('admin/file/add', 'Add'); ?></li>
				</ul>
			</li>
            -->
                        <li style="margin-top:5px;">
            	<span style="font-size:26px; font-family:Georgia, 'Times New Roman', Times, serif; font-style:italic; text-transform:lowercase; font-weight:100;">
                classes</span><br />
				<span style="text-transform: uppercase; color:#999; size:.8em; font-family:Helvetica, Arial, sans-serif; letter-spacing:1px;">Posts</span>
				<ul>
					<li><? echo anchor('admin/kclass/overview', 'Overview'); ?></li>
                                        <li><? echo anchor('admin/kclass/add', 'Add'); ?></li>
				</ul>
			</li>
                        <li style="margin-top:5px;">
            	<span style="font-size:26px; font-family:Georgia, 'Times New Roman', Times, serif; font-style:italic; text-transform:lowercase; font-weight:100;">
                events </span><br />
				<span style="text-transform: uppercase; color:#999; size:.8em; font-family:Helvetica, Arial, sans-serif; letter-spacing:1px;">Posts</span>
				<ul>
					<li><? echo anchor('admin/kevent/overview', 'Overview'); ?></li>
                                        <li><? echo anchor('admin/kevent/add', 'Add'); ?></li>
				</ul>
			</li>
                        <li style="margin-top:5px;">
				<span style="font-size:26px; font-family:Georgia, 'Times New Roman', Times, serif; font-style:italic; text-transform:lowercase; font-weight:100;">
                Profiles </span><br />
                <span style="text-transform: uppercase; color:#999; size:.8em; font-family:Helvetica, Arial, sans-serif; letter-spacing:1px;">Posts</span>
				<ul>
					<li><? echo anchor('admin/kprofile/overview', 'Overview'); ?></li>
                                        <li><? echo anchor('admin/kprofile/add', 'Add'); ?></li>
				</ul>
			</li>
            
            <li><hr style=" border:5px solid #F30; margin-top:10px; margin-bottom:30px" /></li>
            
            
			<li>
				<span style="text-transform: uppercase; size:.8em; font-family:Helvetica, Arial, sans-serif; letter-spacing:1px;">Groups</span>
				<ul>
					<li><? echo anchor('admin/group/overview', 'Overview'); ?></li>
					<li><? echo anchor('admin/group/add', 'Add'); ?></li>
				</ul>
			</li>
	<?
		}
	?>
	<li>
		<span style="text-transform: uppercase; size:.8em; font-family:Helvetica, Arial, sans-serif; letter-spacing:1px;">Users</span>
		<?
			if($this->auth->has_right('can_edit_user'))
			{
		?>
				<ul>
					<li><? echo anchor('admin/user/overview', 'Overview'); ?></li>
				</ul>
		<?
			}
		?>
		<ul style="border:0px">
			<li><? echo anchor('admin/user/edit', 'Own profile'); ?></li>
		</ul>
	</li>
    
			<li style="font-size:12px; text-transform:uppercase; margin-bottom:10px; margin-top:10x; text-align:right">
				<? echo anchor('admin/config', '> Config'); ?>
			</li>
    
    
    
</ul>