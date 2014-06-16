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
				<a href="#">管理面板</a>
			</li>
			<li class="active"><?php echo isset($admin) ? '修改' : '添加'?>管理员</li>
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
			<h1>
				管理面板
				<small>
					<i class="icon-double-angle-right"></i>
					<?php echo isset($admin) ? '修改' : '添加'?>管理员
				</small>
			</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS -->

				<form id="add-admin-form" class="form-horizontal" action="/admin/auth/register" method="post">
					<?php if (isset($admin)):?>
						<input type="hidden" name="id" value="<?php echo $admin->id?>" />
					<?php endif;?>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="role"> 管理组 </label>

						<div class="col-sm-4">
							<select class="validate[required] width-80 chosen-select" id="role" data-placeholder="选择医院..." name="role">
								<option value="">--选择--</option>
								<?php if (count($roles) > 0):?>
									<?php foreach($roles as $val):?>
								<option value="<?php echo $val->id?>"<?php echo $admin->role_id == $val->id ? ' selected=selected' : ''?>><?php echo $val->name?></option>
									<?php endforeach;?>
								<?php endif;?>
							</select>
							<span class="help-inline col-xs-12 col-sm-7"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="username"> 用户名 </label>

						<div class="col-sm-9">
							<?php if (isset($admin)):?>
							<input type="text" id="username" name="username" placeholder="用户名" value="<?php echo $admin->username?>" class="validate[required, minSize[5], maxSize[50], custom[onlyLetterNumber]] col-xs-10 col-sm-4" />
							<?php else:?>
							<input type="text" id="username" name="username" placeholder="用户名" class="validate[required, minSize[5], maxSize[50], custom[onlyLetterNumber], ajax[ajaxUsernameCall]] col-xs-10 col-sm-4" />
							<?php endif;?>
							<span class="help-inline col-xs-12 col-sm-7"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="password"> <?php echo isset($admin) ? '修改密码' : '密码'?> </label>

						<div class="col-sm-9">
							<input type="password" id="password" name="password" placeholder="密码" class="validate[required, minSize[6]] col-xs-10 col-sm-4" />
							<span class="help-inline col-xs-12 col-sm-7"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="repassword"> 重复密码 </label>

						<div class="col-sm-9">
							<input type="password" id="repassword" name="repassword" placeholder="重复密码" class="validate[required, minSize[6], equals[password]] col-xs-10 col-sm-4" />
							<span class="help-inline col-xs-12 col-sm-7"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="realname"> 真实姓名 </label>

						<div class="col-sm-9">
							<input type="text" id="realname" name="realname" value="<?php echo $admin->realname?>" placeholder="真实姓名" class="validate[required, minSize[2], maxSize[10]] col-xs-10 col-sm-4" />
							<span class="help-inline col-xs-12 col-sm-7"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="sex"> 性别 </label>

						<div class="col-sm-9">
							<select class="validate[required] form-control col-sm-4" id="sex" name="sex" style="width:100px;">
								<option value="">--选择--</option>
								<option value="1"<?php echo $admin->sex == 1 ? ' selected=selected' : ''?>>男</option>
								<option value="2"<?php echo $admin->sex == 2 ? ' selected=selected' : ''?>>女</option>
							</select>
							<span class="help-inline col-xs-12 col-sm-7"></span>
						</div>
					</div>

					 

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="mobil"> 手机 </label>

						<div class="col-sm-9">
							<input type="text" id="mobil" name="mobil" value="<?php echo $admin->mobil?>" placeholder="手机" class="validate[required, custom[phone], maxSize[11]] col-xs-10 col-sm-4" />
							<span class="help-inline col-xs-12 col-sm-7"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="uemail"> 邮箱 </label>

						<div class="col-sm-9">
							<input type="text" id="uemail" name="uemail" value="<?php echo $admin->email?>" placeholder="邮箱" class="validate[required, custom[email]] col-xs-10 col-sm-4" />
							<span class="help-inline col-xs-12 col-sm-7"></span>
						</div>
					</div>
 

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="qq"> QQ </label>

						<div class="col-sm-9">
							<input type="text" id="qq" name="qq" value="<?php echo $admin->qq?>" placeholder="QQ" class="validate[custom[number]] col-xs-10 col-sm-4" />
							<span class="help-inline col-xs-12 col-sm-7"></span>
						</div>
					</div>

					  

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="status"> 状态 </label>

						<div class="col-sm-9">
							<select class="validate[required] form-control col-sm-4" id="status" name="status" style="width:100px;">
								<option value="">--选择--</option>
								<option value="0"<?php echo $admin->status == 0 ? ' selected=selected' : ''?>>未激活</option>
								<option value="1"<?php echo $admin->status == 1 ? ' selected=selected' : ''?>>激活</option> 
							</select>
							<span class="help-inline col-xs-12 col-sm-7"></span>
						</div>
					</div>


					<div class="clearfix form-actions">
						<div class="col-md-offset-3 col-md-9">
							<button class="btn btn-info" type="submit">
								<i class="icon-ok bigger-110"></i>
								<?php echo isset($admin) ? '修改' : '添加'?>
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

<script src="<?php echo PUBLICADMIN?>assets/js/chosen.jquery.min.js"></script>
<script src="<?php echo PUBLICADMIN?>assets/js/languages/jquery.validationEngine-zh_CN.js"></script>
<script src="<?php echo PUBLICADMIN?>assets/js/jquery.validationEngine.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
	$(document).ready(function() {
		$(".chosen-select").chosen();
		$("#add-admin-form").validationEngine('attach', {
			'ajaxFormValidationMethod': 'post'
		});
	});
</script>
