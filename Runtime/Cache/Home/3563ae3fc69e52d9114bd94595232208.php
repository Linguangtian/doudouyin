<?php if (!defined('THINK_PATH')) exit(); $title = "金币";?><!DOCTYPE html>

<html>

<head>

    <?php
 $version = time(); ?>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0"/>

    <meta name="keywords" content=""/>

    <meta name="description" content=""/>

    <title><?php echo ($title); ?></title>

    <link rel="stylesheet" href="/tpl/Public/css/share.css?<?php echo ($version); ?>">

    <link rel="stylesheet" href="/tpl/Public/css/font.css?<?php echo ($version); ?>" />
    
    <link rel="stylesheet" href="/tpl/Public/css/ystep.css" type="text/css" />

    <!--JQ-->

    <script type="text/javascript" src="/tpl/Public/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="/tpl/Public/js/jquery-form.js"></script>
    <script type="text/javascript" src="/tpl/Public/js/layer_mobile2/layer.js?<?php echo ($version); ?>"></script>
    <!--<script type="text/javascript" src="/tpl/Public/js/swiper.3.1.7.min.js"></script>-->



    <!--<script src="/tpl/Public/js/jquery.simplesidebar.js"></script>-->

    <!--<script src="/tpl/Public/js/jquery.SuperSlide.2.1.1.js"></script>-->

    <!--<script src="/tpl/Public/js/TouchSlide.1.0.js"></script>-->



    <script type="text/javascript" src="/tpl/Public/js/func.js?<?php echo ($version); ?>"></script>

    <script>

        var SITE_URL  = 'https:' == document.location.protocol ?'https://' : 'http://' + "<?php echo $_SERVER['HTTP_HOST'];?>";

    </script>

</head><link rel="stylesheet" href="/tpl/Public/css/double-date.css"/><script type="text/javascript" src="/tpl/Public/js/double-date.js"></script><style>    .team_tab li{width:33.3%}</style><body style="background: #f6f6f6"><!-- 头部部分 开始 --><header class="top_header">    <div class="left"><a href="javascript:" class="return go-back"></a></div>    <div class="title">        <?php if($show_day == ''): ?>金币记录            <?php else: ?>            <?php echo ($show_day); endif; ?>    </div></header><div class="ceng" ></div><script>    function show_date()    {        $('.ceng').show();        $('.select_days_box').show();    }    function close_date()    {        $('.ceng').hide();        $('.select_days_box').hide();    }</script><section class="profit-main" style="margin-top: 50px">    <!--<div class="tab">-->        <!--<span class="cur"><a href="<?php echo U('sale',array('start_date'=>$start_date,'end_date'=>$end_date));?>">分享收益</a></span>-->        <!--<span><a href="<?php echo U('sale_fx',array('start_date'=>$start_date,'end_date'=>$end_date));?>">业绩收益</a></span>-->    <!--</div>-->    <ul>        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>                <p>                    <span class="p1"><?php echo ($vo["dsc"]); ?></span>                    <?php if($vo["type"] == 1): ?><span class="p2" style="color: green;">+<?php echo ($vo["c_jinbin"]); ?></span>                        <?php else: ?>                        <span class="p2" style="color: red;">-<?php echo ($vo["c_jinbin"]); ?></span><?php endif; ?>                </p>                <p class="time"><?php echo ($vo["create_time"]); ?></p>            </li><?php endforeach; endif; else: echo "" ;endif; ?>    </ul>    <?php echo ($Page); ?></section><div style="display: none"><form id="form_1" class="form-search" method="get" action="<?php echo U('sale');?>" style="padding: 10px 0; ">    <input type="hidden" name="type" value="<?php echo ($type); ?>">    <input type="hidden" name="date" id="date" value="<?php echo ($day); ?>"></form></div></body></html>