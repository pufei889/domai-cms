<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
<?php the_amp_html();?>
<title><?php
if(is_home()){
     echo sitename;
}else if(is_category()){
    the_category();
}else if(is_single()){
    the_title();
}
?></title>
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" type="text/css" href="/template/style.css" media="all">
</head>
<body>
<div class="primary-header">
    <div class="inner-primary-header">
    <nav class="headnav" id="headnav">
        <a href="#headnav" class="menubar">&#xe5d2;</a>
        <a href="/chat.html">Online Inquiry</a>
        <a href="/chat.html">Get Price</a>
        <a href="/">Home</a>
        <a href="/batching-plant/">Concrete Batching Plant</a>
        <a href="/crushing-plant/">Stone Crushing Plant</a>
        <a href="/mixing-plant/">Continuous Mixing Plant</a>
        <a href="/about-us.html">ABout us</a>
        <a href="/contact-us.html">Contact Us</a>
    </nav>
    </div>
</div>
<header class="master">
    <div class="inside">
            <a href="/"><img src="/template/images/logo.png" alt="logo" class="logo"></a>
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
