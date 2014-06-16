<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<?php if (isset($site_name['title'])):?>
		<title><?php echo $site_name['title']?></title>
		<?php endif;?>
		<?php if (isset($site_name['keywords'])):?>
		<meta name="keywords" content="<?php echo $site_name['keywords']?>" />
		<?php endif;?>
		<?php if (isset($site_name['description'])):?>
		<meta name="description" content="<?php echo $site_name['description']?>" />
		<?php endif;?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- basic styles -->

		<link href="<?php echo PUBLICADMIN?>assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="<?php echo PUBLICADMIN?>assets/css/font-awesome.min.css" rel="stylesheet" />
		<link href="<?php echo PUBLICADMIN?>css/myself.css" rel="stylesheet" />
		<link href="/public/admin/assets/css/validationEngine.jquery.css" rel="stylesheet" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="<?php echo PUBLICADMIN?>assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!-- page specific plugin styles -->

		<!-- fonts -->

		<link rel="stylesheet" href="<?php echo PUBLICADMIN?>assets/css/fonts.css" />

		<!-- ace styles -->

		<link rel="stylesheet" href="<?php echo PUBLICADMIN?>assets/css/ace.min.css" />
		<link rel="stylesheet" href="<?php echo PUBLICADMIN?>assets/css/ace-rtl.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="<?php echo PUBLICADMIN?>assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="<?php echo PUBLICADMIN?>assets/js/html5shiv.js"></script>
		<script src="<?php echo PUBLICADMIN?>assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="login-layout">
		<div class="admin-message"><?php echo $this->template->message(); ?></div>
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<!-- <i class="icon-leaf green"></i> -->
									<span class="red">医图在线</span>
									<span class="white">后台管理系统</span>
								</h1>
								<h4 class="blue">&copy; 京ICP备110XXXXXX号</h4>
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="icon-coffee green"></i>
												请输入用户名和密码
											</h4>

											<div class="space-6"></div>

											<form id="login-form" action="/admin/auth/login" method="post">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input name="username" type="text" class="validate[required] form-control" placeholder="用户名" />
															<i class="icon-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input name="password" type="password" class="validate[required] form-control" placeholder="密码" />
															<i class="icon-lock"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="clearfix">
														<!-- <label class="inline">
															<input type="checkbox" class="ace" />
															<span class="lbl"> Remember Me</span>
														</label> -->

														<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
															<i class="icon-key"></i>
															登录
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>
										</div>
										<!-- /widget-main -->

										<div class="toolbar clearfix">
											<div>
												<a href="#" onclick="show_box('forgot-box'); return false;" class="forgot-password-link">
													<i class="icon-arrow-left"></i>
													忘记密码
												</a>
											</div>
										</div>
									</div><!-- /widget-body -->
								</div>
								<!-- /login-box -->

								<!-- 忘记密码 -->
								<div id="forgot-box" class="forgot-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header red lighter bigger">
												<i class="icon-key"></i>
												找回密码
											</h4>

											<div class="space-6"></div>
											<p>
												请输入您的邮箱
											</p>

											<form>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input id="email" type="email" class="form-control" placeholder="Email" />
															<i class="icon-envelope"></i>
														</span>
													</label>

													<div class="clearfix">
														<button type="button" class="width-35 pull-right btn btn-sm btn-danger">
															<i class="icon-lightbulb"></i>
															发送
														</button>
													</div>
												</fieldset>
											</form>
										</div><!-- /widget-main -->

										<div class="toolbar center">
											<a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link">
												返回登录
												<i class="icon-arrow-right"></i>
											</a>
										</div>
									</div><!-- /widget-body -->
								</div>
								<!-- /忘记密码 -->
							</div>
							<!-- /position-relative -->
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->

		<script type="text/javascript" src="<?php echo PUBLICADMIN?>assets/js/jquery-2.0.3.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo PUBLICADMIN?>assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
		<script type="text/javascript">
		 window.jQuery || document.write("<script src='<?php echo PUBLICADMIN?>assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
		</script>
		<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='<?php echo PUBLICADMIN?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script src="<?php echo PUBLICADMIN?>assets/js/languages/jquery.validationEngine-zh_CN.js"></script>
		<script src="<?php echo PUBLICADMIN?>assets/js/jquery.validationEngine.js"></script>

		<script type="text/javascript">
			$(document).ready(function(){
				$("#login-form").validationEngine('attach', {
					'ajaxFormValidationMethod': 'post',
					'promptPosition': 'topLeft'
				});
				//3秒清除提示信息
				if ($('.admin-message').html() != '') {
					setTimeout("closeMessage()", 3000);
				};
			});
			function show_box(id) {
				jQuery('.widget-box.visible').removeClass('visible');
				jQuery('#'+id).addClass('visible');
			}
			//清除提示信息
			function closeMessage() {
				$(".admin-message").html('');
			}
		</script>
	</body>
</html>
