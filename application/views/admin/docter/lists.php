<!-- main-content -->
<div class="main-content">
	<div class="breadcrumbs" id="breadcrumbs">
		<script type="text/javascript">
			try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
		</script>

		<ul class="breadcrumb">
			<li>
				<i class="icon-home home-icon"></i>
				<a href="/admin/main/index">首页</a>
			</li>

			<li>
				<a href="#">管理面板</a>
			</li>
			<li class="active">医生列表</li>
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
			<h1>医生列表</h1>
		</div>
		<!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS -->
				<div class="row">
					<div class="col-xs-12">
						<div class="widget-box">
							<div class="table-header">
								<a class="btn btn-danger" href="/admin/docter/lists"><i class="icon-edit"></i> 添加 </a>
								共有医生<b class="text-warning orange"><?php echo $total?></b>名
							</div>

							<div class="widget-body">
								<div class="widget-main">
									<form class="search-form form-inline" action="/admin/auth/lists" method="get">
										<label for="s_name">用户名:</label>
										<input type="text" id="s_name" name="s_name" class="input-sm" placeholder="用户名" value="<?php echo $search['s_name']?>" />
										<label for="s_realname">姓名:</label>
										<input type="text" id="s_realname" name="s_realname" class="input-sm" placeholder="姓名" value="<?php echo $search['s_realname']?>" />
										<button type="submit" class="btn btn-success btn-sm">
											搜索
											<i class="icon-search icon-on-right bigger-110"></i>
										</button>
									</form>
								</div>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th class="center">
											<label>
												<input type="checkbox" class="ace" />
												<span class="lbl"></span>
											</label>
										</th>
										<th>ID</th>
										<th>姓名</th>
										<th>用户名</th>
										<th>时间</th>
										<th>状态</th>
										<th>操作</th>
									</tr>
								</thead>

								<?php if (count($list) > 0):?>
								<tbody>
									<?php foreach ($list as $v):?>
									<tr>
										<td class="center">
											<label>
												<input type="checkbox" class="ace" />
												<span class="lbl"></span>
											</label>
										</td>
										<td><?php echo $v->id?></td>
										<td><?php echo $v->realname?></td>
										<td><a href="/admin/docter/action?id=<?php echo $v->id?>"><?php echo $v->username?></a></td>
										<td><?php echo date('Y-m-d H:i:s', $v->time)?></td>
										<td>
											<?php if ($v->status == 1):?>
											<span class="label label-sm label-success"><i class="icon-ok"></i></span>
											<?php else:?>
											<span class="label label-sm label-warning"><i class="icon-remove"></i></span>
											<?php endif;?>
										</td>
										<td>
											<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
												<!-- <a class="btn-blue admin-detail" href="#modal-table" data-toggle="modal" value="<?php echo $v->id?>">
													<i class="icon-zoom-in bigger-130"></i>
												</a> -->
											
												<a class="green" href="/admin/docter/action?id=<?php echo $v->id?>">
													<i class="icon-pencil bigger-130"></i>
												</a>
											</div>

											<div class="visible-xs visible-sm hidden-md hidden-lg">
												<div class="inline position-relative">
													<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
														<i class="icon-caret-down icon-only bigger-120"></i>
													</button>

													<ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
														<li>
															<a href="#modal-table" class="tooltip-info admin-detail" data-rel="tooltip" data-toggle="modal" value="<?php echo $v->id?>">
																<span class="blue">
																	<i class="icon-zoom-in bigger-120"></i>
																</span>
															</a>
														</li>

														<li>
															<a href="/admin/docter/action?id=<?php echo $v->id?>" class="tooltip-success" data-rel="tooltip" title="Edit">
																<span class="green">
																	<i class="icon-edit bigger-120"></i>
																</span>
															</a>
														</li>
													</ul>
												</div>
											</div>
										</td>
									</tr>
									<?php endforeach;?>
								</tbody>
								<?php endif;?>
							</table>
							<div class="row">
								<div class="col-sm-6">
									<div class="dataTables_info">共 <?php echo $total?> 条数据</div>
								</div>
								<div class="col-sm-6">
									<div class="dataTables_paginate paging_bootstrap"><?php echo $page_links?></div>
								</div>
							</div>
						</div><!-- /.table-responsive -->
					</div><!-- /span -->
				</div>
				<!-- <div id="modal-table" class="modal fade" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header no-padding">
								<div class="table-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										<span class="white">&times;</span>
									</button>
									查看详细信息
								</div>
							</div>
				
							<div class="modal-body no-padding"><i class="icon-spinner icon-spin orange bigger-300"></i></div>
				
							<div class="modal-footer no-margin-top">
								<button class="btn btn-sm btn-blue pull-left" data-dismiss="modal">
									<i class="icon-pencil"></i>
									Close
								</button>
							</div>
						</div>/.modal-content
					</div>/.modal-dialog
				</div> -->
				<!-- PAGE CONTENT ENDS -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.page-content -->
</div>
<!-- /.main-content -->
<script type="text/javascript">
$(document).ready(function() {
	$('table th input:checkbox').on('click' , function(){
		var that = this;
		$(this).closest('table').find('tr > td:first-child input:checkbox').each(function(){
			this.checked = that.checked;
			$(this).closest('tr').toggleClass('selected');
		});
	});

	/**
	 * [获取管理员详细信息并显示到弹出层]
	 * @return {[type]} [description]
	 */
	$('.admin-detail').click(function() {
		var v = $(this).attr('value');
		$("#modal-table .modal-body").html('<i class="icon-spinner icon-spin orange bigger-300"></i>');
		$.post('/admin/auth/admin_detail', {id:v}, function(data){
			$("#modal-table .modal-body").html(data);
		}, 'html');
	});
});
</script>