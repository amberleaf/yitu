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
			<li class="active">添加科室</li>
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
			<h1>添加/修改科室</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS -->

				<form id="add-admin-form" class="form-horizontal" action="/admin/auth/create_school_area" method="post">

					<?php if ($school_area):?>
					<input type="hidden" name="id" value="<?php echo $school_area->id?>">
					<?php endif;?>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right"> 区域 </label>

						<div id="pcc" class="col-sm-9">
							<?php if (count($provinces) > 0):?>
							<select class="validate[required] form-control col-sm-4" id="province" name="province" style="width:100px;">
								<option value="">--省份--</option>
								<?php foreach ($provinces as $p):?>
								<option level="<?php echo $p->level?>" value="<?php echo $p->id?>"<?php echo $p->id == $school_area->province?'selected="selected"':''?>><?php echo $p->name?></option>
								<?php endforeach;?>
							</select>
							<?php endif;?>
							<select class="validate[required] form-control col-sm-4" id="city" name="city" style="width:100px;">
								<?php if (isset($school_area->city)):?>
								<option value="<?php echo $school_area->city?>"><?php echo $school_area->city_name?></option>
								<?php else:?>
								<option value="">--城市--</option>
								<?php endif;?>
							</select>
							<select class="validate[required] form-control col-sm-4" id="county" name="county" style="width:100px;">
								<?php if (isset($school_area->county)):?>
								<option value="<?php echo $school_area->county?>"><?php echo $school_area->county_name?></option>
								<?php else:?>
								<option value="">--区|县--</option>
								<?php endif;?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="school"> 学校 </label>

						<div class="col-sm-4">
							<select class="validate[required] width-80 chosen-select" id="school" data-placeholder="请选择学校" name="school">
								<?php if (isset($school_area->schoolid)):?>
								<option value="<?php echo $school_area->schoolid?>"><?php echo $school_area->schoolname?></option>
								<?php else:?>
								<option value=""></option>
								<?php endif;?>
							</select>
							<input type="hidden" id="schoolname" name="schoolname" />
							<span class="help-inline col-xs-12 col-sm-7"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="channeladmin"> 渠道管理员 </label>

						<div class="col-sm-2">
							<select class="validate[required] width-80 chosen-select" id="channeladmin" data-placeholder="选择管理员" name="channeladmin">
								<option value=""></option>
								<?php if (count($channel_admins) > 0):?>
									<?php foreach($channel_admins as $val):?>
								<option value="<?php echo $val->id?>"<?php echo $val->id == $school_area->channeladmin?'selected="selected"':''?>><?php echo $val->realname?></option>
									<?php endforeach;?>
								<?php endif;?>
							</select>
							<span class="help-inline col-xs-12 col-sm-7"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="Hospital"> 医院 </label>

						<div class="col-sm-2">
							<select class="validate[required] width-80 chosen-select" id="Hospital" data-placeholder="选择医院" name="Hospital">
								<option value=""></option>
								<?php if (count($Hospitals) > 0):?>
									<?php foreach($Hospitals as $val):?>
								<option value="<?php echo $val->id?>"<?php echo $val->id == $school_area->Hospitalid?'selected="selected"':''?>><?php echo $val->Hospitalname?></option>
									<?php endforeach;?>
								<?php endif;?>
							</select>
							<span class="help-inline col-xs-12 col-sm-7"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="schoolmaster"> 校长 </label>

						<div class="col-sm-9">
							<input type="text" id="schoolmaster" name="schoolmaster" value="<?php echo $school_area->schoolmaster?>" placeholder="校长" class="validate[required, minSize[3], maxSize[10]] col-xs-10 col-sm-4" />
							<span class="help-inline col-xs-12 col-sm-7"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="schoolemail"> 电子邮件 </label>

						<div class="col-sm-9">
							<input type="text" id="schoolemail" name="schoolemail" value="<?php echo $school_area->schoolemail?>" placeholder="电子邮件" class="validate[required, custom[email]] col-xs-10 col-sm-4" />
							<span class="help-inline col-xs-12 col-sm-7"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="schoolphone"> 固定电话 </label>

						<div class="col-sm-9">
							<input type="text" id="schoolphone" name="schoolphone" value="<?php echo $school_area->schoolphone?>" placeholder="固定电话" class="validate[custom[phone]] col-xs-10 col-sm-4" />
							<span class="help-inline col-xs-12 col-sm-7"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="schoolmobil"> 手机 </label>

						<div class="col-sm-9">
							<input type="text" id="schoolmobil" name="schoolmobil" value="<?php echo $school_area->schoolmobil?>" placeholder="手机" class="validate[required, custom[phone], maxSize[11]] col-xs-10 col-sm-4" />
							<span class="help-inline col-xs-12 col-sm-7"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="schooladdress"> 学校地址 </label>

						<div class="col-sm-4">
							<textarea class="validate[required] form-control" id="schooladdress" name="schooladdress" placeholder="学校地址"><?php echo $school_area->schooladdress?></textarea>
							<span class="help-inline col-xs-12 col-sm-7"></span>
						</div>
					</div>

					<div class="clearfix form-actions">
						<div class="col-md-offset-3 col-md-9">
							<button class="btn btn-info" type="submit">
								<i class="icon-ok bigger-110"></i>
								<?php echo isset($school_area)?'修改':'添加'?>
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
		$(".chosen-select").chosen({
			no_results_text: "没有找到"
		}).change(function(){
			if ($(this).attr('id') == 'school') {
				$("#schoolname").val($(this).children('option[value='+$(this).val()+']').html());
			};
		});
		$("#add-admin-form").validationEngine('attach', {
			'ajaxFormValidationMethod': 'post'
		});

		//区域选择
		$("#province, #city, #county").change(function() {
			var idarr = new Array('province', 'city', 'county'),
				pi = $(this).val(),
				lv = parseInt($(this).find("option[value="+pi+"]").attr('level'));
			$("#"+idarr[lv-1]+" ~ select").html("<option value=''>--选择--</option>").val('');
			$("#school").html("<option value=''></option>").val('');
			$.post("/admin/city/get_cities", {pid: pi, level: (lv+1)}, function(data){
				if (data.length > 0) {
					$.each(data, function(i,v) {
						var o = '<option level="'+v.level+'" value="'+v.id+'">'+v.name+'</option>';
						$("#"+idarr[lv]).append(o)
					});
				};
			}, 'json');
			if ($(this).attr('id') != 'province') {
				var provinceId = $("#province").val(),
					cityId = $("#city").val(),
					countyId = $("#county").val();
				$.post("/admin/city/get_schools", {pid: provinceId, cid: cityId, tid: countyId}, function(obj){
					if (obj.length > 0) {
						$.each(obj, function(i,s) {
							var so = '<option value="'+s.id+'">'+s.school+'</option>';
							$("#school").append(so);
						})
					};
					$(".chosen-select").trigger("chosen:updated");
				}, 'json');
			} else {
				$("#school").html("<option value=''></option>");
				$(".chosen-select").trigger("chosen:updated");
			};
		});
	});
</script>
