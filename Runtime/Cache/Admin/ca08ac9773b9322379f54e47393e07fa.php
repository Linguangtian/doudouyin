<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<title>分类管理 - <?php echo sp_cfg('website');?></title>
	    <meta http-equiv="Cache-Control" content="no-transform" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="/Public/statics/bootstrap-3.3.5/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/Public/statics/bootstrap-3.3.5/css/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="/Public/statics/font-awesome-4.4.0/css/font-awesome.min.css" />

    <!--[if IE 7]>
        <link rel="stylesheet" href="/tpl/Admin/Public/aceadmin/css/font-awesome-ie7.min.css" />
    <![endif]-->
    <link rel="stylesheet" href="/tpl/Admin/Public/aceadmin/css/ace.min.css" />
    <link rel="stylesheet" href="/tpl/Admin/Public/aceadmin/css/ace-rtl.min.css" />
    <link rel="stylesheet" href="/tpl/Admin/Public/aceadmin/css/ace-skins.min.css" />
    <!--[if lte IE 8]>
        <link rel="stylesheet" href="/tpl/Admin/Public/aceadmin/css/ace-ie.min.css" />
    <![endif]-->
    <script src="/tpl/Admin/Public/aceadmin/js/ace-extra.min.js"></script>
    <!--[if lt IE 9]>
        <script src="/tpl/Admin/Public/aceadmin/js/html5shiv.js"></script>
        <script src="/tpl/Admin/Public/aceadmin/js/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="/tpl/Public/css/base.css" />
    <link rel="stylesheet" href="/tpl/Public/js/artDialog/skins/default.css" />
</head>
<body>
<!-- 导航栏开始 -->
<div class="bjy-admin-nav">
	<a href="<?php echo U('Admin/Index/index');?>"><i class="fa fa-home"></i> 首页</a>
	&gt;
	分类管理
</div>
<!-- 导航栏结束 -->
<ul id="myTab" class="nav nav-tabs">
   <li class="active">
		 <a href="#home" data-toggle="tab">分类列表</a>
   </li>
   <li>
		<a href="javascript:;" onclick="add()">添加分类</a>
	</li>
</ul>
<form action="<?php echo U('Admin/Category/order');?>" method="post">
	<div id="myTabContent" class="tab-content">
	   <div class="tab-pane fade in active" id="home">
			<table class="table table-striped table-bordered table-hover table-condensed">
				<tr>
					<th width="5%">排序</th>
                    <th width="40">ID</th>
					<th>分类名</th>
					<th>图标</th>
					<th>首页显示</th>
					<th>操作</th>
				</tr>
				<?php if(is_array($data)): foreach($data as $key=>$v): ?><tr>
						<td>
							<input class="form-control" style="width:40px;height:25px;" type="text" name="<?php echo ($v['id']); ?>" value="<?php echo ($v['order_number']); ?>">
						</td>
                        <td><?php echo ($v['id']); ?></td>
						<td><?php echo ($v['_name']); ?></td>
						<td><img src="<?php echo ($v['ico']); ?>" alt="" width="60"></td>
						<td><?php echo ($v['is_show'] ? '显示' : '不显示'); ?></td>
						<td>
							<!--<a href="javascript:;" CategoryId="<?php echo ($v['id']); ?>" CategoryName="<?php echo ($v['name']); ?>"  onclick="add_child(this)">添加子分类</a> |-->
							<a href="javascript:;" sort="<?php echo ($v['order_number']); ?>" CategoryId="<?php echo ($v['id']); ?>" CategoryName="<?php echo ($v['name']); ?>" CategoryMca="<?php echo ($v['mca']); ?>" Desc="<?php echo ($v['desc']); ?>" isShow="<?php echo ($v['is_show']); ?>" CategoryIco="<?php echo ($v['ico']); ?>" onclick="edit(this)">修改</a>
							<a href="javascript:if(confirm('确定删除？'))location='<?php echo U('Admin/Category/delete',array('id'=>$v['id']));?>'">删除</a>
						</td>
					</tr><?php endforeach; endif; ?>
				<tr>
					<th>
						<input class="btn btn-success" type="submit" value="排序">
					</th>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>
                    <td></td>
				</tr>
			</table>
	   </div>
	</div>
</form>
<!-- 添加分类模态框开始 -->
<div class="modal fade" id="bjy-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		 <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel">
					添加分类
				</h4>
			</div>
			<div class="modal-body">
				<form id="bjy-form" class="form-inline" action="<?php echo U('Admin/Category/add');?>" method="post">
					<input type="hidden" name="pid" value="0">
					<table class="table table-striped table-bordered table-hover table-condensed">
						<tr>
							<th width="12%">分类名：</th>
							<td>
								<input class="form-control" type="text" name="name">
							</td>
						</tr>
						<tr>
							<th>简短描述：</th>
							<td>
								<textarea class="form-control" type="text" name="desc"> </textarea> 描述
							</td>
						</tr>
						<tr>
							<th>图标：</th>
							<td>
								<input class="form-control" type="hidden" id="ico" name="ico">
								<img src="/tpl/Public/js/fex/image.png" onclick="addImgs('ico')" alt="" width="45">　
								<span style="color: #c0c0c0;">点击上传,图标主要显示在前端首页</span>
							</td>
						</tr>
						<tr>
							<th>前台首页显示：</th>
							<td>
								<input class="form-control" type="radio" value="1" name="is_show">显示　
								<input class="form-control" type="radio" value="0" name="is_show">不显示

								<span style="color: #c0c0c0;">此选项 主要显示在 前台首页 轮播图下方</span>
							</td>
						</tr>
						<tr>
							<th>排序：</th>
							<td>
								<input class="form-control" type="text" name="order_number">
								排序越小 越靠前
							</td>
						</tr>
						<tr>
							<th></th>
							<td>
								<input class="btn btn-success" type="submit" value="添加">
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- 添加分类模态框结束 -->

<!-- 修改分类模态框开始 -->
<div class="modal fade" id="bjy-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
	<div class="modal-dialog">
		 <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel2">
					修改分类
				</h4>
			</div>
			<div class="modal-body">
				<form id="bjy-form2" class="form-inline" action="<?php echo U('Admin/Category/edit');?>" method="post">
					<input type="hidden" name="id">
					<table class="table table-striped table-bordered table-hover table-condensed">
						<tr>
							<th width="12%">分类名：</th>
							<td>
								<input class="form-control" type="text" name="name">
							</td>
						</tr>
						<tr>
							<th>简短描述：</th>
							<td>
								<textarea class="form-control" type="text" name="desc"> </textarea> 描述
							</td>
						</tr>
						<tr>
							<th>图标：</th>
							<td>
								<input class="form-control" type="hidden" id="ico2" name="ico">
								<img src="/tpl/Public/js/fex/image.png" onclick="addImgs('ico2')" alt="" width="45">　
								<span style="color: #c0c0c0;">点击上传,图标主要显示在前端首页</span>
							</td>
						</tr>
						<tr>
							<th>前台首页显示：</th>
							<td>
								<input class="form-control" type="radio" value="1" name="is_show">显示　
								<input class="form-control" type="radio" value="0" name="is_show">不显示
								<span style="color: #c0c0c0;">此选项 主要显示在 前台首页 轮播图下方</span>
							</td>
						</tr>
						<tr>
							<th>排序：</th>
							<td>
								<input class="form-control" type="text" name="order_number">
								排序越小 越靠前
							</td>
						</tr>
						<tr>
							<th></th>
							<td>
								<input class="btn btn-success" type="submit" value="添加">
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- 修改分类模态框结束 -->
<!-- 引入bootstrjs部分开始 -->
<script src="/Public/statics/js/jquery-1.10.2.min.js"></script>
<script src="/Public/statics/bootstrap-3.3.5/js/bootstrap.min.js"></script>
<script src="/tpl/Public/js/artDialog/artDialog.js"></script>
<script src="/tpl/Public/js/artDialog/iframeTools.js"></script>
<script src="/tpl/Public/js/bootbox.js"></script>
<script src="/tpl/Public/js/base.js"></script>

<link rel="stylesheet" href="/tpl/Public/js/datepicker/css/bootstrap-datepicker3.min.css" />
<link rel="stylesheet" href="/tpl/Public/js/datepicker/css/bootstrap-datetimepicker.min.css" />
<script src="/tpl/Public/js/datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="/tpl/Public/js/datepicker/js/bootstrap-timepicker.min.js"></script>

<script src="/Public/statics/layer/layer.js"></script>
<script src="/Public/statics/layer/extend/layer.ext.js"></script>

<script>
// 添加分类
function add(){
	$("input[name='name'],input[name='mca']").val('');
	$("input[name='pid']").val(0);
	$('#bjy-add').modal('show');
}

//多图添加
function addImgs(id){
    flashupload2(id, '上传文件', id, return_value, '<?php echo CONTROLLER_NAME;?>_thumb',1);
}


// 添加子分类
function add_child(obj){
	var CategoryId=$(obj).attr('CategoryId');
	$("input[name='pid']").val(CategoryId);
	$("input[name='name']").val('');
	$("input[name='mca']").val('');
	$("input[name='ico']").val('');
	$('#bjy-add').modal('show');
}

// 修改分类
function edit(obj){
	var CategoryId=$(obj).attr('CategoryId');
	var CategoryName=$(obj).attr('CategoryName');
	var CategoryMca=$(obj).attr('CategoryMca');
	var CategoryIco=$(obj).attr('CategoryIco');
	$("#bjy-form2 input[name='id']").val(CategoryId);
	$("#bjy-form2 input[name='name']").val(CategoryName);
	$("#bjy-form2 input[name='mca']").val(CategoryMca);
	$("#bjy-form2 input[name='ico']").val(CategoryIco);
	$("#bjy-form2 input[name='ico']").next('img').attr('src',CategoryIco);

	$("#bjy-form2 textarea[name='desc']").val($(obj).attr('Desc'));
	//$("#bjy-form2 input[name='desc']").html($(obj).attr('Desc'));
	$("#bjy-form2 input[name='order_number']").val($(obj).attr('sort'));
	if ( $(obj).attr('isShow') == '1' ) {
        $("#bjy-form2 input[name='is_show']").eq(0).attr("checked",true);
	}else{
        $("#bjy-form2 input[name='is_show']").eq(1).attr("checked",true);//$().attr("checked",true);
	}


	$('#bjy-edit').modal('show');
}

</script>
</body>
</html>