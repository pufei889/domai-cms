<aside class="sider">
    <div class="widget">
        <h4>Products</h4>
        <ul>
<?php
rand_post(5,"batching plant");
while(have_posts()){
    echo "<li><a href=\"".get_the_post_link()."\">".get_the_post_title()."</a></li>";
}
rand_post(5,"mixing plant");
while(have_posts()){
    echo "<li><a href=\"".get_the_post_link()."\">".get_the_post_title()."</a></li>";
}
rand_post(5,"crushing plant");
while(have_posts()){
    echo "<li><a href=\"".get_the_post_link()."\">".get_the_post_title()."</a></li>";
}
rand_post(5,"mobile crushing plant");
while(have_posts()){
    echo "<li><a href=\"".get_the_post_link()."\">".get_the_post_title()."</a></li>";
}
?>
        </ul>
    </div>
    <div class="widget">
    <h4>Related Posts</h4>
    <ul>
<?php
rand_post(5);
while(have_posts()){
    echo "<li><a href=\"".get_the_post_link()."\">".get_the_post_title()."</a></li>";
}
?>
    </ul>
    </div>
    <div class="widget">
        <h4>Contact US</h4>
        <p>Email: yht@camelway.net</p>
        <p>Whatsapp:008618838109566</p>
    </div>
</aside>
