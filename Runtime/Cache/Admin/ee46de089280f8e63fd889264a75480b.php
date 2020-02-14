<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<title>信用分设置 - <?php echo sp_cfg('website');?></title>
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
    信用分设置
</div>
<!-- 导航栏结束 -->
<ul id="myTab" class="nav nav-tabs">
   <li class="active">
		 <a href="#home" data-toggle="tab">信用分列表</a>
   </li>
   <li>
		<a href="javascript:;" onclick="add()">添加信用分</a>
	</li>
</ul>
	<div id="myTabContent" class="tab-content">
	   <div class="tab-pane fade in active" id="home">
			<table class="table table-striped table-bordered table-hover" style="margin-top: 10px;">
				<tr>
					<th>描述</th>
                    <th>信用分</th>
                    <th>操作</th>
				</tr>
				<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
						<td><?php echo ($vo["title"]); ?></td>
                        <td><?php echo ($vo["point"]); ?></td>
						<td><a class="btn btn-default btn-xs" href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" data-title="<?php echo ($vo["title"]); ?>" data-point="<?php echo ($vo["point"]); ?>" onclick="edit(this)">修改</a></td>
					</tr><?php endforeach; endif; ?>
			</table>
	   </div>
	</div>

<!-- 添加等级模态框开始 -->
<div class="modal fade" id="bjy-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		 <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel">
					添加信用分
				</h4>
			</div>
			<div class="modal-body">
				<form id="bjy-form" class="form-inline" action="<?php echo U('add');?>" method="post">
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <tr>
                            <th>描述：</th>
                            <td>
                                <input class="form-control" type="text" name="title">
                            </td>
                        </tr>
                        <tr>
                            <th>信用分：</th>
                            <td>
                                <input class="form-control" type="text" name="point">
                            </td>
                        </tr>
                      
                        <tr>
                            <th></th>
                            <td>
                                <input class="btn btn-success" type="submit" value="修改">
                            </td>
                        </tr>
                    </table>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- 添加等级模态框结束 -->

<!-- 修改等级模态框开始 -->
<div class="modal fade" id="bjy-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		 <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel">
					修改信用分
				</h4>
			</div>
			<div class="modal-body">
				<form id="bjy-form" class="form-inline" action="<?php echo U('edit');?>" method="post">
					<input type="hidden" name="id">
					<table class="table table-striped table-bordered table-hover table-condensed">
						<tr>
							<th>描述：</th>
							<td>
								<input class="form-control" type="text" name="name">
							</td>
						</tr>
						<tr>
							<th>信用分：</th>
							<td>
								<input class="form-control" type="text" name="price">
							</td>
						</tr>
						<tr>
							<th></th>
							<td>
								<input class="btn btn-success" type="submit" value="修改">
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- 修改等级模态框结束 -->
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
// 添加等级
function add(){
    $("input[name='title']").val('');
    $("input[name='point']").val('');
	$('#bjy-add').modal('show');
}

// 修改等级
function edit(obj){
	var id=$(obj).attr('data-id');
	var title=$(obj).attr('data-title');
	var point=$(obj).attr('data-point');
	$("input[name='id']").val(id);
	$("input[name='title']").val(title);
	$("input[name='point']").val(point);
  
	$('#bjy-edit').modal('show');
}

</script>
</body>
</html>