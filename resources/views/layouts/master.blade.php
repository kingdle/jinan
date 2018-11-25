<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>青岛乾通源物流有限公司</title>
    <link rel="stylesheet" href="/css/app.css">
    <style media="screen" type="text/css">
        #appLoading {
            width: 100%;
            height: 100%;
            background: url("/images/index-background.jpg") no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            min-height: 1200px;
        }
        #appLoading .navbar{
            background-color: #fff;
            filter:alpha(opacity=80);
            -moz-opacity:0.8;
            -khtml-opacity: 0.8;
            opacity: 0.8;
        }
        #appLoading h7 {
            color: #f06307;
            margin: 30px 0;
        }
        .explain{
            font-size: 18px;
            color: #000000;
            padding: 30px;
            text-align: left;
            text-indent: 2em;
            background-color: #d6dee2;
            border-radius: 5px;
            filter:alpha(opacity=80);
            -moz-opacity:0.8;
            -khtml-opacity: 0.8;
            opacity: 0.8;
        }
        .company{
            margin-top: 10%;
            font-size: 42px;
            color: #fff;
        }
        .weixin{
            font-size: 28px;
            color: #fff;
            padding:20px 0;
        }
        .code{
            padding-top:30px;
        }
        #appLoading .text-muted{
            color: #fff !important;
        }
    </style>

</head>
<body>
<div id="appLoading">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container-fluid px-0">
            <div class="navbar-header">
                <a href="/" class="navbar-brand" exact>
                    <img src="/images/logo-sm.png" alt="仓储物流管理系统" width="260" height="50">
                </a>

            </div>
            <div class="float-right">
                <span><img src="https://images.veg.kim/pc/Spinner-1s-200px.gif" alt="loading" width="42" height="42"></span>
                <span style="color:#8a8e91">服务加载中...</span>
            </div>
        </div>
    </nav>
    <div class="col-12 w-100per m-b-100 overflow-auto">
        <div class="w-1200 py-5 m-auto">
            <h2 class="text-center company">
                青岛乾通源物流有限公司
            </h2>
            <div class="my-0">
                <div class="text-center">
                        <img class="code" style="width:288px;"
                             src="">
                    <h5 class="weixin">智能服务，承诺您的每一份嘱托</h5>
                    {{--<div class="explain">--}}
                        {{--<p>--}}
                            {{--平台由青岛乾通源物流有限公司运作，公司坐落于青岛保税区，成立于2006年10月，注册资金人民币1500万元，总投资人民币4000万元。公司为客户提供基于保税功能的保税仓储、物资分拨、运输配送、贸易代理、国际货代等综合物流服务。本公司占地22000平方米，仓储面积13000多平方米，拥有先进的硬件设备、软件服务及安全设施。我公司有着多种货物作业及仓储的实际案例及经验，可以为客户提供各种大宗散货、标准货物的仓储和作业。--}}
                        {{--</p>--}}
                    {{--</div>--}}
                    <div class="row">
                        <div class="link col-12 text-center">
                            <a class="text-muted" href="http://www.hlqgroup.com">技术支持：青岛苗果智能科技有限公司</a>
                            <p class="mb-3 text-muted">© 1996-2018</p>
                            <p class="mb-5 text-muted">备案号：鲁ICP备14021000号-1</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
<div id="app"  style="display: none">
    <app></app>
</div>
<script src="/js/app.js"></script>
</body>
</html>
