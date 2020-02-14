<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title><?php echo ($title); ?></title>
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <meta name="description" content=""/>

    <!--JQ-->
    <script type="text/javascript" src="/tpl/Public/js/jquery.min.js"></script>
    <script type="text/javascript" src="/tpl/Public/js/jquery-form.js"></script>
    <script type="text/javascript" src="/tpl/Public/js/layer_mobile2/layer.js?<?php echo ($version); ?>"></script>
    <script type="text/javascript" src="/tpl/Public/js/swiper.min.js"></script>

    <script src="/tpl/Public/js/jquery.simplesidebar.js"></script>
    <!--<script src="/tpl/Public/js/jquery.SuperSlide.2.1.1.js"></script>-->
    <!--<script src="/tpl/Public/js/TouchSlide.1.0.js"></script>-->

    <script type="text/javascript" src="/tpl/Public/js/func.js"></script>

    <link rel="stylesheet" href="/tpl/Public/css/share.css?3"/>
    <link rel="stylesheet" href="/tpl/Public/css/font.css?3"/>

    <style>
        .index_xslb_a {background: url(/Public/statics/images/dp.png) 0 0 no-repeat; background-size: 100% 100%;}
        .index_xslb_b {background: url(/Public/statics/images/kp.png) 0 0 no-repeat; background-size: 100% 100%;}
        .index_xslb_c {background: url(/Public/statics/images/2.xhs.png) 0 0 no-repeat; background-size: 100% 100%;}
        .index_xslb_d {background: url(/Public/statics/images/2.hs.png) 0 0 no-repeat; background-size: 100% 100%;}
        .index_xslb_e {background: url(/Public/statics/images/2.tt.png) 0 0 no-repeat; background-size: 100% 100%;}
		.lamp[data-v-4444cd4b] {
				position: fixed;
				z-index: 999;
				left: 50%;
				top: 0;
				transform: translate(-50%);
				width: 100%;
				height: 32px;
				background: #2e2e2e;
				color: #9b9b9b
			}

		.lamp-img[data-v-4444cd4b] {
			width: 24px;
			height: auto;
			margin: 5px 15px
		}

		.move-warp[data-v-4444cd4b] {
			display: inline-block;
			white-space: nowrap;
			height: 100%;
			-ms-flex-positive: 1;
			flex-grow: 1;
			position: relative;
			overflow: hidden
		}

		.move[data-v-4444cd4b] {
			width: 100%;
			height: auto
		}

		.move-start[data-v-4444cd4b] {
			animation: message-data-v-4444cd4b 22s linear infinite
		}

		.move-item[data-v-4444cd4b] {
			height: 32px;
			color: #9b9b9b;
			font-size: 13px;
			line-height: 32px;
		}

		.orange[data-v-4444cd4b] {
			color: #fff
		}

		.org[data-v-4444cd4b] {
			color: #ff9917
		}

		@keyframes message-data-v-4444cd4b {
			0%,to {
				transform: translateZ(0)
			}

			2%,10%,18.5% {
				transform: translate3d(0,-10%,0)
			}

			20%,28.5% {
				transform: translate3d(0,-20%,0)
			}

			30%,38.5% {
				transform: translate3d(0,-30%,0)
			}

			40%,48.5% {
				transform: translate3d(0,-40%,0)
			}

			50%,58.5% {
				transform: translate3d(0,-50%,0)
			}

			60%,68.5% {
				transform: translate3d(0,-60%,0)
			}

			70%,78.5% {
				transform: translate3d(0,-70%,0)
			}

			80%,88.5% {
				transform: translate3d(0,-80%,0)
			}

			90%,99.9999% {
				transform: translate3d(0,-90%,0)
			}
		}

		.index_lb img{border-radius: 6px}

		.swiper-slide{
			width:100%!important;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding:0 6%;
		}
		.index_lb{
			float: none;
			margin-top:0;
			margin-left:0%;
			width:100%;background: none;
		}

		#oval {
			width: 100%;
			height: 100px;
			background: #ff5196;
			-moz-border-radius: 100px / 50px;
			-webkit-border-radius: 100px / 50px;
			border-radius: 100px / 50px;

			margin-top: -50px;
		}

		.lamp[data-v-4444cd4b]{
			position: relative;
			background-color: #fff;
		}

		.row .col{
			float: left;
			box-sizing: border-box;
		}
		.category .col {
			float: left;
			width: 20%!important;
			margin-top: 7px;;
		}
		.category .content img{
			width: 50px;;
		}
		.category .content{
			text-align: center;
		}
		.category .content span {
			display: block;
			margin-top: 1px;
			margin-bottom: 5px;;
		}

		/**/
		.row .col.s6 {
			width: 50%;
			margin-left: auto;
			left: auto;
			right: auto;
		}
		.row .col.s8 {
			width: 66.6666666667%;
			margin-left: auto;
			left: auto;
			right: auto;
		}
		.chart-child .s8 span {
			font-size: 10px;}
		.chart-child .s8, .chart-child h3 {
			/*color: #fff;*/
		}


		/*首页项目统计*/
		.home-chart h3{
			font-size:18px;}
		.chart-child{
			height: 70px;background:linear-gradient(90deg, #A722CC 30%, #fff);
			-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;
			padding: 5px!important;
		}
		.chart-child:nth-of-type(2){  background:linear-gradient(90deg, #e81745 30%, #fff);margin-bottom: 10px;  }
		.chart-child:nth-of-type(3){  background:linear-gradient(90deg, #028e04 30%, #fff);  }
		.chart-child:nth-of-type(4){  background:linear-gradient(90deg, #38f 30%, #fff);  }
		.chart-child .s8,.chart-child h3{
			color: #fff;}
		.chart-child .s8 span{font-size: 10px}
		.chart-child .s8 p{
			font-size: 12px;margin:0
		}
		.chart-child .s4 img{
			width: 40px;height: 40px;margin-top: 9px;border-radius: 50%;
		}
		/*首页项目统计*/


		.index_tjrw{margin-top:10px;
			height:100%;}
		.index_rwxq img{
			width: 4rem;margin:1rem 0.5rem;
			height:4rem;;}
		.index_wzns{
			width:55%;padding-top:5px}
		.index_title{
			display: -webkit-box;min-height:33px;
			-webkit-box-orient: vertical;
			-webkit-line-clamp: 2;
			overflow: hidden;
		}

    </style>
</head>
<body class="gray_bg" style="background:#fff;overflow-x: hidden">
<div id="body">
    <div class="body_main" style="margin-top:-px;">

		<div class="pop-background flex" id="myModal">
			<div class="ggnotice flex fw">
				<img src="/tpl/Public/images/topnotice.png" class="ggnotice-img">
				<div class="ggnotice-html"><p style="margin-left:0cm; margin-right:0cm; text-align:center"><span style="font-size:12pt"><span style="font-family:宋体"><strong><span style="font-size:13.5pt"><span style="font-family:宋体">
					<?php echo ($page_notice_list['title']); ?> </span></span></strong></span></span></p>
					<p>
						<?php echo ($page_notice_list['content']); ?>
					</p>
					<p><a class="page_index_ckxxnr" href="<?php echo U('Page/show',array('id'=>$page_notice_list['id']));?>">查看详细内容 </a></p>
				</div>
				<img src="/tpl/Public/images/close_notice.png" class="close-img">
			</div>
		</div>

        <!--banner部分 开始-->
	
        <!--banner部分 开始-->
		<div style="background: #ff5196;">
			<div style="padding:5% 6%">
				<input id="serachInput" type="text" style="width: 100%;border-radius: 7px;height: 30px;text-align: center" placeholder="输入关键词">
			</div>
		</div>
		<div style="height: 50px;background: #ff5196;"> </div>
		<div id="oval">

		</div>
		<div class="swiper-banner" style="margin-top:-100px;width: 100%;overflow: hidden">
			<div class="index_lb swiper-wrapper" style="display: ">
				<?php $_result=sp_get_advert(1, 2);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a class="swiper-slide goto" href="<?php echo ($vo["url"]); ?>">
						<img src="<?php echo (sp_img($vo["thumb"])); ?>"/>
					</a><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<!--<div class="swiper-pagination"></div>-->
		</div>

		<div data-v-4444cd4b="" class="lamp flex js" style="margin: 0px; ">
			<img style="margin:5px 20px;width:20px" data-v-4444cd4b="" src="https://o2o.mfapi.cn/addons/nxb_community//newui/images/notice.png" class="lamp-img">
			<div data-v-4444cd4b="" class="move-warp">
				<div data-v-4444cd4b="" class="move move-start">
					<div data-v-4444cd4b="" class="move-item ell">
						<span data-v-4444cd4b="">用户</span>
						<span data-v-4444cd4b="" class="org">彭正芳</span>
						<span data-v-4444cd4b="">完成悬赏提现成功</span>
						<span data-v-4444cd4b="" class="org">20.00元</span>
					</div>
					<div data-v-4444cd4b="" class="move-item ell">
						<span data-v-4444cd4b="">用户</span>
						<span data-v-4444cd4b="" class="org">李明</span>
						<span data-v-4444cd4b="">完成悬赏提现成功</span>
						<span data-v-4444cd4b="" class="org">20.00元</span>
					</div>
					<div data-v-4444cd4b="" class="move-item ell">
						<span data-v-4444cd4b="">用户</span>
						<span data-v-4444cd4b="" class="org">于秀文</span>
						<span data-v-4444cd4b="">完成悬赏提现成功</span>
						<span data-v-4444cd4b="" class="org">60.00元</span>
					</div>
					<div data-v-4444cd4b="" class="move-item ell">
						<span data-v-4444cd4b="">用户</span>
						<span data-v-4444cd4b="" class="org">刘燕</span>
						<span data-v-4444cd4b="">完成悬赏提现成功</span>
						<span data-v-4444cd4b="" class="org">50.00元</span>
					</div>
					<div data-v-4444cd4b="" class="move-item ell">
						<span data-v-4444cd4b="">用户</span>
						<span data-v-4444cd4b="" class="org">方涛</span>
						<span data-v-4444cd4b="">完成悬赏提现成功</span>
						<span data-v-4444cd4b="" class="org">30.00元</span>
					</div>
					<div data-v-4444cd4b="" class="move-item ell">
						<span data-v-4444cd4b="">用户</span>
						<span data-v-4444cd4b="" class="org">陈芳</span>
						<span data-v-4444cd4b="">完成悬赏提现成功</span>
						<span data-v-4444cd4b="" class="org">20.00元</span>
					</div>
					<div data-v-4444cd4b="" class="move-item ell">
						<span data-v-4444cd4b="">用户</span>
						<span data-v-4444cd4b="" class="org">陈秀清</span>
						<span data-v-4444cd4b="">完成悬赏提现成功</span>
						<span data-v-4444cd4b="" class="org">10.00元</span>
					</div>
					<div data-v-4444cd4b="" class="move-item ell">
						<span data-v-4444cd4b="">用户</span><span data-v-4444cd4b="" class="org">张怀秀</span>
						<span data-v-4444cd4b="">完成悬赏提现成功</span><span data-v-4444cd4b="" class="org">50.00元</span>
					</div>
					<div data-v-4444cd4b="" class="move-item ell">
						<span data-v-4444cd4b="">用户</span>
						<span data-v-4444cd4b="" class="org">罗玉群</span>
						<span data-v-4444cd4b="">完成悬赏提现成功</span><span data-v-4444cd4b="" class="org">200.00元</span>
					</div>
					<div data-v-4444cd4b="" class="move-item ell">
						<span data-v-4444cd4b="">用户</span>
						<span data-v-4444cd4b="" class="org">李晨</span><span data-v-4444cd4b="">完成悬赏提现成功</span>
						<span data-v-4444cd4b="" class="org">50.00元</span>
					</div>
					<!---->
				</div>
			</div>
		</div>
		

  <div class="index_xslb">
        	<a href="<?php echo U('Task/lists_lb',array('lb'=>1));?>" class="index_xslb_a"></a>
        	<a href="<?php echo U('Task/lists_lb',array('lb'=>2));?>" class="index_xslb_b"></a>
            <a href="<?php echo U('Task/lists_lb',array('lb'=>3));?>" class="index_xslb_c"></a>
            <a href="<?php echo U('Task/lists_lb',array('lb'=>4));?>" class="index_xslb_d"></a>
            <a href="<?php echo U('Task/lists_lb',array('lb'=>5));?>" class="index_xslb_e"></a>
        </div>

<!-- 
		<div style="padding: 3%">
			<div class="row category">
				<?php if(is_array($cate_list)): $i = 0; $__LIST__ = $cate_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="col s3 col-5x">
						<div class="content">
							<a href="<?php echo U('Index/serach',array('cid'=>$vo['id']));?>">
								<img src="<?php echo ($vo['ico']); ?>" alt="">
								<span><?php echo ($vo['name']); ?></span>
							</a>
						</div>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
				<div style="clear: both"></div>
			</div>
		</div> -->



		<div class="b-seller segments home-chart">
			<div class="container" style="padding:3%">
				<div class="row">
					<div class="col s6 chart-child">
						<div class="col s8 ">
							<span>今日 <span>任务</span> 数</span>
							<h3>130</h3>
							<p>较昨日 <i class="fa fa-arrow-up"></i> 0.3%</p>
						</div>
						<div class="col s4">
							<img src="/Public/statics/images/2.xhs.png" alt="">
						</div>
					</div>
					<div class="col s6 chart-child">
						<div class="col s8 ">
							<span>今日 <span>用户</span> 数</span>
							<h3>130</h3>
							<p>较昨日 <i class="fa fa-arrow-down"></i> 1.3%</p>
						</div>
						<div class="col s4">
							<img src="/Public/statics/images/2.xhs.png" alt="">
						</div>
					</div>
					<div class="col s6 chart-child">
						<div class="col s8 ">
							<span>今日 <span>金额</span> 数</span>
							<h3>130</h3>
							<p>较昨日 <i class="fa fa-arrow-down"></i> 0.05%</p>
						</div>
						<div class="col s4">
							<img src="/Public/statics/images/2.xhs.png" alt="">
						</div>
					</div>
					<div class="col s6 chart-child">
						<div class="col s8 ">
							<span>今日 <span>成交</span> 数</span>
							<h3>2</h3>
							<p>较昨日 <i class="fa fa-arrow-up"></i> 0.01%</p>
						</div>
						<div class="col s4">
							<img src="/Public/statics/images/2.xhs.png" alt="">
						</div>
					</div>
					

				</div>
			</div>
		</div>

        
        <div class="index_xslb" style="display: none;">
        	<a href="<?php echo U('Task/lists_lb',array('lb'=>2));?>" class="index_xslb_a"></a>
        	<a href="<?php echo U('Task/lists_lb',array('lb'=>1));?>" class="index_xslb_b"></a>
            <a href="<?php echo U('Task/lists_lb',array('lb'=>3));?>" class="index_xslb_c"></a>
            <a href="<?php echo U('Task/lists_lb',array('lb'=>4));?>" class="index_xslb_d"></a>
            <a href="<?php echo U('Task/lists_lb',array('lb'=>5));?>" class="index_xslb_e"></a>
        </div>
        
        
        <div class="index_rwlb task_index_rwlbfl">
        	<p class="index_tjrw">推荐任务 <a href="" style="float: right;color: #9a9292;">more > 　</a></p>
        	 <?php if(is_array($task_list)): $i = 0; $__LIST__ = $task_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Task/show',array('id'=>$vo['id']));?>">
					<div class="index_rwxq">
						<img src="<?php echo ($vo["ico"]); ?>"/>

						<div class="index_wzns">
							<p class="index_title"><?php echo ($vo["title"]); ?></p>
					  		<p class="index_ffl">
								<span><?php echo ($vo["name"]); ?></span>
								<span class="index_gjrw"><?php echo ($vo["levelname"]); ?></span>
							</p>
							<p class="index_syrw">剩余数量：<span><?php echo ($vo["leftnum"]); ?></span></p>
						</div>

						<p class="index_qqq">
							<?php echo ($vo["jinbin"]); ?>喵币
							<span></span>
						</p>
					</div>
				</a><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    <!-- 底部联系部分 开始 -->
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
</div>


</body>
</html>

<script>
	//回车直接搜索
    $('#serachInput').keydown(function(e){
        if(e.keyCode==13){
            if ( $('#serachInput').val() !="") {
                var indexReload=layer.open({type: 2});
                window.location.href = '/Home/Index/serach.html'+"?key="+$('#serachInput').val();
			}
        }
    });

    // 获取弹窗
    var modal = document.getElementById('myModal');


    $(document).ready(function () {
        if(getCookie('notice')=='23'){
            modal.style.display = "none";
        }
    });

    var swiper1 = new Swiper('.swiper-banner', {
        pagination: {
            el: '.swiper-pagination',
        },
        autoplay:true
    });

//    var swiper2 = new Swiper('.swiper-roll', {
//        direction: 'vertical',
//        pagination: {
//            clickable: true,
//        },
//        autoplay: true,
//        loop:true
//    });




    // 获取 <span> 元素，用于关闭弹窗 that closes the modal
    var span = document.getElementsByClassName("close-img")[0];


    // 点击 <span> (x), 关闭弹窗
    span.onclick = function() {
        modal.style.display = "none";
        setCookie('notice',23);
    }

    // 在用户点击其他地方时，关闭弹窗
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            setCookie('notice',23);
        }
    }

    function setCookie(name,value)
    {
        var mins = 60;
        var exp = new Date();
        exp.setTime(exp.getTime() + mins*60*1000);
        document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
    }

    function getCookie(name)
    {
        var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
        if(arr=document.cookie.match(reg))
            return unescape(arr[2]);
        else
            return null;
    }


    var nStart = 10;
    var isbool = true;

    $(window).scroll(function(){
        var scrollTop = $(this).scrollTop();
        var scrollHeight = $(document).height();
        var windowHeight = $(this).height();
        if(scrollTop + windowHeight >= scrollHeight && isbool == true){
            isbool = false;
            jiazai();
        }
    });

    function jiazai(){
        if(nStart >= 61) {
            layer.open({
                content: '没有更多的任务'
                ,skin: 'msg'
                ,time: 2
            });
            return false;
        }else{
            var _this = $(".task_index_rwlbfl");
            var taskname;
            var iconame;
            var levelname;
            layer.open({
                type: 2,
                content: '加载中...'
            });
            $.post("/index.php/Home/Index/index.html",{start: nStart},function(res){
                $.each(res['info'], function(i,item){
                    _this.append('<a href="/home/Task/show/id/'+item.id+'.html">\
<div class="index_rwxq" ><img src="'+item.ico+'"/>\
<div class="index_wzns">\
<p class="index_title">'+item.title+'</p>\
<p class="index_ffl"> <span>'+item.name+' </span> <span class="index_gjrw">'+item.levelname+'</span> </p>\
<p class="index_syrw">剩余数量：<span>'+item.leftnum+'</span>/'+item.max_num+'</p>\
</div>\
<p class="index_qqq">+'+item.price+'<span></span></p>\
</div>\
</a>');
                });
                isbool = true;
                layer.closeAll();
            });
            nStart += 10;
        }
    };





//    $(document).ready(function () {
//        //幻灯片
//        var swiper = new Swiper('.swiper-container', {
//            pagination: '.swiper-pagination',
//            nextButton: '.swiper-button-next',
//            prevButton: '.swiper-button-prev',
//            paginationClickable: true,
//            spaceBetween: 30,
//            centeredSlides: true,
//            autoplay: 4000,
//            autoplayDisableOnInteraction: false
//        });
//    });
</script>