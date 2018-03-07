<?php
/*
 *后台管理界面
 */
require_once("./auth.php");

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Simple Content Mangement System</title>
<link href="./editor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="./editor/third-party/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8" src="./editor/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="./editor/umeditor.min.js"></script>
<script type="text/javascript" src="./editor/lang/zh-cn/zh-cn.js"></script>

<style>
* {margin:0;padding:0}
html,body {width:100%;height:100%}
.left {width:200px;height:100%;float:left;margin-top:20px;text-align:center}
.right {float:left;margin-top:20px;width:calc(100% - 200px);}
.right table tr:nth-child(1) {background:#eee}
.right table {border-collapse:collapse}
.right table td {padding:5px 10px;border:1px solid #ccc}
 h1{
            font-family: "微软雅黑";
            font-weight: normal;
        }
        .btn {
            display: inline-block;
            *display: inline;
            padding: 4px 12px;
            margin-bottom: 0;
            *margin-left: .3em;
            font-size: 14px;
            line-height: 20px;
            color: #333333;
            text-align: center;
            text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
            vertical-align: middle;
            cursor: pointer;
            background-color: #f5f5f5;
            *background-color: #e6e6e6;
            background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6);
            background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6));
            background-image: -webkit-linear-gradient(top, #ffffff, #e6e6e6);
            background-image: -o-linear-gradient(top, #ffffff, #e6e6e6);
            background-image: linear-gradient(to bottom, #ffffff, #e6e6e6);
            background-repeat: repeat-x;
            border: 1px solid #cccccc;
            *border: 0;
            border-color: #e6e6e6 #e6e6e6 #bfbfbf;
            border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
            border-bottom-color: #b3b3b3;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff', endColorstr='#ffe6e6e6', GradientType=0);
            filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
            *zoom: 1;
            -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
            -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .btn:hover,
        .btn:focus,
        .btn:active,
        .btn.active,
        .btn.disabled,
        .btn[disabled] {
            color: #333333;
            background-color: #e6e6e6;
            *background-color: #d9d9d9;
        }

        .btn:active,
        .btn.active {
            background-color: #cccccc \9;
        }

        .btn:first-child {
            *margin-left: 0;
        }

        .btn:hover,
        .btn:focus {
            color: #333333;
            text-decoration: none;
            background-position: 0 -15px;
            -webkit-transition: background-position 0.1s linear;
            -moz-transition: background-position 0.1s linear;
            -o-transition: background-position 0.1s linear;
            transition: background-position 0.1s linear;
        }

        .btn:focus {
            outline: thin dotted #333;
            outline: 5px auto -webkit-focus-ring-color;
            outline-offset: -2px;
        }

        .btn.active,
        .btn:active {
            background-image: none;
            outline: 0;
            -webkit-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
            -moz-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .btn.disabled,
        .btn[disabled] {
            cursor: default;
            background-image: none;
            opacity: 0.65;
            filter: alpha(opacity=65);
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            box-shadow: none;
        }
        label {width:100px;display:inline-block}
        input[type="text"] {width:500px;height:25px;line-height:25px;margin-top:10px}
        input[type="submit"] {width:80px;height:30px;line-height:30px;margin-top:30px;}
</style>
</head>
<body>
<div class="left">
    <ul>
        <li><a href="./">内容管理</a></li>
        <li><a href="./add.php">添加管理</a></li>
    </ul>
</div>
<div class="right">
  <form action="../post.php?action=save&secret=yht123hito" method="post">
        <p><label>标题</label><input name="post_title" type="text"></p>
        <p><label>分类</label><input name="post_category" type="text"></p>
        <p><label>内容</label><br/><script type="text/plain" id="myEditor" name="post_content" style="width:1000px;height:240px;"></script></p>
        <p><input type="submit" value="提交"></p>
    </form>
</div>
<script type="text/javascript">
    var um = UM.getEditor('myEditor');
</script>
</body>
</html>
