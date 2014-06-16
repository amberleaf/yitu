<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>错误提示页面 - 医图在线</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- basic styles -->
		<link rel="stylesheet" href="<?php echo PUBLICADMIN?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo PUBLICADMIN?>assets/css/font-awesome.min.css" />
		<link rel="stylesheet" href="<?php echo PUBLICADMIN?>assets/css/fonts.css" />
		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo PUBLICADMIN?>assets/css/ace.min.css" />
		<link rel="stylesheet" href="<?php echo PUBLICADMIN?>assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="<?php echo PUBLICADMIN?>assets/css/ace-skins.min.css" />
	</head>
	<body>
		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->

					<div class="error-container">
						<div class="well">
							<h1 class="grey lighter smaller">
								<span class="blue bigger-125">
									<i class="icon-sitemap"></i>
									哇，你真厉害！
								</span>
								<?php echo $heading; ?>
							</h1>

							<hr />
							<h3 class="lighter smaller"><?php echo $message; ?></h3>

							<div>

								<div class="space"></div>
								<h4 class="smaller">尝试如下操作:</h4>

								<ul class="list-unstyled spaced inline bigger-110 margin-15">
									<li>
										<i class="icon-hand-right blue"></i>
										检查您的网络是否畅通
									</li>

									<li>
										<i class="icon-hand-right blue"></i>
										检查您的网站是否正常运行
									</li>

									<li>
										<i class="icon-hand-right blue"></i>
										检查您是否有权限
									</li>
								</ul>
							</div>
<!-- 
							<hr />
							<div class="space"></div>

							<div class="center">
								<a href="/admin/main/index" class="btn btn-grey">
									<i class="icon-arrow-left"></i>
									返回
								</a>

								<a href="/admin/auth/logout" class="btn btn-primary">
									<i class="icon-dashboard"></i>
									退出登录
								</a>
							</div> -->
						</div>
					</div><!-- PAGE CONTENT ENDS -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div>
	</body>
</html>
