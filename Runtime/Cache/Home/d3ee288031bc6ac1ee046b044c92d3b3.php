<?php if (!defined('THINK_PATH')) exit();?><html><head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <title>积分充值</title>

    <link rel="stylesheet" href="/tpl/Public/css/share.css?2.0">
    <link rel="stylesheet" href="/tpl/Public/css/font.css?2.0">
    <link rel="stylesheet" href="/tpl/Public/css/ystep.css" type="text/css">

    <!--JQ-->

    <script type="text/javascript" src="/tpl/Public/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="/tpl/Public/js/jquery-form.js"></script>
    <script type="text/javascript" src="/tpl/Public/js/layer_mobile2/layer.js?2.0"></script>
    <link href="http://zan.0766city.com/tpl/Public/js/layer_mobile2/need/layer.css?2.0" type="text/css" rel="styleSheet" id="layermcss">
    <script type="text/javascript" src="/tpl/Public/js/swiper.3.1.7.min.js"></script>



    <script src="/tpl/Public/js/jquery.simplesidebar.js"></script>

    <script src="/tpl/Public/js/jquery.SuperSlide.2.1.1.js"></script>

    <script src="/tpl/Public/js/TouchSlide.1.0.js"></script>



    <script type="text/javascript" src="/tpl/Public/js/func.js?2.0"></script>

    <script>

        var SITE_URL  = 'https:' == document.location.protocol ?'https://' : 'http://' + "zan.0766city.com";

    </script>

    <style>
        .recharge_box {
            display: none;
            background: #eeeeee;
            border: solid 1px #dddddd;
            left: 50%;
            top: 50%;
            position: fixed;
            z-index: 999999;
            width: 300px;
            height: 180px;
            margin-left: -170px;
            margin-top: -90px;
            padding: 20px;
            color: #000;
        }
    </style>

</head>
<body><header class="top_header">

    <div class="left"><a href="javascript:" class="return go-back"></a></div>

    <div class="title">积分充值</div>

</header>



<!-- 头部部分 开始 -->
<div class="z-line-header">0.00  <span class="flex number-text">账户积分</span>
    <span style="font-size: 12px; margin: 1% 0px;">1积分=1现金</span>
</div>
<!--主体部分 开始-->

<div class="rech_main">
    <h6>请选择充值金额</h6>
    <ul>
        <li data-price="30"><a href="javascript:void(0)">30元</a></li>
        <li data-price="50"><a href="javascript:void(0)">50元</a></li>
        <li data-price="100"><a href="javascript:void(0)">100元</a></li>
    </ul>

    <form id="form1" class="" data-callback="1" name="form1" method="post" action="">

        <div class="rech_sea">
            <span class="money">自定义金额：</span><input id="price" type="text" name="price" id="price" placeholder="充值金额">
        </div>
    </form></div>



<div class="recharge_box" style="text-align:center">
    <label> 请选择以下支付方式</label>

    <input type="hidden" name="payment_type" id="payment_type" value="">
    <!--<p>选择支付方式：</p>-->
    <label data-key="alipay">
        <i class="alipay"></i> 支付宝支付 <span></span>
    </label>
     <label data-key="wxpay">
        <i class="wxpay"></i> 微信支付 <span></span>
    </label>
    <label style="padding:0">*如需帮助，可联系客服人工充值</label>
    <button type="button" class="cancel vip_lijisj">取消</button>
    <button type="submit" id="submit" class="chongzhi vip_lijisj">在线支付</button>
</div>




<!--按钮分区 开始-->
<div class="pay-menu">
    <div class="rech_botton">
        <a href="javascript:void(0)" class="blue_btn recharge_btn">
            确定充值
        </a>
    </div>
</div>

<form style='display:none;' id='formpay' name='formpay' method='post' action='https://pay.paysapi.com'>
    <input name='goodsname' id='goodsname' type='text' value='' />
    <input name='istype' id='istype' type='text' value='' />
    <input name='key' id='key' type='text' value=''/>
    <input name='notify_url' id='notify_url' type='text' value=''/>
    <input name='orderid' id='orderid' type='text' value=''/>
    <input name='orderuid' id='orderuid' type='text' value=''/>
    <input name='price' id='prices' type='text' value=''/>
    <input name='return_url' id='return_url' type='text' value=''/>
    <input name='uid' id='uid' type='text' value=''/>
    <input type='submit' id='submitdemo1'>
</form>
<script>
    $(function(){
        /*金额数值 切换*/
        $('.rech_main li').click(function(){
            $(this).css("background-color","#4eaf00").children().css("color","#fff");
            $(this).siblings().css("background-color","#704eea").children().css("color","#fff");
            $('#price').val($(this).attr('data-price'));
        });


        $('.recharge_box label').click(function(){
            $('.recharge_box label span').removeClass('active');
            $(this).find('span').addClass('active');
            var payment_type = $(this).attr('data-key');
            $('#payment_type').val(payment_type);
        });

        $('.cancel').click(function () {
            $('.recharge_box').hide();
        });




        $('.chongzhi').click(function(){
            var  type   = $('#payment_type').val();
        if(!type||type=='alipay'){
            type    =   1;
        }else{
            type    =   2;
        }

            $.post(
                "/pay/pay.php",
                {
                    price : $("#price").val(),
                    istype : type,

                },
                function(data){
                    if (data.code > 0){
                        $("#goodsname").val(data.data.goodsname);
                        $("#istype").val(data.data.istype);
                        $('#key').val(data.data.key);
                        $('#notify_url').val(data.data.notify_url);
                        $('#orderid').val(data.data.orderid);
                        $('#orderuid').val(data.data.orderuid);
                        $('#prices').val(data.data.price);
                        $('#return_url').val(data.data.return_url);
                        $('#uid').val(data.data.uid);
                        $('#submitdemo1').click();

                    } else {
                        alert(data.msg);
                    }
                }, "json"
            );


        })




        $('.recharge_btn').click(function(){
            var price = $('#price').val();
            if(price==''){
                sp_tip('请选择充值金额');
                return false;
            }
            if(isNaN(price)){
                sp_tip('价格必须为数字');
                return false;
            }
            if( price < 0){
                sp_tip('价格必须大于0');
                return false;
            }
            $('.recharge_box').show();
        })
    })
</script></body></html>