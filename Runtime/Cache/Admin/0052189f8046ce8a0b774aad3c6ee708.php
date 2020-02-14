<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title><?php echo sp_cfg('website');?></title>
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
        <link rel="stylesheet" href="/Public/statics/iCheck-1.0.2/skins/all.css">

</head>
<body>

<!-- 导航栏开始 -->
<div class="bjy-admin-nav">
    <i class="fa fa-home"></i> 首页
    &gt;
    信用分参数设置
</div>
<!-- 导航栏结束 -->
<ul id="myTab" class="nav nav-tabs">
   <li class="active">
        <a href="javascript:">信用分参数设置</a>
    </li>
</ul>
<form class="form-inline" method="post">
    <table class="table table-bordered table-hover" style="max-width: 800px;">
        <tr>
            <th width="190">
                用户注册
            </th>
            <td>
                <input type="text" name="reg_point" value="<?php echo ($info["reg_point"]); ?>" class="form-control"/>
            </td>
        </tr>
        <tr>
            <th width="190">
                任务
            </th>
            <td>
                信用低于<input type="text" name="renwu_point" value="<?php echo ($info["renwu_point"]); ?>" class="form-control" style="width: 30%"/>，
                每天只能报名完成<input type="text" name="renwu_count" value="<?php echo ($info["renwu_count"]); ?>" class="form-control" style="width: 30%"/>次任务

            </td>
        </tr>
        <tr>
            <th width="190">
                封号信用分
            </th>
            <td>
                <input type="text" name="fh_point" value="<?php echo ($info["fh_point"]); ?>" class="form-control"/>
            </td>
        </tr>
        <tr>
            <th width="190">
                签到（加）
            </th>
            <td>
                <input class="input col-xs-12 col-sm-12" type="text" name="sign_point" value="<?php echo ($info["sign_point"]); ?>" class="form-control"/>
            </td>
        </tr>
        <tr>
            <th width="190">
                完成当日首次任务（加）
            </th>
            <td>
                <input class="input col-xs-12 col-sm-12" type="text" name="day_point" value="<?php echo ($info["day_point"]); ?>" class="form-control"/>
            </td>
        </tr>
        <tr>
            <th width="190">
                未在规定时间内完成任务（减）
            </th>
            <td>
                <input class="input col-xs-12 col-sm-12" type="text" name="wwc_point" value="<?php echo ($info["wwc_point"]); ?>" class="form-control"/>
            </td>
        </tr>
        <tr>
            <th width="190">
                未按要求完成任务（减）
            </th>
            <td>
                <input class="input col-xs-12 col-sm-12" type="text" name="wayq_point" value="<?php echo ($info["wayq_point"]); ?>" class="form-control"/>
            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <input class="btn btn-success" type="submit" value="提交">
            </td>
        </tr>
    </table>
</form>

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

<script src="/Public/statics/iCheck-1.0.2/icheck.min.js"></script>
<script>
$(document).ready(function(){
    $('.xb-icheck').iCheck({
        checkboxClass: "icheckbox_minimal-blue",
        radioClass: "iradio_minimal-blue",
        increaseArea: "20%"
    });
});
</script>

</body>
</html>