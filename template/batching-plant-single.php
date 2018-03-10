<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title><?php the_title();?> - Camelway Machinery</title>
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
<div class="main">
    <article class="single">
        <header>
            <h1><?php the_title();?></h1>
        </header>
        <?php the_bread_nav();?>
        <div class="entry-content">
            <?php the_content();?>
        </div>
    </article>
    <div class="inquiry-form" id="inquiry">
        <h3>Get Support & Quotation</h3>
        <form action="//data.camelway.com/post.php" method="post">
        <p class="note">Please fill in the form below(*  are required), and we will get in touch with you as soon as possible.</p>
        <p class="name"><label for="name"><span class="required">*</span>Name:</label><input type="text" name="name" id="name" required=""></p>
        <p class="tel"><label for="tel">TEl:</label><input type="text" name="tel" id="tel"></p>
        <p class="email"><label for="email"><span class="required">*</span>Email:</label><input type="email" name="email" id="email" required=""></p>
        <p class="area"><label for="area">Area:</label><input type="text" name="country_name" id="area"></p>
        <p class="messenger"><label for="messenger">Instant Messenger:</label><select name="tel"><option value=" whatsapp:">whatsapp</option><option value=" skype:">skype</option></select><input type="text" name="tel" id="messenger"></p>
        <p class="product"><label>Product:</label>
            <input type="checkbox" name="product" value="Concrete Mixing Plant">Concrete Mixing Plant
            <input type="checkbox" name="product" value="Concrete Mixer">Concrete Mixer
            <input type="checkbox" name="product" value="Crushing Plant">Crushing Plant
            <input type="checkbox" name="product" value="Stone Crusher">Stone Crusher
            Other: <input type="text" name="product" value="">
        </p>
        <p class="details"><label><span class="required">*</span>Details:</label>
        <textarea placeholder="Please enter your detailed requirements, such as the planned capacity, applications, etc." name="message"></textarea>
        </p>
        <p class="submit"><input type="submit" value="Submit"><input type="hidden" name="url" value=""></p>
        </form>
    </div>
    <div class="related">
        <div class="posts cols-1">
        <h3>Related Posts</h3>
            <ul>
<?php
related_post(5);
while(have_related_post()){
?>
    <li><a href="<?php the_related_link()?>"><?php the_related_title();?></a></li>
<?php
}
?>
            </ul>
        </div>
        <div class="cols-3">
            <ul>
                <li><a href="/batching-plant/"><img src="/template/images/batching.jpg" alt="concrete batching plant"></a><h4>Concrete Batching Plant</h4></li>
                <li><a href="/fixed-crusher/"><img src="/template/images/crushing.jpg" alt="stone crushing plant"></a><h4>Stone Crushing Plant</h4></li>
                <li><a href="/mixing-plant/"><img src="/template/images/mixing.jpg" alt="Continuous Mixing Plant"></a><h4>Continuous Mixing Plant</h4></li>
                <li><a href="/mobile-crusher/"><img src="/template/images/mobile.jpg" alt="Mobile Crushing Plant"></a><h4>Mobile Crushing Plant</h4></li>
            </ul>
        </div>
    </div>
</div>
<div class="footer">
    <div class="text">Address: No. 466, Zheng Shang Road, Zhengzhou city China.  Email: info@camelway.com   Whatsapp:008618838109566</div>
    <div class="text"> Copyright &copy;Camelway Machinery <a href="/privacy-policy.html">Privacy Policy</a></div>
</div>
<script language="javascript" src="https://pkt.zoosnet.net/JS/LsJS.aspx?siteid=PKT10517310&lng=en&float=1"></script>
</body>
</html>
