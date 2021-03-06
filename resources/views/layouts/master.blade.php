<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>双招双引</title>
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
{{--<div id="appLoading">--}}

    {{--<div class="col-12 w-100per m-b-100 overflow-auto">--}}
        {{--<div class="w-1200 py-5 m-auto">--}}
            {{--<span><img src="/images/Spinner-1s-200px.gif" alt="loading" width="42" height="42"></span>--}}
            {{--<span style="color:#8a8e91">服务加载中...</span>--}}
        {{--</div>--}}
    {{--</div>--}}

{{--</div>--}}
<div id="app"  style="display: none">
    <app></app>
</div>
<script src="/js/app.js"></script>
</body>
</html>
