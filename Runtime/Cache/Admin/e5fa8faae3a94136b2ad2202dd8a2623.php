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

    <?php
 if($info['id'] > 0) { $handle_type = "编辑"; } else { $handle_type = "添加"; } ?>
</head>
<body>

<!-- 导航栏开始 -->
<div class="bjy-admin-nav">
    <i class="fa fa-home"></i> 首页
    &gt;
    新闻列表
    &gt;
    <?php echo ($handle_type); ?>
</div>
<!-- 导航栏结束 -->
<ul id="myTab" class="nav nav-tabs">
   <li>
         <a href="<?php echo U('index');?>">任务列表</a>
   </li>
   <li class="active">
        <a href="javascript:"><?php echo ($handle_type); ?>任务</a>
    </li>
</ul>
<form class="form-inline" method="post">
    <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>">
    <input type="hidden" name="copy" value="<?php echo ($_GET['copy']); ?>">
    <table class="table table-striped table-bordered table-hover table-condensed">
        <tr>
            <th>标题</th>
            <td>
                <input class="col-xs-12 col-sm-5" type="text" name="title" value="<?php echo ($info["title"]); ?>">
            </td>
        </tr>
       <!-- <tr>
            <th>悬赏金额</th>
            <td>
                <?php if($info['id'] > 0): ?><input class="col-xs-12 col-sm-5" type="text" name="price" value="<?php echo (floatval($info["price"])); ?>" style="width: 100px;">元
                    <?php else: ?>
                    <input class="col-xs-12 col-sm-5" type="text" name="price" value="8" style="width: 100px;">元<?php endif; ?>

            </td>
        </tr>-->

        <tr>
            <th>悬赏喵币</th>
            <td>
                <?php if($info['id'] > 0): ?><input class="col-xs-12 col-sm-5" type="text" name="jinbin" value="<?php echo ($info["jinbin"]); ?>" style="width: 100px;">圈币
                    <?php else: ?>
                    <input class="col-xs-12 col-sm-5" type="text" name="jinbin" value="1" style="width: 100px;">圈币<?php endif; ?>

            </td>

        <tr>
            <th>任务类型</th>
            <td>
                <?php $_result=C('TASK_TYPE');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><label><input type="radio" name="type" value="<?php echo ($key); ?>" style="height: inherit" <?php if($key == $info['type']): ?>checked<?php endif; ?> ><?php echo ($vv); ?></label> &nbsp; &nbsp; &nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
            </td>
        </tr>
  
         <tr>
            <th>抖音名称</th>
            <td>
                <input class="col-xs-12 col-sm-5" type="text" name="taskuser" value="<?php echo ($info["taskuser"]); ?>">
            </td>
        </tr>
  
        <tr>
            <th>任务级别</th>
            <td>
                <?php if(is_array($level)): $i = 0; $__LIST__ = $level;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><label><input type="radio" name="level" value="<?php echo ($vv["level"]); ?>" style="height: inherit" <?php if($vv['level'] == $info['level']): ?>checked<?php endif; ?> ><?php echo ($vv["name"]); ?></label> &nbsp; &nbsp; &nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
            </td>
        </tr>

 <tr>
            <th>任务类别</th>
       <td>
                
        <label><input type="radio" name="tasklb" value="1" style="height: inherit" <?php if($info['tasklb'] == 1): ?>checked<?php endif; ?> >快手关注</label> &nbsp; &nbsp; &nbsp;
        <label> <input type="radio" name="tasklb" value="2" style="height: inherit" <?php if($info['tasklb'] == 2): ?>checked<?php endif; ?> >抖音关注<?php echo ($vv['tasklb']); ?></label> &nbsp; &nbsp; &nbsp;
        <label><input type="radio" name="tasklb" value="3" style="height: inherit" <?php if($info['tasklb'] == 3): ?>checked<?php endif; ?> >小红书任务<?php echo ($vv['tasklb']); ?></label> &nbsp; &nbsp; &nbsp;
        <label> <input type="radio" name="tasklb" value="4" style="height: inherit" <?php if($info['tasklb'] == 4): ?>checked<?php endif; ?> >火山任务<?php echo ($vv['tasklb']); ?></label> &nbsp; &nbsp; &nbsp;
        <label><input type="radio" name="tasklb" value="5" style="height: inherit" <?php if($info['tasklb'] == 5): ?>checked<?php endif; ?> >头条任务<?php echo ($vv['tasklb']); ?></label> &nbsp; &nbsp; &nbsp;
        
              			
				 
               
            </td>
        </tr>


        <tr>
            <th>领取名额</th>
            <td>
                <input class="col-xs-12 col-sm-5" type="text" name="max_num" value="<?php echo ($info["max_num"]); ?>">
            </td>
        </tr>
        <tr>
            <th>截止日期</th>
            <td>
                <input class="col-xs-12 col-sm-5 date-picker" data-date-format="yyyy-mm-dd" autocomplete="off" type="text" name="end_time" value="<?php if($info[end_time] > 0): echo (date('Y-m-d',$info["end_time"])); endif; ?>">
            </td>
        </tr>
        <tr>
            <th>图片</th>
            <td>
                <input name="thumb" id="thumb" type="text" class="col-xs-12 col-sm-5" size="40" value="<?php echo ($info["thumb"]); ?>" /> <input type="button" class="btn btn-info"  onclick="flashupload('thumb', '上传文件', 'thumb', return_value, '<?php echo CONTROLLER_NAME;?>_thumb');" value="浏览..">
            </td>
        </tr>
        <tr>
            <th>文案</th>
            <td>
                <textarea id="info" class="form-control col-xs-12 col-sm-5" name="info" style="width: 41.66666667%;"><?php echo ($info["info"]); ?></textarea>
            </td>
        </tr>
        <tr>
            <th>图片信息</th>
            <td>
                <textarea id="page_content" class="col-xs-6 col-sm-6" style="height: 400px;" name="content"><?php echo ($info["content"]); ?></textarea>
            </td>
        </tr>

        <tr>
            <style>
                #taskBuzhou .item>div{
                    float: left;
                }
                #taskBuzhou .item .itemLeft{
                    margin: 10px;;
                }
                #taskBuzhou .item .itemCenter{
                    margin: 10px;;
                }
                #taskBuzhou .item .itemLeft input{
                    width:34px;}
            </style>
            <th>任务步骤</th>
            <td style="min-height: 300px">
                <div style="padding: 10px">
                    <h1>任务步骤</h1>

                    <div id="taskBuzhou">
                        <div class="item">
                            <div class="itemLeft">
                                第 <input type="text"  value="1">步
                            </div>
                            <div class="itemCenter">
                                <img src="/Upload/Task/thumb/5daa998e7f60b.jpg" alt="" width="50">
                            </div>
                            <div class="itemRight">
                                <textarea name="" id="" cols="50" rows="5"></textarea>
                            </div>
                            <div style="clear: both"></div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <th></th>
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

<script type="text/javascript" src="/Public/kindeditor/kindeditor.js"></script><script type="text/javascript" src="/Public/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript">
    $(function(){
        //引入编辑器
        var  content;
        KindEditor.ready(function(K) {
            content = K.create('#page_content');
        });
    });


    //

    $(function () {
        /**
         *
         * @constructor
         */
        function Add(){
            var prevHtml = $('#LastFang').prev().html();
            var childLenghth = $('.container').children().length - 1;

            prevHtml = prevHtml.replace(/uploads/g, "uploads"+childLenghth);
            prevHtml = prevHtml.replace(/picid/g, "picid"+childLenghth);
            prevHtml = prevHtml.replace(/desc/g, "desc"+childLenghth);



            $('.caozuo').remove();
            $("#LastFang").before('<div class="row" style="position:relative;border: 1px dashed  #ccc;margin-bottom: 5px">'+prevHtml+'</div>');
        }

        function Jian(){
            if($('.fang_post').children().length <=2){
                layer.msg(' <span style="color:red">X</span><br> 至少保留一项!');
                //alert('至少保留一项!');
                return false;
            }
            var prevHtml = $('#LastFang').prev().remove();
            var caoZuo = ' <div class="caozuo" id="add" onclick="Add()" style="position: relative;width:40px;height: 40px;right: 5px;bottom: 1px;display: block;text-align: right;"><span class="btn btn-success">+</span></div> <div class="caozuo" id="add" onclick="Jian()" style="position: relative;width:40px;height: 40px;right: -35px;bottom: 1px;display: block;text-align: right;"><span class="btn btn-success">-</span></div>';
            $('#LastFang').prev().append(caoZuo);
            //$('#container').children('div');

            //$("#LastFang").before('<div class="row" style="position:relative;border: 1px dashed  #ccc;">'+prevHtml+'</div>');
        }

    })
</script>
</body>
</html>