<!-- main-content -->
<div class="main-content">
	<div class="breadcrumbs" id="breadcrumbs">
		<script type="text/javascript">
			try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
		</script>

		<ul class="breadcrumb">
			<li>
				<i class="icon-home home-icon"></i>
				<a href="/admin/main/index">主页</a>
			</li>

			<li>
				<a href="#">权限控制</a>
			</li>
			<li class="active">添加角色</li>
		</ul><!-- .breadcrumb -->

		<div class="nav-search" id="nav-search">
			<form class="form-search">
				<span class="input-icon">
					<input type="text" name="navsearch" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
					<i class="icon-search nav-search-icon"></i>
				</span>
			</form>
		</div><!-- #nav-search -->
	</div>

	<div class="page-content">
		<div class="page-header">
			<h1>添加／编辑角色</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS -->

				<form id="role-form" class="form-horizontal" action="/admin/role/add" method="post">
					<?php if (isset($role)):?>
					<input type="hidden" name="id" value="<?php echo $role->id?>" />
					<?php endif;?>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="name"> 角色 </label>

						<div class="col-sm-9">
							<input type="text" id="name" name="name" value="<?php echo $role->name?>" placeholder="角色" class="validate[required, maxSize[20], ajax[ajaxRolenameCall]] col-xs-10 col-sm-4" />
							<span class="help-inline col-xs-12 col-sm-7"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="description"> 描述 </label>

						<div class="col-sm-4">
							<textarea class="form-control" id="description" name="description" value="<?php echo $role->description?><" placeholder="描述"></textarea>
							<span class="help-inline col-xs-12 col-sm-7"></span>
						</div>
					</div>

					<div class="clearfix form-actions">
						<div class="col-md-offset-3 col-md-9">
							<button class="btn btn-info" type="submit">
								<i class="icon-ok bigger-110"></i>
								<?php echo isset($role) ? '修改' : '添加'?>
							</button>

							&nbsp; &nbsp; &nbsp;
							<button class="btn" type="button">
								<i class="icon-remove bigger-110"></i>
								取消
							</button>
						</div>
					</div>
				</form>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div>
	<!-- /.page-content -->
</div>
<!-- /.main-content -->

<!-- page specific plugin scripts -->

<!--[if lte IE 8]>
  <script src="<?php echo PUBLICADMIN?>assets/js/excanvas.min.js"></script>
<![endif]-->

<script src="<?php echo PUBLICADMIN?>assets/js/languages/jquery.validationEngine-zh_CN.js"></script>
<script src="<?php echo PUBLICADMIN?>assets/js/jquery.validationEngine.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
	$(document).ready(function() {
		$("#role-form").validationEngine('attach', {
			'ajaxFormValidationMethod': 'post'
		});
	});
</script>
