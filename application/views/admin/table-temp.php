<!-- main-content -->
<div class="main-content">
	<div class="breadcrumbs" id="breadcrumbs">
		<script type="text/javascript">
			try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
		</script>

		<ul class="breadcrumb">
			<li>
				<i class="icon-home home-icon"></i>
				<a href="#">Home</a>
			</li>

			<li>
				<a href="#">Tables</a>
			</li>
			<li class="active">Simple &amp; Dynamic</li>
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
				Tables
				<small>
					<i class="icon-double-angle-right"></i>
					Static &amp; Dynamic Tables
				</small>
			</h1>
		</div>
		<!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS -->

				<!-- <h4 class="pink">
					<i class="icon-hand-right icon-animated-hand-pointer blue"></i>
					<a href="#modal-table" role="button" class="green" data-toggle="modal"> Table Inside a Modal Box </a>
				</h4> -->
				<div class="row">
					<div class="col-xs-12">
						<div class="table-header">
							超级管理员<b class="text-warning orange">100</b>名　
							超级管理员<b class="text-warning orange">100</b>名　
							超级管理员<b class="text-warning orange">100</b>名　
							超级管理员<b class="text-warning orange">100</b>名　
							超级管理员<b class="text-warning orange">100</b>名　
						</div>

						<div class="table-responsive">
							<table id="sample-table-2" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th class="center">
											<label>
												<input type="checkbox" class="ace" />
												<span class="lbl"></span>
											</label>
										</th>
										<th>用户名</th>
										<th>姓名</th>
										<th>类型</th>
										<th>权限</th>
										<th>身份证</th>
										<th>手机</th>
										<th>邮箱</th>
										<th>医院</th>
										<th>科室</th>
										<th>状态</th>
										<th>操作</th>
									</tr>
								</thead>

								<tbody>
									<tr>
										<td class="center">
											<label>
												<input type="checkbox" class="ace" />
												<span class="lbl"></span>
											</label>
										</td>

										<td><a href="#">app.com</a></td>
										<td>$45</td>
										<td>3,330</td>
										<td>Feb 12</td>
										<td>Feb 12</td>
										<td>Feb 12</td>
										<td>Feb 12</td>
										<td>Feb 12</td>
										<td>Feb 12</td>
										<td><span class="label label-sm label-warning">Expiring</span></td>

										<td>
											<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
												<a class="blue" href="#">
													<i class="icon-zoom-in bigger-130"></i>
												</a>

												<a class="green" href="#">
													<i class="icon-pencil bigger-130"></i>
												</a>

												<a class="red" href="#">
													<i class="icon-trash bigger-130"></i>
												</a>
											</div>

											<div class="visible-xs visible-sm hidden-md hidden-lg">
												<div class="inline position-relative">
													<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
														<i class="icon-caret-down icon-only bigger-120"></i>
													</button>

													<ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
														<li>
															<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																<span class="blue">
																	<i class="icon-zoom-in bigger-120"></i>
																</span>
															</a>
														</li>

														<li>
															<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																<span class="green">
																	<i class="icon-edit bigger-120"></i>
																</span>
															</a>
														</li>

														<li>
															<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																<span class="red">
																	<i class="icon-trash bigger-120"></i>
																</span>
															</a>
														</li>
													</ul>
												</div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div id="modal-table" class="modal fade" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header no-padding">
								<div class="table-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										<span class="white">&times;</span>
									</button>
									Results for "Latest Registered Domains
								</div>
							</div>

							<div class="modal-body no-padding">
								<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
									<thead>
										<tr>
											<th>Domain</th>
											<th>Price</th>
											<th>Clicks</th>

											<th>
												<i class="icon-time bigger-110"></i>
												Update
											</th>
										</tr>
									</thead>

									<tbody>
										<tr>
											<td>
												<a href="#">ace.com</a>
											</td>
											<td>$45</td>
											<td>3,330</td>
											<td>Feb 12</td>
										</tr>

										<tr>
											<td>
												<a href="#">base.com</a>
											</td>
											<td>$35</td>
											<td>2,595</td>
											<td>Feb 18</td>
										</tr>

										<tr>
											<td>
												<a href="#">max.com</a>
											</td>
											<td>$60</td>
											<td>4,400</td>
											<td>Mar 11</td>
										</tr>

										<tr>
											<td>
												<a href="#">best.com</a>
											</td>
											<td>$75</td>
											<td>6,500</td>
											<td>Apr 03</td>
										</tr>

										<tr>
											<td>
												<a href="#">pro.com</a>
											</td>
											<td>$55</td>
											<td>4,250</td>
											<td>Jan 21</td>
										</tr>
									</tbody>
								</table>
							</div>

							<div class="modal-footer no-margin-top">
								<button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
									<i class="icon-remove"></i>
									Close
								</button>

								<ul class="pagination pull-right no-margin">
									<li class="prev disabled">
										<a href="#">
											<i class="icon-double-angle-left"></i>
										</a>
									</li>

									<li class="active">
										<a href="#">1</a>
									</li>

									<li>
										<a href="#">2</a>
									</li>

									<li>
										<a href="#">3</a>
									</li>

									<li class="next">
										<a href="#">
											<i class="icon-double-angle-right"></i>
										</a>
									</li>
								</ul>
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div>
				<!-- PAGE CONTENT ENDS -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.page-content -->
</div>
<!-- /.main-content -->

<!-- page specific plugin scripts -->
<script src="<?php echo PUBLICADMIN?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo PUBLICADMIN?>assets/js/jquery.dataTables.bootstrap.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
	jQuery(function($) {
		$('#sample-table-2').dataTable( {
			"aoColumns": [
		      { "bSortable": false },
		      null,
			  { "bSortable": false },
			  { "bSortable": false },
			  { "bSortable": false },
			  { "bSortable": false },
			  { "bSortable": false },
			  { "bSortable": false },
			  { "bSortable": false },
			  { "bSortable": false },
			  { "bSortable": false },
			  { "bSortable": false }
			],
			"oLanguage": {
				"sLengthMenu": "每页显示_MENU_条数据",
				"sZeroRecords": "抱歉，没有找到！",
				"sInfo": "从 _START_ 到 _END_ /共 _TOTAL_ 条数据",
				"sInfoEmpty": "没有数据！",
				"sInfoFiltered": "(从 _MAX_ 条数据中检索)",
				"oPaginate": {
					"sFirst": "首页",
					"sPrevious": "上一页",
					"sNext": "下一页",
					"sLast": "尾页"
				}
			},
			"sZeroRecords": "抱歉，没有检索到数据！",
			"sProcessing": "<i class='icon-spinner icon-spin orange bigger-125'></i>",
		} );
		
		
		$('table th input:checkbox').on('click' , function(){
			var that = this;
			$(this).closest('table').find('tr > td:first-child input:checkbox')
			.each(function(){
				this.checked = that.checked;
				$(this).closest('tr').toggleClass('selected');
			});
		});
	
	
		$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
		function tooltip_placement(context, source) {
			var $source = $(source);
			var $parent = $source.closest('table')
			var off1 = $parent.offset();
			var w1 = $parent.width();
	
			var off2 = $source.offset();
			var w2 = $source.width();
	
			if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
			return 'left';
		}
	})
</script>