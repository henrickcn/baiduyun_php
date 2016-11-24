<?php
/**
 * Created by PhpStorm.
 * User: henrick
 * Date: 2016/11/24 0024
 * Time: 21:35
 */
?>

<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="百度网盘搜索|网盘搜索|百度云搜索">
    <meta name="keywords" content="百度网盘搜索，搜索百度网盘资源">
    <meta name="author" content="henrick">

    <title>百度网盘搜索引擎</title>

    <!-- Bootstrap core CSS -->
    <link href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="resource/js/bootstrap.autocomplete.js"></script>
    <style>
        body {
            font-family: "Helvetica Neue", Helvetica, Microsoft Yahei, Hiragino Sans GB, WenQuanYi Micro Hei, sans-serif;
        }

        .bs-example:after {
            content: "实例：" !important;
        }

        .bs-docs-section > p, .bs-docs-section > ul,
        .bs-docs-section > ol, .bs-callout > p,
        .bs-callout > ol, .bs-callout > ul {
            font-size: 16px;
            line-height: 1.75;
            margin-bottom: 1em;
        }

        .bs-callout *:last-child {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">百度网盘搜索</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">首页</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div class="container" style="margin-top: 180px;">
    <div class="row">
        <div class="col-md-12 text-center">
            <img src="resource/img/logo.png" alt="">
        </div>
    </div>
    <div class="row" style="margin-top: 50px;">
        <form class="form-horizontal" role="form" action="so.php">
            <div class="form-group">
                <div class="col-md-4 col-md-offset-4 col-xs-offset-1 col-xs-6">
                    <input id="autocompleteInput" autocomplete="off" name="k" type="search" class="form-control" placeholder="请输入关键字">
                </div>
                <button type="submit" class="col-md-1 btn btn-success">搜素资源</button>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group text-center">
                <label for="" style="color: red;line-height: 1.7em;">申明：本站资源采集于网络，对搜索结果不做任何的正确性确认。</label>
            </div>
        </div>
    </div>
</div>
<script>
    var auto,process_obj;
    window.baidu = {
        sug: function (o) {
            console.log(o.s);
            process_obj(o.s);
            return o;
        }
    }

    $(function () {
        auto = $('#autocompleteInput').autocomplete({
            source:function(query,process){
                process_obj = process;
                var time = (Date.parse(new Date()))/1000;
                $.ajax({
                    url: 'http://suggestion.baidu.com/su?wd='+query+'&sc=hao123&t='+time,
                    dataType: 'jsonp',
                    jsonp: 'jsoncallback',
                    success: function (data) {
                        console.log(data);
                    }
                });
            },
            formatItem:function(item){
                return item;
            },
            setValue:function(item){
                console.log(item);
                return {'data-value':item,'real-value':item};
            }
        });
        var time = (new Date().getTime())/1000;

    });
</script>
</body>
</html>
