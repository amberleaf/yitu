<ul class="nav nav-list">
	<li<?php echo $cur_controller == 'main' ? ' class="active"' : ''?>>
		<a href="/admin/main/index">
			<i class="icon-dashboard"></i>
			<span class="menu-text"> 控制台 </span>
		</a>
	</li>

	<?php if ($admin_role == 1 || (array_key_exists('hospital', $nav_permission) && count($nav_permission['hospital']) > 1)):?>
	<li<?php echo $cur_controller == 'hospital' ? ' class="active open"' : ''?>>
		<a href="" class="dropdown-toggle">
			<i class="icon-cogs"></i>
			<span class="menu-text"> 医院科室管理 </span>

			<b class="arrow icon-angle-down"></b>
		</a>

		<ul class="submenu">

			

			<?php if ($admin_role == 1 || in_array('hospital_lists', $nav_permission['hospital'])):?>
			<li<?php echo  $cur_controller == 'hospital' && $cur_method == 'lists' ? ' class="active"' : ''?>>
				<a href="/admin/hospital/lists">
					<i class="icon-double-angle-right"></i>
					合作医院列表
				</a>
			</li>
			<?php endif;?>

			<?php if ($admin_role == 1 || in_array('hospital-edit_hospital', $nav_permission['hospital'])):?>
			<li<?php echo  $cur_controller == 'hospital' && $cur_method == 'edit_hospital' ? ' class="active"' : ''?>>
				<a href="/admin/hospital/edit_hospital">
					<i class="icon-double-angle-right"></i>
					添加合作医院
				</a>
			</li>
			<?php endif;?>

			<?php if ($admin_role == 1 || in_array('hospital-dept_lists', $nav_permission['hospital'])):?>
			<li<?php echo  $cur_controller == 'hospital' && $cur_method == 'dept_lists' ? ' class="active"' : ''?>>
				<a href="/admin/hospital/dept_lists">
					<i class="icon-double-angle-right"></i>
					科室列表
				</a>
			</li>
			<?php endif;?>

			<?php if ($admin_role == 1 || in_array('hospital-edit_dept', $nav_permission['hospital'])):?>
			<li<?php echo  $cur_controller == 'hospital' && $cur_method == 'edit_dept' ? ' class="active"' : ''?>>
				<a href="/admin/hospital/edit_dept">
					<i class="icon-double-angle-right"></i>
					添加科室
				</a>
			</li>
			<?php endif;?>
		</ul>
	</li>
	<?php endif;?>


	<?php if ($admin_role == 1 || (array_key_exists('docter', $nav_permission) && count($nav_permission['docter']) > 1)):?>
	<li<?php echo $cur_controller == 'docter' ? ' class="active open"' : ''?>>
		<a href="" class="dropdown-toggle">
			<i class="icon-bookmark"></i>
			<span class="menu-text"> 医生管理 </span>

			<b class="arrow icon-angle-down"></b>
		</a>

		<ul class="submenu">
		
			<?php if ($admin_role == 1 || in_array('lists', $nav_permission['docter'])):?>
			<li<?php echo $cur_controller == 'docter' && $cur_method == 'lists' ? ' class="active"' : ''?>>
				<a href="/admin/docter/lists">
					<i class="icon-double-angle-right"></i>
					医生列表
				</a>
			</li>
			<?php endif;?>
		
			<?php if ($admin_role == 1 || in_array('edit', $nav_permission['docter'])):?>
			<li<?php echo $cur_controller == 'docter' && $cur_method == 'edit' ? ' class="active"' : ''?>>
				<a href="/admin/docter/edit">
					<i class="icon-double-angle-right"></i>
					添加/修改医生
				</a>
			</li>
			<?php endif;?>

		</ul>
	</li>
	<?php endif;?>
	<?php if ($admin_role == 1 || (array_key_exists('role', $nav_permission) && count($nav_permission['role']) > 1)):?>
	<li<?php echo $cur_controller == 'role' ? ' class="active open"' : ''?>>
		<a href="" class="dropdown-toggle">
			<i class="icon-key"></i>
			<span class="menu-text"> 权限管理 </span>

			<b class="arrow icon-angle-down"></b>
		</a>

		<ul class="submenu">
			<?php if ($admin_role == 1 || in_array('role-role_lists', $nav_permission['role'])):?>
			<li<?php echo $cur_method == 'role_lists' ? ' class="active"' : ''?>>
				<a href="/admin/role/role_lists">
					<i class="icon-double-angle-right"></i>
					角色列表
				</a>
			</li>
			<?php endif;?>
			
			<?php if ($admin_role == 1 || in_array('role-add', $nav_permission['role'])):?>
			<li<?php echo $cur_method == 'add' ? ' class="active"' : ''?>>
				<a href="/admin/role/add">
					<i class="icon-double-angle-right"></i>
					添加角色
				</a>
			</li>
			<?php endif;?>
		
			
			<?php if ($admin_role == 1 || in_array('auth-lists', $nav_permission['auth'])):?>
			<li<?php echo $cur_controller == 'auth' && $cur_method == 'lists' ? ' class="active"' : ''?>>
				<a href="/admin/auth/lists">
					<i class="icon-double-angle-right"></i>
					管理员列表
				</a>
			</li>
			<?php endif;?>

			<?php if ($admin_role == 1 || in_array('auth-register', $nav_permission['auth'])):?>
			<li<?php echo  $cur_controller == 'auth' && $cur_method == 'register' ? ' class="active"' : ''?>>
				<a href="/admin/auth/register">
					<i class="icon-double-angle-right"></i>
					添加管理员
				</a>
			</li>
			<?php endif;?>
			
			<?php if ($admin_role == 1 || in_array('role-permission', $nav_permission['role'])):?>
			<li<?php echo $cur_method == 'permission' ? ' class="active"' : ''?>>
				<a href="/admin/role/permission">
					<i class="icon-double-angle-right"></i>
					所有权限URL
				</a>
			</li>
			<?php endif;?>
		</ul>
	</li>
	<?php endif;?>


	<?php if ($admin_role == 1 || (array_key_exists('alog', $nav_permission) && count($nav_permission['alog']) > 1)):?>
	<li<?php echo $cur_controller == 'alog' ? ' class="active open"' : ''?>>
		<a href="" class="dropdown-toggle">
			<i class="icon-circle"></i>
			<span class="menu-text"> 日志管理 </span>

			<b class="arrow icon-angle-down"></b>
		</a>

		<ul class="submenu">
		
			<?php if ($admin_role == 1 || in_array('index', $nav_permission['docter'])):?>
			<li<?php echo $cur_method == 'index' ? ' class="active"' : ''?>>
				<a href="/admin/alog/index">
					<i class="icon-double-angle-right"></i>
					日志列表
				</a>
			</li>
			<?php endif;?>

		</ul>
	</li>
	<?php endif;?>
</ul>
