<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/24 0024
 * Time: 21:37
 */
   $key = $_GET['k'] ? $_GET['k']:'';
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

    <title>百度网盘搜索引擎-搜索<?php echo $key;?>的结果</title>

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

        #searchList ul,#searchList ul li{list-style: none;margin: 0px;padding: 0px;}
        #searchList ul li{background: #eeeeff;margin-bottom: 10px;padding: 15px;border-radius: 10px;}
        #searchList ul li .title{padding: 10px 0;font-size: 18px;font-weight: bold;}
        #searchList ul li .content{line-height: 1.7em;}
    </style>
</head>
<body>
<div style="background: #EFEFEF;padding: 20px;">
    <a href="index.php">
        <img src="resource/img/logo.png" alt="">
    </a>
</div>
<div style="padding: 20px;">
    <form class="form-horizontal" role="form" action="so.php">
        <div class="form-group">
            <div class="col-md-4 col-xs-6">
                <input id="autocompleteInput" value="<?php echo $key;?>" autocomplete="off" name="k" type="search" class="form-control" placeholder="请输入关键字">
            </div>
            <button type="submit" class="col-md-1 btn btn-success">搜素资源</button>
        </div>
    </form>
</div>
<div style="padding: 0px 20px 20px 20px;" id="searchList">

</div>
<div id="loading" style="display: none;">
    <p>
        <img src="resource/img/spin.gif" alt="" width="30">
        正在努力的加载中...
    </p>
</div>
<div style="padding: 0px 20px 20px 20px;">
    <nav>
        <ul class="pagination">
            <li><a href="javascript:;" onclick="prevPage()">&laquo;上一页</a></li>
            <li><a href="javascript:;" onclick="nextPage()">下一页&raquo;</a></li>
        </ul>
    </nav>
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

    var start = 0;

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
        getSearch();
    });

    function getSearch() {
        var outhtml = $("#loading").html();
        $("#searchList").html(outhtml);
        var time = (Date.parse(new Date()))/1000;
        $.ajax({
            url: "http://pan1234.com/server3?jsoncallback=result&q=<?php echo $key;?>&start="+start+"&_="+time,
            dataType: 'jsonp',
            jsonp: 'result',
            success: function (data) {}
        });
    }

    function nextPage() {
        getSearch();
    }

    function prevPage() {
        start = start-2;
        getSearch();
    }

    function result(o) {
        var outhtml = "<ul>";
        $.each(o,function (index) {
            outhtml+="<li>" +
                "<div class='title'><a target='_blank' href='"+o[index].unescapedUrl+"'>"+o[index].title+"</a></div>" +
                "<div class='content'>"+o[index].content+"</div></li>";
        })
        outhtml += "</ul>";
        start++;
        $("#searchList").html(outhtml);
    }
</script>
</body>
</html>
