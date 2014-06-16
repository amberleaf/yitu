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
			<li class="active">添加/编辑医院</li>
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
			<h1><?php echo isset($hospital)?'编辑':'添加'?>医院</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS -->

				<form id="agency-form" class="form-horizontal" action="/admin/hospital/edit-hospital" method="post">
					<?php if ($hospital):?>
					<input type="hidden" name="id" value="<?php echo $hospital->id?>">
					<?php endif;?>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="fname"> 医院名称 </label>

						<div class="col-sm-9">
							<input type="text" id="fname" name="fname" value="<?php echo $hospital->fname?>" placeholder="医院名称" class="validate[required, maxSize[20]] col-xs-10 col-sm-4" />
							<span class="help-inline col-xs-12 col-sm-7"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="sname"> 简称 </label>

						<div class="col-sm-9">
							<input type="text" id="sname" name="sname" value="<?php echo $hospital->sname?>" placeholder="简称" class="validate[required, minSize[2], maxSize[10]] col-xs-10 col-sm-4" />
							<span class="help-inline col-xs-12 col-sm-7"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right"> 区域 </label>

						<div id="pcc" class="col-sm-9">
							<?php if (count($provinces) > 0):?>
							<select class="validate[required] form-control col-sm-4" id="province" name="province" style="width:100px;">
								<option value="">--省份--</option>
								<?php foreach ($provinces as $p):?>
								<option level="<?php echo $p->level?>" value="<?php echo $p->id?>"<?php echo $p->id == $hospital->province?'selected="selected"':''?>><?php echo $p->name?></option>
								<?php endforeach;?>
							</select>
							<?php endif;?>
							<select class="validate[required] form-control col-sm-4" id="city" name="city" style="width:100px;">
								<?php if (isset($hospital->city)):?>
								<option value="<?php echo $hospital->city?>"><?php echo $hospital->city_name?></option>
								<?php else:?>
								<option value="">--城市--</option>
								<?php endif;?>
							</select>
							 
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="extel"> 电话 </label>

						<div class="col-sm-9">
							<input type="text" id="extel" name="extel" value="<?php echo $hospital->extel?>" placeholder="电话" class="validate[required, custom[extel], maxSize[11]] col-xs-10 col-sm-4" />
							<span class="help-inline col-xs-12 col-sm-7"></span>
						</div>
					</div>

					 

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="address"> 地址 </label>

						<div class="col-sm-4">
							<textarea class="form-control" id="address" name="address" placeholder="医院地址"><?php echo $hospital->address?></textarea>
							<span class="help-inline col-xs-12 col-sm-7"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="logo"> 医院LOGO </label>

						<div class="col-sm-9">
							<input readonly="true" type="text" id="logo" name="logo" value="<?php echo $hospital->logo?>" placeholder="医院LOGO" class="validate[required] col-xs-10 col-sm-4" />
							<span class="help-inline col-xs-12 col-sm-7">
								<i class="icon-hand-right green"></i>
								<a href="#modal-form" role="button" class="blue" data-toggle="modal"> 上传 </a>
							</span>
						</div>
					</div>

					<div class="clearfix form-actions">
						<div class="col-md-offset-3 col-md-9">
							<button class="btn btn-info" type="submit">
								<i class="icon-ok bigger-110"></i>
								<?php echo isset($hospital)?'修改':'添加'?>
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
		<div id="modal-form" class="modal" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 id="modal-title" class="blue bigger">请选择LOGO，开始上传...</h4>
					</div>

					<div class="modal-body overflow-visible">
						<div class="row">
							<div class="col-xs-12">
								<div class="form-group">
									<div>
									    <div id="progress" class="progress">
											<div class="progress-bar"></div>
										</div>
										<span class="btn btn-success fileinput-button">
									        <i class="glyphicon glyphicon-plus"></i>
									        <span>添加...</span>
									        <input id="fileupload" type="file" name="userfile" multiple />
									    </span>
										<div id="files" class="files"></div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="modal-footer">
						<button class="btn btn-sm" data-dismiss="modal">
							<i class="icon-remove"></i>
							取消
						</button>

						<button class="btn btn-sm btn-primary" data-dismiss="modal">
							<i class="icon-ok"></i>
							保存
						</button>
					</div>
				</div>
			</div>
		</div>
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
<script src="<?php echo PUBLICADMIN?>assets/js/vendor/jquery.ui.widget.js"></script>
<script src="<?php echo PUBLICADMIN?>assets/js/load-image.min.js"></script>
<script src="<?php echo PUBLICADMIN?>assets/js/jquery.fileupload.js"></script>
<script src="<?php echo PUBLICADMIN?>assets/js/jquery.fileupload-process.js"></script>
<script src="<?php echo PUBLICADMIN?>assets/js/jquery.fileupload-image.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
	$(document).ready(function() {
		$("#agency-form").validationEngine('attach', {
			'ajaxFormValidationMethod': 'post'
		});

	    'use strict';
	    // Change this to the location of your server-side upload handler:
	    // var url = window.location.hostname === 'www.zd.dev' ? '//jquery-file-upload.appspot.com/' : 'server/php/',
	    var url = '/admin/main/do_upload',
	        uploadButton = $('<button/>')
	            .addClass('btn btn-info')
	            .prop('disabled', true)
	            .text('Processing...')
	            .on('click', function () {
	                var $this = $(this),
	                    data = $this.data();
	                $this
	                    .off('click')
	                    .text('Abort')
	                    .on('click', function () {
	                        $this.remove();
	                        data.abort();
            	});
            data.submit().always(function () {
                $this.remove();
            });
        });
	    $('#fileupload').fileupload({
	        url: url,
	        dataType: 'json',
	        autoUpload: false,
	        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
	        maxFileSize: 5000000, // 5 MB
	        // Enable image resizing, except for Android and Opera,
	        // which actually support image resizing, but fail to
	        // send Blob objects via XHR requests:
	        disableImageResize: /Android(?!.*Chrome)|Opera/
	            .test(window.navigator.userAgent),
	        previewMaxWidth: 100,
	        previewMaxHeight: 100,
	        previewCrop: true
	    }).on('fileuploadadd', function (e, data) {
	        data.context = $('<div/>').appendTo('#files');
	        $.each(data.files, function (index, file) {
	            var node = $('<p/>')
	                    .append($('<span/>').text(file.name));
	            if (!index) {
	                node.append('<br>').append(uploadButton.clone(true).data(data));
	            }
	            node.appendTo(data.context);
	        });
	    }).on('fileuploadprocessalways', function (e, data) {
	        var index = data.index,
	            file = data.files[index],
	            node = $(data.context.children()[index]);
	        if (file.preview) {
	            node.prepend('<br>').prepend(file.preview);
	        }
	        if (file.error) {
	            node.append('<br>').append($('<span class="text-danger"/>').text(file.error));
	        }
	        if (index + 1 === data.files.length) {
	            data.context.find('button')
	                .text('开始')
	                .prop('disabled', !!data.files.error);
	        }
	    }).on('fileuploadprogressall', function (e, data) {
	        var progress = parseInt(data.loaded / data.total * 100, 10);
	        $('#progress .progress-bar').css(
	            'width',
	            progress + '%'
	        );
	        $('#progress').attr('data-percent', progress + '%');
	    }).on('fileuploaddone', function (e, data) {
	        $.each(data.result.files, function (index, file) {
	            if (file.url) {
	            	$("#logo").val(file.url);
	            	$("#modal-title").html("上传成功!");
	                // var link = $('<a>').attr('target', '_blank').prop('href', file.url);
	                // $(data.context.children()[index]).wrap(link);
	            } else if (file.error) {
	                var error = $('<span class="text-danger"/>').text(file.error);
	                $(data.context.children()[index]).append('<br>').append(error);
	            }
	        });
	    }).on('fileuploadfail', function (e, data) {
	        $.each(data.files, function (index, file) {
	            var error = $('<span class="text-danger"/>').text('图片上传失败！');
	            $(data.context.children()[index]).append('<br>').append(error);
	        });
	    }).prop('disabled', !$.support.fileInput)
	        .parent().addClass($.support.fileInput ? undefined : 'disabled')
	    	.find("input:file").removeAttr('disabled');
	});
</script>
