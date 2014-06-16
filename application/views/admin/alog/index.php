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
				<a href="#">日志管理</a>
			</li>
			<li class="active">日志列表</li>
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
			<h1>日志列表</h1>
		</div>
		<!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS -->
				<div class="row">
					<div class="col-xs-12">
						<div class="widget-box">
							<div class="table-header">
								共 <b class="text-warning orange"><?php echo $total?></b> 条数据
							</div>

							<div class="widget-body">
								<div class="widget-main">
									<form class="search-form form-inline" action="/admin/role/role_lists" method="get">
										<label for="s_controller">Conroller:</label>
										<input type="text" id="s_controller" name="s_controller" class="input-sm" placeholder="Controller" value="<?php echo $search['s_controller']?>" />
										<label for="s_method">Method:</label>
										<input type="text" id="s_method" name="s_method" class="input-sm" placeholder="Method" value="<?php echo $search['s_method']?>" />
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
										<th class="center" width="50">
											<label>
												<input type="checkbox" class="ace" />
												<span class="lbl"></span>
											</label>
										</th>
										<th>Controller</th>
										<th>Method</th>
										<th>信息</th>
										<th>URL</th>
										<th>类型</th>
										<th>时间</th>
										<th>管理员</th>
										<th>IP</th>
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
										<td><?php echo $v->controller?></td>
										<td><?php echo $v->method?></td>
										<td><?php echo $v->data?></td>
										<td><?php echo $v->uri?></td>
										<td><?php echo $v->type?></td>
										<td><?php echo date('Y-m-d H:i:s', $v->time)?></td>
										<td><?php echo $v->admin?></td>
										<td><?php echo $v->ip?></td>
										<td>
											<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
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
															<a href="#" class="tooltip-error" data-rel="tooltip" title="删除">
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
	});
</script>