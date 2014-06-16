<div class="main-content">
	<div class="breadcrumbs" id="breadcrumbs">
		<script type="text/javascript">
			try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
		</script>

		<ul class="breadcrumb">
			<li>
				<i class="icon-home home-icon"></i>
				<a href="/admin/main/index">首页</a>
			</li>

			<li>
				<a href="#">权限管理</a>
			</li>
			<li class="active">权限URL（浏览/分配）</li>
		</ul><!-- .breadcrumb -->

		<div class="nav-search" id="nav-search">
			<form class="form-search">
				<span class="input-icon">
					<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
					<i class="icon-search nav-search-icon"></i>
				</span>
			</form>
		</div><!-- #nav-search -->
	</div>

	<div class="page-content">
		<div class="page-header">
			<h1>
				<?php if (isset($role_id)):?>
				<a href="/admin/role/operate_permission"><i class="icon-edit"></i></a> <?php echo $role_name?>
				<button id="save-permission" class="btn btn-primary">保存权限</button>
				<input id="role_id" type="hidden" name="role_id" value="<?php echo $role_id?>">
				<?php else:?>
				<a href="/admin/role/operate_permission"><i class="icon-edit"></i></a> 权限URL（浏览/分配）
				<?php endif;?>
			</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS -->
				<div class="row">
					<?php if (count($urls) > 0):?>
						<?php foreach ($urls as $key => $val):?>
					<div class="col-xs-12 col-sm-3">
						<div class="control-group">
							<label class="control-label bolder blue"><?php echo $key?> <a href="/admin/role/operate_permission?group=<?php echo $key?>"><i class="icon-edit"></i></a></label>
							<div class="checkbox">
								<label>
									<input name="<?php echo $key . '-all'?>" type="checkbox" class="ace check-all" value="<?php echo $key?>" />
									<span class="lbl"> 全选/反选</span>
								</label>
							</div>
							<?php if (count($val) > 0):?>
								<?php foreach ($val as $uk => $url):?>
									<?php if (!strpos($url, '*')):?>
							<div class="checkbox">
								<label>
									<input class="ace" type="checkbox" name="<?php echo $key . '-url[]'?>" value="<?php echo $uk?>"<?php echo in_array($uk, $pids) ? ' checked="checked"' : ''?> />
									<span class="lbl"> <a href="/admin/role/operate_permission?id=<?php echo $uk?>&group=<?php echo $key?>"><?php echo $url?></a></span>
								</label>
							</div>
									<?php endif;?>
								<?php endforeach;?>
							<?php endif;?>
						</div>
					</div>
						<?php endforeach;?>
					<?php endif;?>
				</div>
				<!-- /row -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.page-content -->
</div>
<script type="text/javascript">
$(document).ready(function() {
	//全选所有url
	$('.check-all').on('click' , function(){
		var g = $(this).attr('value'),
			s = $(this).prop('checked');
		$("input:checkbox[name='"+g+"-url[]']").prop('checked',s);
	});
	<?php if (isset($role_id)):?>
	//保存权限
	$("#save-permission").click(function() {
		var ci = $(".checkbox input:checked[name*='url']"),
			rid = $("#role_id").val(),
			idsArr = new Array();
		$.each(ci, function(i,o){
			idsArr.push($(o).val());
		});
		$.post('/admin/role/assign_permission', {roleid:rid,ids:idsArr}, function(data){
			$('.admin-message').html('');
			if (data.save) {
				$('.admin-message').html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>分配成功！<br></div>');
			} else {
				$('.admin-message').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>分配失败！<br></div>');
			};
		}, 'json');
		setTimeout("closeMessage()", 3000);
	});
	<?php endif;?>
});
</script>