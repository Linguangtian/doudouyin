<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>中环汇展</title>
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
<div class="m20" style="margin-top: 10px">
<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-sm-4">
                <br>
                <table class="table table-bordered table-condensed">
                    <tr>
                        <th>一级团队</th>
                    </tr>
                    <tbody>
                        <?php if(!empty($list1)): if(is_array($list1)): $i = 0; $__LIST__ = $list1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td> <a href="<?php echo U('handle',array('id'=>$vo['id']));?>" class=""><?php echo ($vo["nickname"]); ?></a> <span style="float: right;color: #999;"><?php echo (date('Y-m-d',$vo["create_time"])); ?></span></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        <?php else: ?>
                            <tr>
                                <td>暂无信息</td>
                            </tr><?php endif; ?>
                    </tbody>
                </table>
            </div><!-- /.col -->
            <div class="col-sm-4">
                <br>
                <table class="table table-bordered table-condensed">
                    <tr>
                        <th>二级团队</th>
                    </tr>
                    <tbody>
                    <?php if(!empty($list2)): if(is_array($list2)): $i = 0; $__LIST__ = $list2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td> <a href="<?php echo U('handle',array('id'=>$vo['id']));?>" class=""><?php echo ($vo["nickname"]); ?></a> <span style="float: right;color: #999;"><?php echo (date('Y-m-d',$vo["create_time"])); ?></span></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        <?php else: ?>
                        <tr>
                            <td>暂无信息</td>
                        </tr><?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-4">
                <br>
                <table class="table table-bordered table-condensed">
                    <tr>
                        <th>三级团队</th>
                    </tr>
                    <tbody>
                    <?php if(!empty($list3)): if(is_array($list3)): $i = 0; $__LIST__ = $list3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td> <a href="<?php echo U('handle',array('id'=>$vo['id']));?>" class=""><?php echo ($vo["nickname"]); ?></a> <span style="float: right;color: #999;"><?php echo (date('Y-m-d',$vo["create_time"])); ?></span></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        <?php else: ?>
                        <tr>
                            <td>暂无信息</td>
                        </tr><?php endif; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.col -->
</div><!-- /.row -->
</div>

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