<ul>
	<?
		if($this->auth->has_right('view_administration'))
		{
	?>
			<li>
				<? echo anchor('admin/dashboard', 'Dashboard'); ?>
			</li>
			<li>
				<? echo anchor('admin/config', 'Config'); ?>
			</li>
			<li>
				Posts
				<ul>
					<li><? echo anchor('admin/post/overview', 'Overview'); ?></li>
					<li><? echo anchor('admin/post/add', 'Add'); ?></li>
					<li><? echo anchor('admin/tag/overview', 'Tags'); ?></li>
					<li><? echo anchor('admin/category/overview', 'Categories'); ?></li>
				</ul>
			</li>
			<li>
				Page
				<ul>
					<li><? echo anchor('admin/page/overview', 'Overview'); ?></li>
					<li><? echo anchor('admin/page/add', 'Add'); ?></li>
				</ul>
			</li>
			<li>
				Comments
				<ul>
					<li><? echo anchor('admin/comment/overview', 'Overview'); ?></li>
				</ul>
			</li>
			<li>
				Links
				<ul>
					<li><? echo anchor('admin/link/overview', 'Overview'); ?></li>
					<li><? echo anchor('admin/link/add', 'Add'); ?></li>
				</ul>
			</li>
			<li>
				Files
				<ul>
					<li><? echo anchor('admin/file/overview', 'Overview'); ?></li>
					<li><? echo anchor('admin/file/add', 'Add'); ?></li>
				</ul>
			</li>
			<li>
				Groups
				<ul>
					<li><? echo anchor('admin/group/overview', 'Overview'); ?></li>
				</ul>
				<ul>
					<li><? echo anchor('admin/group/add', 'Add'); ?></li>
				</ul>
			</li>
			<li>
				<? echo anchor('admin/module', 'Modules'); ?>
			</li>
	<?
		}
	?>
	<li>
		Users
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
		<ul>
			<li><? echo anchor('admin/user/edit', 'Own profile'); ?></li>
		</ul>
	</li>
</ul>