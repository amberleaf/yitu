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
			<li class="active">添加/修改URL</li>
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
			<h1>添加／修改URL</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS -->

				<form id="per-form" class="form-horizontal" action="/admin/role/operate_permission" method="post">
					<?php if (isset($permission)):?>
					<input type="hidden" name="id" value="<?php echo $permission->id?>" />
					<input type="hidden" name="order" value="<?php echo $permission->order?>" />
					<?php endif;?>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="group"> 所属组 </label>

						<div class="col-sm-9">
							<input type="text" id="group" name="group" value="<?php echo $group_name?>"<?php if($group_name):?> readonly="true"<?php endif;?> placeholder="所属组" class="validate[required] col-xs-10 col-sm-4" />
							<span class="help-inline col-xs-12 col-sm-7">一般为controller名称</span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="key"> 键值 </label>

						<div class="col-sm-9">
							<?php if ($permission):?>
							<input type="text" id="key" name="key" value="<?php echo $permission->key?>" placeholder="键值" class="validate[required, maxSize[30]] col-xs-10 col-sm-4" />
							<?php else:?>
							<input type="text" id="key" name="key" value="<?php echo $permission->key?>" placeholder="键值" class="validate[required, maxSize[30], ajax[ajaxKeyCall]] col-xs-10 col-sm-4" />
							<?php endif;?>
							<span class="help-inline col-xs-12 col-sm-7">格式：controller-action，所有：*，例如：main-index</span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="name"> 名称 </label>

						<div class="col-sm-9">
							<input type="text" id="name" name="name" value="<?php echo $permission->name?>" placeholder="名称" class="validate[required, maxSize[20]] col-xs-10 col-sm-4" />
							<span class="help-inline col-xs-12 col-sm-7"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="url"> URL </label>

						<div class="col-sm-9">
							<?php if ($permission):?>
							<input type="text" id="url" name="url" value="<?php echo $permission->url?>" placeholder="URL" class="validate[required, maxSize[200]] col-xs-10 col-sm-4" />
							<?php else:?>
							<input type="text" id="url" name="url" value="<?php echo $permission->url?>" placeholder="URL" class="validate[required, maxSize[200], ajax[ajaxUrlCall]] col-xs-10 col-sm-4" />
							<?php endif;?>
							<span class="help-inline col-xs-12 col-sm-7">格式：/admin/controller/action，所有：/admin/controller/*，例如：/admin/main/index</span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="description"> 描述 </label>

						<div class="col-sm-4">
							<textarea class="form-control" id="description" name="description" placeholder="描述"><?php echo $permission->description?></textarea>
							<span class="help-inline col-xs-12 col-sm-7"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="display"> 是否显示 </label>

						<div class="col-sm-9">
							<select class="validate[required] form-control col-sm-4" id="display" name="display" style="width:100px;">
								<option value="">--选择--</option>
								<option value="1"<?php echo $permission->display == 1 ? ' selected=selected' : ''?>>是</option>
								<option value="0"<?php echo $permission->display == 0 ? ' selected=selected' : ''?>>否</option>
							</select>
							<span class="help-inline col-xs-12 col-sm-7"></span>
						</div>
					</div>

					<div class="clearfix form-actions">
						<div class="col-md-offset-3 col-md-9">
							<button class="btn btn-info" type="submit">
								<i class="icon-ok bigger-110"></i>
								<?php echo isset($permission) ? '修改' : '添加'?>
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
		$("#per-form").validationEngine('attach', {
			'ajaxFormValidationMethod': 'post'
		});
	});
</script>
