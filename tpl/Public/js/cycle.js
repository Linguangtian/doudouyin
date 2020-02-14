// JavaScript Document

//created by zcy 20161011

;(function ($, window, document, undefined) {

    //默认参数var this.PARAMS;

    var plugin = function (ele, opt) {

        this.parent = ele;

        this.defaults = {percent: 100, w: 500, oneCircle: "false"};

        //初始化参数

        this.PARAMS = $.extend({}, this.defaults, opt);

        this.DrawCircle();

    }

    //定义方法

    plugin.prototype = {

        DrawCircle: function () {


            if (!canvasSupport()) {

                return

            }

            var drawOne = this.PARAMS.oneCircle;

            var r = this.PARAMS.w / 2;

            var r1 = this.PARAMS.w / 2 - 20;

            var x1 = this.PARAMS.w / 2;

            var y1 = this.PARAMS.w / 2;

            var canvas = this.parent[0];

            var tip = this.PARAMS.percent;

            var angle = "";

            var init = 0;

            var initA = 0;

            var preM = 0;

            var initM = 0;  //因为是半圆  所以初始角度是Math.PI;

            var s = 2 * Math.PI / 180;

            var bottomC = Math.PI;

            var allCount = 180;

            var allCountP = 1.8;

            var poinits = new Array();

            if (drawOne == "ture") {

                angle = tip * 2 * Math.PI / 100;

                canvas.width = this.PARAMS.w;

                canvas.height = this.PARAMS.w;

                bottomC = 2 * Math.PI;

                allCount = 0;

                allCountP = 3.6;

            } else {

                angle = tip * Math.PI / 100 + Math.PI;

                canvas.width = this.PARAMS.w;

                canvas.height = this.PARAMS.w / 2;

                init = 180;

                preM = Math.PI;

                initM = Math.PI;  //因为是半圆  所以初始角度是Math.PI;

                s = 2 * Math.PI / 180;

            }

            var cxt = canvas.getContext("2d");

            //cxt.lineCap="round";

            cxt.lineWidth = 6;

            var speed = 1;

            var radius = this.PARAMS.w / 2 - 2;

            var ball = {x: 0, y: 0, speed: 2};

            var T1;

            function drawScreen() {

                cxt.fillStyle = "#6143d5";

                cxt.fillRect(0, 0, canvas.width, canvas.height);

                //创建圆环与虚线

                //底圆

                cxt.beginPath();

                cxt.strokeStyle = "#ffaa02";

                cxt.arc(x1, y1, r1 - 6, 0, bottomC, true);

                cxt.stroke();  //先执行stroke  就不会出现横线

                cxt.closePath();

                //虚线

                var balls = [];

                var balls = new Array();

                for (var i = initA; i <= 360; i += ball.speed) {

                    var radians = (i) * (Math.PI / 180);

                    ball.x = x1 + Math.cos(radians) * radius;

                    ball.y = y1 + Math.sin(radians) * radius;

                    balls.push({x: ball.x, y: ball.y});

                }

                for (var i = 0; i < balls.length; i++) {

                    cxt.fillStyle = "#a7a7a7";

                    cxt.beginPath();

                    cxt.arc(balls[i].x, balls[i].y, 1, 0, Math.PI * 2, false);

                    //console.log(balls[i].x)

                    cxt.closePath();

                    cxt.fill();

                }

                //画实线

                if (initM < angle) {

                    initM += s;

                } else {

                    initM = angle;

                }

                cxt.beginPath();

                cxt.strokeStyle = "#fff";

                cxt.arc(x1, y1, r1 - 6, 0, initM, false);

                cxt.stroke();  //先执行stroke  就不会出现横线

                cxt.closePath();

                //画虚线

                if (init < tip * allCountP + allCount) {  //小于初始角度

                    init += ball.speed

                } else {

                    clearInterval(T1);

                }

                for (var i = initA; i <= init; i += 2) {

                    var radians2 = i * (Math.PI / 180);

                    var a1 = x1 + Math.cos(radians2) * radius;

                    var a2 = y1 + Math.sin(radians2) * radius;

                    cxt.fillStyle = "#fff";

                    cxt.beginPath();

                    cxt.arc(a1, a2, 1, 0, Math.PI * 2, false);

                    //console.log(balls[i].x)

                    cxt.closePath();

                    cxt.fill();

                }

                //百分比文字

                cxt.font = "20px microsoft yahei";

                cxt.textBaseline = "middle";

                cxt.textAlign = "center";

                cxt.fillStyle = "#fff";

                var messT = tip * initM / angle;

                /*if(drawOne!="ture"){

                     messT=tip*(initM)/angle;

                     console.log(initM-Math.PI)

                    }*/

                if (messT > tip) {

                    messT = tip

                }

                // var mess = messT.toFixed(2) + "%";

                // cxt.fillText(mess, canvas.width / 4, canvas.height / 4);

            }

            //


            T1 = setInterval(drawScreen, 30)

        }

    }

    function canvasSupport() {

        //判断是否支持canvas标签

        return Modernizr.canvas;

    }

    //在插件中使用plugin对象

    $.fn.audios2 = function (options) {

        //创建实体

        var plugina = new plugin(this, options);

    }

})(jQuery, window, document);



