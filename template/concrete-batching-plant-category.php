<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title><?php the_category();?> - Page <?php echo $page?>- Camelway Machinery</title>
<link rel="stylesheet" type="text/css" media="all" href="/template/style/style.css"/>
</head>
<body>
<div class="head">
    <div class="menu">
        <a href="/"><img src="/template/images/logo.png" alt="logo" class="logo"></a>
        <nav>
            <a href="/">Home</a>
            <a href="/batching-plant/">Concrete Batching Plant</a>
            <a href="/stone-crusher/">Stone Crusher</a>
            <a href="/mobile-crusher/">Mobile Crusher</a>
            <a href="/about.html">ABout Us</a>
        </nav>
    </div>
</div>
<div class="content">
    <header class="category-header">
        <h1><?php the_category();?></h1>
    </header>
    <p class="intro">Camelway Machinery has produced concrete batching plant for over 30 years as a leading manufacturer of the industry. In overseas markets, we have the delivery record of over 20 countries. Camelway's  HZS series <strong>concrete batching plant</strong> based on modular structure and its easy operation and maintenance received a high evaluation from users. Camelway can offer the complete range of batching plants starting with a capacity of 25 m³/h upt t240 0 m³/h. All plant types are available like horizontal or tower plant, plants with wet and dry output leg and also mobile plants for easy erection and dismantling.</p>
    <?php
    while(have_posts()){
    ?>
        <article id="post-<?php the_post_id()?>" class="post">
            <header>
                <h2><a href="<?php the_post_link()?>"><?php the_post_title();?></a></h2>
            </header>
            <div class="entry-content">
                <img src="<?php the_rand_image(get_the_post_title());?>" alt="<?php the_post_title();?>" class="thumb">
                <?php the_post_description();?>
                <a href="<?php the_post_link();?>" class="viewmore">Read More</a>
            </div>
        </article>
    <?php
    }
    ?>
    <div class="pages">
        <?php the_paging_nav();?>
    </div>
</div>
<div class="footer">
    <div class="text">Address: No. 466, Zheng Shang Road, Zhengzhou city China.  Email: info@camelway.com   Whatsapp:008618838109566</div>
    <div class="text"> Copyright &copy;Camelway Machinery <a href="/privacy-policy.html">Privacy Policy</a></div>
</div>
<script language="javascript" src="https://pkt.zoosnet.net/JS/LsJS.aspx?siteid=PKT10517310&lng=en&float=1"></script>
</body>
</html>
