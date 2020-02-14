<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta name="wap-font-scale" content="no">
<title>首页</title>
<link rel="stylesheet" type="text/css" href="/tpl/Public/css/style.css">
<link rel="stylesheet" type="text/css" href="/tpl/Public/css/share.css">
<script type="text/javascript" src="/tpl/Public/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="/tpl/Public/js/hidpi-canvas.min.js"></script>
<script type="text/javascript" src="/tpl/Public/js/modernizr-2.6.2.min.js"></script>
<script type="text/javascript" src="/tpl/Public/js/cycle.js"></script>
    <script type="text/javascript" src="/tpl/Public/js/layer_mobile2/layer.js?<?php echo ($version); ?>"></script>
    <script type="text/javascript" src="/tpl/Public/js/func.js?<?php echo ($version); ?>"></script>

    <style>
        .xianzhi i {font-style: normal;color: #847fff;}
    </style>
</head>

<body>
<header class="top_header">
    <div class="left"><a href="javascript:" data-url="<?php echo U('Member/index');?>" class="return go-back" ></a></div>
    <div class="title">我的信用</div>
    <div class="right "></div>
</header>
<div style="margin-top:40px;"></div>
    <div class="qian" style="top: 55px;">
        <p onclick="toSign()"><?php if($is_sign == 0): ?>签到<?php else: ?>已签到<?php endif; ?></p>
    </div>

    <div class="loadingParent">
      <p style="top: 47%;"><?php echo ($member["point"]); ?></p>
      <p>信用分数</p>
      <canvas id="canvasIndex"  amount="10000" vote="10000" tip="50">您的浏览器不支持canvas标签，建议使用chrome,firefox,ie10+</canvas>
   </div>        
    
    <script>
	   //圆环进度条
		$(function(){
			 var w=$(".loadingParent").width();
			 var option={
				   percent:"<?php echo ($percent); ?>" ,
				   w:300
				 }
			$("#canvasIndex").audios2(option);
			
		})
	</script>
    <div class="koujia clear">
       <a href="<?php echo U('detail', ['type' => 1]);?>">
           <span><?php echo ($member["jia_point"]); ?></span>
           <p>已加信用</p>
       </a>
       <a href="<?php echo U('detail', ['type' => 2]);?>">
           <span>-<?php echo ($member["jian_point"]); ?></span>
           <p>已扣信用</p>
       </a>
    </div>
    
    
    <div class="fenshu">
       <h2>信用分数</h2>
       <ul class="ques-card-list">
           <?php if(is_array($point_level)): $key = 0; $__LIST__ = $point_level;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?><li class="ques-card-list-noe">
                <div class="ques-list-box clear">
                    <div class="ques-list-head">
                        <div class="ques-list-image">
                           <?php echo ($vo["point"]); ?>分
                        </div>
                    </div>
                    <div class="ques-list-name">
                        <div class="ques-list-name-head"><?php echo ($vo["title"]); ?></div>
                    </div>
                    <span class="ques-list-name-icon item-icon00<?php echo ($key); ?>"><?php echo ($key); ?></span>
                </div>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
    
    <div class="xianzhi">
       <h3>信用分限制规则：</h3>
        <p>1、信用分低于<i><?php echo ($point_set["renwu_point"]); ?></i>分，每天只能报名完成<i><?php echo ($point_set["renwu_count"]); ?></i>次任务</p>
        <p>2、信用分低于<i><?php echo ($point_set["fh_point"]); ?></i>分，进行永久封号处理</p>
        <h3>信用分增加规则：</h3>
        <p>1、注册新用户首次默认：<i><?php echo ($point_set["reg_point"]); ?></i>信用分</p>
        <p>2、通过每日签到，增加<i><?php echo ($point_set["sign_point"]); ?></i>信用分</p>
        <p>3、完成当日首次任务并获得赏金，信用分<i>+<?php echo ($point_set["day_point"]); ?></i>（每天一次）</p>
        <h3>信用分减少规则：</h3>
        <p>1、报名任务成功后，未在规定时间内完成<i>-<?php echo ($point_set["wwc_point"]); ?></i></p>
        <p>2、恶意乱传图，错误图片，未按照要求完成任务<i>-<?php echo ($point_set["wayq_point"]); ?></i></p>
    </div>
</body>
<script>
  function toSign() {
    $.post("<?php echo U('sign_handle');?>", function (result) {
        $('.qian p').html('已签到');
        sp_alert(result.msg);
        if (result.status == 1) {
            $('.loadingParent p').eq(0).html(result.point);
            $('.koujia a').eq(0).find('span').html(result.jia_point);
        }
    })
}
</script>

</html>