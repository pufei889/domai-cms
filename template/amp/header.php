<!DOCTYPE HTML>
<html amp lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,user-scalable=no">
<?php the_amp_canonical();?>
<title><?php
if(is_home()){
    echo sitename;
}else if(is_category()){
    the_category();
}else if(is_single()){
    the_title();
}
?></title>
<script async src="https://cdn.ampproject.org/v0.js"></script>
<script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
<script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.1.js"></script>
<script async custom-element="amp-bind" src="https://cdn.ampproject.org/v0/amp-bind-0.1.js"></script>
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
<style amp-custom><?php importcss("../style.css");?></style>
</head>
<body>
<div class="primary-header">
    <div class="inner-primary-header">
    <nav class="headnav" id="headnav">
        <a href="#headnav" class="menubar">&#xe5d2;</a>
        <a href="/chat.html" target="_blank">Online Inquiry</a>
        <a href="/chat.html" target="_blank">Get Price</a>
        <a href="/?amp">Home</a>
        <a href="/batching-plant/amp/">Concrete Batching Plant</a>
        <a href="/crushing-plant/amp/">Stone Crushing Plant</a>
        <a href="/mixing-plant/amp/">Continuous Mixing Plant</a>
        <a href="/amp/about-us.html">ABout us</a>
        <a href="/amp/contact-us.html">Contact Us</a>
    </nav>
    </div>
</div>
<header class="master">
    <div class="inside">
            <a href="/?amp"><amp-img src="/template/images/logo.png" alt="logo" class="logo" layout="fixed" width=150 height=73></amp-img></a>
            <a href="mailto:zziavip@gmail.com" class="email">zziavip@gmail.com</a>
    </div>
</header>
<main role="main">
    <nav class="productnav">
        <a href="#productnav" class="productbar">&#xe5d2;</a>
        <ul id="productnav">
            <li><a href="/batching-plant/">Concrete Batching Plant</a>
                    <ul>
<?php
rand_post(10,"batching plant");
while(have_posts()){
    echo "<li><a href=\"".get_the_post_link()."\">".get_the_post_title()."</a></li>";
}
?>
                    </ul>
            </li>
            <li><a href="/mixing-plant/">Continuous Mixing Plant</a>
                    <ul>
<?php
rand_post(10,"mixing plant");
while(have_posts()){
    echo "<li><a href=\"".get_the_post_link()."\">".get_the_post_title()."</a></li>";
}
?>
                    </ul>
            </li>
            <li><a href="/crushing-plant/">Stone Crushing Plant</a>
                    <ul>
<?php
rand_post(10,"crushing plant");
while(have_posts()){
    echo "<li><a href=\"".get_the_post_link()."\">".get_the_post_title()."</a></li>";
}
?>
                    </ul>
            </li>
            <li><a href="/mobile-crushing-plant/">Mobile Crushing Plant</a>
                <ul>
<?php
rand_post(10,"mobile crushing plant");
while(have_posts()){
    echo "<li><a href=\"".get_the_post_link()."\">".get_the_post_title()."</a></li>";
}
?>
                </ul>
            </li>
        </ul>
    </nav>
