<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
	<thead>
		<tr>
			<th width="100"><span class="pull-right">项目</span></th>
			<th>数据</th>
		</tr>
	</thead>

	<?php if ($detail):?>
	<tbody>
		<tr>
			<td>
				<span class="pull-right">姓名</span>
			</td>
			<td><?php echo $detail->realname?></td>
		</tr>
		<tr>
			<td>
				<span class="pull-right">用户名</span>
			</td>
			<td><?php echo $detail->username?></td>
		</tr>
		<tr>
			<td>
				<span class="pull-right">性别</span>
			</td>
			<td><?php echo $detail->sex == 1 ? "男" : "女"?></td>
		</tr>
		<tr>
			<td>
				<span class="pull-right">所属角色</span>
			</td>
			<td><?php echo $detail->role?></td>
		</tr>
		
		<tr>
			<td>
				<span class="pull-right">手机</span>
			</td>
			<td><?php echo $detail->mobil?></td>
		</tr>
		<tr>
			<td>
				<span class="pull-right">邮箱</span>
			</td>
			<td><?php echo $detail->email?></td>
		</tr>
		<tr>
			<td>
				<span class="pull-right">QQ</span>
			</td>
			<td><?php echo $detail->qq?></td>
		</tr>
		<tr>
			<td>
				<span class="pull-right">状态</span>
			</td>
			<td><?php echo $detail->status == 1 ? '激活' : '未激活'?></td>
		</tr>
		<tr>
			<td>
				<span class="pull-right">创建者</span>
			</td>
			<td><?php echo $detail->creator_name?></td>
		</tr>
		<tr>
			<td>
				<span class="pull-right">创建时间</span>
			</td>
			<td><?php echo date('Y-m-d H:i:s', $detail->time)?></td>
		</tr>
	</tbody>
	<?php endif;?>
</table>
