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
			<li class="active">医院列表</li>
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
			<h1>医院列表</h1>
		</div>
		<!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS -->
				<div class="row">
					<div class="col-xs-12">
						<div class="widget-box">
							<div class="table-header">
								<a class="btn btn-danger" href="/admin/hospital/edit_hospital"><i class="icon-edit"></i> 添加 </a>
								共建立医院<b class="text-warning orange"><?php echo $total?></b>个
							</div>

							<div class="widget-body">
								<div class="widget-main">
									<form class="search-form form-inline" action="/admin/hospital/lists" method="get">
										<label for="s_fname">医院名称:</label>
										<input type="text" id="s_fname" name="s_fname" class="input-small" placeholder="医院" value="<?php echo $search['s_fname']?>" />
										<label for="s_phone">电话:</label>
										<input type="text" id="s_extel" name="s_extel" class="input-small" placeholder="电话" value="<?php echo $search['s_extel']?>" />
										<label for="s_address">地址:</label>
										<input type="text" id="s_address" name="s_address" class="input-small" placeholder="地址" value="<?php echo $search['s_address']?>" />
										<label for="s_status">状态:</label>
										<select name="s_status" id="s_status">
											<option value="">-选择-</option>
										</select>
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
										<th>医院名称</th>
										<th>省市</th>
										<th>市区</th>
										<th>等级</th>
										<th>地址</th>
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
										<td><?php echo $v->fname?></td>
										<td><?php echo $v->province_name ?></td>
										<td><?php echo $v->city_name?></td>
										<td><?php echo $v->grade?></td>
										<td><?php echo $v->address?></td>
										<td>
											<?php if ($v->status == 1):?>
											<span class="label label-sm label-success"><i class="icon-ok"></i></span>
											<?php else:?>
											<span class="label label-sm label-warning"><i class="icon-remove"></i></span>
											<?php endif;?>
										</td>
										<td>
											<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">

												<a class="green" href="/admin/auth/create_Hospital?id=<?php echo $v->id?>">
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
															<a href="/admin/hospital/edit_hospital?id=<?php echo $v->id?>" class="tooltip-success" data-rel="tooltip" title="Edit">
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