<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name = "viewport" content = "width = device-width,user-scalable = no, inital-scale = 1，maximum-scale = 1 minium-scal = 1">

    <title>跳转提示</title>
    <bootstrapcss />

    <style>
        @media only screen and (max-width: 760px) {
            .bjy-public-jump{
                width:96%;
                margin:2%;
            }
        }
    </style>
</head>
<body>

<div class="xb-h-100"></div>
<div class="xb-out">
    <ul class="bjy-public-jump">
        <li class="bjy-pj-word">
            <b>{$message}{$error}</b>
        </li>
        <li class="bjy-pj-word">
            页面将在<b id="wait">{$waitSecond}</b>秒后<a id="href" href="{$jumpUrl}">跳转</a>
        </li>
    </ul>
</div>

<bootstrapjs />
<script type="text/javascript">
(function(){
    var wait = document.getElementById('wait'),href = document.getElementById('href').href;
    var interval = setInterval(function(){
        var time = --wait.innerHTML;
        if(time <= 0) {
            location.href = href;
            clearInterval(interval);
        };
    }, 1000);
})();
</script>
</body>
</html>