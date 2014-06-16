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
				<a href="#">权限管理</a>
			</li>
			<li class="active">角色（管理组）列表</li>
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
			<h1>角色（管理组）列表</h1>
		</div>
		<!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS -->
				<div class="row">
					<div class="col-xs-12">
						<div class="widget-box">
							<div class="table-header">
								<a class="btn btn-danger" href="/admin/role/add"><i class="icon-edit"></i> 添加 </a>
								共角色（管理组）<b class="text-warning orange"><?php echo $total?></b>个
							</div>

							<div class="widget-body">
								<div class="widget-main">
									<form class="search-form form-inline" action="/admin/role/role_lists" method="get">
										<label for="s_name">角色(管理组):</label>
										<input type="text" id="s_name" name="s_name" class="input-sm" placeholder="角色(管理组)" value="<?php echo $search['s_name']?>" />
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
										<th width="250">角色（管理组）名</th>
										<th>描述</th>
										<th width="200">操作</th>
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
										<td><?php echo $v->name?></td>
										<td><?php echo $v->description?></td>
										<td>
											<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
												<a class="blue" href="/admin/role/permission?rid=<?php echo $v->id?>&name=<?php echo $v->name?>">
													<i class="icon-cog bigger-130"></i>
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
															<a href="/admin/role/permission?rid=<?php echo $v->id?>" class="tooltip-info" data-rel="tooltip" title="分配">
																<span class="blue">
																	<i class="icon-cog bigger-120"></i>
																</span>
															</a>
														</li>

														<li>
															<a href="#" class="tooltip-success" data-rel="tooltip" title="编辑">
																<span class="green">
																	<i class="icon-edit bigger-120"></i>
																</span>
															</a>
														</li>

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