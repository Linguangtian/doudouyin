<?php if (!defined('THINK_PATH')) exit(); $title = "个人中心";?>


<!DOCTYPE html>

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

</head>
<style>
	.user_index_top_ppp{
		/*padding:0 3%;;*/
		width:94%;;
		box-sizing: border-box;
		background: #989292;
		margin:0 auto;
		border:1px solid red;
		border-radius: 5px;
		float: left;
		margin-left:3%;
	}
	.user_index_top_ppp li{
		width:25%;text-align: center}
	.user_index_top_ppp li a{
		width:auto;
		margin:0;
		-webkit-border-radius:5px;
		-moz-border-radius:5px;
		border-radius:5px;
		height:auto;
		line-height: 100%;
		padding:2px 10px;
		margin-top:45%;
	}

	.wrap-flex-row {
		display: flex;
		display: -webkit-flex;
		flex-direction: row;
		justify-content: space-around;
		align-items: center;
		flex-wrap: wrap;
	}

	.user_index_top .usermes{
		width:90%;
		border-top: 0.3vw solid #f4f4f4;
		background: #fff;
		padding:3vw;
		margin:20px auto;
		top: 5vw;
		border-radius: 2vw;
	}
	.user_index_top .usermes .u-data-g{
		color: #999;
	}
	.user_index_top .usermes .mesBox{
		text-align: center;
	}
	.user_index_top .usermes .mesBox .num{
		font-size: 3vw;
		color: #666;
	}

	.user_index_top .usermes .mesBox a{
		padding:0 5px;
		width:60px;
		text-align: center;
		line-height: 2rem;
		color: #fff;
		border-radius: 2rem;
		border: 1px #fff  solid;
		background:#7552e6;
		display: inline-block;
	}

	.mytool{
		justify-content:space-between;
		/*	background: #fff;*/
		margin:0 3vw;

	}
	.mytool .openvip{
		position: relative;
		width: 48%;
		background: #fcd66b;
		background: linear-gradient(90deg,#ffe8bf,#fcd66b);
		color: #bf9955;
		border-radius: 2vw;
		margin:3vw 0;
	}
	.mytool .sharefriend{
		position: relative;
		width: 48%;
		background: #fcd66b;
		background: linear-gradient(90deg,#cddcff,#5f97fc);
		color: #5a92d1;
		border-radius: 2vw;
		margin:3vw 0;
	}
	.mytool .corner{
		position: absolute;
		right: 0;
		bottom: 0;
		height: 12vw;
	}
	.mytool .text{
		margin:5vw 3vw;
	}


</style>

<body class="gray_bg" style="background: #fff;overflow-x: hidden">

	<div class="user_index_top" style="clear: both;">
		<div class="user_index_top_t">
			<img src="<?php echo ($sys_config["web_logo"]); ?>"/>
			<p class="user_index_top_s"><?php echo ($data["username"]); ?></p>
			<p class="user_index_top_x">ID:<?php echo ($member["id"]); ?> <?php echo ($data["nickname"]); ?> <?php if($data['level'] > 0): ?><span><?php echo ($level_name); ?></span><?php endif; ?></p>
		</div>

		<div class="usermes wrap-flex-row">
			<div class="mesBox">
				<div class="text">0</div>
				<div class="num">累计收益</div>
			</div>
			<span class="u-data-g">|</span>
			<div class="mesBox" onclick="window.open('/index.php/Home/Member/jinbin_log.html','_self')">
				<div class="text" ><?php echo ($data["jinbin_point"]); ?></div>
				<div class="num">喵币余额</div>
			</div>
			<span class="u-data-g">|</span>
			<div class="mesBox goto">
				<a href="/index.php/Home/Member/recharge_do.html">充值</a>
			</div>

			<div class="mesBox goto">
				<a href="/index.php/Home/Member/tixian.html">提现</a>
			</div>
			<div style="clear: both;"></div>
		</div>
		<div style="clear: both;"></div>
		
		<!--<div class="user_index_top_ppp">-->
			<!--<ul>-->
				<!--<li>-->
					<!--<a href="<?php echo U('recharge_do');?>">充值</a>-->
				<!--</li>-->
				<!--<li>-->
					<!--<p style="margin-top: 1rem;font-size: 18px;font-weight: bold;color: #fff;"><?php echo ($data["price"]); ?>元</p>-->
					<!--<p>我的余额</p>-->
				<!--</li>-->
				<!--<li>-->
					<!--<p style="margin-top: 1rem;font-size: 18px;font-weight: bold;color: #fff;"><?php echo (floatval($total_price["all"])); ?>元</p>-->
					<!--<p>累计收益</p>-->
				<!--</li>-->
				<!--<li>-->
					<!--<a href="<?php echo U('tixian');?>">提现</a>-->
				<!--</li>-->
			<!--</ul>-->
		<!--</div>-->
	</div>

	<div>
		<div class="mytool wrap-flex-row">
			<div class="openvip goto" url="/index.php/Home/Member/vip.html">
				<div class="text wrap-flex-column">
					开通VIP
					<span>躺着也有收益</span>
				</div>
				<img src="/tpl/Public/images/vip-jb.png" class="corner">
			</div>
			<div class="sharefriend goto" url="/index.php/Home/Public/share.html">
				<div class="text wrap-flex-column">
					邀请好友
					<span>有钱一起赚</span>
				</div>
				<img src="/tpl/Public/images/yq-jb.png" class="corner">
			</div>
		</div>
	</div>


	<p style="width: 100%;height: 10px;background: #ededed;margin-top: 0px;"></p>
    <!--信用等级 开始-->
    <div class="user_index_shz dengji" style="padding:0;">
     <a href="<?php echo U('Point/index');?>">
       <div class="feng" style="margin-left:2.5%">
           <img src="/tpl/Public/images/siliao.png">
           <p>封号</p>
       </div>
	   <div class="tiao" id="myVue" style="margin-top: 8px">
			<div class="ystep1"></div>
		</div> 
         <div class="zhi" style="margin-top: 8px">
           <img src="/tpl/Public/images/haoping.png">
           <p>超棒</p> 
       </div>
		 <div style="clear: both"></div>
      </a>  
           
	</div>
	<!--信用等级 结束-->
	<p style="width: 100%;height: 10px;background: #ededed;margin-top: 0px;"></p>
	<div class="user_index_shz">
		<ul>
			<a href="<?php echo U('Task/submission_task');?>">
			<li>
				<img src="/tpl/Public/images/HTB1IzpDcRaE3KVjSZLe760sSFXaz.png"/>
				<p>进行中</p>
			</li>
			</a>
			
			<a href="<?php echo U('Member/apply');?>">
			<li>
				<img src="/tpl/Public/images/HTB11u0AcMmH3KVjSZKz7622OXXas.png"/>
				<p>审核中</p>
			</li>
			</a>
			
			<a href="<?php echo U('Member/apply');?>">
			<li>
				<img src="/tpl/Public/images/HTB1k38AcUCF3KVjSZJn762nHFXau.png"/>
				<p>已审核</p>
			</li>
			</a>
		</ul>
	</div>
	<p style="width: 100%;height: 10px;background: #ededed;float: left;margin-top: 10px;"></p>

	<div class="user_index_shz">
		<ul>
			<a href="<?php echo U('TaskApply/index');?>">
			<li>
				<img src="/tpl/Public/images/HTB11u0AcMmH3KVjSZKz7622OXXas.png"/>
				<p>审核发布</p>
			</li>
			</a>

			<a href="<?php echo U('Task/get_list');?>">
			<li>
				<img src="/tpl/Public/images/HTB11u0AcMmH3KVjSZKz7622OXXas.png"/>
				<p>发布管理</p>
			</li>
			</a>
		</ul>
	</div>
	
	<p style="width: 100%;height: 10px;background: #ededed;float: left;margin-top: 10px;"></p>

	<div class="user_index_shza">
		<ul>
			<a href="<?php echo U('sale');?>">
			<li>
				<img src="/tpl/Public/images/HTB1fwdKcRKw3KVjSZTE763uRpXas.png"/>
				<p>收支记录</p>
			</li>
			</a>

			
			<a href="<?php echo U('Page/show', ['id' => 5]);?>">
			<li>
				<img src="/tpl/Public/images/HTB1vuRFcRGE3KVjSZFh763kaFXa8.png"/>
				<p>新手问答</p>
			</li>
          </a>
			
			
			
			<a href="<?php echo U('team');?>">
			<li>
				<img src="/tpl/Public/images/HTB1aGpJcRKw3KVjSZFO761rDVXag.png"/>
				<p>我的团队</p>
			</li>
			</a>
         
         
        
            
            <a href="<?php echo U('Point/index');?>">
			<li>
				<img src="/Public/statics/images/xinyong.png"/>
				<p>我的信用</p>
			</li>
			</a>
			
			<a href="<?php echo U('info');?>">
			<li>
				<img src="/tpl/Public/images/HTB1calEcL1G3KVjSZFk761K4XXaN.png"/>
				<p>认证中心</p>
			</li>
			</a>

			
			<a href="<?php echo U('index/about');?>">
			<li>
				<img src="/tpl/Public/images/HTB15lNDcRWD3KVjSZFs763qkpXav.png"/>
				<p>喵赚Q群</p>
			</li>
			</a>
			
			
			<a href="<?php echo U('password');?>">
			<li>
				<img src="/tpl/Public/images/HTB1QmBCcUGF3KVjSZFo762mpFXaM.png"/>
				<p>修改密码</p>
			</li>
			</a>
			
			<a href="/index.php/Home/Public/share">
			<li>
				<img src="/tpl/Public/images/HTB1kgzjXMFY.1VjSZFq761dbXXa4.png"/>
				<p>邀请好友</p>
			</li>
			</a>

			<a href="/index.php/Home/Public/bdwx">
			<li>
				<img src="/tpl/Public/images/HTB1kgzjXMFY.1VjSZFq761dbXXa4.png"/>
				<p>绑定微信</p>
			</li>
			</a>

			<a href="/index.php/Home/Public/bdzh">
			<li>
				<img src="/tpl/Public/images/HTB1kgzjXMFY.1VjSZFq761dbXXa4.png"/>
				<p>绑定账号</p>
			</li>
			</a>

			<a href="<?php echo U('Page/show', ['id' => 6]);?>">
			<li>
				<img src="/tpl/Public/images/HTB1kgzjXMFY.1VjSZFq761dbXXa4.png"/>
				<p>联系我们</p>
			</li>
			</a>
			
			<a href="<?php echo U('Public/logout');?>">
			<li>
				<img src="/tpl/Public/images/HTB1FXBEcSSD3KVjSZFK76210VXaE.png"/>
				<p>退出登录</p>
			</li>
			</a>
			
		</ul>
	</div>
	
<script type="text/javascript" src="/tpl/Public/js/ystep.js"></script>

<script type="text/javascript">
//根据jQuery选择器找到需要加载ystep的容器
//loadStep 方法可以初始化ystep
$(".ystep1").loadStep({
  //ystep的外观大小
  //可选值：small,large
  size: "small",
  //ystep配色方案
  //可选值：green,blue
  color: "green",
  //ystep中包含的步骤
  steps: [{
	//步骤名称
	title: "限制",
	//步骤内容(鼠标移动到本步骤节点时，会提示该内容)

  },{
	title: "良好",

  },{
	title: "优秀",

  }]
});
$('.goto').click(function () {
    location.href = $(this).attr('url');
})

$(".ystep1").setStep('<?php echo ($setStep); ?>');

</script>
  

<style type="text/css">
	.footer li{
		width: 20%;
        padding:5px 0;
	}

    .fabu{
        /*font-size: 20px;display: block;border-radius: 50%;margin: 0 auto;*/
        /*width:50px;height: 50px;border: 1px solid red;*/
        /*margin-top: -30px;*/
        /*z-index: 999;;position:absolute;*/

        border: 1px solid gainsboro;
        border-radius: 50%;
        background: #f7f7f7;
        width: 48px;
        line-height: 48px;
        margin:0 auto;
        height: 48px;
        font-size: 2.5rem;
        margin-top: -5px;
    }
    .user_index_shza{
        margin-bottom:150px;
    }
    .divright{
        position: relative;
        right: 10px;;
        top: -35px;;
        background:#c72c4f;
        width: 15px;
        height: 15px!important;
        float: right;
        border-radius: 50%;
        color: #fff;
    }
    .body_main{
        margin-bottom: 76px;;}
    .footer li span.hide{display: none}

</style>
<footer class="footer">
    <ul>
        <li <?php if(CONTROLLER_NAME == 'Index'): ?>class="active"<?php endif; ?> >
            <a href="<?php echo U('Index/index');?>">
                <span><i class="icon_home" style="width: 20px;height: 20px;"></i></span>
                <p>首页</p>
            </a>
        </li>
        <li <?php if(CONTROLLER_NAME == 'Task'): ?>class="active"<?php endif; ?> >
            <a href="<?php echo U('Task/index');?>">
                <span><i class="icon_task" style="width: 20px;height: 20px;"></i></span>
              <p>VIP</p>
            </a>
        </li>
        <li <?php if(CONTROLLER_NAME == 'Task2'): ?>class="active"<?php endif; ?> >
        <div class="fabu">
            <a href="<?php echo U('Task/handle');?>" style="font-size: 25px">+</a>
        </div>

        </li>
		<li <?php if(CONTROLLER_NAME == 'Member' and ACTION_NAME == 'notice'): ?>class="active"<?php endif; ?> >
           <a href="<?php echo U('Member/notice');?>">
                <span><i class="icon_xiaoxi" style="width: 20px;height: 20px;"></i></span>
             <p>消息 </p>
               <span class="divright <?php echo ($_SESSION['weidu_xiaoxi'] ? 'show':'hide'); ?>"><?php echo ($_SESSION['weidu_xiaoxi']); ?></span>
            </a>
        </li>
        <li <?php if(CONTROLLER_NAME == 'Member' and ACTION_NAME == 'index' ): ?>class="active"<?php endif; ?> >
            <a href="<?php echo U('Member/index');?>">
                <span><i class="icon_user" style="width: 20px;height: 20px;"></i></span>
                <p>我的</p>
            </a>
        </li>
    </ul>
</footer>

<script>
    $(function () {
        $('.footer').prev('div').css('margin-bottom','150px')
    })

</script>

</body>
</html>