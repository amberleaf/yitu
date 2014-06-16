<!-- main-content -->
<div class="main-content">
	<div class="breadcrumbs" id="breadcrumbs">
		<script type="text/javascript">
			try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
		</script>

		<ul class="breadcrumb">
			<li>
				<i class="icon-home home-icon"></i>
				<a href="#">主页</a>
			</li>

			<li>
				<a href="#">医生管理</a>
			</li>
			<li class="active">添加/编辑医生</li>
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
			<h1>添加/编辑医生</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS -->

				<form id="docter-form" class="form-horizontal" action="/admin/docter/edit<?php echo isset($docter) ? '?id='. $docter->id : ''?>" method="post">
					  
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="name"> 姓名 </label>

						<div class="col-sm-9">
							<input type="text" id="name" name="name" value="<?php echo $docter->realname?>" placeholder="姓名" class="validate[required, minSize[2], maxSize[10]] col-xs-10 col-sm-4" />
							<span class="help-inline col-xs-12 col-sm-7"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="sex"> 性别 </label>

						<div class="col-sm-9">
							<select class="validate[required] form-control col-sm-4" id="sex" name="sex" style="width:100px;">
								<option value="">--选择--</option>
								<option value="1"<?php echo $docter->sex == 1 ? ' selected=selected' : ''?>>男</option>
								<option value="2"<?php echo $docter->sex == 2 ? ' selected=selected' : ''?>>女</option>
							</select>
							<span class="help-inline col-xs-12 col-sm-7"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="status"> 状态 </label>

						<div class="col-sm-9">
							<select class="validate[required] form-control col-sm-4" id="status" name="status" style="width:100px;">
								<option value="">--选择--</option>
								<option value="0"<?php echo $docter->status == 0 ? ' selected=selected' : ''?>>未激活</option>
								<option value="1"<?php echo $docter->status == 1 ? ' selected=selected' : ''?>>激活</option>
								<option value="2"<?php echo $docter->status == 2 ? ' selected=selected' : ''?>>删除</option>
							</select>
							<span class="help-inline col-xs-12 col-sm-7"></span>
						</div>
					</div>


					<div class="clearfix form-actions">
						<div class="col-md-offset-3 col-md-9">
							<button class="btn btn-info" type="submit">
								<i class="icon-ok bigger-110"></i>
								<?php echo isset($docter) ? '修改' : '添加'?>
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
		$("#docter-form").validationEngine('attach', {
			'ajaxFormValidationMethod': 'post'
		});
	});
</script>
