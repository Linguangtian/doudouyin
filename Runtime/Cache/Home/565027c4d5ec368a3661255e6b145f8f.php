<?php if (!defined('THINK_PATH')) exit();?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <title>注册</title>
    <script type="text/javascript" src="/tpl/Public/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="/tpl/Public/js/jquery-form.js"></script>
    <script type="text/javascript" src="/tpl/Public/js/layer_mobile2/layer.js"></script>
    <script type="text/javascript" src="/tpl/Public/js/func.js"></script>
    <style>
        html,body,div,p,form,label,ul,li,dl,dt,dd,ol,img,button,b,em,strong,small,h1,h2,h3,h4,h5,h6{margin:0;padding:0;border:0;list-style:none;font-style:normal;}
        body{font-family:SimHei,'Helvetica Neue',Arial,'Droid Sans',sans-serif;font-size:14px;color:#333;background:#f2f2f2;}
        a, a.link{color:#666;text-decoration:none;font-weight:500;}
        a, a.link:hover{color:#666;}
        h1,h2,h3,h4,h5,h6{font-weight: normal;}
        body{
            background:url(/tpl/Public/images/login-bg.png) no-repeat;
            background-size: 100% auto;
            /*background: #58afbd;*/
        }
        .login{}
        .welcome{width:100%;margin:7% 0 7% 0;text-align: center;}
        .welcome img{}
        .login-inp{margin:0 30px 15px 30px;border:1px solid #fff;border-radius:25px;}
        .login-inp label{text-align:center;display:inline-block;color:#fff;margin-left:10px}
        .login-inp input{line-height:40px;color:#fff;background-color:transparent;border:none;outline: none;}
        .login-inp .submit{display:block;background:none;width:100%;text-align:center;line-height:40px;color:#fff;font-size:16px;letter-spacing:5px;}
        .login-txt{text-align:center;color:#fff;}
        .login-txt a{color:#fff;padding:0 5px;}
      	#code { width: 40%;font-size:12px;}
      	#username {font-size:12px;}
      	#nickname{font-size:12px;}
      	#password{font-size:12px;}
      	#repassword{font-size:12px;}
     	#invite_code{font-size:12px;}
      	.footer li{background-color:transparent}
      	.footer li span{display:inline}
      	.footer li span i{marginn-top: 0;}

        /*新加*/
        .reg_tab{text-align: center;padding-bottom: 10px;
            -moz-box-shadow:0px -10px 11px #333333; -webkit-box-shadow:0px -10px 11px #bdbcbc; box-shadow:0px -10px 11px #bdbcbc;
            border-radius: 0;
            margin:0 20px 15px 20px;
            padding-top: 10px;;
        }
        .reg_tab a{  font-size: 16px;
            display: inline-block;
            width:48%; }
        .reg_tab a.active{ color: #704eea; }
    </style>
</head>

<body style="background: #fff;">
<div class="login">
    <div class="welcome"><img src="<?php echo ($sys_config["web_logo"]); ?>" style="width: 108px;height: 108px;display: block;margin: 0 auto;"></div>

    <div class="reg_tab login-inp" data-tab="email">
        <a class="email active" >邮箱注册</a>
        <a class="phone " >手机号注册</a>
    </div>



    <div class="login-form">
        <form class="submit-ajax" action="<?php echo U('reg');?>">


            <!-- // TODO 修改注册-->
            <div class="reg_email">
                <div class="login-inp" style="background: #f4f4f4;border: none;">
                    <label style="color: #999;">注册账号</label>
                    <input type="text" name="username_email" id="username" placeholder="请输入可用邮箱" style="color: #999;">
                </div>

                <div class="login-inp" style="background: #f4f4f4;border: none;">
                    <label style="color: #999;">验证码</label>
                    <input type="text" name="code_email" id="code_email" placeholder="请输入邮箱验证码" style="color: #999;">
                    <input type="button" id="getcode_email" value="发送验证码" style="background:#704eea; color:#FFF; border-radius:5px; height:30px; line-height:30px;" />
                </div>
            </div>

            <div class="reg_phone" style="display: none">
                <div class="login-inp" style="background: #f4f4f4;border: none;">
                    <label style="color: #999;">注册账号</label>
                    <input type="text" name="username" id="username_phone" placeholder="请输入手机号" style="color: #999;">
                </div>

                <div class="login-inp" style="background: #f4f4f4;border: none;">
                    <label style="color: #999;">验证码</label>
                    <input type="text" name="code" id="code" placeholder="请输入手机验证码" style="color: #999;">
                    <input type="button" id="getcode" value="发送验证码" style="background:#704eea; color:#FFF; border-radius:5px; height:30px; line-height:30px;" />
                </div>
            </div>
            <!-- // TODO 修改注册-->
           

        
        <div class="login-inp" style="background: #f4f4f4;border: none;">
        	<label style="color: #999;">您的姓名</label>
        	<input type="text" name="nickname" id="nickname" placeholder="请输入姓名"  style="color: #999;">
        </div>
        
        
        <div class="login-inp" style="background: #f4f4f4;border: none;">
        	<label style="color: #999;">登录密码</label>
        	<input type="password" name="password" id="password" placeholder="请输入密码" class="password" style="color: #999;">
        </div>
        
        <div class="login-inp" style="background: #f4f4f4;border: none;">
        	<label style="color: #999;">确认密码</label>
        	<input type="password" name="repassword" id="repassword" value="" class="password" placeholder="重新输入密码" style="color: #999;">
        </div>
        
        <div class="login-inp" style="background: #f4f4f4;border: none;display:block;">
        	<label style="color: #999;">邀请码</label>
        	<input type="text" name="invite_code" id="invite_code" value="<?php echo ($invite_code); ?>" placeholder="没有可不填" style="color: #999;">
        </div>
        
        <p style="margin-top: -5px;margin-bottom: 10px;width: 80%;margin-left: 10%;font-size: 10px;color: #a196c4;">*密码需右英文与字母组成，最少6位</p>
        
        <div class="login-inp" style="border: none;background: #704eea;">
        	<button type="submit" class="submit">立即注册</button>
        </div>
        
        </form>
    </div>
   
   <a href="<?php echo U('login');?>">
        	<p style="width: 150px;height: 60px;line-height: 60px;margin: 20px auto 0; color: #704eea; "> <span style="width: 20px;height: 20px;border: 1px #704eea solid;display: inline-block;margin: 20px 6px 20px 40px;text-align: center;float: left;line-height: 20px;border-radius: 20px;text-align: center;color: #704eea;">→</span> 去登陆</p>
        </a>
   
</div>
</body>
</html>

<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
    $('.reg_tab a').click(function () {
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
        if( $(this).hasClass('email')){
            $('.reg_tab').attr('data-tab','email');
            $('.reg_email').show();
            $('.reg_phone').hide();
        }else{
            $('.reg_tab').attr('data-tab','phone');
            $('.reg_email').hide();
            $('.reg_phone').show();
        }
    });
 
   function daojishi( t,type )
  {

      if (type ==1 ){
          var intv = setInterval( function(){
              t--;
              if( t > 0 )
              {
                  $("#getcode").attr('disabled', 'disabled');
                  $("#getcode").val( t +'秒获取');
              }
              else
              {
                  $("#getcode").attr('disabled', false );
                  $("#getcode").val( '获取验证码');
                  clearInterval(intv);
              }
          }, 1000);
      }else{
          var intv = setInterval( function(){
              t--;
              if( t > 0 )
              {
                  $("#getcode_email").attr('disabled', 'disabled');
                  $("#getcode_email").val( t +'秒获取');
              }
              else
              {
                  $("#getcode_email").attr('disabled', false );
                  $("#getcode_email").val( '获取验证码');
                  clearInterval(intv);
              }
          }, 1000);
      }

  }
  	$(document).ready(function(){
  	    //加载layer

    	$("#getcode").click(function(){
        	var username = $.trim( $("#username_phone").val() );
          	if( username == ''  )
            {
                alert_fang('请输入手机号码！');
               return false;
            }
          	if( username.length != 11 )
            {
                alert_fang('手机号码不正确！');
            	return false;
            }

            var indexLoad1 = layer.open({
                type: 2
                ,content: '邮件发送中...'
            });
          	$.get( "<?php echo U('getcode');?>",{tel:username},function( res ){
                    alert_fang(res.msg);
              		//alert( res.msg );
            		if( res.code == 1 )
                    {
                    	daojishi( 60,1 );
                    }
                layer.close(indexLoad1)
            } , 'json')

        }) ;
        $("#getcode_email").click(function(){
            var username = $.trim( $("#username").val() );
            if( username == ''  )
            {
                alert_fang('请输入邮箱！');
                return false;
            }
            var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
            isok= reg.test(username );
            if (!isok) {
                alert_fang('邮箱格式不正确，请重新输入！');
                return false;
            }

            var indexLoad2 = layer.open({
                type: 2
                ,content: '邮件发送中...'
            });
            $.get( "<?php echo U('getcode_email');?>",{tel:username,email:1},function( res ){
                //alert( res.msg );
                alert_fang(res.msg);
                if( res.code == 1 )
                {
                    daojishi( 60,2 );
                }
                layer.close(indexLoad2)
            } , 'json')

        });
    });
   function alert_fang(msg) {
       layer.open({
           content: msg
           ,skin: 'msg'
           ,time: 2 //2秒后自动关闭
       });
   }
    Wechat.share({
        message: {
            title: "Hi, here",
            description: "That is description.",
            thumb: "http://bb.szwaesheji.com/tpl/Public/images/logo.png",
            mediaTagName: "TEST-TAG-002",
            messageExt: "这是第三方带的测试字段ddd",
            messageAction: "<action>dotalist</action>",
            media: {
                type: Wechat.Type.WEBPAGE,
                webpageUrl: "http://bb.szgyesheji.com/"
            }
        },
        scene: Wechat.Scene.TIMELINE   // share to Timeline
    }, function (data) {
        alert("Success"+JSON.stringify(data));
    }, function (reason) {
        alert("Failed: " + JSON.stringify(reason));
    });
</script>