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

		<!--[if IE 7]>
		  <link rel="stylesheet" href="<?php echo PUBLICADMIN?>assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!-- page css -->
		<?php if (isset($page_css)):?>
		<?php foreach ($page_css as $ck => $cv):?>
		<?php if (count($cv) > 0):?>
		<?php foreach ($cv as $fname):?>
		<?php if ($ck == 'default'):?>
		<link rel="stylesheet" href="<?php echo PUBLICADMIN?>css/<?php echo $fname?>.css" />
		<?php else:?>
		<link rel="stylesheet" href="<?php echo PUBLICADMIN . $ck?>/css/<?php echo $fname?>.css" />
		<?php endif;?>
		<?php endforeach;?>
		<?php endif;?>
		<?php endforeach;?>
		<?php endif;?>
		<!-- /page css -->

		<!-- fonts -->
		<link rel="stylesheet" href="<?php echo PUBLICADMIN?>assets/css/fonts.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo PUBLICADMIN?>assets/css/ace.min.css" />
		<link rel="stylesheet" href="<?php echo PUBLICADMIN?>assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="<?php echo PUBLICADMIN?>assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="<?php echo PUBLICADMIN?>assets/css/ace-ie.min.css" />
		<![endif]-->
    
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="<?php echo PUBLICADMIN?>assets/js/html5shiv.js"></script>
		<script src="<?php echo PUBLICADMIN?>assets/js/respond.min.js"></script>
		<![endif]-->

		<!-- ace settings handler -->
		<script type="text/javascript" src="<?php echo PUBLICADMIN?>assets/js/ace-extra.min.js"></script>

		<!-- basic scripts -->
		<script type="text/javascript" src="<?php echo PUBLICADMIN?>assets/js/jquery-2.0.3.min.js"></script>

		<!--[if !IE]>
		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo PUBLICADMIN?>assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>
		<![endif]-->

		<!--[if IE]> -->
		<script type="text/javascript">
		 window.jQuery || document.write("<script src='<?php echo PUBLICADMIN?>assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
		</script>
		<!-- [endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='<?php echo PUBLICADMIN?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script type="text/javascript" src="<?php echo PUBLICADMIN?>assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo PUBLICADMIN?>assets/js/typeahead-bs2.min.js"></script>
</head>

<body>
	<div class="admin-message"><?php echo $this->template->message(); ?></div>
	<!-- /.navbar -->
	<?php echo $this->template->block('navbar');?>
	<!-- /.navbar -->

	<!-- main-container -->
	<div class="main-container" id="main-container">
		<script type="text/javascript">
			try{ace.settings.check('main-container' , 'fixed')}catch(e){}
		</script>

		<div class="main-container-inner">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>

			<!-- .sidebar -->
			<div class="sidebar" id="sidebar">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				<!-- #sidebar-shortcuts -->
				<?php echo $this->template->block('shortcut');?>
				<!-- #sidebar-shortcuts -->

				<!-- .nav-list -->
				<?php echo $this->template->block('nav-list');?>
				<!-- /.nav-list -->

				<div class="sidebar-collapse" id="sidebar-collapse">
					<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
				</div>

				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>
			<!-- /.sidebar -->

		</div>
		<!-- /.main-container-inner -->

		<?php 
		
			echo $this->template->yield(); 
		?>

	</div>
	<!-- /.main-container -->

	<!-- #ace-settings-container -->
	<?php echo $this->template->block('settings');?>
	<!-- /#ace-settings-container -->

	<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
		<i class="icon-double-angle-up icon-only bigger-110"></i>
	</a>

	<!-- ace scripts -->
	<script src="<?php echo PUBLICADMIN?>assets/js/ace-elements.min.js"></script>
	<script src="<?php echo PUBLICADMIN?>assets/js/ace.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		if ($('.admin-message').html() != '') {
			setTimeout("closeMessage()", 3000);
		};
	});
	function closeMessage() {
		$(".admin-message").html('');
	}
	</script>
</body>
</html>
